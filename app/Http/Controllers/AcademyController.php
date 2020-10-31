<?php

namespace App\Http\Controllers;

use App\Models\Academy;
use App\Models\User;
use Firebase\JWT\ExpiredException;
use Firebase\JWT\JWT;
use Firebase\JWT\SignatureInvalidException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class AcademyController extends Controller
{
    /**
     * Create new Controller instance
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Get all teams for admin only
     *
     * @return Illuminate\Http\Response
     */
    public function index()
    {
        // TODO: Get all teams
        $academys = Academy::orderBy('academy_id')->get();

        $returnList = [];

        foreach ($academys as $academy) {
            $user = User::where('user_id', $academy->user_id)->get();

            $academy->detail_user = $user;


            array_push($returnList, $academy);
        }

        return response()->json([
            'success' => true,
            'data' => $returnList,
            'message' => 'Successfully get all academy user'
        ]);
    }

    /**
     * Store new academy user
     *
     * @param App\Models\Request $request
     * @return Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // TODO: Store new team

        // validate data
        $validation = Validator::make($request->all(), [
            'resume' => 'required',
            'phone' => 'required'
        ]);

        // check validation fails
        if ($validation->fails()) {
            return response()->json([
                'success' => false,
                'data' => null,
                'message' => $validation->errors(),
            ], 403);
        }

        $file = $request->file('resume');

        // Create new filename
        $fileName = Str::uuid();
        $ext = $file->getClientOriginalExtension();
        $filePath = storage_path("app/academy/resume/$fileName.$ext");

        // Store file in storage
        move_uploaded_file($file->getPathname(), $filePath);


        // create new team
        $academy = new Academy();

        $academy->user_id = $request->auth->user_id;
        $academy->academy_resume = $ext.'-'.$fileName;
        $academy->academy_payment_proof = '';
        $academy->academy_status = 0;
        $academy->academy_phone_number = $request->phone;

        try {
            $academy->save();


        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'data' => null,
                'message' => $e
            ], 500);
        }

        // return success response
        return response()->json([
            'success' => true,
            'data' => [
                'academy' => $academy,
            ],
            'message' => 'Academy user created'
        ], 201);
    }

    /**
     * Show a specific team
     *
     * @param smallint $id
     * @return Illuminate\Http\Response
     */
    public function show($id)
    {
        // TODO: Show a team and its details

        try {
            // get team data
            $academy = Academy::where('academy_id', $id)
                ->first();

            if (!$academy) {
                return response()->json([
                    'success' => false,
                    'data' => null,
                    'message' => 'Academy user not found!'
                ]);
            }
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'data' => null,
                'message' => 'Oops! Looks like the server in a bad mood, please try again later. :D'
            ], 500);
        }

        return response()->json([
            'success' => true,
            'data' => $academy,
            'message' => 'Success get academy user'
        ]);
    }

    /**
     * get payment proof
     *
     * @param smallint $id
     * @return Illuminate\Http\Response
     */
    public function getPaymentProof($id)
    {
        // TODO: get team payment proof

        // get team;
        $academy = Academy::where('academy_id', $id)->first();

        if (!$academy)
            return response()->json([
                'success' => 'false',
                'data' => null,
                'message' => 'Academy user not found!'
            ], 404);

        if (empty($academy->academy_payment_proof))
            return response()->json([
                'success' => 'false',
                'data' => null,
                'message' => 'Payment proof not uploaded yet!'
            ], 400);

        // split ext and filename
        [$ext, $filename] = explode("-", $academy->academy_payment_proof, 2);

        // define path
        $filepath = storage_path("app/academy/payments/$filename.$ext");

        // read file content
        try {
            $file = file_get_contents($filepath);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'data' => null,
                'message' => 'Oops! Looks like the server in a bad mood, please try again later. :D'
            ], 500);
        }

        return response($file, 200, ['Content-Type' => "image/$ext"]);
    }

        /**
     * get resume
     *
     * @param smallint $id
     * @return Illuminate\Http\Response
     */
    public function getResume($id)
    {
        // TODO: get team payment proof

        // get team;
        $academy = Academy::where('academy_id', $id)->first();

        if (!$academy)
            return response()->json([
                'success' => 'false',
                'data' => null,
                'message' => 'Academy user not found!'
            ], 404);

        // split ext and filename
        [$ext, $filename] = explode("-", $academy->academy_resume, 2);

        // define path
        $filepath = storage_path("app/academy/resume/$filename.$ext");

        // read file content
        try {
            $file = file_get_contents($filepath);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'data' => null,
                'message' => 'Oops! Looks like the server in a bad mood, please try again later. :D'
            ], 500);
        }

        return response()->file($filepath);
    }


    /**
     * Upload payment proof
     *
     * @param Illuminate\Http\Request $request
     * @param smallint $id
     * @return Illuminate\Http\Response
     */
    public function uploadPaymentProof(Request $request, $id)
    {
        // TODO: Store team payment proof

        // Validate file
        $validation = Validator::make($request->file(), [
            'payment_proof' => 'required|mimes:png,jpg,jpeg|max:4096'
        ]);

        // If validation fails
        if ($validation->fails()) {
            return response()->json([
                'success' => false,
                'data' => null,
                'message' => $validation->errors()
            ], 403);
        }

        // get team;
        $academy = Academy::where('academy_id', $id)->first();

        $file = $request->file('payment_proof');

        // Create new filename
        $fileName = Str::uuid();
        $ext = $file->getClientOriginalExtension();
        $filePath = storage_path("app/academy/payments/$fileName.$ext");

        // Store file in storage
        move_uploaded_file($file->getPathname(), $filePath);

        // Update field in database;
        try {
            Academy::where('academy_id', $id)
                ->update([
                    'academy_payment_proof' => "$ext-$fileName"
                ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'data' => null,
                'message' => 'Oops! Looks like the server in a bad mood, please try again later. :D'
            ], 500);
        }

        return response()->json([
            'success' => true,
            'data' => [
                'academy_payment_proof' => "$ext-$fileName"
            ],
            'message' => 'Upload success'
        ]);
    }
    
    /**
     * Update academy data
     *
     * @param Illuminate\Http\Request $request
     * @param smallint $id
     * @return Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // TODO: Update team data
    }

    public function updateStatus(Request $request, $id)
    {
        $validation = Validator::make($request->all(), [
            'approve' => 'required', 
        ]);

        if ($validation->fails()) {
            return response()->json([
                'success' => false,
                'data' => null,
                'message' => $validation->errors(),
            ]);
        }

        try {
            Academy::where(['academy_id' => $id])
                ->update(['academy_status' => $request->approve]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'data' => null,
                'message' => 'Oops! Looks like the server in a bad mood, please try again later. :D'
            ], 500);
        }
        
        return response()->json([
            'success' => true,
            'data' => null,
            'message' => 'Academy status updated'
        ]);

        
    }

    /**
     * Delete team
     *
     * @param smallint $id
     * @return Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // TODO: Delete team
    }
}
