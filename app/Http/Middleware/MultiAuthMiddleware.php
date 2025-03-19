<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Facades\JWTAuth;

class MultiAuthMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Check if authenticated via Sanctum
        $authSanctum = Auth::guard('sanctum')->check();

        if ($authSanctum) {
            return $next($request);
        }
        
        // Check if authenticated via JWT
        try {
            $user = JWTAuth::parseToken()->authenticate();
            if ($user) {
                Auth::setUser($user);
                return $next($request);
            }
        } catch (\Exception $e) {
            return response()->json([
                'code' => Response::HTTP_UNAUTHORIZED,
                'msg' => 'Unauthorized'
            ], Response::HTTP_UNAUTHORIZED);
        }

        return response()->json(['error' => 'Unauthorized'], Response::HTTP_UNAUTHORIZED);
    }
}
