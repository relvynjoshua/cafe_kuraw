<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use App\Notifications\OrderStatusNotification;
use App\Models\PointsHistory;
use Illuminate\Support\Facades\Storage;
use DB;

class OrderController extends Controller
{
    public function myOrders()
    {
        $orders = Auth::user()->orders()->with('products')->orderBy('created_at', 'desc')->get();

        if (request()->is('api/*')) {
            return response()->json(['orders' => $orders], 200);
        }

        return view('frontend.orders', compact('orders'));
    }

    public function index(Request $request)
    {
        $search = $request->input('search');
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

        if (request()->is('api/*')) {
            return response()->json(['orders' => $orders], 200);
        }

        return view('dashboard.orders.index', compact('orders'));
    }

    public function create()
    {
        $products = Product::with('variations')->get();
        return view('dashboard.orders.create', compact('products'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'customer_name' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'required|string|max:20',
            'address' => 'required_if:delivery_method,delivery|string|max:255',
            'payment_method' => 'required|string|in:GCash',
            'reference_number' => 'required_if:payment_method,GCash|string|max:50',
            'proof_of_payment' => 'required_if:payment_method,GCash|image|max:2048',
            'products' => 'required|array|min:1',
            'products.*.product_id' => 'required|exists:products,id',
            'products.*.quantity' => 'required|integer|min:1|max:10',
            'products.*.variation' => 'nullable|string|max:255',
        ]);

        if (array_sum(array_column($validated['products'], 'quantity')) > 10) {
            return back()->withErrors(['error' => 'Orders exceeding 10 items must be placed directly with the business.']);
        }

        DB::beginTransaction();
        try {
            $redeemedPoints = session()->get('redeemed_points', 0);
            $discount = $redeemedPoints;
            $totalAmount = max(0, $this->calculateTotalAmount($validated['products']) - $discount);

            $proofPath = null;
            if ($request->hasFile('proof_of_payment')) {
                $proofPath = $request->file('proof_of_payment')->store('proofs', 'public');
            }

            $order = Order::create([
                'user_id' => Auth::id(),
                'customer_name' => $validated['customer_name'],
                'email' => $validated['email'],
                'phone' => $validated['phone'],
                'address' => $validated['address'] ?? null,
                'status' => 'Preparing',
                'payment_method' => $validated['payment_method'],
                'delivery_method' => $validated['delivery_method'] ?? null,
                'reference_number' => $validated['reference_number'] ?? null,
                'proof_of_payment' => $proofPath,
                'total_amount' => $totalAmount,
                'discount' => $discount,
            ]);

            foreach ($validated['products'] as $product) {
                $order->products()->attach($product['product_id'], [
                    'quantity' => $product['quantity'],
                    'price' => Product::findOrFail($product['product_id'])->price,
                    'variation' => $product['variation'] ?? null,
                ]);
            }

            $user = Auth::user();
            if ($redeemedPoints > 0) {
                $user->decrement('reward_points', $redeemedPoints);
                PointsHistory::create([
                    'user_id' => $user->id,
                    'activity' => 'Redeemed points for order discount',
                    'points' => -$redeemedPoints,
                ]);
            }

            if ($order->status === 'completed') {
                $earnedPoints = $this->calculateRewardPoints($totalAmount);
                $user->increment('reward_points', $earnedPoints);
                PointsHistory::create([
                    'user_id' => $user->id,
                    'activity' => 'Earned points for completed order',
                    'points' => $earnedPoints,
                ]);
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
        $order->load(['products.variations', 'products']);
        return view('frontend.order_show', compact('order'));
    }

    public function edit(Order $order)
    {
        $order->load(['products.variations']);
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
            'products' => 'nullable|array|min:1',
            'products.*.product_id' => 'required_with:products|exists:products,id',
            'products.*.quantity' => 'required_with:products|integer|min:1',
            'products.*.variation' => 'nullable|string|max:255',
        ]);

        DB::beginTransaction();
        try {
            $order->update([
                'customer_name' => $validated['customer_name'],
                'email' => $validated['email'],
                'phone' => $validated['phone'],
                'status' => $validated['status'],
                'payment_method' => $validated['payment_method'],
                'delivery_method' => $validated['delivery_method'],
                'total_amount' => $this->calculateTotalAmount($validated['products']),
            ]);

            if (isset($validated['products'])) {
                $productDetails = $this->getProductDetails($validated['products']);
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
            $order->update(['status' => $validated['status']]);

            $user = $order->user;
            if ($user) {
                $earnedPoints = $this->calculateRewardPoints($order->total_amount);

                if ($oldStatus !== 'completed' && $order->status === 'completed') {
                    $user->increment('reward_points', $earnedPoints);
                    PointsHistory::create([
                        'user_id' => $user->id,
                        'activity' => 'Earned points for status update to completed',
                        'points' => $earnedPoints,
                    ]);
                } elseif ($oldStatus === 'completed' && $order->status !== 'completed') {
                    $user->decrement('reward_points', $earnedPoints);
                    PointsHistory::create([
                        'user_id' => $user->id,
                        'activity' => 'Deducted points due to status change',
                        'points' => -$earnedPoints,
                    ]);
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
            $order->products()->detach();
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

    public function cancel(Order $order)
    {
        if (Auth::id() !== $order->user_id) {
            return redirect()->route('orders.index')->with('error', 'You do not have permission to cancel this order.');
        }

        if (!$order->isCancelable()) {
            return redirect()->route('orders.index')->with('error', 'This order has already been accepted and cannot be canceled.');
        }

        $order->update(['status' => 'cancelled']);
        return redirect()->route('orders.index')->with('success', 'Your order has been successfully canceled.');
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
