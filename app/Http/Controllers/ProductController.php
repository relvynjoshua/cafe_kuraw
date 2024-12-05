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
        // Get search query
        $search = $request->input('search');

        // Fetch products with optional search filters and paginate results
        $products = Product::with('category')
            ->when($search, function ($query, $search) {
                $query->where('name', 'like', "%$search%")
                    ->orWhere('price', 'like', "%$search%")
                    ->orWhereHas('category', function ($q) use ($search) {
                        $q->where('name', 'like', "%$search%");
                    });
            })
            ->paginate(10); // Display 10 products per page

        return view('dashboard.products.index', compact('products'));
    }

    // Show the form to add a new product
    public function showAdd()
    {
        $categories = Category::all();
        return view('dashboard.products.create', compact('categories'));
    }

    // Show a single product by its ID
    public function show($id)
    {
        $product = Product::findOrFail($id);
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

        return redirect()->route('dashboard.products.index')->with('message', 'Product added successfully!');
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
        $product = Product::findOrFail($id);

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

        $imagePath = $product->image;

        if ($request->hasFile('image')) {
            if ($product->image) {
                \Storage::delete('public/' . $product->image);
            }

            $imagePath = $request->file('image')->store('products', 'public');
        }

        // Update the product
        $product->update(array_merge(
            $request->only('name', 'price', 'description', 'category_id'),
            ['image' => $imagePath]
        ));

        // Update variations
        if ($request->has('variations')) {
            $product->variations()->delete(); // Remove existing variations
            foreach ($request->variations as $variation) {
                $product->variations()->create($variation); // Recreate variations
            }
        }

        return redirect()->route('dashboard.products.index')->with('message', 'Product updated successfully!');
    }

    // Delete a product from the database
    public function destroy($id)
    {
        $product = Product::with('variations')->findOrFail($id);

        // Delete variations first
        $product->variations()->delete();

        // Delete product image from storage
        if ($product->image) {
            \Storage::delete('public/' . $product->image);
        }

        $product->delete();

        return redirect()->route('dashboard.products.index')->with(['message' => 'Product deleted successfully!', 'alert' => 'alert-success']);
    }
}
;