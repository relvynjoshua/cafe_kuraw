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

        // Check if the email exists
        $user = User::where('email', $request->email)->first();

        if (!$user) {
            // Email does not exist
            return back()
                ->withErrors(['email' => 'Account does not exist.']) // Show error for non-existent email
                ->withInput();
        }

        // Check for valid password
        if (!Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            // Invalid password
            return back()
                ->withErrors(['password' => 'Invalid password.']) // Show error for invalid password
                ->withInput();
        }

        // Redirect only when login is successful
        return redirect()->intended(route('home'))->with('success', 'Logged in successfully!');
    }
}
