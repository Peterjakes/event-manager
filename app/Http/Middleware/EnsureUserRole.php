<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureUserRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $role): Response
    {

         // Restrict route to users with a specific role
    if (auth()->check() && auth()->user()->role !== $role) {
        abort(403, 'Unauthorized');
    }

        return $next($request);
    }
}
