<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class UserProfileController extends Controller
{
    public function show()
    {
        $user = Auth::user();
        return view('frontend.profile', compact('user'));
    }

    public function edit()
    {
        $user = Auth::user();
        return view('frontend.profile-edit', compact('user'));
    }

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
                return redirect()->back()->withErrors(['current_password' => 'The current password is incorrect.']);
            }
        }

        // Update user information
        $user->update([
            'firstname' => $request->firstname,
            'email' => $request->email,
            'password' => $request->password ? Hash::make($request->password) : $user->password,
        ]);

        return redirect()->route('profile')->with('success', 'Profile updated successfully.');
    }


}
