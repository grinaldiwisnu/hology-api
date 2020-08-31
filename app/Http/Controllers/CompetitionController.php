<?php

namespace App\Http\Controllers;

use App\Models\Competition;

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
                'message' => 'Data is empty, add institution first'
            ], 200);
        } else {
            return response()->json([
                'success' => true,
                'data' => $result,
                'message' => 'Success fetch institution data'
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
                'message' => 'Success fetch institution data'
            ], 200);
        }
    }
}
