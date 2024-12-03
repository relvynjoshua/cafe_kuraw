<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Product;
use App\Models\Stock;

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
        $products = Product::all();  // Get all products for the order form
        return view('dashboard.orders.create', compact('products'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'customer_name' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'required|string|max:20',
            'status' => 'required|string',
            'payment_method' => 'required|string|max:255',
            'delivery_method' => 'required|string|max:255',
            'products' => 'required|array|min:1',
            'products.*.product_id' => 'required|exists:products,id',
            'products.*.quantity' => 'required|integer|min:1',
        ]);

        // Calculate total amount for the order
        $totalAmount = $this->calculateTotalAmount($validated['products']);

        // Create the order
        $order = Order::create([
            'customer_name' => $validated['customer_name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'],
            'status' => $validated['status'],
            'payment_method' => $validated['payment_method'], // Add payment_method
            'delivery_method' => $validated['delivery_method'], // Add delivery_method
            'total_amount' => $totalAmount,  // Store the total amount
        ]);

        // Loop through products and add them to the order
        foreach ($validated['products'] as $product) {
            $productModel = Product::findOrFail($product['product_id']);
            $order->products()->attach($product['product_id'], [
                'quantity' => $product['quantity'],
                'price' => $productModel->price, // Attach the product's price
            ]);
        }

        return redirect()->route('dashboard.orders.index')->with('success', 'Order created successfully!');
    }

    public function show(Order $order)
    {
        // Eager load products for the show page
        $order->load('products');

        // Return the order with its associated products
        return view('dashboard.orders.show', compact('order'));
    }

    public function edit(Order $order)
    {
        $products = Product::all();  // Get all products for the order form
        return view('dashboard.orders.edit', compact('order', 'products'));
    }

    public function update(Request $request, Order $order)
    {
        $request->validate([
            'customer_name' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'required|string|max:15',
            'status' => 'required|in:pending,completed,cancelled',
            'payment_method' => 'required|string|max:255',
            'delivery_method' => 'required|string|max:255',
            'products' => 'required|array|min:1',
            'products.*.product_id' => 'required|exists:products,id',
            'products.*.quantity' => 'required|numeric|min:1',
        ]);

        // Begin a transaction to ensure data integrity
        \DB::beginTransaction();

        try {
            // Update the order
            $order->update([
                'customer_name' => $request->customer_name,
                'email' => $request->email,
                'phone' => $request->phone,
                'total_amount' => $this->calculateTotalAmount($request->products),
                'status' => $request->status,
                'payment_method' => $request->payment_method,
                'delivery_method' => $request->delivery_method,
            ]);

            // Sync products to the order (i.e., update quantities, remove deleted products)
            $order->products()->sync($this->getProductQuantities($request->products));

            \DB::commit();

            return redirect()->route('dashboard.orders.index')
                ->with('success', 'Order updated successfully.');

        } catch (\Exception $e) {
            \DB::rollBack();
            return back()->withErrors(['error' => 'Failed to update order: ' . $e->getMessage()]);
        }
    }

    public function destroy(Order $order)
    {
        try {
            // Begin a transaction to delete the order and associated data
            \DB::beginTransaction();

            // Restore stock if necessary
            foreach ($order->products as $product) {
                $stock = $product->stock;
                if ($stock) {
                    $stock->quantity += $product->pivot->quantity; // Revert stock reduction
                    $stock->save();
                }
            }

            // Delete the order
            $order->delete();

            \DB::commit();

            return redirect()->route('dashboard.orders.index')
                ->with('success', 'Order deleted successfully.');

        } catch (\Exception $e) {
            \DB::rollBack();
            return back()->withErrors(['error' => 'Failed to delete order: ' . $e->getMessage()]);
        }
    }

    private function calculateTotalAmount($products)
    {
        $total = 0;
        foreach ($products as $productData) {
            $product = Product::findOrFail($productData['product_id']);
            $total += $product->price * $productData['quantity'];
        }
        return $total;
    }

    private function getProductQuantities($products)
    {
        $productQuantities = [];
        foreach ($products as $productData) {
            $productQuantities[$productData['product_id']] = [
                'quantity' => $productData['quantity'],
                'price' => Product::findOrFail($productData['product_id'])->price,
            ];
        }
        return $productQuantities;
    }
}
