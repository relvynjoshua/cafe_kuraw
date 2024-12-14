<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use App\Notifications\NewOrderPlaced;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index()
    {
        $cart = session()->get('cart', []);
        $totalPrice = collect($cart)->sum(fn($item) => $item['price'] * $item['quantity']);
        $discount = session('cart_discount', 0); // Retrieve the applied discount
        $finalPrice = max(0, $totalPrice - $discount); // Calculate the final price after discount

        $orders = Auth::check() ? Auth::user()->orders()->orderBy('created_at', 'desc')->get() : collect();

        return view('frontend.cart', compact('cart', 'totalPrice', 'discount', 'finalPrice', 'orders'));
    }

    public function add(Request $request)
    {
        $productId = $request->input('product_id');
        $variationId = $request->input('variation_id');
        $quantity = $request->input('quantity', 1);

        // Find product and variation
        $product = Product::with('variations')->find($productId);
        $variation = $product->variations->find($variationId);

        // Validation: Ensure product and variation exist
        if (!$product || !$variation) {
            return redirect()->route('menu')->withErrors('Product or variation not found. Please select a valid option.');
        }

        // Fetch existing cart or initialize it
        $cart = session()->get('cart', []);

        // Use product and variation ID as a unique cart key
        $cartKey = $productId . '-' . $variationId;

        if (isset($cart[$cartKey])) {
            $cart[$cartKey]['quantity'] += $quantity;
        } else {
            // Add new item to the cart
            $cart[$cartKey] = [
                'name' => $product->name,
                'image' => $product->image,
                'price' => $variation->price, // Use variation price
                'variation' => "{$variation->type} - {$variation->value}", // Display variation details
                'quantity' => $quantity,
            ];
        }

        // Save updated cart to session
        session()->put('cart', $cart);

        return redirect()->route('menu')->with('success', 'Product added to cart!');
    }

    public function update(Request $request)
    {
        $itemId = $request->input('item_id');
        $quantity = $request->input('quantity');

        $cart = session()->get('cart', []);

        if (isset($cart[$itemId])) {
            $cart[$itemId]['quantity'] = $quantity;
            session()->put('cart', $cart);
        }

        return redirect()->route('cart.index')->with('success', 'Cart updated successfully!');
    }

    public function remove(Request $request)
    {
        $itemId = $request->input('item_id');

        $cart = session()->get('cart', []);

        if (isset($cart[$itemId])) {
            unset($cart[$itemId]);
            session()->put('cart', $cart);
        }

        return redirect()->route('cart.index')->with('success', 'Item removed from cart.');
    }

    public function checkout(Request $request)
    {
        $validated = $request->validate([
            'customer_name' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'required|string|max:15',
            'payment_method' => 'required|string',
            'delivery_method' => 'required|string',
        ]);

        $cart = session()->get('cart', []);
        $discount = session('cart_discount', 0);

        if (empty($cart)) {
            return redirect()->route('cart.index')->withErrors('Your cart is empty.');
        }

        $totalAmount = collect($cart)->sum(fn($item) => $item['price'] * $item['quantity']);
        $finalAmount = max(0, $totalAmount - $discount);

        $user = Auth::user();
        if (!$user) {
            return redirect()->route('login')->withErrors('You must be logged in to place an order.');
        }

        $order = Order::create([
            'customer_name' => $validated['customer_name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'],
            'total_amount' => $totalAmount,
            'status' => 'pending',
            'payment_method' => $validated['payment_method'],
            'delivery_method' => $validated['delivery_method'],
        ]);

        foreach ($cart as $key => $item) {
            [$productId, $variationId] = explode('-', $key);
            $order->products()->attach($productId, [
                'quantity' => $item['quantity'],
                'price' => $item['price'],
                'variation' => $item['variation'] ?? null,
            ]);
        }

        if ($discount > 0) {
            \App\Models\PointsHistory::create([
                'user_id' => $user->id,
                'activity' => 'Redeemed points for cart checkout',
                'points' => -$discount,
            ]);
        }

        // Notify all admins
        $admins = User::where('role', 'admin')->get();
        foreach ($admins as $admin) {
            $admin->notify(new NewOrderPlaced($order));
            \Log::info("Notification sent to admin: {$admin->id} for order: {$order->id}");
        }

        session()->forget(['cart', 'cart_discount']); // Clear session data after checkout

        return redirect()->route('cart.index')->with('success', 'Order placed successfully!');
    }

    public function redeemPoints(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'points' => 'required|integer|min:1|max:' . $user->reward_points,
        ]);

        $pointsToRedeem = $request->input('points');

        if (session()->has('cart_discount')) {
            return back()->withErrors(['error' => 'You have already redeemed points.']);
        }

        session(['cart_discount' => $pointsToRedeem]);

        return redirect()->route('cart.index')->with('success', "$pointsToRedeem points have been applied to your cart.");
    }
}
