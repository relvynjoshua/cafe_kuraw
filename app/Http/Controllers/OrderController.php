<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use App\Notifications\OrderStatusNotification;
use DB;

class OrderController extends Controller
{
    public function myOrders()
    {
        $orders = Auth::user()->orders()->with('products')->orderBy('created_at', 'desc')->get();
        return view('frontend.orders', compact('orders'));
    }
    public function index(Request $request)
    {
        $search = $request->input('search');

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

        return view('dashboard.orders.index', compact('orders'));
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
            'payment_method' => 'required|string|max:255',
            'delivery_method' => 'required|string|max:255',
            'products' => 'required|array|min:1',
            'products.*.product_id' => 'required|exists:products,id',
            'products.*.quantity' => 'required|integer|min:1',
            'products.*.variation' => 'nullable|string|max:255',
        ]);

        DB::beginTransaction();
        try {
            $redeemedPoints = session()->get('redeemed_points', 0);
            $discount = $redeemedPoints;
            $totalAmount = max(0, $this->calculateTotalAmount($validated['products']) - $discount);

            // Create the order and associate it with the authenticated user
            $order = Order::create([
                'user_id' => Auth::id(),
                'customer_name' => $validated['customer_name'],
                'email' => $validated['email'],
                'phone' => $validated['phone'],
                'status' => $validated['status'],
                'payment_method' => $validated['payment_method'],
                'delivery_method' => $validated['delivery_method'],
                'total_amount' => $totalAmount,
                'discount' => $discount,
            ]);

            // Attach products to the order
            foreach ($validated['products'] as $product) {
                $order->products()->attach($product['product_id'], [
                    'quantity' => $product['quantity'],
                    'price' => Product::find($product['product_id'])->price,
                    'variation' => $product['variation'] ?? null,
                ]);
            }

            // Deduct redeemed points from user
            if ($redeemedPoints > 0) {
                $user = Auth::user();
                $user->decrement('reward_points', $redeemedPoints);
            }

            // Reward points logic for completed orders
            if ($order->status === 'completed') {
                $user = Auth::user();
                $earnedPoints = $this->calculateRewardPoints($totalAmount);
                $user->increment('reward_points', $earnedPoints);
            }

            session()->forget('redeemed_points');
            DB::commit();
            return redirect()->route('dashboard.orders.index')->with(['success' => 'Order created successfully!', 'alert' => 'alert-success']);
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['error' => 'Failed to create order: ' . $e->getMessage()]);
        }
    }

    public function show(Order $order)
    {
        $order->load(['products.variations']); // Eager-load variations for each product

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
                    $user->notify(new OrderStatusNotification($order));
                } elseif ($oldStatus === 'completed' && $order->status !== 'completed') {
                    $user->decrement('reward_points', $earnedPoints);
                    $user->notify(new OrderStatusNotification($order));
                }
            }

            DB::commit();
            return redirect()->route('dashboard.orders.index')->with(['success' => 'Order status updated successfully!', 'alert' => 'alert-success']);
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['error' => 'Failed to update status: ' . $e->getMessage()]);
        }
    }


    public function destroy(Order $order)
    {
        DB::beginTransaction();
        try {
            $order->products()->detach(); // Detach all products from the order

            if ($order->status === 'completed') {
                $user = Auth::user();
                $earnedPoints = $this->calculateRewardPoints($order->total_amount);
                $user->decrement('reward_points', $earnedPoints);
            }

            $order->delete();

            DB::commit();
            return redirect()->route('dashboard.orders.index')->with(['success' => 'Order deleted successfully!', 'alert' => 'alert-danger']);
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
}
