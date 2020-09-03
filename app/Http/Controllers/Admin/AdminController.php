<?php

namespace App\Http\Controllers;

use App\Models\Admin;
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
}
