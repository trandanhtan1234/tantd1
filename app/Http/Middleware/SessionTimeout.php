<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class SessionTimeout
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check()) {
            $loginTime = session('login_time');
            if ($loginTime && $loginTime->diffInMinutes(now()) > 30) {
                Auth::logout();
                session()->flush();
                return redirect('/login')->with('failed', 'Session expired. Please login again.');
            }
        }

        return $next($request);
    }
}
