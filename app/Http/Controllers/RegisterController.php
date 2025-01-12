<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class RegisterController extends Controller
{
    /**
     * Register a new user and send OTP for email verification.
     */
    public function register(Request $request)
    {
        $validated = $request->validate([
            'firstname' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => [
                'required',
                'string',
                'min:8',
                'confirmed',
                'regex:/[A-Z]/',
                'regex:/[a-z]/',
                'regex:/[0-9]/',
                'regex:/[@$!%*?&]/',
            ],
        ], [
            'password.regex' => 'Password must contain at least 1 uppercase letter, 1 lowercase letter, 1 number, and 1 special character.',
            'password.min' => 'Password must be at least 8 characters long.',
            'password.confirmed' => 'Passwords do not match.',
        ]);

        try {
            // Create the user
            $user = User::create([
                'firstname' => $validated['firstname'],
                'email' => $validated['email'],
                'password' => Hash::make($validated['password']),
            ]);

            // Send OTP using OTPController
            app('App\Http\Controllers\OTPController')->sendOTP($request);

            // For API, return JSON response
            if ($request->is('api/*')) {
                return response()->json([
                    'status' => 'success',
                    'message' => 'Account created successfully! OTP sent to your email.',
                    'user' => $user,
                ], 201);
            }

            // For web, redirect to OTP verification page
            session(['otp_email' => $user->email]);
            return redirect()->route('otp.verify')->with('success', 'Account created successfully! OTP sent to your email.');
        } catch (\Exception $e) {
            Log::error("Error during registration: " . $e->getMessage());

            if ($request->is('api/*')) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Something went wrong during registration. Please try again.',
                ], 500);
            }

            return back()->withErrors(['error' => 'Something went wrong during registration. Please try again.']);
        }
    }

    /**
     * Check if an email is already registered.
     */
    public function checkEmailAvailability(Request $request)
    {
        $email = $request->input('email');
        $exists = User::where('email', $email)->exists();

        return response()->json(['taken' => $exists], 200);
    }
}
