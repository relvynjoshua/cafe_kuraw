<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Mail\ResetPasswordMail;
use App\Models\User;

class CustomForgotPasswordController extends Controller
{
    /**
     * Show the reset link request form.
     */
    public function showLinkRequestForm()
    {
        return view('auth.passwords.email');
    }

    /**
     * Handle sending the reset link email.
     */
    public function sendResetLinkEmail(Request $request)
    {
        // Validate the email input
        $request->validate(['email' => 'required|email']);

        // Find user by email
        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return back()->withErrors(['email' => 'The provided email does not exist in our system.']);
        }

        // Generate reset token
        $token = Str::random(60);

        // Store the reset token (hashed) in password_resets table
        DB::table('password_resets')->updateOrInsert(
            ['email' => $user->email],
            [
                'token' => Hash::make($token),
                'created_at' => now()
            ]
        );

        // Generate reset link
        $resetLink = url('/password/reset/' . urlencode($token) . '?email=' . urlencode($user->email));

        // Send the reset link via email
        Mail::to($user->email)->send(new ResetPasswordMail($resetLink));

        return back()->with('success', 'Please check your email. A password reset link has been sent.');
    }

    /**
     * Show the password reset form.
     */
    public function showResetForm(Request $request, $token)
    {
        return view('auth.passwords.reset', [
            'token' => $token,
            'email' => $request->email
        ]);
    }

    /**
     * Handle resetting the password.
     */
    public function reset(Request $request)
    {
        // Validate the reset form inputs
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|confirmed|min:6',
        ]);

        // Retrieve the password reset record
        $resetRecord = DB::table('password_resets')->where('email', $request->email)->first();

        if (!$resetRecord || !Hash::check($request->token, $resetRecord->token)) {
            return back()->withErrors(['email' => 'Invalid or expired reset token.']);
        }

        // Reset the user's password
        $user = User::where('email', $request->email)->first();
        if ($user) {
            $user->password = Hash::make($request->password);
            $user->save();

            // Delete the reset record
            DB::table('password_resets')->where('email', $request->email)->delete();

            return redirect('/login-signup')->with('success', 'Your password has been reset successfully.');
        }

        return back()->withErrors(['email' => 'Unable to reset password.']);
    }
}
