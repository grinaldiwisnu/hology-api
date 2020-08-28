<?php

namespace App\Http\Controllers;

use App\Models\Team;
use App\Models\DetailTeam;
use Firebase\JWT\ExpiredException;
use Firebase\JWT\JWT;
use Firebase\JWT\SignatureInvalidException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

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
     * @param string user_id
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

        return JWT::encode($payload, env('APP_JWT'));
    }

    /**
     * Decode Join Token
     *
     * @param string token
     * @return Firebase\JWT\JWT
     */
    private function decodeToken($token)
    {
        return JWT::decode($token, env('APP_JWT'));
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
     * @param App\Models\Team $team
     * @return Illuminate\Http\Response
     */
    public function store(Team $team)
    {
        // TODO: Store new team

        // validate data
        $validation = Validator::make($team, [
            'institution_id' => 'required',
            'competition_id' => 'required',
            'team_name' => 'required|unique',
            'team_lead' => 'required|unique'
        ]);

        // check validation fails
        if ($validation->fails()) {
            return response()->json([
                'success' => false,
                'data' => null,
                'message' => $validation->errors(),
            ]);
        }

        // create new team
        $team = Team::create($team);
        // create relation
        $relation = DetailTeam::create();

        // set default value
        $team->payment_proof = "";
        $team->team_status = 0;

        // store data to database
        try {
            $team->save();
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'data' => null,
                'message' => $e
            ]);
        }

        // set relation value
        $relation->user_id = $team->team_lead;
        $relation->team_id = $team->id;

        // store data to database
        try {
            $relation->save();
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'data' => null,
                'message' => $e
            ]);
        }

        $joinToken = $this->encodeToken($relation->team_id);

        // return success response
        return response()->json([
            'success' => true,
            'data' => [
                'team' => $team,
                'join_link' => env('CLIENT_URL') . "?join_team=$joinToken",
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
        $join_token = $request->post('join_token');
        $user_id = $request->auth->user->id;

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
        $relation = DetailTeam::create();

        // initialize relation vars
        $relation->user_id = $user_id;
        $relation->team_id = $payload->sub->team_id;

        try {
            $relation->save();
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'data' => null,
                'message' => $e
            ]);
        }


        return response()->json([
            'success' => true,
            'data' => $relation,
            'message' => 'Success add new member'
        ], 201);
    }

    /**
     * Upload payment proof
     *
     * @param Illuminate\Http\Request $request
     * @return Illuminate\Http\Response
     */
    public function uploadPaymentProof(Request $request)
    {
        // TODO: Store team payment proof
    }

    /**
     * Upload identity
     *
     * @param Illuminate\Http\Request $request
     * @return Illuminate\Http\Response
     */
    public function uploadIdentity(Request $request)
    {
        // TODO: Store team identities
    }

    /**
     * Upload assignment letter
     *
     * @param Illuminate\Http\Request $request
     * @return Illuminate\Http\Response
     */
    public function uploadAssingmentLetter(Request $request)
    {
        // TODO: Store team assignment letter
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
