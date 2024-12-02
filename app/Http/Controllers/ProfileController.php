<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    // Display a list of users with optional search functionality
    public function index(Request $request)
    {
        $search = $request->input('search');

        $users = User::when($search, function ($query, $search) {
            $query->where('firstname', 'like', "%$search%")
                ->orWhere('email', 'like', "%$search%");
        })
        ->orderBy('id', 'DESC')
        ->paginate(10); // Adjust pagination size as needed

        return view('dashboard.profile.index', compact('users'));
    }

    // Show the edit form for a specific user
    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('dashboard.profile.edit', compact('user'));
    }

    // Update a user's profile
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'firstname' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
            'password' => 'nullable|min:8',
        ]);

        $user->firstname = $request->firstname;
        $user->email = $request->email;

        if ($request->password) {
            $user->password = bcrypt($request->password);
        }

        $user->save();

        return redirect()->route('dashboard.profile.index')->with('success', 'Profile updated successfully.');
    }
}
