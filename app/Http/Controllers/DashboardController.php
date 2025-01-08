<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\PDF;
use App\Models\Reservation;

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

        // Calculate total sales
        $totalSales = Order::sum('total_amount');

        // Fetch all orders
        $latestOrders = Order::with('user')
            ->latest()
            ->take(3)
            ->get();

        // Fetch latest 5 reservations
        $latestReservations = \App\Models\Reservation::latest()
            ->latest()
            ->take(3)
            ->get();

        // Calculate orders by time
        $ordersDaily = Order::whereDate('created_at', now()->toDateString())->count();
        $ordersWeekly = Order::whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()])->count();
        $ordersMonthly = Order::whereMonth('created_at', now()->month)->whereYear('created_at', now()->year)->count();

        // Fetch category data with inventory count
        $inventoryByCategory = \App\Models\Inventory::select('category_id', DB::raw('count(*) as total'))
            ->groupBy('category_id')
            ->with('category') // Assuming a relationship exists between Inventory and Category
            ->get();

        // Prepare data for the chart
        $categories = $inventoryByCategory->pluck('category.name'); // Adjust field name if different
        $categoryCounts = $inventoryByCategory->pluck('total');

        // Fetch reward points for all users
        $rewardPoints = \App\Models\User::pluck('reward_points');

        // Example: Fetch customer growth over the last 6 months
        $customerGrowth = \App\Models\User::selectRaw('COUNT(id) as total, MONTH(created_at) as month, YEAR(created_at) as year')
            ->groupBy('year', 'month')
            ->orderBy('year')
            ->orderBy('month')
            ->take(6) // Fetch the last 6 months
            ->get()
            ->map(function ($item) {
                return [
                    'month' => Carbon::create()->month($item->month)->format('F') . ' ' . $item->year,
                    'total' => $item->total,
                ];
            });

        $growthMonths = $customerGrowth->pluck('month');
        $growthData = $customerGrowth->pluck('total');

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
            'latestOrders',
            'latestReservations',
            'notifications',
            'totalSales',
            'ordersDaily',
            'ordersWeekly',
            'ordersMonthly',
            'categories',
            'categoryCounts',
            'rewardPoints',
            'growthMonths',
            'growthData',
        ));
    }

    public function generateOrdersReport(Request $request)
    {
        $timeFrame = $request->input('time_frame', 'daily');

        // Filter orders based on the time frame
        $orders = Order::query();

        switch ($timeFrame) {
            case 'daily':
                $orders->whereDate('created_at', today());
                break;
            case 'weekly':
                $orders->whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()]);
                break;
            case 'monthly':
                $orders->whereMonth('created_at', now()->month)->whereYear('created_at', now()->year);
                break;
            case 'yearly':
                $orders->whereYear('created_at', now()->year);
                break;
        }

        $orders = $orders->get();

        // Generate PDF
        $pdf = PDF::loadView('dashboard.reports.orders', compact('orders', 'timeFrame'));

        // Return the PDF
        return $pdf->download("KURAW_orders_report_{$timeFrame}.pdf");
    }

    public function generateReservationsReport(Request $request)
    {
        $timeFrame = $request->input('time_frame', 'daily');

        // Filter reservations based on the time frame
        $reservations = Reservation::query();

        switch ($timeFrame) {
            case 'daily':
                $reservations->whereDate('created_at', today());
                break;
            case 'weekly':
                $reservations->whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()]);
                break;
            case 'monthly':
                $reservations->whereMonth('created_at', now()->month)->whereYear('created_at', now()->year);
                break;
            case 'yearly':
                $reservations->whereYear('created_at', now()->year);
                break;
        }

        $reservations = $reservations->get();

        // Generate PDF
        $pdf = PDF::loadView('dashboard.reports.reservations', compact('reservations', 'timeFrame'));

        // Return the PDF
        return $pdf->download("KURAW_reservations_report_{$timeFrame}.pdf");
    }
}
