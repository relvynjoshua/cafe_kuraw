<?php

namespace App\Http\Controllers;

use App\Models\Order; // Assuming you have an Order model
use App\Models\Reservation; // Assuming you have a Reservation model
use Illuminate\Http\Request;

class HistoryController extends Controller
{
    /**
     * Show the order and reservation history.
     *
     * @return \Illuminate\View\View
     */
    public function showHistory()
    {
        // Fetch orders and reservations from the database
        $orders = Order::all(); // You can customize this query based on your needs
        $reservations = Reservation::all(); // You can customize this query based on your needs

        // Pass the data to the view
        return view('pos.cashierHistory', compact('orders', 'reservations'));
    }
}