<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\Order;
use App\Models\Reservation;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class CashierController extends Controller
{
    public function showPOS()
    {
        // Fetch the latest transactions
        $latestTransactions = Order::orderBy('created_at', 'desc')
            ->take(5) // Limit to the latest 5 transactions
            ->get();

        // Fetch popular products by the number of orders
        $popularProducts = Product::withCount('orders') // Assuming a relationship exists
            ->orderBy('orders_count', 'desc')
            ->take(5) // Limit to the top 5 products
            ->get();

        // Fetch reservations as receipts
        $recentReceipts = Reservation::where('status', 'confirmed')
            ->orderBy('reservation_date', 'desc')
            ->take(5)
            ->get();

        // Calculate today's gross profit
        $today = now()->toDateString(); // Get today's date
        $todayOrders = Order::whereDate('created_at', $today)->get();

        $grossProfit = $todayOrders->sum(function ($order) {
            return $order->total_amount; // Total order amount
        });

        $totalCost = $todayOrders->sum(function ($order) {
            return $order->products->sum(function ($product) {
                return $product->cost_price * $product->pivot->quantity; // Assuming `cost_price` exists
            });
        });

        $netProfit = $grossProfit - $totalCost; // Calculate net profit

        return view('pos.POS', compact(
            'latestTransactions',
            'popularProducts',
            'recentReceipts',
            'grossProfit',
            'netProfit'
        ));
    }

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

    public function update(Request $request, $id)
    {
        $request->validate([
            'firstname' => 'required|string|max:255',
            'email' => 'required|email|max:255',
        ]);

        // Find the cashier by ID
        $cashier = User::findOrFail($id);

        // Update the fields
        $cashier->firstname = $request->input('firstname');
        $cashier->email = $request->input('email');

        // Save the changes
        $cashier->save();

        // Redirect back with success message
        return redirect()->route('cashierProfile.index')->with('success', 'Profile updated successfully!');
    }

    public function edit($id)
    {
        // Retrieve the cashier by ID
        $cashier = User::findOrFail($id); // Replace `User` with your Cashier model if different

        // Return the edit view with the cashier data
        return view('pos.cashierEdit', compact('cashier'));
    }

    public function index()
    {
        $categories = Category::limitedCategories()->get();
        $products = Product::whereIn('category_id', $categories->pluck('id'))->get();
        return view('pos.cashierPOS', compact('categories', 'products'));
    }

    public function checkout(Request $request)
    {
        // Validate request data
        $request->validate([
            'customer_name' => 'required|string|max:255',
            'email' => 'nullable|email|max:255',
            'phone' => 'nullable|string|max:15',
            'total_amount' => 'required|numeric|min:0',
            'payment_method' => 'required|string|in:cash,gcash',
            'delivery_method' => 'required|string|in:pickup,delivery',
            'cart' => 'required|array',
            'cart.*.id' => 'required|integer|exists:products,id',
            'cart.*.quantity' => 'required|integer|min:1',
            'reference_number' => 'nullable|string|max:255',
            'proof_of_payment' => 'nullable|file|mimes:jpeg,png,jpg,pdf|max:2048',
        ]);

        try {
            // Create new order
            $order = new Order();
            $order->customer_name = $request->customer_name;
            $order->email = $request->email;
            $order->phone = $request->phone;
            $order->address = $request->address; // Optional
            $order->total_amount = $request->total_amount;
            $order->status = 'pending'; // Default to pending
            $order->payment_method = $request->payment_method;
            $order->delivery_method = $request->delivery_method;

            // Handle file upload for GCash proof of payment
            if ($request->hasFile('proof_of_payment')) {
                $file = $request->file('proof_of_payment');
                $path = $file->store('proofs', 'public');
                $order->proof_of_payment = $path;
            }

            $order->reference_number = $request->reference_number; // Optional
            $order->gcash_reference_number = $request->gcash_reference_number; // Optional
            $order->user_id = auth()->id(); // Assign the authenticated user
            $order->save();

            // Save cart items to pivot table (order_product)
            foreach ($request->cart as $item) {
                $product = Product::find($item['id']);

                if ($product->stock < $item['quantity']) {
                    return response()->json([
                        'success' => false,
                        'message' => "Insufficient stock for {$product->name}."
                    ]);
                }

                // Deduct stock
                $product->stock -= $item['quantity'];
                $product->save();

                // Attach product to the order
                $order->products()->attach($product->id, [
                    'quantity' => $item['quantity'],
                    'price' => $product->price,
                    'variation' => $item['variation'] ?? null,
                ]);
            }

            return response()->json([
                'success' => true,
                'message' => 'Order placed successfully!',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to place order. ' . $e->getMessage(),
            ], 500);
        }
    }

    public function pos()
    {
        return view('pos.POS');
    }

    public function transactions()
    {
        $orders = Order::with('products')->orderBy('created_at', 'desc')->paginate(10);

        if ($orders->isEmpty()) {
            return back()->with('error', 'No orders found.');
        }

        return view('pos.transaction', compact('orders'));
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:pending,completed,cancelled',
        ]);

        $order = Order::findOrFail($id);
        $order->status = $request->status;
        $order->save();

        return redirect()->route('cashier.transactions')->with('success', 'Order status updated successfully!');
    }

    public function masterItem()
    {
        $allowedCategories = ['Espresso-Based', 'Coffee', 'Milk Tea', 'Non-Coffee', 'Snacks', 'Waffle', 'Ramen'];
        $categories = Category::whereIn('name', $allowedCategories)->get();
        $products = Product::with('category')->get();

        return view('pos.masteritem', compact('categories', 'products'));
    }

    public function reservationIndex()
    {
        $reservations = Reservation::orderBy('reservation_date', 'asc')->paginate(10); // Retrieve reservations
        $bookedDates = Reservation::where('status', 'confirmed')->pluck('reservation_date')->toArray(); // Fetch booked dates
        return view('pos.cashierReservation', compact('reservations', 'bookedDates'));
    }

    public function storeReservation(Request $request)
    {
        // Validate the reservation data
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone_number' => 'required|string|max:15',
            'reservation_date' => 'required|date',
            'reservation_time' => 'required|date_format:H:i',
            'number_of_guests' => 'required|integer|min:1',
            'note' => 'nullable|string',
        ]);

        // Check for existing reservations at the same time
        $existingReservation = Reservation::where('reservation_date', $validated['reservation_date'])
            ->where('reservation_time', $validated['reservation_time'])
            ->where('status', 'confirmed')
            ->exists();

        if ($existingReservation) {
            return redirect()->back()->withErrors('The selected date and time are already booked. Please choose another slot.');
        }

        // Create a new reservation
        Reservation::create($validated);

        return redirect()->route('cashierReservation.index')->with('success', 'Reservation created successfully.');
    }

    public function history(Request $request)
    {
        // Check which table (orders or reservations) is being paginated
        $orders = Order::orderBy('created_at', 'desc')->paginate(10, ['*'], 'orders_page');
        $reservations = Reservation::orderBy('created_at', 'desc')->paginate(10, ['*'], 'reservations_page');

        return view('pos.cashier-order-history', compact('orders', 'reservations'));
    }

    public function manageOrders()
    {
        // Fetch pending orders
        $orders = Order::where('status', 'pending')->orderBy('created_at', 'asc')->get();

        // Fetch pending reservations
        $reservations = Reservation::where('status', 'pending')->orderBy('reservation_date', 'asc')->get();

        // Pass the data to the view
        return view('pos.cashierManage', compact('orders', 'reservations'));
    }

    public function acceptOrder($id)
    {
        $order = Order::findOrFail($id);
        $order->status = 'completed';
        $order->save();

        return redirect()->back()->with('success', 'Order accepted successfully!');
    }

    public function cancelOrder($id)
    {
        $order = Order::findOrFail($id);
        $order->status = 'cancelled';
        $order->save();

        return redirect()->back()->with('success', 'Order cancelled successfully!');
    }

    public function acceptReservation($id)
    {
        $reservation = Reservation::findOrFail($id);
        $reservation->status = 'completed';
        $reservation->save();

        return redirect()->back()->with('success', 'Reservation accepted successfully!');
    }

    public function cancelReservation($id)
    {
        $reservation = Reservation::findOrFail($id);
        $reservation->status = 'cancelled';
        $reservation->save();

        return redirect()->back()->with('success', 'Reservation cancelled successfully!');
    }

    public function logout(Request $request)
    {
        // Invalidate the session and log the user out
        auth()->logout();

        // Regenerate the session to prevent session fixation attacks
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // Redirect to the login page
        return redirect()->route('login-signup.form')->with('success', 'You have been logged out successfully.');
    }

    public function logoutCashier(Request $request)
    {
        Auth::guard('cashier')->logout();

        $request->session()->forget('cashier_auth_session');
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login-signup.form')->with('success', 'Cashier logged out successfully!');
    }

}