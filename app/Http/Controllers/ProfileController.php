<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
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
            $query->where('is_active', $request->status === 'active' ? true : false);
        }

        if ($request->has('sort')) {
            $query->orderBy($request->sort, $request->get('direction', 'asc'));
        }

        $users = $query->paginate(10);

        return view('dashboard.profile.index', compact('users'));
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('dashboard.profile.edit', compact('user'));
    }

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
        $user = User::findOrFail($id);

        if (!$user->is_active) {
            return redirect()->route('dashboard.profile.index')->with('error', 'User is already disabled.');
        }

        $user->update(['is_active' => false]);

        return redirect()->route('dashboard.profile.index')->with('success', "User '{$user->firstname}' has been disabled.");
    }

    public function enable($id)
    {
        $user = User::findOrFail($id);

        if ($user->is_active) {
            return redirect()->route('dashboard.profile.index')->with('error', 'User is already active.');
        }

        $user->update(['is_active' => true]);

        return redirect()->route('dashboard.profile.index')->with('success', "User '{$user->firstname}' has been enabled.");
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
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
