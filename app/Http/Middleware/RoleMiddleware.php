<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    public function handle($request, Closure $next, $role)
    {
        if (!Auth::check()) {
            return redirect()->route('login'); // Redirect to login if user is not authenticated
        }

        $user = Auth::user();

        // Check if the user's role matches the required role
        if ($user->role !== $role) {
            // Redirect users based on their role
            return match ($user->role) {
                'admin' => redirect()->route('dashboard.index'),
                'cashier' => redirect()->route('pos.POS'),
                'customer' => redirect()->route('home'),
                default => abort(403, 'Unauthorized'), // Fallback for undefined roles
            };
        }

        // Allow the request to proceed
        return $next($request);
    }
}
