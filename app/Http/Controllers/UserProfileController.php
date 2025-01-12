<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserProfileController extends Controller
{
    /**
     * Show the user profile (Web and API).
     */
    public function show(Request $request)
    {
        $user = Auth::user();

        // API Response
        if ($request->is('api/*')) {
            return response()->json([
                'status' => 'success',
                'user' => $user,
            ], 200);
        }

        // Web Response
        return view('frontend.profile', compact('user'));
    }

    /**
     * Show the profile edit form (Web only).
     */
    public function edit()
    {
        $user = Auth::user();
        return view('frontend.profile-edit', compact('user'));
    }

    /**
     * Update user profile (Web and API).
     */
    public function update(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'firstname' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'current_password' => 'nullable|string|min:5|required_with:password',
            'password' => 'nullable|string|min:5|confirmed',
        ]);

        // Verify current password if provided
        if ($request->current_password) {
            if (!Hash::check($request->current_password, $user->password)) {
                if ($request->is('api/*')) {
                    return response()->json([
                        'status' => 'error',
                        'message' => 'The current password is incorrect.',
                    ], 422);
                }

                return redirect()->back()->withErrors(['current_password' => 'The current password is incorrect.']);
            }
        }

        // Update user information
        $user->update([
            'firstname' => $request->firstname,
            'email' => $request->email,
            'password' => $request->password ? Hash::make($request->password) : $user->password,
        ]);

        // API Response
        if ($request->is('api/*')) {
            return response()->json([
                'status' => 'success',
                'message' => 'Profile updated successfully.',
                'user' => $user,
            ], 200);
        }

        // Web Response
        return redirect()->route('profile')->with('success', 'Profile updated successfully.');
    }
}
