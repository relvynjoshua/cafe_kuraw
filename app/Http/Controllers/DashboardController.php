<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        // Aggregate Data
        $totalProducts = \App\Models\Product::count();
        $totalSuppliers = \App\Models\Supplier::count();
        $totalCategories = \App\Models\Category::count();
        $totalInventory = \App\Models\Inventory::count();
        $totalReservations = \App\Models\Reservation::count();
        $totalCustomers = \App\Models\User::count();
        $totalOrders = Order::count();

        // Fetch all orders
        $orders = Order::with('products')->latest()->paginate(10); // Paginate if there are many orders

        // Fetch unread notifications
        $notifications = $user->unreadNotifications;

        return view('dashboard.index', compact(
            'totalProducts',
            'totalCustomers',
            'totalSuppliers',
            'totalCategories',
            'totalInventory',
            'totalReservations',
            'totalOrders',
            'orders',
            'notifications'
        ));
    }
}
