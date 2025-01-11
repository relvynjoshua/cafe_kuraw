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

            session()->flash('success', 'Quantity updated successfully!'); // Flash message
        }

        $cartCount = collect($cart)->sum('quantity');
        session()->put('cart_count', $cartCount);

        return redirect()->back(); // Redirect back with the success message
    }


    /**
     * Remove an item from the cart.
     */
    public function remove(Request $request)
    {
        $itemId = $request->input('item_id');

        // Get the current cart from the session
        $cart = session()->get('cart', []);

        // Check if the item exists in the cart
        if (isset($cart[$itemId])) {
            // Remove the item from the cart
            unset($cart[$itemId]);

            // Update the cart in the session
            session()->put('cart', $cart);
        }

        // Recalculate the cart count
        $cartCount = collect($cart)->sum('quantity');
        session()->put('cart_count', $cartCount);

        // Set a success flash message
        session()->flash('success', 'Item removed successfully!');

        // Redirect back to the cart page (or another route as needed)
        return redirect()->route('cart.index');
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
            'phone' => ['required', 'regex:/^0[0-9]{10}$/'], // Validates exactly 11 digits starting with 0
            'payment_method' => 'required|in:credit_card,paypal,Gcash',
            'reference_number' => 'required_if:payment_method,Gcash|digits:13',
            'proof_of_payment' => 'required_if:payment_method,Gcash|file|mimes:jpeg,png,jpg,pdf|max:2048',
            'delivery_method' => 'required|in:pickup,delivery',
            'address' => 'required_if:delivery_method,delivery|string|max:255',
        ], [
            'phone.regex' => 'The phone number must start with 0 and be exactly 11 digits.',
            'reference_number.required_if' => 'The GCash reference number is required when paying with GCash.',
            'reference_number.digits' => 'The GCash reference number must be exactly 13 digits.',
            'proof_of_payment.required_if' => 'Proof of payment is required for GCash payments.',
            'address.required_if' => 'The delivery address is required for delivery.',
        ]);

        // Handle empty cart scenario
        $cart = session()->get('cart', []);
        $discount = session('cart_discount', 0);
        if (empty($cart)) {
            return redirect()->route('cart.index')->withErrors('Your cart is empty.');
        }

        // Handle the total and final amounts
        $totalAmount = collect($cart)->sum(fn($item) => $item['price'] * $item['quantity']);
        $finalAmount = max(0, $totalAmount - $discount);

        $user = Auth::user();
        if (!$user) {
            return redirect()->route('login')->withErrors('You must be logged in to place an order.');
        }

        // Handle payment proof storage
        $gcashProofPath = null;
        if ($request->payment_method === 'Gcash' && $request->hasFile('proof_of_payment')) {
            $gcashProofPath = $request->file('proof_of_payment')->store('gcash_proofs', 'public');
        }

        // Create order
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

        // Clear the cart session
        session()->forget(['cart', 'cart_discount']);
        session()->put('cart_count', 0);

        // Return success message
        return redirect()->route('orders.index')->with('success', 'Your order has been successfully placed! Your order is currently being processed.');
    }
}