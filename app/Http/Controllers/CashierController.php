<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\Order;
use App\Models\Reservation;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Pagination\LengthAwarePaginator;

class CashierController extends Controller
{
    public function showPOS()
    {
        $categories = Category::limitedCategories()->get();
        $products = Product::whereIn('category_id', $categories->pluck('id'))->get();

        // Fetch the latest transactions
        $latestTransactions = Order::orderBy('created_at', 'desc')
            ->take(3) // Limit to the latest 5 transactions
            ->get();

        // Fetch popular products by the number of orders
        $popularProducts = Product::withCount('orders') // Assuming a relationship exists
            ->orderBy('orders_count', 'desc')
            ->take(3) // Limit to the top 5 products
            ->get();

        // Fetch reservations as receipts
        $recentReceipts = Reservation::where('status', 'confirmed')
            ->orderBy('reservation_date', 'desc')
            ->take(3)
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
            'netProfit',
            'categories',
            'products'
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
        $validated = $request->validate([
            'customer_name' => 'required|string|max:255',
            'email' => 'nullable|email|max:255',
            'phone' => 'nullable|string|max:15',
            'address' => 'nullable|string|max:65535',
            'total_amount' => 'required|numeric|min:0',
            'payment_method' => 'required|string|in:cash,gcash',
            'delivery_method' => 'required|string|in:dinein,takeout,pickup,delivery',
            'cart' => 'required|string', // Cart is sent as JSON string
            'reference_number' => 'nullable|string|max:255|required_if:payment_method,gcash',
            'proof_of_payment' => 'nullable|file|mimes:jpeg,png,jpg,pdf|max:2048|required_if:payment_method,gcash',
        ]);

        try {
            // Decode the cart JSON string
            $cart = json_decode($request['cart'], true);
            if (!$cart) {
                return response()->json([
                    'success' => false,
                    'message' => 'Invalid cart data.'
                ], 400);
            }

            // Create new order
            $order = new Order();
            $order->customer_name = $validated['customer_name'];
            $order->email = $validated['email'];
            $order->phone = $validated['phone'];
            $order->address = $validated['address'];
            $order->total_amount = $validated['total_amount'];
            $order->status = 'pending';
            $order->payment_method = $validated['payment_method'];
            $order->delivery_method = $validated['delivery_method'];

            // Handle GCash proof of payment
            if ($request->hasFile('proof_of_payment')) {
                $file = $request->file('proof_of_payment');
                $path = $file->store('proofs', 'public');
                $order->proof_of_payment = $path;
            }

            $order->reference_number = $validated['reference_number'] ?? null;
            $order->user_id = auth()->id(); // Optional: Assign authenticated user
            $order->save();

            // Save cart items to pivot table (order_product)
            foreach ($cart as $item) {
                \Log::info('Processing Cart Item:', $item); // Debugging

                $product = Product::find($item['id']);

                $variation = null;
                if (!empty($item['variation'])) { // Check if variation exists
                    $variation = $item['variation']; // Use the combined variation directly
                }

                \Log::info("Variation to Store: {$variation}"); // Debugging

                $order->products()->attach($product->id, [
                    'quantity' => $item['quantity'],
                    'price' => $item['price'],
                    'variation' => $variation,
                ]);
            }


            return response()->json([
                'success' => true,
                'message' => 'Order placed successfully!',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to place order: ' . $e->getMessage(),
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
        $allowedCategories = ['Espresso-Based Coffee', 'Milk Tea', 'Non-Coffee', 'Snacks', 'Waffle', 'Ramen'];
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
        // Fetch orders with initial filters (excluding transaction_id)
        $ordersQuery = Order::query();

        if ($request->filled('order_status')) {
            $ordersQuery->where('status', $request->order_status);
        }

        // Sort orders by created_at (latest first)
        $ordersQuery->orderByDesc('created_at');

        $orders = $ordersQuery->with('products')->get();

        // Filter orders by transaction_id or customer_name
        if ($request->filled('order_search')) {
            $search = $request->order_search;
            $orders = $orders->filter(function ($order) use ($search) {
                return str_contains($order->transaction_id, $search) ||
                    str_contains($order->customer_name, $search);
            });
        }

        // Paginate the results manually
        $currentPage = $request->get('page', 1);
        $perPage = 10;
        $ordersPaginated = new LengthAwarePaginator(
            $orders->forPage($currentPage, $perPage),
            $orders->count(),
            $perPage,
            $currentPage,
            ['path' => $request->url(), 'query' => $request->query()]
        );

        // Fetch reservations with filters
        $reservationsQuery = Reservation::query();

        if ($request->filled('reservation_status')) {
            $reservationsQuery->where('status', $request->reservation_status);
        }

        // Sort reservations by reservation_date and reservation_time (latest first)
        $reservationsQuery->orderByDesc('reservation_date')
            ->orderByDesc('reservation_time');

        $reservations = $reservationsQuery->get();

        if ($request->filled('reservation_search')) {
            $search = $request->reservation_search;
            $reservations = $reservations->filter(function ($reservation) use ($search) {
                return str_contains($reservation->reservation_id, $search) ||
                    str_contains($reservation->name, $search);
            });
        }

        // Paginate the reservations
        $reservationsPaginated = new LengthAwarePaginator(
            $reservations->forPage($currentPage, $perPage),
            $reservations->count(),
            $perPage,
            $currentPage,
            ['path' => $request->url(), 'query' => $request->query()]
        );

        return view('pos.cashier-order-history', [
            'orders' => $ordersPaginated,
            'reservations' => $reservationsPaginated,
        ]);
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