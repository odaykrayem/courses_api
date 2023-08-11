<?php

namespace App\Http\Controllers\Api\V1\Auth;

use App\CentralLogic\Helpers;

use App\Http\Controllers\Controller;
use App\Http\Resources\V1\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;


class UserAuthController extends Controller
{

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required',
            'password' => 'required|min:6'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => Helpers::error_processor($validator)], 403);
        }
        $data = [
            'email' => $request->email,
            'password' => $request->password
        ];

        if (Auth::attempt($data)) {
            //auth()->user() is coming from laravel auth:api middleware
            $user = Auth::user();

            $token = $user->createToken('LWheelsAuth',['create','update','delete']);
            // if (!auth()->user()->status) {
            //     $errors = [];
            //     array_push($errors, ['code' => 'auth-003', 'message' => trans('messages.your_account_is_blocked')]);
            //     return response()->json([
            //         'errors' => $errors
            //     ], 403);
            // }

            $user = new UserResource(User::where('email', $request['email'])->first());

            // $user->token = $token->plainTextToken;
            // $user['token'] = $token->plainTextToken;
            $user->additional(['token' => $token->plainTextToken]);

            return response()->json([
                'msg' => 'success',
                'token' => $token->plainTextToken,
                'data' => $user], 200);
        } else {
            $errors = [];
            array_push($errors, ['code' => 'auth-001', 'message' => 'Unauthorized.']);
            return response()->json([
                'errors' => $errors
            ], 401);
        }
    }

    public function register(Request $request)
    {
        $creds = [
            'name' => $request['name'],
            'email' => 'required|unique:users',
            'phone' => $request['phone'],
            'password' => $request['passowrd'],
        ];
        if (!Auth::attempt($creds)) {

            $validator = Validator::make($request->all(), [
                'name' => 'required',
                'email' => 'required|unique:users',
                'phone' => 'unique:users',
                'password' => 'required|min:6',
            ], [
                'name.required' => 'The name field is required.',
                'email.required' => 'The email field is required.',
                'password.min' => 'Password must be at least 6.',
            ]);

            if ($validator->fails()) {
                return response()->json(['errors' => $this->error_processor($validator)], 403);
            }
            // if ($validator->fails()) {
            //     return response()->json(['errors' => "Failed Validation check"], 403);
            // }
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'password' => bcrypt($request->password),
            ]);

            // $token = $user->createToken('LWheelsAuth')->accessToken;


            return response()->json(['msg' => 'success'], 200);
        }
    }

    public static function error_processor($validator)
    {
        $err_keeper = [];
        foreach ($validator->errors()->getMessages() as $index => $error) {
            array_push($err_keeper, ['code' => $index, 'message' => $error[0]]);
        }
        return $err_keeper;
    }
}
