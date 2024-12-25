<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CustomRoleRestrictionMiddleware
{
    public function handle(Request $request, Closure $next, ...$allowedRoles)
    {
        // Check if user is authenticated
        if (!Auth::check()) {
            return redirect('login');
        }
        // Get the authenticated user's role
        $userRole = Auth::user()->getRoleNames()->first();
        // Check if the user's role is in the allowed roles
        if (!in_array($userRole, $allowedRoles)) {
            // Unauthorized access
            abort(403, 'Unauthorized action.');
        }

        return $next($request);
    }
}
