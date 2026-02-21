<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class EnsureProfileCompleted
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Only check for authenticated users
        if (!Auth::check()) {
            return $next($request);
        }

        $user = Auth::user();

        // If user is already on profile setup pages or logout, let them proceed
        if ($request->is('profile-setup/*') || $request->is('logout')) {
            return $next($request);
        }

        // Check if profile is completed
        if (!$user->profile_completed) {
            return redirect()->route('profile.setup.step1');
        }

        return $next($request);
    }
}
