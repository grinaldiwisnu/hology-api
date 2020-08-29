<?php

namespace App\Http\Middleware;

use App\Models\DetailTeam;
use Closure;

class TeamMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        // get path from url => /api/team/{teamId}/...
        $pathUrl = $request->path();

        // get split url to get team id
        $teamId = explode('/', $pathUrl, 3)[2];
        $userId = $request->auth->id;

        if ($this->checkAuthUserRelation($teamId, $userId))
            return $next($request);

        return response()->json([
            'success' => false,
            'data' => null,
            'message' => 'You are not authorized here.'
        ], 401);
    }

    private function checkAuthUserRelation($teamId, $userId)
    {
        $detailTeam = DetailTeam::where('team_id', $teamId)->where('user_id', $userId);

        return !!$detailTeam;
    }
}
