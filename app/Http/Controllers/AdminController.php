<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\User;
use Firebase\JWT\JWT;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    private function jwt(Admin $admin)
    {
        $payload = [
            'iss'   => 'triplen-jwt-token',
            'sub'   => $admin,
            'iat'   => time(),
            'exp'   => time() + (60 * 60)
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
            $admin = Admin::where('admin_email', $request->email)->first();

            if (!$admin) {
                return response()->json([
                    'success' => true,
                    'data' => null,
                    'message' => 'User not found'
                ], 401);
            } else {
                if (Hash::check($request->password, $admin->admin_password))
                    return response()->json([
                        'success' => true,
                        'data' => [
                            'user' => $admin,
                            'access_token' => $this->jwt($admin),
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
            'password' => 'required|regex:/^[a-zA-Z\d]{8,25}$/',
            'role' => 'required'
        ]);

        if ($validation->fails()) {
            return response()->json([
                'success' => false,
                'data' => null,
                'message' => $validation->errors()
            ], 400);
        } else {
            $admin = new Admin();
            $admin->admin_name = $request->fullname;
            $admin->admin_email = $request->email;
            $admin->admin_password = Hash::make($request->password);
            $admin->admin_role = $request->role;
            try {
                if ($admin->save()) {
                    return response()->json([
                        'success' => true,
                        'data' => $admin,
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

    public function generatePassword(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'email' => 'required|email'
        ]);
        
        if ($validation->fails()) {
            return response()->json([
                'success' => false,
                'data' => null,
                'message' => $validation->errors()
            ], 400);
        }
        
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < 12; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        
        try {
            User::where(['user_email' => $request->email])
        	->update(['user_password' => Hash::make($randomString)]);
        
            return response()->json([
        	'success' => true,
        	'data' => ['newPassword' => $randomString],
        	'message' => 'User new Password'
            ]);
        } catch (\Exception $error) {
            return response()->json([
        	'success' => false,
        	'data' => null,
        	'message' => $error
            ]);
        }
    }

    public function updateUser(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'email' => 'unique:users,user_email',
            'gender' => 'boolean',
            'birthdate' => 'date|before:today',
        ]);

        if ($validation->fails()) {
            return response()->json([
                'success' => false,
                'data' => null,
                'message' => $validation->errors(),
            ], 400);
        }

        try {
            $user = $request->auth;

            $user->user_fullname = $request->fullname ?? $user->user_fullname;
            $user->user_email = $request->email ?? $user->user_email;
            $user->user_name = $request->name ?? $user->user_name;
            $user->user_gender = $request->gender ?? $user->user_gender;
            $user->user_birthdate = $request->birthdate ?? $user->user_birthdate;
            
            $user->save();

            return response()->json([
                'success' => true,
                'data' => $user,
                'message' => 'Berhasil memperbarui data user!',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'data' => null,
                'message' => 'Oops! Sorry, but the server is gone wrong.',
            ], 500);
        }
    }
}
