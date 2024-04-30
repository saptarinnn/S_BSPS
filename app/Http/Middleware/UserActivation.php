<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class UserActivation
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        // return $request->user()->aktif == '1'
        //     ? $next($request)
        //              : view('auth.verify-number');
        if ($request->user()->aktif == '0') {
            return to_route('verification.number');
        }

        return $next($request);
    }
}
