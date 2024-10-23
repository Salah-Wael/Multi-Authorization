<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class GuestMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {
                // Customize the redirection or logic here
                return redirect('/home');
            }
        }

        return $next($request);
    }
    }
}
