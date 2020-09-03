<?php

namespace App\Http\Middleware;

use App\Models\Admin;
use Closure;
use Firebase\JWT\ExpiredException;
use Firebase\JWT\JWT;

class AdminMiddleware
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
        $token = $request->header('Authorization');
        if (!$token) {
            return response()->json([
                'status' => false,
                'data' => null,
                'message' => 'Bearer for admin not provided',
            ], 401);
        }
        $token = explode(' ', $token);

        if (($token[0] !== 'Bearer') || !$token[1]) {
            return response()->json([
                'status' => false,
                'data' => null,
                'message' => 'Bearer for admin not provided',
            ], 401);
        }

        try {
            $credentials = JWT::decode($token[1], env('APP_JWT'), ['HS256']);
        } catch (ExpiredException $e) {
            return response()->json([
                'status' => false,
                'data' => null,
                'message' => 'Bearer expired'
            ], 400);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'data' => null,
                'message' => 'An error with bearer',
            ], 400);
        }

        $users = Admin::where('admin_id', $credentials->sub->admin_id)->where('admin_email', $credentials->sub->admin_email)->first();

        if (!$users) {
            return response()->json([
                'status' => false,
                'data' => null,
                'message' => 'Admin with bearer not match',
            ], 400);
        }

        $request->auth = $users;

        return $next($request);
    }
}
