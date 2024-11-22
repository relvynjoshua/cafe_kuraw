<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard()
    {
        // Check if the user is authenticated and has the 'admin' role
        if (Auth::check() && Auth::user()->role === 'admin') {
            return view('dashboard.category.index'); // Admin dashboard view
        }

        // Redirect non-admin users with an error message
        return redirect()->route('login-signup.form')->withErrors([
            'error' => 'Access denied. Admins only.',
        ]);
    }
}
