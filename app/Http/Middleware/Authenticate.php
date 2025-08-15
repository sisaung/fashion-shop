<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class Authenticate
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // If user is not logged in
        if (! $request->user()) {

            // Ignore API/AJAX calls so they don't overwrite intended URL
            if ($request->expectsJson() || !$request->is('get-wishlist')) {
                return response()->json(['message' => 'Unauthenticated.'], 401);
            }

            // For normal page requests, store intended URL and redirect
            return redirect()->guest(route('login'));
        }

        return $next($request);
    }
}
