<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;

class ProductController extends Controller
{
    // Show the list of products
    public function index()
    {
        $products = Product::orderBy('id', 'DESC')->with('category')->get();
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
        // Validate the incoming request
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'description' => 'required|string|max:500',
            'category_id' => 'required|exists:categories,id',
        ]);

        // Create the product
        Product::create($request->only('name', 'price', 'description', 'category_id'));

        return redirect()->route('dashboard.products.index')->with(['message' => 'Product added successfully!', 'alert' => 'alert-success']);
    }

    // Show the form to edit an existing product
    public function showEdit($id)
    {
        $product = Product::findOrFail($id);
        $categories = Category::all();
        return view('dashboard.products.edit', compact('product', 'categories'));
    }

    // Update an existing product in the database
    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        // Validate the request
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'description' => 'required|string|max:500',
            'category_id' => 'required|exists:categories,id',
        ]);

        // Update the product
        $product->update($request->only('name', 'price', 'description', 'category_id'));

        return redirect()->route('dashboard.products.index')->with(['message' => 'Product updated successfully!', 'alert' => 'alert-success']);
    }

    // Delete a product from the database
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();

        return redirect()->route('dashboard.products.index')->with(['message' => 'Product deleted successfully!', 'alert' => 'alert-success']);
    }
}
