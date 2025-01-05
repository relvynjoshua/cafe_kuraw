<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        // Validate login inputs
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:5',
        ]);

        // Attempt to log in the user
        if (!Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            // Invalid credentials
            return back()
                ->withErrors(['email' => 'Invalid email or password.']) // Combined error for security reasons
                ->withInput();
        }

        // Get the authenticated user
        $user = Auth::user();

        // Check if the account is active
        if (!$user->is_active) {
            Auth::logout(); // Immediately log out the user
            return back()
                ->withErrors(['email' => 'Your account has been disabled. Please contact support.'])
                ->withInput();
        }

        // Redirect based on the user's role
        if ($user->role === 'admin') {
            return redirect()->route('dashboard.index')->with('success', 'Welcome, Admin!');
        } elseif ($user->role === 'cashier') {
            return redirect()->route('pos.POS')->with('success', 'Welcome, Cashier!');
        } elseif ($user->role === 'user') {
            return redirect()->route('home')->with('success', 'Welcome back!');
        } 

        // Fallback for undefined roles
        Auth::logout();
        return back()
            ->withErrors(['email' => 'Your account role is not recognized. Please contact support.'])
            ->withInput();
    }
}
