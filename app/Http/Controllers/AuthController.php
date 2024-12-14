<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    /**
     * Handle user registration.
     */
    public function register(Request $request)
    {
        // Validate registration input
        $request->validate([
            'firstname' => 'required|string|max:255',
            'email' => 'required|email|unique:users|max:255',
            'password' => 'required|string|confirmed|min:5',
        ]);

        // Create a new user
        $user = User::create([
            'firstname' => $request->firstname,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'user', // Default role for a new user
        ]);

        // Log in the newly registered user
        Auth::login($user);

        // Redirect to the menu or other appropriate page
        return redirect()->route('menu');
    }

    /**
     * Handle user login.
     */
    public function login(Request $request)
    {
        // Validate login input
        $request->validate([
            'firstname' => 'required|string|max:255',
            'password' => 'required|string|min:5',
        ]);

        // Get login credentials
        $credentials = $request->only('firstname', 'password');

        // Attempt to log in the user
        if (Auth::attempt($credentials)) {
            // Redirect based on the user's role
            if (Auth::user()->role === 'admin') {
                return redirect()->route('dashboard.index'); // Admin dashboard route
            }

            return redirect()->route('menu'); // Regular user menu route
        }

        // Redirect back with an error for invalid credentials
        return back()->withErrors(['firstname' => 'Invalid credentials.']);
    }

    /**
     * Handle user logout.
     */
    public function logoutAccount(Request $request)
    {
        // Log out the user
        Auth::logout();

        // Invalidate the session
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // Redirect to the login-signup page
        return redirect()->route('login-signup.form');
    }
}
