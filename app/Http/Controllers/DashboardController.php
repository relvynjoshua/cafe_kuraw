<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        $totalProducts = \App\Models\Product::count();
        $totalSuppliers = \App\Models\Supplier::count();
        $totalCategories = \App\Models\Category::count();
        $totalInventory = \App\Models\Inventory::count();
        $totalReservations = \App\Models\Reservation::count();
        $totalCustomers = \App\Models\User::count();
        $totalOrders = \App\Models\Order::count();

        $notifications = $user->unreadNotifications;

        return view('dashboard.index', compact('totalProducts', 'totalCustomers',
            'totalSuppliers', 'totalCategories', 'totalInventory', 'totalReservations', 'totalOrders', 'notifications'));
    }
}
