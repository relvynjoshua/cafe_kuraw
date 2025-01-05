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
    /**
     * Show the cart page with the cart items and order summary.
     */
    public function index()
    {
        $cart = session()->get('cart', []);
        $totalPrice = collect($cart)->sum(fn($item) => $item['price'] * $item['quantity']);
        $discount = session('cart_discount', 0); // Retrieve the applied discount
        $finalPrice = max(0, $totalPrice - $discount); // Calculate the final price after discount

        $orders = Auth::check() ? Auth::user()->orders()->orderBy('created_at', 'desc')->get() : collect();

        return view('frontend.cart', compact('cart', 'totalPrice', 'discount', 'finalPrice', 'orders'));
    }

    public function cartCount()
    {
        $cartCount = session('cart_count', 0);
        return response()->json(['cart_count' => $cartCount]);
    }

    /**
     * Add a product to the cart.
     */
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
            return response()->json(['status' => 'error', 'message' => 'Invalid product or variation.'], 400);
        }

        // Fetch existing cart or initialize it
        $cart = session()->get('cart', []);

        // Calculate current total quantity
        $currentTotalQuantity = collect($cart)->sum('quantity');

        // Check if adding the new quantity will exceed the limit
        if ($currentTotalQuantity + $quantity > 10) {
            return response()->json([
                'status' => 'error',
                'message' => 'You cannot order more than 10 items. Please call us for larger orders.'
            ], 400);
        }

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
                'variation' => "{$variation->type} - {$variation->value}",
                'quantity' => $quantity,
            ];
        }

        // Save updated cart to session
        session()->put('cart', $cart);

        // Update the cart count in session
        session()->put('cart_count', collect($cart)->sum('quantity'));

        $cartCount = collect($cart)->sum('quantity');
        session()->put('cart_count', $cartCount);

        return response()->json(['status' => 'success', 'message' => 'Product added to cart!', 'cart_count' => $cartCount]);
    }

    /**
     * Update the quantity of an item in the cart.
     */
    public function update(Request $request)
    {
        $itemId = $request->input('item_id');
        $quantity = $request->input('quantity');

        $cart = session()->get('cart', []);

        if (isset($cart[$itemId])) {
            $cart[$itemId]['quantity'] = $quantity;
            session()->put('cart', $cart);
        }

        $cartCount = collect($cart)->sum('quantity');
        session()->put('cart_count', $cartCount);

        return response()->json(['status' => 'success', 'message' => 'Cart updated successfully!', 'cart_count' => $cartCount]);
    }
    /**
     * Remove an item from the cart.
     */
    public function remove(Request $request)
    {
        $itemId = $request->input('item_id');

        $cart = session()->get('cart', []);

        if (isset($cart[$itemId])) {
            unset($cart[$itemId]);
            session()->put('cart', $cart);
        }

        $cartCount = collect($cart)->sum('quantity');
        session()->put('cart_count', $cartCount);

        return response()->json(['status' => 'success', 'message' => 'Item removed from cart.', 'cart_count' => $cartCount]);
    }
    /**
     * Checkout the cart and create an order.
     */
    public function checkout(Request $request)
    {
        // Validate request
        $validated = $request->validate([
            'customer_name' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'required|string|max:15',
            'payment_method' => 'required|string',
            'delivery_method' => 'required|string',
            'address' => 'nullable|string|max:255',
            'reference_number' => 'nullable|required_if:payment_method,Gcash|string|size:13',
            'proof_of_payment' => 'nullable|image|required_if:payment_method,Gcash|file|mimes:jpeg,png,jpg,pdf|max:2048',
        ]);

        if ($validated['delivery_method'] === 'pickup') {
            $validated['address'] = 'Kuraw Cafe';
        }

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

        $gcashProofPath = null;
        if ($request->payment_method === 'Gcash' && $request->hasFile('proof_of_payment')) {
            $gcashProofPath = $request->file('proof_of_payment')->store('gcash_proofs', 'public');
        }

        $order = Order::create([
            'user_id' => $user->id,
            'customer_name' => $validated['customer_name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'],
            'total_amount' => $finalAmount,
            'discount' => $discount,
            'status' => 'pending',
            'payment_method' => $validated['payment_method'],
            'delivery_method' => $validated['delivery_method'],
            'address' => $validated['address'],
            'reference_number' => $validated['reference_number'] ?? null,
            'proof_of_payment' => $gcashProofPath,
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

        $admins = User::where('role', 'admin')->get();
        foreach ($admins as $admin) {
            $admin->notify(new NewOrderPlaced($order));
        }

        // Clear the cart session and reset cart count
        session()->forget(['cart', 'cart_discount']);
        session()->put('cart_count', 0); // Reset cart count to zero

        return redirect()->route('cart.index')->with('success', 'Order placed successfully!');
    }
}