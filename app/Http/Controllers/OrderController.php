<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Product;
use DB;

class OrderController extends Controller
{
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
            // Create the order
            $order = Order::create([
                'customer_name' => $validated['customer_name'],
                'email' => $validated['email'],
                'phone' => $validated['phone'],
                'status' => $validated['status'],
                'payment_method' => $validated['payment_method'],
                'delivery_method' => $validated['delivery_method'],
                'total_amount' => $this->calculateTotalAmount($validated['products']),
            ]);

            // Attach products to the order
            foreach ($validated['products'] as $product) {
                $order->products()->attach($product['product_id'], [
                    'quantity' => $product['quantity'],
                    'price' => Product::find($product['product_id'])->price,
                    'variation' => $product['variation'] ?? null,
                ]);
            }

            DB::commit();
            return redirect()->route('dashboard.orders.index')->with('success', 'Order created successfully!');
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
            'products' => 'required|array|min:1',
            'products.*.product_id' => 'required|exists:products,id',
            'products.*.quantity' => 'required|integer|min:1',
            'products.*.variation' => 'nullable|string|max:255',
        ]);

        DB::beginTransaction();
        try {
            // Update the order details
            $order->update([
                'customer_name' => $validated['customer_name'],
                'email' => $validated['email'],
                'phone' => $validated['phone'],
                'status' => $validated['status'],
                'payment_method' => $validated['payment_method'],
                'delivery_method' => $validated['delivery_method'],
                'total_amount' => $this->calculateTotalAmount($validated['products']),
            ]);

            // Sync products with updated details
            $order->products()->sync($this->getProductDetails($validated['products']));

            DB::commit();
            return redirect()->route('dashboard.orders.index')->with('success', 'Order updated successfully!');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['error' => 'Failed to update order: ' . $e->getMessage()]);
        }
    }

    public function destroy(Order $order)
    {
        DB::beginTransaction();
        try {
            $order->products()->detach(); // Detach all products from the order
            $order->delete();

            DB::commit();
            return redirect()->route('dashboard.orders.index')->with('success', 'Order deleted successfully!');
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
