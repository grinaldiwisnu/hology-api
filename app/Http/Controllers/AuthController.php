<?php

namespace App\Http\Controllers;

use App\Models\User;
use Firebase\JWT\JWT;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //TODO: create auth API for Hology login and register
    }

    private function jwt(User $user)
    {
        $payload = [
            'iss'   => 'triplen-jwt-token',
            'sub'   => $user,
            'iat'   => time(),
            'exp'   => time() + (60 * 60)
        ];

        return JWT::encode($payload, env('APP_JWT'));
    }

    private function jwtRefresh(User $user)
    {
        $payload = [
            'iss'   => 'triplen-jwt-refresh',
            'sub'   => $user,
            'iat'   => time(),
            'exp'   => time() + (24 * 60 * 60 * 7)
        ];

        return JWT::encode($payload, env('APP_JWT'));
    }

    public function auth(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'email' => 'required',
            'password' => 'required',
        ]);

        if ($validation->fails()) {
            return response()->json([
                'success' => false,
                'data' => null,
                'message' => $validation->errors()
            ], 400);
        } else {
            $user = User::where('user_email', $request->email)->first();

            if (!$user) {
                return response()->json([
                    'success' => true,
                    'data' => null,
                    'message' => 'User not found'
                ], 401);
            } else {
                if (Hash::check($request->password, $user->user_password))
                    return response()->json([
                        'success' => true,
                        'data' => [
                            'user' => $user,
                            'access_token' => $this->jwt($user),
                            'refresh_token' => $this->jwtRefresh($user)
                        ],
                        'message' => 'User logged in'
                    ], 200);
                else return response()->json([
                    'success' => false,
                    'data' => null,
                    'message' => 'Wrong password!'
                ], 401);
            }
        }
    }

    public function register(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'fullname' => 'required',
            'email' => 'required|email|unique:users,user_email',
            'password' => 'required|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}$/',
            'gender' => 'required|boolean',
            'birthdate' => 'required|date|before:today',
            'institution' => 'required|exists:institutions,institution_id'
        ]);

        if ($validation->fails()) {
            return response()->json([
                'success' => false,
                'data' => null,
                'message' => $validation->errors()
            ], 400);
        } else {
            $user = new User();
            $user->user_fullname = $request->fullname;
            $user->user_email = $request->email;
            $user->user_name = substr(str_replace(" ", "", strtolower($request->fullname)), 0, 8);
            $user->user_password = Hash::make($request->password);
            // $user->img_url = $request->image;
            $user->user_birthdate = $request->birthdate;
            $user->user_gender = $request->gender;
            $user->institution_id = $request->institution;
            try {
                if ($user->save()) {
                    return response()->json([
                        'success' => true,
                        'data' => $user,
                        'message' => 'Success register to server'
                    ], 200);
                } else {
                    return response()->json([
                        'success' => false,
                        'data' => null,
                        'message' => 'Failed register to server'
                    ], 200);
                }
            } catch (\Throwable $th) {
                return response()->json([
                    'success' => false,
                    'data' => null,
                    'message' => $th
                ], 400);
            }
        }
    }
}
