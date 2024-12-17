<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\OTPMail;
use App\Models\User;

class OTPController extends Controller
{
    public function sendOTP(Request $request)
    {
        // Validate email input
        $request->validate([
            'email' => 'required|email',
        ]);

        // Check if the email exists in the database
        $userExists = User::where('email', $request->email)->exists();

        if ($userExists) {
            return response()->json(['error' => 'This email is already registered. OTP cannot be sent.'], 400);
        }

        // Generate a random 6-digit OTP
        $otp = mt_rand(100000, 999999);

        // Store the OTP in the session for verification
        session(['otp' => $otp]);

        // Send OTP via email
        try {
            Mail::to($request->email)->send(new OTPMail($otp));
            return response()->json(['message' => 'OTP sent successfully to your email.']);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to send OTP. Please try again.'], 500);
        }
    }

    public function verifyOTP(Request $request)
    {
        $request->validate([
            'otp' => 'required|numeric',
        ]);

        // Compare entered OTP with stored OTP in session
        if ($request->otp == session('otp')) {
            session()->forget('otp');
            return response()->json(['message' => 'OTP verified successfully.']);
        } else {
            return response()->json(['error' => 'Invalid OTP. Please try again.'], 400);
        }
    }
}