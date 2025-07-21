<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class LoggedUserRedirect
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

         // Redirect users based on role after login
    if (auth()->check()) {
        switch (auth()->user()->role) {
            case 'admin':
                return redirect()->route('admin.dashboard');
            case 'organizer':
                return redirect()->route('organizer.dashboard');
            case 'customer':
                return redirect()->route('customer.dashboard');
        }
    }
    
        return $next($request);
    }
}
