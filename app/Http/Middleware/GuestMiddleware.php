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
        if (session('user_id')) {
            // If user is admin, redirect to admin dashboard
            if (session('user_role') === 'admin') {
                return redirect()->route('admin.dashboard');
            }
            // If regular user, redirect to home
            return redirect('/');
        }

        return $next($request);
    }
} 