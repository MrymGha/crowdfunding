<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class Contributor
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    // public function handle(Request $request, Closure $next): Response
    // {
    //     if (Auth::user()->role != 'contributor'){
    //         return redirect('login');
    //     }
    //     return $next($request);
    // }
    public function handle($request, Closure $next)
    {
        if (Auth::check() && Auth::user()->role == 'contributor') {
            return $next($request);
        }

        abort(403, 'Unauthorized action.');
    }
}
