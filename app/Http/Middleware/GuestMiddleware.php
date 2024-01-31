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
    public function handle($request, Closure $next)
{
    if (!auth()->check()) {
        $routeName = $request->route()->getName();

        // Define the data you want to save in the session
        $guestData = [
            'route_name' => $routeName,
            // Add more data as needed
        ];

        // Save the data in the session using the route name as the key
        session([$routeName => $guestData]);
    }

    return $next($request);
}
}
