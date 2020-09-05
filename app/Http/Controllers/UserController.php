<?php

namespace App\Http\Controllers;

use App\Mail\ForgetPassword;
use App\Models\DetailTeam;
use App\Models\Team;
use App\Models\User;
use Firebase\JWT\ExpiredException;
use Firebase\JWT\JWT;
use Firebase\JWT\SignatureInvalidException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function __construct()
    {
        // TODO: CRUD data user
    }

    /**
     * Create new Join Token
     *
     * @param string team_id
     * @return string
     */
    private function encodeToken($sub)
    {
        $payload = [
            'iss'   => 'triplen-jwt-token',
            'sub'   => $sub,
            'iat'   => time(),
            'exp'   => time() + (24 * 60 * 60 * 7)
        ];

        return JWT::encode($payload, env('APP_JWT'), 'HS256');
    }

    /**
     * Decode Join Token
     *
     * @param string token
     * @return Firebase\JWT\JWT
     */
    private function decodeToken($token)
    {
        return JWT::decode($token, env('APP_JWT'), ['HS256']);
    }

    public function index()
    {
        $users = User::orderBy('user_name')->get();

        $returnUsers = [];

        foreach ($users as $user) {
            // get detail users data
            $detailTeam = DetailTeam::where('user_id', $user->user_id)
                ->get();

            // define member obj in user
            $teams = [];

            // get each member data
            foreach($detailTeam as $teamRelation) {
                $team = Team::where('team_id', $teamRelation->team_id)
                    ->first();

                // set detail to member data in team
                $teamRelation->user_identity_pic = $teamRelation->detail_team_identity_pic;
                $teamRelation->user_proof = $teamRelation->detail_team_proof;

                array_push($teams, $team);
            }

            $user->teams = $teams;


            array_push($returnUsers, $user);
        }

        return response()->json([
            'success' => true,
            'data' => $returnUsers,
            'message' => 'Successfully get all users'
        ]);
    }

    public function show($id)
    {
        // TODO: Show an user and its details

        try {
            // get team data
            $user = User::where('user_id', $id)
                ->first();

            if (!$user) {
                return response()->json([
                    'success' => false,
                    'data' => null,
                    'message' => 'User not found!'
                ]);
            }

            // get detail users data
            $detailTeam = DetailTeam::where('user_id', $user->user_id)
                ->get();

            // define member obj in user
            $teams = [];

            // get each member data
            foreach($detailTeam as $teamRelation) {
                $team = Team::where('team_id', $teamRelation->team_id)
                    ->first();

                // set detail to member data in team
                $teamRelation->user_identity_pic = $teamRelation->detail_team_identity_pic;
                $teamRelation->user_proof = $teamRelation->detail_team_proof;

                array_push($teams, $team);
            }

            $user->teams = $teams;
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'data' => null,
                'message' => 'Oops! Looks like the server in a bad mood, please try again later. :D'
            ], 500);
        }

        return response()->json([
            'success' => true,
            'data' => $user,
            'message' => 'Success fetch user'
        ]);
    }

    public function profile(Request $request)
    {
        try {
            // get team data
            $user = User::where('user_id', $request->auth->user_id)
                ->first();

            if (!$user) {
                return response()->json([
                    'success' => false,
                    'data' => null,
                    'message' => 'User not found!'
                ]);
            }

            $detailTeams = DetailTeam::where('user_id', $user->user_id)->get();

            $teams = [];
            foreach ($detailTeams as $detailTeam) {
                $team = Team::where('team_id', $detailTeam->team_id)
                    ->first();

                $team->user_identity_pic = $detailTeam->detail_team_identity_pic;
                $team->user_proof = $detailTeam->detail_team_proof;

                array_push($teams, $team);
            }
            $user->teams = $teams;
            
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'data' => null,
                'message' => 'Oops! Looks like the server in a bad mood, please try again later. :D'
            ], 500);
        }

        return response()->json([
            'success' => true,
            'data' => $user,
            'message' => 'Success fetch user'
        ]);
    }

    public function forgetPassword(Request $request)
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

        try {
            $user = User::where(['user_email' => $request->post('email')])
                ->first();

            $sub = [
                'user_email' => $user->user_email,
            ];

            $token = $this->encodeToken($sub);

            $url = env('CLIENT_FORGOT_URL') . $token;

            Mail::to($request->post('email'))->send(new ForgetPassword($url));
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'data' => null,
                'message' => 'Oops! Looks like the server in a bad mood, please try again later. :D'
            ], 500);
        }
    }

    public function forgetToken(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'token' => 'required'
        ]);

        if ($validation->fails()) {
            return response()->json([
                'success' => false,
                'data' => null,
                'message' => $validation->errors()
            ], 400);
        }

        // post request params
        $reset_token = $request->post('token');

        // decode token
        try {
            $this->decodeToken($reset_token);
        } catch (SignatureInvalidException $sig) {
            return response()->json([
                'success' => false,
                'data' => null,
                'message' => 'Your format is wrong'
            ], 403);
        } catch (ExpiredException $exp) {
            return response()->json([
                'success' => false,
                'data' => null,
                'message' => 'Your link is expired'
            ], 406);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'data' => null,
                'message' => 'Oops! Sorry, but the server is gone wrong.'
            ], 500);
        }

        return response()->json([
            'success' => true,
            'data' => null,
            'message' => 'Token valid'
        ]);
    }

    public function newPassword(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'email' => 'required|email',
            'token' => 'required'
        ]);

        if ($validation->fails()) {
            return response()->json([
                'success' => false,
                'data' => null,
                'message' => $validation->errors()
            ], 400);
        }
        
        // post request params
        $reset_token = $request->post('token');

        // decode token
        try {
            $payload = $this->decodeToken($reset_token);

            User::where('user_email', $payload->sub->user_email)
                ->update([
                    'password' => Hash::make($request->post('password')),
                ]);
        } catch (SignatureInvalidException $sig) {
            return response()->json([
                'success' => false,
                'data' => null,
                'message' => 'Your format is wrong'
            ], 403);
        } catch (ExpiredException $exp) {
            return response()->json([
                'success' => false,
                'data' => null,
                'message' => 'Your link is expired'
            ], 406);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'data' => null,
                'message' => 'Oops! Sorry, but the server is gone wrong.'
            ], 500);
        }

        return response()->json([
            'success' => true,
            'data' => null,
            'message' => 'Berhasil memperbarui password!'
        ]);
    }
}
