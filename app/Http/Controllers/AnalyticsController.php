<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use Carbon\Carbon;

class AnalyticsController extends Controller
{
    public function index(Request $request)
    {
        // Total Sales
        $totalSales = Order::sum('total_amount');

        // Sales This Month
        $salesThisMonth = Order::whereBetween('created_at', [now()->startOfMonth(), now()->endOfMonth()])
                                ->sum('total_amount');

        // Daily Sales for Last 7 Days
        $dailySales = Order::selectRaw('DATE(created_at) as date, SUM(total_amount) as total')
                            ->whereBetween('created_at', [now()->subDays(7), now()])
                            ->groupBy('date')
                            ->get();

        // Top-Selling Products
        $topProducts = Order::join('order_product', 'orders.id', '=', 'order_product.order_id')
                            ->join('products', 'order_product.product_id', '=', 'products.id')
                            ->select('products.name', \DB::raw('SUM(order_product.quantity) as total_quantity'))
                            ->groupBy('products.name')
                            ->orderByDesc('total_quantity')
                            ->limit(5)
                            ->get();

        return view('dashboard.analytics', compact('totalSales', 'salesThisMonth', 'dailySales', 'topProducts'));
    }
}

