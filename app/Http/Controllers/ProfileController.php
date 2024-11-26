<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use App\Models\User;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index(Request $request)
{
    $query = $request->input('search');
    $users = User::when($query, function ($q) use ($query) {
        $q->where('name', 'like', "%$query%")
          ->orWhere('email', 'like', "%$query%");
    })->get();

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
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email,' . $id,
        'password' => 'nullable|min:8',
    ]);

    $user->name = $request->name;
    $user->email = $request->email;

    if ($request->password) {
        $user->password = bcrypt($request->password);
    }

    $user->save();

    return redirect()->route('dashboard.profile.index')->with('success', 'Profile updated successfully.');
}

}
