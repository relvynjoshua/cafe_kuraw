<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\ProductVariation;

class ProductController extends Controller
{
    // Show the list of products
    public function index(Request $request)
    {
        $search = $request->input('search');

        // Fetch products with optional search filters, category, and variations
        $products = Product::with(['category', 'variations'])
            ->when($search, function ($query, $search) {
                $query->where('name', 'like', "%$search%")
                    ->orWhere('price', 'like', "%$search%")
                    ->orWhereHas('category', function ($q) use ($search) {
                        $q->where('name', 'like', "%$search%");
                    });
            })
            ->orderBy('id', 'asc') // Ensure IDs are returned in ascending order
            ->paginate(10);

        // Check if the request is an API call
        if ($request->is('api/*')) {
            return response()->json([
                'status' => 'success',
                'products' => $products->items(),
                'pagination' => [
                    'current_page' => $products->currentPage(),
                    'last_page' => $products->lastPage(),
                    'total' => $products->total(),
                ],
            ], 200);
        }

        // For web response
        return view('dashboard.products.index', compact('products'));
    }

    public function allProducts(Request $request)
    {
        $search = $request->input('search');

        // Fetch products with category and variations without pagination
        $products = Product::with(['category', 'variations'])
            ->when($search, function ($query, $search) {
                $query->where('name', 'like', "%$search%")
                    ->orWhere('price', 'like', "%$search%")
                    ->orWhereHas('category', function ($q) use ($search) {
                        $q->where('name', 'like', "%$search%");
                    });
            })
            ->orderBy('id', 'asc')
            ->get();

        return response()->json([
            'status' => 'success',
            'products' => $products,
        ], 200);
    }

    // Show the form to add a new product
    public function showAdd()
    {
        $categories = Category::all();
        return view('dashboard.products.create', compact('categories'));
    }

    // Show a single product by its ID
    public function show($id, Request $request)
    {
        // Fetch product with category and variations
        $product = Product::with('category', 'variations')->findOrFail($id);

        // API Response
        if ($request->is('api/*')) {
            return response()->json([
                'status' => 'success',
                'product' => $product,
            ], 200);
        }

        // Web Response
        return view('dashboard.products.show', compact('product'));
    }

    // Store a new product in the database
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'description' => 'required|string|max:500',
            'category_id' => 'required|exists:categories,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'variations.*.type' => 'required|string|max:255',
            'variations.*.value' => 'required|string|max:255',
            'variations.*.price' => 'required|numeric|min:0',
        ]);

        $imagePath = null;

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('products', 'public');
        }

        // Create the product
        $product = Product::create(array_merge(
            $request->only('name', 'price', 'description', 'category_id'),
            ['image' => $imagePath]
        ));

        // Save product variations
        if ($request->has('variations')) {
            foreach ($request->variations as $variation) {
                $product->variations()->create($variation);
            }
        }

        if ($request->is('api/*')) {
            return response()->json([
                'status' => 'success',
                'message' => 'Product created successfully.',
                'product' => $product,
            ], 201);
        }

        return redirect()->route('dashboard.products.index')->with(['message' => 'Product added successfully!', 'alert' => 'alert-success']);
    }

    // Show the form to edit an existing product
    public function showEdit($id)
    {
        $product = Product::with('variations')->findOrFail($id);
        $categories = Category::all();
        return view('dashboard.products.edit', compact('product', 'categories'));
    }

    // Update an existing product in the database
    public function update(Request $request, $id)
    {
        // Find the product by ID
        $product = Product::findOrFail($id);

        // Validate the input
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'description' => 'required|string|max:500',
            'category_id' => 'required|exists:categories,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'variations.*.type' => 'required|string|max:255',
            'variations.*.value' => 'required|string|max:255',
            'variations.*.price' => 'required|numeric|min:0',
        ]);

        // Retain the existing image path
        $imagePath = $product->image;

        // Handle the image upload
        if ($request->hasFile('image')) {
            // Delete the old image if it exists
            if ($product->image && \Storage::exists('public/' . $product->image)) {
                \Storage::delete('public/' . $product->image);
            }

            // Store the new image
            $imagePath = $request->file('image')->store('products', 'public');
        }

        // Update the product
        $product->update([
            'name' => $request->input('name'),
            'price' => $request->input('price'),
            'description' => $request->input('description'),
            'category_id' => $request->input('category_id'),
            'image' => $imagePath, // Use new image path or retain old one
        ]);

        // Handle variations
        if ($request->has('variations')) {
            // Delete existing variations
            $product->variations()->delete();

            // Recreate variations
            foreach ($request->input('variations') as $variation) {
                $product->variations()->create([
                    'type' => $variation['type'],
                    'value' => $variation['value'],
                    'price' => $variation['price'],
                ]);
            }
        }

        // Redirect with success message
        if ($request->is('api/*')) {
            return response()->json([
                'status' => 'success',
                'message' => 'Product updated successfully.',
                'product' => $product,
            ], 200);
        }

        return redirect()->route('dashboard.products.index')->with(['message' => 'Product updated successfully!', 'alert' => 'alert-success']);
    }

    // Delete a product from the database
    public function destroy($id, Request $request)
    {
        $product = Product::with('variations')->findOrFail($id);

        $product->variations()->delete();

        if ($product->image) {
            \Storage::delete('public/' . $product->image);
        }

        $product->delete();

        // API Response
        if ($request->is('api/*')) {
            return response()->json([
                'status' => 'success',
                'message' => 'Product deleted successfully.',
            ], 200);
        }

        return redirect()->route('dashboard.products.index')->with(['message' => 'Product deleted successfully!', 'alert' => 'alert-danger']);
    }
}
;