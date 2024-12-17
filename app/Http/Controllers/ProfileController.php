<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    // Display a list of users with optional search functionality
    public function index(Request $request)
    {
        $query = User::query();

        if ($request->has('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('firstname', 'like', '%' . $request->search . '%')
                    ->orWhere('email', 'like', '%' . $request->search . '%');
            });
        }

        if ($request->has('status')) {
            $query->where('is_active', $request->status === 'active');
        }

        if ($request->has('sort')) {
            $query->orderBy($request->sort, $request->get('direction', 'asc'));
        }

        $users = $query->paginate(10);
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

    public function disable($id)
    {
        $user = User::findOrFail($id); // Ensure user is fetched
        $user->update(['is_active' => false]); // Update the is_active column
        return redirect()->route('dashboard.profile.index')->with('success', 'User has been disabled.');
    }


    public function enable($id)
    {
        $user = User::findOrFail($id); // Ensure user is fetched
        $user->update(['is_active' => true]);
        return redirect()->route('dashboard.profile.index')->with('success', 'User has been enabled.');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id); // Ensure user is fetched
        $user->delete();
        return redirect()->route('dashboard.profile.index')->with('success', 'User has been deleted.');
    }
    public function restore($id)
    {
        $user = User::withTrashed()->findOrFail($id);
        $user->restore();
        return redirect()->route('dashboard.profile.index')->with('success', 'User has been restored.');
    }


}
