<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class SettingsController extends Controller
{
    public function index()
    {
        $user = Auth::user(); // Get the currently authenticated user
        return view('dashboard.pages.settings', compact('user'));
    }
}
