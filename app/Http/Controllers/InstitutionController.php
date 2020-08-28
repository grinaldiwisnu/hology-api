<?php

namespace App\Http\Controllers;

use App\Models\Institution;

class InstitutionController extends Controller
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

    public function institutions()
    {
        $result = Institution::all();

        if (count($result) == 0) {
            return response()->json([
                'success' => false,
                'data' => [],
                'message' => 'Data is empty, add institution first'
            ], 201);
        } else {
            return response()->json([
                'success' => true,
                'data' => $result,
                'message' => 'Success fetch institution data'
            ], 201);
        }
    }
}
