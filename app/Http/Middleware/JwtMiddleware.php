<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Firebase\JWT\ExpiredException;
use Firebase\JWT\JWT;
use Firebase\JWT\SignatureInvalidException;

class JwtMiddleware
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
                'message' => 'Bearer not provided',
            ], 401);
        }
        $token = explode(' ', $token);

        if (($token[0] !== 'Bearer') || !$token[1]) {
            return response()->json([
                'status' => false,
                'data' => null,
                'message' => 'Bearer not provided',
            ], 401);
        }

        try {
            $credentials = JWT::decode($token[1], env('APP_JWT'), ['HS256']);
        } catch (SignatureInvalidException $inv) {
            return response()->json([
                'status' => false,
                'message' => 'Invalid format bearer'
            ], 400);
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

        $users = User::where('user_id', $credentials->sub->user_id)->where('user_email', $credentials->sub->user_email)->first();

        if (!$users) {
            return response()->json([
                'status' => false,
                'data' => null,
                'message' => 'User with bearer not match',
            ], 400);
        }

        $request->auth = $users;

        return $next($request);
    }
}
