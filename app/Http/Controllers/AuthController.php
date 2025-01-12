<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\OTPMail; // For sending OTP email
use Carbon\Carbon; // For date/time handling

class AuthController extends Controller
{
    /**
     * Handle user registration (Web and API).
     */
    public function register(Request $request)
    {
        $request->validate([
            'firstname' => 'required|string|max:255',
            'email' => 'required|email|unique:users|max:255',
            'password' => 'required|string|confirmed|min:5',
        ]);

        // Create User
        $user = User::create([
            'firstname' => $request->firstname,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'user', // Default role for new users
        ]);

        // Generate OTP for email verification
        $otp = rand(100000, 999999);
        $user->otp = $otp;
        $user->otp_expires_at = Carbon::now()->addMinutes(10);
        $user->save();
        Mail::to($user->email)->send(new OTPMail($otp));

        if ($request->is('api/*')) {
            $token = $user->createToken('auth_token')->plainTextToken;
            return response()->json([
                'message' => 'Registration successful, OTP sent to your email.',
                'access_token' => $token,
                'token_type' => 'Bearer',
                'user' => $user,
            ], 201);
        }

        return response()->json(['message' => 'Registration successful, OTP sent to your email.'], 200);
    }

    /**
     * Handle user and admin login (Web and API).
     */
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string|min:5',
        ]);

        $credentials = $request->only('email', 'password');

        // Attempt to log in the user
        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            // Handle API login
            if ($request->is('api/*')) {
                $token = $user->createToken('auth_token')->plainTextToken;

                return response()->json([
                    'status' => 'success',
                    'message' => 'Logged in successfully.',
                    'user' => $user,
                    'access_token' => $token,
                    'token_type' => 'Bearer',
                ], 200);
            }

            // Handle web login
            if ($user->role === 'admin') {
                return redirect()->route('dashboard.index')->with('success', 'Welcome, Admin!');
            } elseif ($user->role === 'user') {
                return redirect()->route('menu')->with('success', 'Logged in successfully!');
            }

            // Fallback for unknown roles
            return redirect('/')->with('error', 'Unauthorized role.');
        }

        // Handle failed login
        if ($request->is('api/*')) {
            return response()->json([
                'status' => 'error',
                'message' => 'Invalid credentials.',
            ], 401);
        }

        return back()->withErrors(['email' => 'Invalid credentials'])->withInput();
    }



    /**
     * Verify OTP after login.
     */


    /**
     * Handle user logout.
     */
    public function logoutUser(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->forget('web_auth_session');
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login-signup.form')->with('success', 'User logged out successfully!');
    }

    /**
     * Handle admin logout.
     */
    public function logoutAdmin(Request $request)
    {
        Auth::guard('admin')->logout();

        $request->session()->forget('admin_auth_session');
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login-signup.form')->with('success', 'Admin logged out successfully!');
    }

    /**
     * Handle API logout.
     */
    public function LogoutAccount(Request $request)
    {
        $request->user()->tokens()->delete();
        return response()->json(['message' => 'Logged out successfully'], 200);
    }
}