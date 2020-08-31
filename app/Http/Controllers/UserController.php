<?php

namespace App\Http\Controllers;

use App\Models\DetailTeam;
use App\Models\Team;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function __construct()
    {
        // TODO: CRUD data user
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
}
