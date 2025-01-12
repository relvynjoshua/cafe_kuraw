<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\OTPMail;
use App\Models\User;
use Carbon\Carbon;

class OTPController extends Controller
{
    /**
     * Send OTP to a user's email.
     */
    public function sendOTP(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ]);

        if (User::where('email', $request->email)->doesntExist()) {
            return response()->json(['error' => 'User with this email does not exist.'], 404);
        }

        $otp = mt_rand(100000, 999999);
        $expiresAt = Carbon::now()->addMinutes(10);

        session([
            'otp' => $otp,
            'otp_email' => $request->email,
            'otp_expires_at' => $expiresAt,
        ]);

        try {
            Mail::to($request->email)->send(new OTPMail($otp));
            return response()->json(['message' => 'OTP sent successfully to your email.'], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to send OTP. Please try again.'], 500);
        }
    }

    /**
     * Verify the provided OTP.
     */
    public function verifyOTP(Request $request)
    {
        $request->validate([
            'otp' => 'required|numeric',
        ]);

        // Determine if the request is from API or Web
        if ($request->is('api/*')) {
            // Handle API request
            $validated = $request->validate([
                'email' => 'required|email', // Ensure email is included for API calls
            ]);

            // Find the user by email
            $user = User::where('email', $validated['email'])->first();

            if (!$user) {
                return response()->json(['error' => 'User not found.'], 404);
            }

            // Check OTP and expiration
            if (
                $user->otp == $request->otp &&
                Carbon::now()->lessThanOrEqualTo($user->otp_expires_at)
            ) {
                // Clear OTP data from the user
                $user->otp = null;
                $user->otp_expires_at = null;
                $user->save();

                return response()->json(['message' => 'OTP verified successfully.'], 200);
            }

            return response()->json(['error' => 'Invalid OTP or OTP has expired.'], 400);
        } else {
            // Handle web request using session storage
            if ($request->otp == session('otp')) {
                session()->forget('otp');

                return redirect()->route('login')->with('success', 'OTP verified successfully!');
            }

            return back()->withErrors(['otp' => 'Invalid OTP. Please try again.']);
        }
    }

}
