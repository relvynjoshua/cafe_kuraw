<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\PDF;

class ReportController extends Controller
{
    public function orders(Request $request)
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

    public function reservations(Request $request)
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
