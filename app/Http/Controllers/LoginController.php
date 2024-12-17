<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        // Validate login inputs
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:5',
        ]);

        // Attempt to authenticate user
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            // Authentication successful
            return redirect()->route('home')->with('success', 'Logged in successfully!');
        }

        // Authentication failed
        return back()
            ->withErrors(['email' => 'Invalid credentials. Please try again.']) // Pass error message
            ->withInput() // Retain input for email field
            ->with('form', 'signin'); // Add form identifier for Blade handling
    }
}