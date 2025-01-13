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

    public function cartCount()
    {
        $cartCount = session('cart_count', 0);
        return response()->json(['cart_count' => $cartCount]);
    }


    public function index(Request $request)
    {
        $cart = [];
        $discount = 0;

        if ($request->is('api/*')) {
            $user = Auth::user();

            if (!$user) {
                return response()->json(['status' => 'error', 'message' => 'Unauthorized'], 401);
            }

            $cart = json_decode($user->cart_items ?? '[]', true);
            $discount = $user->cart_discount ?? 0;

            $cartCount = collect($cart)->sum('quantity');
            $totalPrice = collect($cart)->sum(fn($item) => $item['price'] * $item['quantity']);
            $finalPrice = max(0, $totalPrice - $discount);

            return response()->json([
                'status' => 'success',
                'cart' => $cart,
                'cart_count' => $cartCount,
                'total_price' => $totalPrice,
                'discount' => $discount,
                'final_price' => $finalPrice,
            ], 200);
        }

        $cart = session()->get('cart', []);
        $discount = session('cart_discount', 0);

        $cartCount = collect($cart)->sum('quantity');
        $totalPrice = collect($cart)->sum(fn($item) => $item['price'] * $item['quantity']);
        $finalPrice = max(0, $totalPrice - $discount);

        session()->put('cart_count', $cartCount);

        $orders = Auth::check() ? Auth::user()->orders()->orderBy('created_at', 'desc')->get() : collect();

        return view('frontend.cart', compact('cart', 'totalPrice', 'discount', 'finalPrice'));
    }

    /**
     * Add a product to the cart.
     */
    public function add(Request $request)
    {
        $productId = $request->input('product_id');
        $variationId = $request->input('variation_id');
        $quantity = $request->input('quantity', 1);

        // Find the product and variation
        $product = Product::with('variations')->find($productId);
        $variation = $product?->variations->firstWhere('id', $variationId);

        if (!$product || !$variation) {
            $message = 'Invalid product or variation.';
            return $request->is('api/*')
                ? response()->json(['status' => 'error', 'message' => $message], 400)
                : redirect()->back()->withErrors($message);
        }

        // Fetch the cart (API or Web)
        $cart = $request->is('api/*')
            ? json_decode(Auth::user()->cart_items ?? '[]', true)
            : session()->get('cart', []);

        // Calculate current total quantity
        $maxCartItems = 10;
        $currentTotalQuantity = collect($cart)->sum('quantity');
        if ($currentTotalQuantity + $quantity > $maxCartItems) {
            $message = "You cannot order more than {$maxCartItems} items. Please call us for larger orders.";
            return $request->is('api/*')
                ? response()->json(['status' => 'error', 'message' => $message], 400)
                : redirect()->back()->withErrors($message);
        }

        // Use product and variation ID as a unique cart key
        $cartKey = "{$productId}-{$variationId}";

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

        // Save the updated cart
        if ($request->is('api/*')) {
            $user = Auth::user();
            if ($user) {
                $user->cart_items = json_encode($cart);
                $user->save();
            } else {
                return response()->json(['status' => 'error', 'message' => 'Unauthorized'], 401);
            }
        } else {
            session()->put('cart', $cart);
        }

        // Update cart count
        $cartCount = collect($cart)->sum('quantity');
        if (!$request->is('api/*')) {
            session()->put('cart_count', $cartCount);
        }

        // Calculate totals for API response
        $totalPrice = collect($cart)->sum(fn($item) => $item['price'] * $item['quantity']);
        $discount = session('cart_discount', 0);
        $finalPrice = max(0, $totalPrice - $discount);

        // Debugging Logs (for troubleshooting)
        \Log::info('Cart Updated', ['cart' => $cart, 'cart_count' => $cartCount]);

        // Return responses for API or Web
        if ($request->is('api/*')) {
            return response()->json([
                'status' => 'success',
                'message' => 'Product added to cart!',
                'cart' => $cart,
                'cart_count' => $cartCount,
                'total_price' => $totalPrice,
                'discount' => $discount,
                'final_price' => $finalPrice,
            ], 200);
        }

        return response()->json(['status' => 'success', 'message' => 'Product added to cart!', 'cart_count' => $cartCount]);
    }



    /**
     * Checkout the cart and create an order.
     */
    public function checkout(Request $request)
    {
        // Validate the request
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

        // Default address for pickup
        if ($validated['delivery_method'] === 'pickup') {
            $validated['address'] = 'Kuraw Cafe';
        }

        // Retrieve cart based on API or session
        $cart = $request->is('api/*')
            ? json_decode(Auth::user()->cart_items ?? '[]', true)
            : session()->get('cart', []);

        // Return error if cart is empty
        if (empty($cart)) {
            return response()->json([
                'status' => 'error',
                'message' => 'Cart is empty. Cannot proceed to checkout.',
            ], 400);
        }

        // Calculate totals
        $discount = session('cart_discount', 0);
        $totalAmount = collect($cart)->sum(fn($item) => $item['price'] * $item['quantity']);
        $finalAmount = max(0, $totalAmount - $discount);

        // Handle proof of payment for GCash
        $gcashProofPath = null;
        if ($request->payment_method === 'Gcash' && $request->hasFile('proof_of_payment')) {
            $gcashProofPath = $request->file('proof_of_payment')->store('gcash_proofs', 'public');
        }

        // Create the order
        $order = Order::create([
            'user_id' => Auth::id(),
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

        // Attach products to the order
        foreach ($cart as $key => $item) {
            [$productId, $variationId] = explode('-', $key);
            $order->products()->attach($productId, [
                'quantity' => $item['quantity'],
                'price' => $item['price'],
                'variation' => $item['variation'] ?? null,
            ]);
        }

        // Notify admins and the user about the order
        $admins = User::where('role', 'admin')->get();
        foreach ($admins as $admin) {
            $admin->notify(new NewOrderPlaced($order));
        }
        Auth::user()->notify(new NewOrderPlaced($order));

        // Clear the cart after checkout
        if ($request->is('api/*')) {
            $user = Auth::user();
            if ($user) {
                $user->update(['cart_items' => json_encode([])]);
            }
        } else {
            session()->forget(['cart', 'cart_discount']);
        }

        // Return success response
        return $request->is('api/*')
            ? response()->json(['status' => 'success', 'message' => 'Order placed successfully!', 'order_id' => $order->id], 200)
            : redirect()->route('cart.index')->with('success', 'Order placed successfully!');
    }



    public function update(Request $request)
    {
        $itemId = $request->input('item_id');
        $quantity = $request->input('quantity');

        if (!$itemId || !$quantity || $quantity < 1) {
            return response()->json([
                'status' => 'error',
                'message' => 'Invalid item ID or quantity.',
            ], 400);
        }

        if ($request->is('api/*')) {
            $user = Auth::user();

            if (!$user) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Unauthorized',
                ], 401);
            }

            // Fetch and update cart from database
            $cart = json_decode($user->cart_items ?? '[]', true);

            if (isset($cart[$itemId])) {
                $cart[$itemId]['quantity'] = $quantity; // Update quantity
                $user->cart_items = json_encode($cart); // Save updated cart to DB
                $user->save(); // Save user changes
            } else {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Item not found in cart.',
                ], 404);
            }
        } else {
            // Fetch and update cart from session
            $cart = session()->get('cart', []);

            if (isset($cart[$itemId])) {
                $cart[$itemId]['quantity'] = $quantity; // Update quantity
                session()->put('cart', $cart); // Save updated cart in session
            } else {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Item not found in cart.',
                ], 404);
            }
        }

        // Recalculate totals
        $cartCount = collect($cart)->sum('quantity');
        $totalPrice = collect($cart)->sum(fn($item) => $item['price'] * $item['quantity']);

        // Do not attempt to save `cart_count` to the database
        // Only update it dynamically in the response or session

        if (!$request->is('api/*')) {
            session()->put('cart_count', $cartCount); // Update cart count in session
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Cart updated successfully!',
            'cart' => $cart,
            'cart_count' => $cartCount,
            'total_price' => $totalPrice,
        ]);
    }


    public function remove(Request $request)
    {
        $itemId = $request->input('item_id');

        // Fetch the cart (API or Web)
        $cart = $request->is('api/*')
            ? json_decode(Auth::user()->cart_items ?? '[]', true)
            : session()->get('cart', []);

        if (isset($cart[$itemId])) {
            unset($cart[$itemId]); // Remove the item

            // Save the updated cart
            if ($request->is('api/*')) {
                $user = Auth::user();
                if ($user) {
                    $user->cart_items = json_encode($cart);
                    $user->save();
                } else {
                    return response()->json(['status' => 'error', 'message' => 'Unauthorized'], 401);
                }
            } else {
                session()->put('cart', $cart);
            }
        } else {
            // If the item does not exist
            $message = 'Item not found in cart.';
            return $request->is('api/*')
                ? response()->json(['status' => 'error', 'message' => $message], 404)
                : redirect()->back()->withErrors($message);
        }

        // Recalculate totals
        $cartCount = collect($cart)->sum('quantity');
        $totalPrice = collect($cart)->sum(fn($item) => $item['price'] * $item['quantity']);
        $discount = session('cart_discount', 0);
        $finalPrice = max(0, $totalPrice - $discount);

        // Save cart count for web
        if (!$request->is('api/*')) {
            session()->put('cart_count', $cartCount);
        }

        // Return responses for API or Web
        if ($request->is('api/*')) {
            return response()->json([
                'status' => 'success',
                'message' => 'Item removed from cart.',
                'cart' => $cart,
                'cart_count' => $cartCount,
                'total_price' => $totalPrice,
                'discount' => $discount,
                'final_price' => $finalPrice,
            ]);
        }

        return redirect()->back()->with('success', 'Item removed from cart!');
    }
}
