<?php

namespace App\Http\Controllers;

use App\BIOMIX;
use App\ML;
use App\Models\Token;
use App\Models\UserAnalysis;
use App\Models\UserSensor;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    private $model = null;
    private $symptoms = null;

    /**
     * UserController constructor.
     * @throws \Exception
     */
    public function __construct()
    {
        $trainingFile = storage_path("machine-learning/YOUR-FILE-HERE.csv");
        $this->model = new ML($trainingFile, ML::NAIVE_BAYES, true);
        $this->symptoms = $this->model->getSymptoms();
    }


    private function __userInfo()
    {
        $auth = Auth::user();

        $avatarModel = $auth->avatar;
        $avatarURL = $avatarModel ? $avatarModel->path : "default.png";
        $avatarURL = asset("assets/uploads/avatars/" . $avatarURL);

        return [
            'full_name' => $auth->full_name,
            'address' => $auth->address,
            'birth_date' => $auth->birth_date ? Carbon::parse($auth->birth_date)->format("Y-m-d") : null,
            'gender' => $auth->gender,
            'phone_number' => $auth->phone_number,
            'email' => $auth->email,
            'username' => $auth->username,
            'role' => $auth->role,
            'avatar' => $avatarURL,
        ];
    }

    public function addNewToken()
    {
        $newToken = new Token();
        $newToken->id = BIOMIX::getTokenModelLatestID();
        $newToken->token = md5(time());
        $newToken->is_online = false;
        $newToken->user_id = Auth::id();
        $newToken->save();
        $data = ['success' => 'The token is generated successfully.'];
        return redirect('/user/tokens')->with($data);
    }

    public function analyzeSymptoms()
    {
        $rules = [
            'k' => 'required|min:1|max:9999',
        ];

        $validator = Validator::make(request()->all(), $rules);
        if ($validator->fails()) {
            $errors = $validator->errors()->all(); //toArray();
            return redirect('/user/symptoms/start')
                ->withErrors($errors)
                ->withInput(request()->all);
        } else {
            try {
                $symptoms = [];
                $indicesStr = request()->get('k');
                $indicesArr = explode(",", $indicesStr);
                $record = [];
                foreach ($this->symptoms as $k => $symptom) {
                    $record[$k] = 0;
                }
                foreach ($indicesArr as $index) {
                    $record[$index] = 1;
                    array_push($symptoms, $this->symptoms[$index]);
                }

                $this->model->train();
                $response = $this->model->predict($record);

                return DB::transaction(function () use ($symptoms, $response) {
                    $newRecordID = UserAnalysis::latest()->orderBy('id', 'DESC')->first();
                    $newRecordID = $newRecordID ? ($newRecordID->id + 1) : 1;

                    $record = new UserAnalysis();
                    $record->user_id = Auth::id();
                    $record->approach = "Naive Bayes";
                    $record->symptoms = implode(", ", $symptoms);
                    $record->disease = $response;
                    $record->id = $newRecordID;
                    $record->save();

                    $data = [
                        'success' => 'The analysis is generated successfully.',
                    ];
                    return redirect('/user/symptoms/latest-analyses')->with($data);
                });
            } catch (\Exception $ex) {
                $errors = ['Something went wrong. Try again later.'];
                return redirect('/user/symptoms/start')
                    ->withErrors($errors)
                    ->withInput(request()->all);
            }
        }
    }

    public function clearSensorReadings($id)
    {
        try {
            return DB::transaction(function () use ($id) {
                $userSensor = UserSensor::find($id);
                if ($userSensor && $userSensor->user_id == Auth::id()) {
                    $userSensor->user_sensor_readings()->delete();
                    $data = ['success' => 'The readings are removed successfully.'];
                    return redirect('/user/sensor-readings')->with($data);
                } else if ($userSensor->user_id != Auth::id()) {
                    $errors = ['You are not authorized to remove this sensor readings.'];
                    return redirect('/user/sensor-readings')
                        ->withErrors($errors)
                        ->withInput(request()->all);
                } else {
                    $errors = ['Something went wrong. Try again later.'];
                    return redirect('/user/sensor-readings')
                        ->withErrors($errors)
                        ->withInput(request()->all);
                }
            });
        } catch (\Exception $ex) {
            $errors = ['Something went wrong. Try again later.'];
            return redirect('/user/tokens')
                ->withErrors($errors)
                ->withInput(request()->all);
        }
    }

    public function getLatestAnalysesView()
    {
        $analyses = [];
        foreach (Auth::user()->user_analyses as $record) {
            array_push($analyses, [
                'symptoms' => $record->symptoms,
                'disease' => $record->disease,
                'created_at' => $record->created_at,
            ]);
        }

        $data = [
            'user_info' => $this->__userInfo(),
            'analyses' => $analyses,
        ];

        return view('user.latest-analyses', ["data" => $data]);
    }

    public function doClassification(Request $request)
    {
        $rules = [
            'bcImage' => 'required|file|mimes:jpg,jpeg,png,bmp,tiff|max:4096',
        ];

        $validator = Validator::make(request()->all(), $rules);
        if ($validator->fails()) {
            $errors = $validator->errors()->all(); //toArray();
            return redirect('/user/breast-cancer')
                ->withErrors($errors)
                ->withInput(request()->all);
        } else {
            $img = $request->file('bcImage');

            try {
                $newFileName = md5(time()) . "." . $img->getClientOriginalExtension();
                Storage::disk('public')->put('assets/bc-uploads/' . $newFileName, File::get($img));

                $pythonFile = resource_path("python/image.py");
                $modelFile = resource_path("python/FILE-NAME-HERE.h5");
                $labelsFile = resource_path("python/LABELS-FILE-HERE.text");
                $imageFile = public_path("assets/bc-uploads/$newFileName");
                $cmd = 'conda run -n tfgpu23 python "' . $pythonFile . '" "' . $modelFile . '" "' .
                    $imageFile . '" "' . $labelsFile . '"';

                $command = escapeshellcmd($cmd);
                $output = shell_exec($command);
                $output = json_decode($output);

                $outputStr = "";
                foreach ($output as $k => $el) {
                    //$outputStr .= $el[0] . ": " . $el[1] . "%\n";
                    $outputStr .= $el[0];
                    break;
                }

                return redirect('/user/breast-cancer')->with(["result" => $outputStr]);

            } catch (\Exception $ex) {
                $errors = ['Something went wrong. Try again later.'];
                return redirect('/user/breast-cancer')
                    ->withErrors($errors);
            }

        }
    }

    public function getLatestReadings($id)
    {
        $sensor = UserSensor::find($id);
        if (!$sensor) return null;

        $readings = [];
        $reads = $sensor->user_sensor_readings()->orderBy('created_at', 'DESC')->take(15)->get();

        foreach ($reads as $record) {
            array_push($readings, [
                'x' => Carbon::parse($record->created_at)->format("Y-m-d H:i:s"),
                'y' => $record->reading,
            ]);
        }
        return response()->json($readings);
    }

    public function getProfileView()
    {
        $data = [
            'user_info' => $this->__userInfo(),
        ];

        return view('user.profile', ["data" => $data]);
    }

    public function getBreastCancerView()
    {
        $data = [
            'user_info' => $this->__userInfo(),
        ];

        return view('user.breast-cancer', ["data" => $data]);
    }

    public function getReadingsView()
    {
        $sensors = [];
        foreach (Auth::user()->sensors as $sensor) {
            $readings = [];
            $reads = $sensor->user_sensor_readings()->orderBy('created_at', 'DESC')->take(100)->get();

            foreach ($reads as $record) {
                array_push($readings, [
                    'x' => Carbon::parse($record->created_at)->format("Y-m-d H:i:s"),
                    'y' => $record->reading,
                ]);
            }

            array_push($sensors, [
                'id' => $sensor->id,
                'name' => $sensor->sensor->name,
                'description' => $sensor->sensor->description,
                'readings' => json_encode($readings),
                'created_at' => Carbon::parse($sensor->created_at)->format("Y-m-d H:i:s"),
            ]);
        }

        $data = [
            'user_info' => $this->__userInfo(),
            'sensors' => $sensors,
        ];

        return view('user.readings', ["data" => $data]);
    }

    public function getSettingsView()
    {
        $data = [
            'user_info' => $this->__userInfo(),
        ];

        return view('user.settings', ["data" => $data]);
    }

    public function getSymptomsStartView()
    {
        $data = [
            'user_info' => $this->__userInfo(),
            'symptoms' => $this->symptoms,
        ];
        return view('user.symptoms-start', ["data" => $data]);
    }

    public function getSymptomsView()
    {
        $data = [
            'user_info' => $this->__userInfo(),
        ];
        return view('user.symptoms', ["data" => $data]);
    }

    public function getTokensView()
    {
        $tokens = [];
        foreach (Auth::user()->tokens as $record) {
            array_push($tokens, [
                'id' => $record->id,
                'token' => $record->token,
                'is_online' => $record->is_online,
                'created_at' => $record->created_at,
            ]);
        }

        $data = [
            'user_info' => $this->__userInfo(),
            'tokens' => $tokens,
        ];

        return view('user.tokens', ["data" => $data]);
    }

    public function index()
    {
        $auth = Auth::user();

        $avatarModel = $auth->avatar;
        $avatarURL = $avatarModel ? $avatarModel->path : "default.png";
        $avatarURL = asset("assets/uploads/avatars/" . $avatarURL);

        $data = [
            'cards' => BIOMIX::$USER_DASHBOARD_ELEMENTS,
            'user_info' => [
                'full_name' => $auth->full_name,
                'avatar' => $avatarURL,
            ],
        ];

        return view('user.index', ["data" => $data]);
    }

    public function removeToken($id)
    {
        try {
            return DB::transaction(function () use ($id) {
                $token = Token::find($id);
                if ($token && $token->user_id == Auth::id()) {
                    $token->delete();
                    $data = ['success' => 'The token is removed successfully.'];
                    return redirect('/user/tokens')->with($data);
                } else if ($token->user_id != Auth::id()) {
                    $errors = ['You are not authorized to remove this token.'];
                    return redirect('/user/tokens')
                        ->withErrors($errors)
                        ->withInput(request()->all);
                } else {
                    $errors = ['Something went wrong. Try again later.'];
                    return redirect('/user/tokens')
                        ->withErrors($errors)
                        ->withInput(request()->all);
                }
            });
        } catch (\Exception $ex) {
            $errors = ['Something went wrong. Try again later.'];
            return redirect('/user/tokens')
                ->withErrors($errors)
                ->withInput(request()->all);
        }
    }

    public function updatePassword()
    {
        $rules = [
            'password' => 'required|min:6|max:125',
            'retype_password' => 'required|min:6|max:125|required_with:password|same:password',
        ];

        $validator = Validator::make(request()->all(), $rules);
        if ($validator->fails()) {
            $errors = $validator->errors()->all(); //toArray();
            return redirect('/user/settings')
                ->withErrors($errors)
                ->withInput(request()->all);
        } else {
            try {
                return DB::transaction(function () {
                    $record = Auth::user();
                    $record->password = bcrypt(request()->get('password'));
                    $record->save();

                    $data = [
                        'success' => 'The password is updated successfully.',
                    ];
                    return redirect('/user/settings')->with($data);
                });
            } catch (\Exception $ex) {
                $errors = ['Something went wrong. Try again later.'];
                return redirect('/user/settings')
                    ->withErrors($errors)
                    ->withInput(request()->all);
            }
        }
    }

    public function updateSettings()
    {
        $rules = [
            'full_name' => 'required|min:2|max:150',
            'email' => 'required|email|max:125|unique:users,email,' . Auth::id(),
            'gender' => [Rule::in(BIOMIX::$USER_GENDERS)],
            'address' => 'max:1000',
        ];

        if (request()->get('birth_date')) $rules['birth_date'] = 'date';
        if (request()->get('phone_number')) $rules['phone_number'] = 'max:30';
        if (request()->file('avatar')) $rules['avatar'] = 'file|mimes:jpg,jpeg,png|max:2048'; // 2MB

        $validator = Validator::make(request()->all(), $rules);
        if ($validator->fails()) {
            $errors = $validator->errors()->all(); //toArray();
            return redirect('/user/settings')
                ->withErrors($errors)
                ->withInput(request()->all);
        } else {
            try {
                return DB::transaction(function () {
                    $avatar = request()->file('avatar');
                    if ($avatar) $newAvatar = BIOMIX::makeAvatar($avatar);

                    $record = Auth::user();
                    $record->full_name = request()->get('full_name');
                    $record->email = request()->get('email');
                    $record->gender = request()->get('gender');
                    $record->birth_date = request()->get('birth_date');
                    $record->phone_number = request()->get('phone_number');
                    $record->address = request()->get('address');
                    if ($avatar) $record->avatar_id = $newAvatar->id;
                    $record->save();

                    $data = [
                        'success' => 'The settings is updated successfully.',
                    ];
                    return redirect('/user/settings')->with($data);
                });
            } catch (\Exception $ex) {
                $errors = ['Something went wrong. Try again later.'];
                return redirect('/user/settings')
                    ->withErrors($errors)
                    ->withInput(request()->all);
            }
        }
    }
}
