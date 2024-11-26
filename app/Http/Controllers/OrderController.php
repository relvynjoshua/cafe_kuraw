<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Order;

class OrderController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'customer_name' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'required|string|max:15',
            'total_amount' => 'required|numeric|min:0',
            'status' => 'required|in:pending,completed,cancelled',
        ]);

        Order::create($request->all());

        return redirect()->route('dashboard.orders.index')
            ->with('success', 'Order created successfully.');
    }

    public function update(Request $request, Order $order)
    {
        $request->validate([
            'customer_name' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'required|string|max:15',
            'total_amount' => 'required|numeric|min:0',
            'status' => 'required|in:pending,completed,cancelled',
        ]);

        $order->update($request->all());

        return redirect()->route('dashboard.orders.index')
            ->with('success', 'Order updated successfully.');
    }

    public function index() {
        $orders = Order::orderBy('id', 'DESC')->paginate(10); // Show 10 categories per page
        return view('dashboard.orders.index', compact(var_name: 'orders'));
    }

    public function showAdd() {
        // Display the form to add a new order
    }

    public function show($id) {
        // Display the details of a specific order
    }

    public function showEdit($id) {
        // Display the form to edit an existing order
    }

    public function destroy($id) {
        // Delete the specified order from the database
    }
}
