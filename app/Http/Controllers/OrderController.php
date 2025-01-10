<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Mail\OrderStatusMail;
use Illuminate\Support\Facades\Mail;
use App\Notifications\OrderStatusNotification;
use App\Mail\OrderCompletedMail;

class OrderController extends Controller
{
    public function myOrders()
    {

        session(['notification_count' => 0]);

        // Fetch the user's orders
        $orders = Auth::user()->orders()->with('products')->orderBy('created_at', 'desc')->get();

        // Update the session with the latest unread notifications count
        session(['notification_count' => auth()->user()->unreadNotifications()->count()]);

        return view('frontend.orders', compact('orders'));
    }

    public function getOrderDetails($id)
    {
        try {
            $order = Order::with('products')->findOrFail($id);
            return response()->json([
                'success' => true,
                'order' => $order,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Order not found.',
            ], 404);
        }
    }

    public function index(Request $request)
    {
        $search = $request->input('search');


        session(['notification_count' => 0]);

        // Fetch orders with associated products
        $orders = Order::with('products')
            ->when($search, function ($query, $search) {
                $query->where('customer_name', 'like', "%$search%")
                    ->orWhere('email', 'like', "%$search%")
                    ->orWhere('phone', 'like', "%$search%")
                    ->orWhere('status', 'like', "%$search%")
                    ->orWhere('payment_method', 'like', "%$search%")
                    ->orWhere('delivery_method', 'like', "%$search%");
            })
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        // Update the session with the latest unread notifications count
        session(['notification_count' => auth()->user()->unreadNotifications()->count()]);

        // Fetch unread notifications for the logged-in user
        $user = auth()->user();
        $notifications = $user ? $user->unreadNotifications : [];

        // Return the view with the orders and notifications
        return view('dashboard.orders.index', compact('orders', 'notifications'));
    }

    public function create()
    {
        // Fetch all products and their variations
        $products = Product::with('variations')->get();

        return view('dashboard.orders.create', compact('products'));
    }


    public function store(Request $request)
    {
        $validated = $request->validate([
            'customer_name' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'required|string|max:20',
            'status' => 'required|string|in:pending,completed,cancelled',
            'payment_method' => 'required|string|in:cash,gcash',
            'delivery_method' => 'required|string|max:255',
            'products' => 'required|array|min:1',
            'products.*.product_id' => 'required|exists:products,id',
            'products.*.quantity' => 'required|integer|min:1',
            'products.*.variation' => 'nullable|string|max:255',
            'reference_number' => 'nullable|string|max:255',
            'proof_of_payment' => 'nullable|file|mimes:jpg,png,jpeg,pdf|max:2048',
            'total_amount' => 'required|numeric|min:0',
            'cart' => 'required|json',
        ]);

        DB::beginTransaction();

        try {
            // Upload proof of payment if provided
            $proofOfPaymentPath = null;
            if ($request->hasFile('proof_of_payment')) {
                $proofOfPaymentPath = $request->file('proof_of_payment')->store('proofs', 'public');
            }

            // Calculate total amount
            $totalAmount = $this->calculateTotalAmount($validated['products']);
            $discount = 0; // Assume no discount initially

            // Create the order
            $order = Order::create([
                'customer_name' => $validated['customer_name'],
                'email' => $validated['email'],
                'phone' => $validated['phone'],
                'status' => $validated['status'],
                'payment_method' => $validated['payment_method'],
                'delivery_method' => $validated['delivery_method'],
                'total_amount' => $totalAmount,
                'discount' => $discount,
                'reference_number' => $validated['reference_number'] ?? null,
                'proof_of_payment' => $proofOfPaymentPath,
            ]);

            // Save cart items
            $cartItems = json_decode($validated['cart'], true);
            foreach ($cartItems as $item) {
                $order->products()->attach($item['id'], [
                    'quantity' => $item['quantity'],
                    'price' => $item['price'],
                    'variation' => $item['variation'] ?? null,
                ]);
            }

            DB::commit();

            session()->forget('cart'); // Clear session cart data
            session()->forget('cart_discount');
            session()->put('cart_count', 0);

            return redirect()->route('dashboard.orders.index')->with(['success' => 'Order created successfully!', 'alert' => 'alert-success']);
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['error' => 'Failed to create order: ' . $e->getMessage()]);
        }
    }

    public function getProductVariations($productId)
    {
        $variations = \App\Models\ProductVariation::where('product_id', $productId)->get();

        return response()->json($variations);
    }


    public function showDetails($orderId)
    {
        $order = Order::with('products')->findOrFail($orderId);

        if ($order->user_id !== auth()->id()) {
            abort(403, 'Unauthorized action.');
        }

        return view('frontend.order-show', compact('order'));
    }

    public function cancelOrder(Request $request, $orderId)
    {
        $order = Order::findOrFail($orderId);

        if ($order->user_id !== auth()->id() || $order->status !== 'pending') {
            abort(403, 'Unauthorized action or the order cannot be canceled.');
        }

        $order->update(['status' => 'cancelled']);

        return redirect()->route('orders.index')->with('message', 'Order has been canceled successfully.');
    }

    public function show($orderId)
    {
        // Retrieve the order with products, variations, and user relationships
        $order = Order::with(['products.variations', 'user'])->findOrFail($orderId);

        // Debug: Check if the user is loaded correctly
        $user = $order->user;
        logger('Order user ID: ' . optional($user)->id);

        // Pass the order to the view
        return view('dashboard.orders.show', compact('order'));
    }

    public function edit(Order $order)
    {
        // Load the order's products and their variations
        $order->load(['products.variations']);

        // Fetch all products and their variations for selection
        $products = Product::with('variations')->get();

        return view('dashboard.orders.edit', compact('order', 'products'));
    }


    public function update(Request $request, Order $order)
    {
        $validated = $request->validate([
            'customer_name' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'required|string|max:20',
            'status' => 'required|in:pending,completed,cancelled',
            'payment_method' => 'required|string|max:255',
            'delivery_method' => 'required|string|max:255',
            // Only validate products if provided
            'products' => 'nullable|array|min:1',
            'products.*.product_id' => 'required_with:products|exists:products,id',
            'products.*.quantity' => 'required_with:products|integer|min:1',
            'products.*.variation' => 'nullable|string|max:255',
        ]);

        DB::beginTransaction();
        try {
            // Update the general order details
            $order->update([
                'customer_name' => $validated['customer_name'],
                'email' => $validated['email'],
                'phone' => $validated['phone'],
                'status' => $validated['status'],
                'payment_method' => $validated['payment_method'],
                'delivery_method' => $validated['delivery_method'],
                'total_amount' => $this->calculateTotalAmount($validated['products']),
            ]);

            // Only sync products if provided in the request
            if (isset($validated['products'])) {
                $productDetails = [];
                foreach ($validated['products'] as $product) {
                    $productDetails[$product['product_id']] = [
                        'quantity' => $product['quantity'],
                        'price' => Product::findOrFail($product['product_id'])->price,
                        'variation' => $product['variation'] ?? null,
                    ];
                }

                // Sync products with the order
                $order->products()->sync($productDetails);
            }

            DB::commit();
            return redirect()->route('dashboard.orders.index')->with(['success' => 'Order updated successfully!', 'alert' => 'alert-success']);
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['error' => 'Failed to update order: ' . $e->getMessage()]);
        }
    }

    public function updateStatus(Request $request, Order $order)
    {
        $validated = $request->validate([
            'status' => 'required|in:pending,completed,cancelled',
        ]);

        DB::beginTransaction();
        try {
            $oldStatus = $order->status;

            // Update the status only
            $order->update(['status' => $validated['status']]);

            // Handle reward points and notifications
            $user = $order->user;
            if ($user) {
                $earnedPoints = $this->calculateRewardPoints($order->total_amount);

                if ($oldStatus !== 'completed' && $order->status === 'completed') {
                    $user->increment('reward_points', $earnedPoints);
                    $user->notify(new OrderStatusNotification($order, 'completed'));
                } elseif ($oldStatus === 'completed' && $order->status !== 'completed') {
                    $user->decrement('reward_points', $earnedPoints);
                    $user->notify(new OrderStatusNotification($order, $order->status)); // Pass the current status
                }
            }

            DB::commit();
            return redirect()->route('dashboard.orders.index')->with(['success' => 'Order status updated successfully!', 'alert' => 'alert-success']);
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['error' => 'Failed to update status: ' . $e->getMessage()]);
        }
    }


    public function destroy($id)
    {
        DB::beginTransaction();

        try {
            $order = Order::findOrFail($id);

            // Detach products
            $order->products()->detach();

            // Delete related notifications
            DB::table('notifications')->where('notifiable_id', $id)->delete();

            $order->delete();

            DB::commit();

            return redirect()->route('dashboard.orders.index')
                ->with('success', 'Order deleted successfully!');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['error' => 'Failed to delete order: ' . $e->getMessage()]);
        }
    }

    private function calculateTotalAmount($products)
    {
        $total = 0;
        foreach ($products as $product) {
            $total += Product::findOrFail($product['product_id'])->price * $product['quantity'];
        }
        return $total;
    }

    private function calculateRewardPoints($totalAmount)
    {
        // Example: 1 point for every $10 spent
        return floor($totalAmount / 50);
    }

    private function getProductDetails($products)
    {
        $details = [];
        foreach ($products as $product) {
            $details[$product['product_id']] = [
                'quantity' => $product['quantity'],
                'price' => Product::findOrFail($product['product_id'])->price,
                'variation' => $product['variation'] ?? null,
            ];
        }
        return $details;
    }

    public function updateOrderStatus(Request $request, $id)
    {
        $validated = $request->validate([
            'status' => 'required|in:pending,completed,cancelled',
        ]);

        $order = Order::findOrFail($id); // Find the order by its ID
        $oldStatus = $order->status;
        $order->status = $validated['status'];
        $order->save();

        // Send email to the customer
        if ($order->email) {
            Mail::to($order->email)->send(new OrderStatusMail($order, $validated['status']));
        }

        // Add a database notification for the order
        DB::table('notifications')->insert([
            'type' => \App\Notifications\OrderStatusNotification::class,
            'notifiable_type' => 'App\Models\Order',
            'notifiable_id' => $order->id,
            'data' => json_encode([
                'order_id' => $order->id,
                'status' => $validated['status'],
                'customer_name' => $order->customer_name,
                'message' => "Your order #{$order->id} has been updated to '{$validated['status']}'!",
            ]),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->route('dashboard.orders.index')
            ->with('success', 'Order status updated and customer notified.');
    }

    public function notifications($orderId)
    {
        // Fetch unread notifications for the logged-in user
        $userNotifications = Auth::user()->unreadNotifications;

        // Fetch notifications specific to the given order
        $orderNotifications = DB::table('notifications')
            ->where('notifiable_type', 'App\Models\Order')
            ->where('notifiable_id', $orderId)
            ->latest()
            ->get();

        // Pass both user-specific unread notifications and order-specific notifications to the view
        return view('frontend.notifications', compact('userNotifications', 'orderNotifications'));
    }

    public function markNotificationsAsRead()
    {
        if (auth()->check()) {
            auth()->user()->unreadNotifications->markAsRead();
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Notifications marked as read.',
            'notification_count' => auth()->user()->unreadNotifications()->count()
        ]);
    }

}
