<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User; // Import User model
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class RegisterController extends Controller
{
    public function register(Request $request)
    {
        // Validate input with detailed password rules
        $validated = $request->validate([
            'firstname' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => [
                'required',
                'string',
                'min:8',            // Password must be at least 8 characters long
                'confirmed',        // Ensures 'password' and 'password_confirmation' match
                'regex:/[A-Z]/',    // At least one uppercase letter
                'regex:/[a-z]/',    // At least one lowercase letter
                'regex:/[0-9]/',    // At least one number
                'regex:/[@$!%*?&]/' // At least one special character
            ],
        ], [
            // Custom error messages for password rules
            'password.regex' => 'Password must contain at least 1 uppercase letter, 1 lowercase letter, 1 number, and 1 special character.',
            'password.min' => 'Password must be at least 8 characters long.',
            'password.confirmed' => 'Passwords do not match.',
        ]);

        try {
            // Save the validated user into the database
            User::create([
                'firstname' => $validated['firstname'],
                'email' => $validated['email'],
                'password' => Hash::make($validated['password']), // Hash the password securely
            ]);

            // Log the successful creation
            Log::info("New user registered: {$validated['email']}");

            // Redirect to login with a success message
            return redirect()->route('login')->with('success', 'Account created successfully! Please sign in.');
        } catch (\Exception $e) {
            // Log any errors for debugging
            Log::error("Error creating account: " . $e->getMessage());

            // Return back with an error message
            return back()->with('error', 'Something went wrong. Please try again.');
        }
    }

    /**
     * Check if an email already exists in the database.
     * Returns a JSON response for AJAX requests.
     */
    public function checkEmail(Request $request)
    {
        // Validate the incoming email field
        $request->validate([
            'email' => 'required|email',
        ]);

        // Check if the email already exists in the database
        $emailExists = User::where('email', $request->email)->exists();

        // Return JSON response
        return response()->json([
            'taken' => $emailExists
        ]);
    }
}
