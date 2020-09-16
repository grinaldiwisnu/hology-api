<?php

namespace App\Http\Controllers;

use App\Models\Submission;
use App\Models\Team;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SubmissionController extends Controller
{
    public function __construct()
    {

    }

    public function store(Request $request, $id)
    {
        $validation = Validator($request->all(), [
            'link' => 'required|string|unique:submission,submission_link',
        ]);

        if ($validation->fails()) {
            return response()->json([
                'success' => false,
                'data' => null,
                'message' => $validation->errors(),
            ], 400);
        }

        try {
            $team = Team::where('team_id', $id)->first();

            $submission = new Submission();

            $submission->submission_link = $request->link;
            $submission->submission_phase = 0;
            $submission->team_id = $team->team_id;

            $submission->save();

            return response()->json([
                'success' => true,
                'data' => $submission,
                'message' => 'Berhasil menambahkan submission',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'data' => null,
                'message' => 'Oops! Something went wrong!',
            ]);
        }
    }

    public function show(Request $request, $id)
    {
        try {
            $submission = Submission::where('team_id', $id)
                ->get();

            return response()->json([
                'success' => true,
                'data' => $submission,
                'message' => 'Berhasil menambahkan submission',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'data' => null,
                'message' => 'Oops! Something went wrong!',
            ]);
        }
    }
}
