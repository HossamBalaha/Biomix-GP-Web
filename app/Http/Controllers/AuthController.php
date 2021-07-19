<?php

namespace App\Http\Controllers;

use App\BIOMIX;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class AuthController extends Controller
{
    public function doLogin(Request $request)
    {
        $rules = [
            'username' => 'required|min:6|max:60|exists:users,username',
            'password' => 'required|min:6|max:125',
        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            $errors = $validator->errors()->all(); //toArray();
            return redirect('/login')
                ->withErrors($errors)
                ->withInput($request->all);
        } else {
            $auth = [
                'username' => $request->get('username'),
                'password' => $request->get('password'),
            ];
            if (Auth::attempt($auth)) {
                try {
                    return DB::transaction(function () use ($auth) {
                        $user = Auth::user();
                        if ($user->role == "User")
                            return redirect('/user');
                        elseif ($user->role == "Admin")
                            return redirect('/dashboard');
                        else
                            return redirect('/');
                    });
                } catch (\Exception $ex) {
                    $errors = ['Something went wrong. Try again later.'];
                    return redirect('/login')
                        ->withErrors($errors)
                        ->withInput($request->all);
                }
            } else {
                $errors = ['Authentication failed.'];
                return redirect('/login')
                    ->withErrors($errors)
                    ->withInput($request->all);
            }
        }
    }

    public function doLogout()
    {
        Auth::logout();
        return redirect('/login');
    }

    public function doRegistration(Request $request)
    {
        $rules = [
            'full_name' => 'required|min:2|max:150',
            'password' => 'required|min:6|max:125',
            'retype_password' => 'required|min:6|max:125|required_with:password|same:password',
            'username' => 'required|min:6|max:60|unique:users,username',
            'email' => 'required|email|max:125|unique:users,email',
            'gender' => [Rule::in(BIOMIX::$USER_GENDERS)],
            'address' => 'max:1000',
        ];

        if ($request->get('birth_date')) $rules['birth_date'] = 'date';
        if ($request->get('phone_number')) $rules['phone_number'] = 'max:30';

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            $errors = $validator->errors()->all(); //toArray();
            return redirect('/register')
                ->withErrors($errors)
                ->withInput($request->all);
        } else {
            try {
                return DB::transaction(function () use ($request) {
                    $record = new User();
                    $record->id = BIOMIX::getUserModelLatestID();
                    $record->password = bcrypt($request->get('password'));
                    $record->full_name = $request->get('full_name');
                    $record->username = $request->get('username');
                    $record->email = $request->get('email');
                    $record->gender = $request->get('gender');
                    $record->birth_date = $request->get('birth_date');
                    $record->phone_number = $request->get('phone_number');
                    $record->address = $request->get('address');
                    $record->role = 'User';
                    $record->save();

                    $data = [
                        'success' => 'The account is created successfully.',
                    ];
                    return redirect('/login')->with($data);
                });
            } catch (\Exception $ex) {
                $errors = ['Something went wrong. Try again later.', $ex->getMessage()];
                return redirect('/register')
                    ->withErrors($errors)
                    ->withInput($request->all);
            }
        }
    }

    public function getLogin()
    {
        return view('auth/login');
    }

    public function getRegistration()
    {
        return view('auth/register');
    }
}
