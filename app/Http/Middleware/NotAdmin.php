<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class NotAdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        // first check if the user is authenticated and not an admin
        if ($request->user() && !$request->user()->isAdmin) {
            return $next($request);
        }

        // if user is admin or not auth
        return redirect('/welcome')->with('error', 'You do not have permission to access this resource.');
    }
}