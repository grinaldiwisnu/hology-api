<?php

namespace App\Http\Controllers;

use App\Models\Team;
use App\Models\DetailTeam;
use Firebase\JWT\ExpiredException;
use Firebase\JWT\JWT;
use Firebase\JWT\SignatureInvalidException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class TeamController extends Controller
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
     * Create new Join Token
     *
     * @param string team_id
     * @return string
     */
    private function encodeToken($team_id)
    {
        $payload = [
            'iss'   => 'triplen-jwt-token',
            'sub'   => [
                'team_id' => $team_id,
            ],
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

    /**
     * Get all teams for admin only
     *
     * @return Illuminate\Http\Response
     */
    public function index()
    {
        // TODO: Get all teams
        $teams = Team::orderBy('team_name')->get();

        return response()->json([
            'success' => true,
            'data' => $teams,
            'message' => 'Successfully get all teams'
        ]);
    }

    /**
     * Store new team
     *
     * @param App\Models\Request $request
     * @return Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // TODO: Store new team

        // validate data
        $validation = Validator::make($request->all(), [
            'institution_id' => 'required',
            'competition_id' => 'required',
            'name' => 'required|unique:teams,team_name',
            'lead' => 'required|unique:teams,team_lead'
        ]);

        // check validation fails
        if ($validation->fails()) {
            return response()->json([
                'success' => false,
                'data' => null,
                'message' => $validation->errors(),
            ], 403);
        }

        // create new team
        $team = new Team();
        // create relation
        $relation = new DetailTeam();

        // set value
        $team->institution_id = $request->institution_id;
        $team->competition_id = $request->competition_id;
        $team->team_name = $request->name;
        $team->team_lead = $request->lead;
        $team->team_payment_proof = "";
        $team->team_assignment_letter = "";
        $team->team_status = 0;

        // store data to database
        try {
            $team->save();
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'data' => null,
                'message' => $e
            ], 500);
        }

        // set relation value
        $relation->user_id = $team->team_lead;
        $relation->team_id = $team->id;
        $relation->detail_team_identity_pic = "";

        // store data to database
        try {
            $relation->save();
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'data' => null,
                'message' => $e
            ], 500);
        }

        $joinToken = $this->encodeToken($relation->team_id);

        // return success response
        return response()->json([
            'success' => true,
            'data' => [
                'team' => $team,
                'join_link' => env('CLIENT_URL') . "?token=$joinToken",
            ],
            'message' => 'Team created'
        ], 201);
    }

    /**
     * Add new member to team
     *
     * @param Illuminate\Http\Request $request
     * @return Illuminate\Http\Response
     */
    public function addMember(Request $request)
    {
        // TODO: Store user to a team

        // get request params
        $join_token = $request->get('token');

        // decode token
        try {
            $payload = $this->decodeToken($join_token);
        } catch (SignatureInvalidException $sig) {
            response()->json([
                'success' => false,
                'data' => null,
                'message' => 'Your format is wrong'
            ], 403);
        } catch (ExpiredException $exp) {
            response()->json([
                'success' => false,
                'data' => null,
                'message' => 'Your link is expired'
            ], 406);
        } catch (\Exception $e) {
            response()->json([
                'success' => false,
                'data' => null,
                'message' => 'Oops! Sorry, but the server is gone wrong.'
            ], 500);
        }

        // define new relation
        $relation = new DetailTeam();

        // initialize relation vars
        $relation->user_id = $request->auth->user_id;
        $relation->team_id = $payload->sub->team_id;
        $relation->detail_team_identity_pic = "";

        try {
            $relation->save();
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'data' => null,
                'message' => $e
            ], 500);
        }

        return response()->json([
            'success' => true,
            'data' => $relation,
            'message' => 'Success add new member'
        ], 201);
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
        $team = Team::where('team_id', $id)->get();

        // split ext and filename
        [$ext, $filename] = explode("-", $team->payment_proof);


        // define path
        $filepath = storage_path("/app/teams/$id/$filename.$ext");

        // read file content
        try {
            $file = file_get_contents($filepath);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'data' => null,
                'message' => $e
            ], 500);
        }

        return response($file, 200, ['Content-Type' => "image/$ext"]);
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
            'payment_proof' => 'mimes:png,jpg|max:2048'
        ]);

        // If validation fails
        if ($validation->fails()) {
            return response()->json([
                'success' => false,
                'data' => null,
                'message' => $validation->errors()
            ], 403);
        }

        // Get file from request
        $file = $request->file('payment_proof');

        // Create new filename
        $fileName = Str::uuid();
        $ext = $file->getClientOriginalExtension();
        $filePath = storage_path("/app/teams/$id/$fileName.$ext");

        // Store file in storage
        move_uploaded_file($file->getPathname(), $filePath);

        // Update field in database;
        Team::where('team_id', $id)
            ->update([
                'team_payment_proof' => "$ext-$fileName"
            ]);

        return response()->json([
            'success' => true,
            'data' => [
                'team_payment_proof' => "$ext-$fileName"
            ],
            'message' => 'Upload success'
        ]);
    }

    /**
     * get team members identities
     *
     * @param smallint $id
     * @return Illuminate\Http\Response
     */
    public function getIdentities($id)
    {
        // TODO: get team members identities

        // get relation;
        $detailTeams = DetailTeam::where('team_id', $id)->get();

        if (!$detailTeams)
            return response()->json([
                'success' => 'false',
                'data' => null,
                'message' => 'Team not found!'
            ], 404);

        // define paths
        $paths = [];

        // fill path with data from table
        foreach ($detailTeams as $value) {
            $paths[$value->user_id] = url("api/teams/$id/identity-pics/") . $value->detail_team_identity_pic;
        }

        // return path to user
        return response()->json([
            'success' => true,
            'data' => $paths,
            'message' => 'Berhasil menagmbil link untuk identitas user'
        ]);
    }

    /**
     * get team members identity
     *
     * @param smallint $id
     * @param string $filename
     * @return Illuminate\Http\Response
     */
    public function getIdentity($id, $filename)
    {
        // TODO: get team members identity

        // get relation;
        $detailTeam = DetailTeam::where('team_id', $id)
            ->where('detail_team_identity_pic', $filename)
            ->get();

        if (!$detailTeam)
            return response()->json([
                'success' => 'false',
                'data' => null,
                'message' => 'Team not found!'
            ], 404);

        // split ext and filename
        [$ext, $filename] = explode("-", $detailTeam->detail_team_identity_pic);


        // define path
        $filepath = storage_path("/app/teams/$id/$filename.$ext");

        // read file content
        try {
            $file = file_get_contents($filepath);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'data' => null,
                'message' => $e
            ], 500);
        }

        return response($file, 200, ['Content-Type' => "image/$ext"]);
    }

    /**
     * Upload identity
     *
     * @param Illuminate\Http\Request $request
     * @param smallint $id
     * @return Illuminate\Http\Response
     */
    public function uploadIdentity(Request $request, $id)
    {
        // TODO: Store team identities

        // Validate file
        $validation = Validator::make($request->file(), [
            'identity' => 'mimes:png,jpg|max:2048'
        ]);

        // If validation fails
        if ($validation->fails()) {
            return response()->json([
                'success' => false,
                'data' => null,
                'message' => $validation->errors()
            ], 403);
        }

        // Get file from request
        $file = $request->file('identity');

        // Create new filename
        $fileName = Str::uuid();
        $ext = $file->getClientOriginalExtension();
        $filePath = storage_path("/app/teams/$id/$fileName.$ext");

        // Store file in storage
        move_uploaded_file($file->getPathname(), $filePath);

        // Update field in database;
        DetailTeam::where('team_id', $id)
            ->where('user_id', $request->auth->id)
            ->update([
                'detail_team_identity_pic' => "$ext-$fileName"
            ]);

        return response()->json([
            'success' => true,
            'data' => [
                'detail_team_identity_pic' => "$ext-$fileName"
            ],
            'message' => 'Upload success'
        ]);
    }

    /**
     * get team members proofs
     *
     * @param smallint $id
     * @return Illuminate\Http\Response
     */
    public function getProofs($id)
    {
        // TODO: get team members proofs

        // get relation;
        $detailTeams = DetailTeam::where('team_id', $id)->get();

        if (!$detailTeams)
            return response()->json([
                'success' => 'false',
                'data' => null,
                'message' => 'Team not found!'
            ], 404);

        // define paths
        $paths = [];

        // fill path with data from table
        foreach ($detailTeams as $value) {
            $paths[$value->user_id] = url("api/teams/$id/proofs/") . $value->detail_team_proof;
        }

        // return path to user
        return response()->json([
            'success' => true,
            'data' => $paths,
            'message' => 'Berhasil menagmbil link untuk identitas user'
        ]);
    }

    /**
     * get team members prood
     *
     * @param smallint $id
     * @param string $filename
     * @return Illuminate\Http\Response
     */
    public function getProof($id, $filename)
    {
        // TODO: get team members proof

        // get relation;
        $detailTeam = DetailTeam::where('team_id', $id)
            ->where('detail_team_identity_pic', $filename)
            ->get();

        if (!$detailTeam)
            return response()->json([
                'success' => 'false',
                'data' => null,
                'message' => 'Team not found!'
            ], 404);

        // split ext and filename
        [$ext, $filename] = explode("-", $detailTeam->detail_team_proof);


        // define path
        $filepath = storage_path("/app/teams/$id/$filename.$ext");

        // read file content
        try {
            $file = file_get_contents($filepath);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'data' => null,
                'message' => $e
            ], 500);
        }

        return response($file, 200, ['Content-Type' => "image/$ext"]);
    }

    /**
     * Upload student proof
     *
     * @param Illuminate\Http\Request $request
     * @param smallint $id
     * @return Illuminate\Http\Response
     */
    public function uploadProof(Request $request, $id)
    {
        // TODO: Store detail team proof

        // Validate file
        $validation = Validator::make($request->file(), [
            'proof' => 'mimes:pdf,png,jpg|max:2048'
        ]);

        // If validation fails
        if ($validation->fails()) {
            return response()->json([
                'success' => false,
                'data' => null,
                'message' => $validation->errors()
            ], 403);
        }

        // Get file from request
        $file = $request->file('identity');

        // Create new filename
        $fileName = Str::uuid();
        $ext = $file->getClientOriginalExtension();
        $filePath = storage_path("/app/teams/$id/$fileName.$ext");

        // Store file in storage
        move_uploaded_file($file->getPathname(), $filePath);

        // Update field in database;
        DetailTeam::where('team_id', $id)
            ->where('user_id', $request->auth->id)
            ->update([
                'detail_team_proof' => "$ext-$fileName"
            ]);

        return response()->json([
            'success' => true,
            'data' => [
                'detail_team_proof' => "$ext-$fileName"
            ],
            'message' => 'Upload success'
        ]);
    }

    /**
     * Update team data
     *
     * @param Illuminate\Http\Request $request
     * @param smallint $id
     * @return Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // TODO: Update team data
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
