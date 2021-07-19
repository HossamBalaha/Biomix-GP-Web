<?php

namespace App\Http\Controllers;

use App\Models\Token;
use App\Models\UserSensor;
use App\Models\UserSensorReading;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class UserAPIController extends Controller
{
    public function storeSensorReading()
    {
        $rules = [
            'token' => 'required|min:1|max:150|exists:tokens,token',
            'sensor' => 'required|integer|min:1|max:99999|exists:user_sensors,id',
            'reading' => 'required|numeric|min:-9999|max:9999',
        ];

        $validator = Validator::make(request()->all(), $rules);
        if ($validator->fails()) {
            $errors = $validator->errors()->all(); //toArray();
            return response()->json([
                'is_completed' => false,
                'errors' => $errors,
                'data' => null,
            ]);
        } else {
            try {
                return DB::transaction(function () {
                    $token = Token::whereToken(request()->get('token'))->first();
                    if ($token) {
                        if (!$token->is_online) {
                            $token->is_online = true;
                            $token->save();
                        }
                        $userSensor = UserSensor::find(request()->get('sensor'))->first();
                        if ($userSensor) {
                            $newRecordID = UserSensorReading::latest()->orderBy('id', 'DESC')->first();
                            $newRecordID = $newRecordID ? ($newRecordID->id + 1) : 1;
                            $newReading = new UserSensorReading();
                            $newReading->id = $newRecordID;
                            $newReading->user_sensor_id = $userSensor->id;
                            $newReading->reading = request()->get('reading');
                            $isStored = $newReading->save();

                            if ($isStored) {
                                $data = [
                                    "message" => "Sensor reading is stored successfully."
                                ];
                                return response()->json([
                                    'is_completed' => true,
                                    'errors' => null,
                                    'data' => $data,
                                ]);
                            } else {
                                $errors = ['Something went wrong. Try again later.'];
                                return response()->json([
                                    'is_completed' => false,
                                    'errors' => $errors,
                                    'data' => null,
                                ]);
                            }
                        } else {
                            $errors = ["Invalid sensor code."];
                            return response()->json([
                                'is_completed' => false,
                                'errors' => $errors,
                                'data' => null,
                            ]);
                        }
                    } else {
                        $errors = ["Invalid token."];
                        return response()->json([
                            'is_completed' => false,
                            'errors' => $errors,
                            'data' => null,
                        ]);
                    }
                });
            } catch (\Exception $ex) {
                $errors = ['Something went wrong. Try again later.', $ex->getMessage()];
                return response()->json([
                    'is_completed' => false,
                    'errors' => $errors,
                    'data' => null,
                ]);
            }
        }
    }
}
