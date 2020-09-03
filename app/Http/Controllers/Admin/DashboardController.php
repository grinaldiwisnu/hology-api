<?php

namespace App\Http\Controllers;

use App\Models\Competition;
use App\Models\Team;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
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

    public function getAllTeam()
    {
        $teams = Team::all();

        if (count($teams) == 0) {
            return response()->json([
                'success' => true,
                'data' => null,
                'message' => 'Team is empty'
            ]);
        }

        return response()->json([
            'success' => true,
            'data' => $teams,
            'message' => 'All teams fetched'
        ]);
    }

    public function getAllUser()
    {
        $users = User::all();

        if (count($users) == 0) {
            return response()->json([
                'success' => true,
                'data' => null,
                'message' => 'User is empty'
            ]);
        }

        return response()->json([
            'success' => true,
            'data' => $users,
            'message' => 'All users fetched'
        ]);
    }

    public function getAllCompetition()
    {
        $competitions = Competition::all();

        if (count($competitions) == 0) {
            return response()->json([
                'success' => true,
                'data' => null,
                'message' => 'Competition is empty'
            ]);
        }

        return response()->json([
            'success' => true,
            'data' => $competitions,
            'message' => 'All competitions fetched'
        ]);
    }
}
