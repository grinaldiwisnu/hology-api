<?php

namespace App\Http\Controllers;

use App\Models\Competition;
use App\Models\Team;

class CompetitionController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //TODO: create CRUD for competition and create CRUD for competition by user ID
    }

    /**
     * Get all competitions
     *
     * @return \Illuminate\Http\Response $response
     */
    public function index()
    {
        $result = Competition::get();

        if (count($result) == 0) {
            return response()->json([
                'success' => false,
                'data' => [],
                'message' => 'Data is empty, add competition first'
            ], 200);
        } else {
            return response()->json([
                'success' => true,
                'data' => $result,
                'message' => 'Success fetch competition data'
            ], 200);
        }
    }

    public function show($id)
    {
        $result = Competition::where('competition_id', $id)
            ->first();

        if (count($result) == 0) {
            return response()->json([
                'success' => false,
                'data' => [],
                'message' => 'Data not found'
            ], 404);
        } else {
            return response()->json([
                'success' => true,
                'data' => $result,
                'message' => 'Success fetch competition data'
            ], 200);
        }
    }

    public function showTeams($id)
    {
        try {
            $teams = Team::where(['competition_id', $id])
                ->get();

            return response()->json([
                'success' => true,
                'data' => $teams,
                'message' => 'Success fetch competition data'
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'data' => null,
                'message' => 'Oops! Looks like the server in a bad mood, please try again later. :D'
            ], 500);
        }
    }
}
