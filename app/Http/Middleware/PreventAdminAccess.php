<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PreventAdminAccess
{
    public function handle(Request $request, Closure $next)
    {
        dd('PreventAdminAccess middleware triggered'); // Debugging point
    }

}
