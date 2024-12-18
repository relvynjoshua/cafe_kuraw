<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CashierController extends Controller
{
    // Show the settings form
    public function settings()
{
    // Check if the user is authenticated
    if (!auth()->check()) {
        // Redirect to login if the user is not authenticated
        return redirect()->route('login')->with('error', 'You must be logged in to view your settings.');
    }

    // Retrieve the authenticated cashier (user)
    $cashier = auth()->user();

    // Return the settings view with the cashier data
    return view('pos.cashierSettings', compact('cashier'));
}

    // Update cashier settings
    public function updateSettings(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:15',
            'password' => 'nullable|string|min:8|confirmed',
            'role' => 'required|string|in:cashier,admin',
        ]);

        // Get the authenticated user
        $cashier = auth()->user();

        // Update the user's details
        $cashier->name = $request->input('name');
        $cashier->email = $request->input('email');
        $cashier->phone = $request->input('phone');
        $cashier->role = $request->input('role');

        if ($request->filled('password')) {
            $cashier->password = bcrypt($request->input('password'));
        }

        $cashier->save();

        // Redirect back to the settings page with a success message
        return redirect()->route('cashierSettings.index')->with('success', 'Settings updated successfully!');
    }

    public function profile()
    {
        // Check if the user is authenticated
        if (!auth()->check()) {
            return redirect()->route('login')->with('error', 'You must be logged in to view your profile.');
        }

        // Retrieve the authenticated user (cashier)
        $cashier = auth()->user();

        // Return the profile view with the cashier data
        return view('pos.cashierProfile', compact('cashier'));
    }
}