<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\Stock;
use App\Models\Supplier;

class ProductController extends Controller
{
    // Show the list of products
    public function index()
    {
        $products = Product::orderBy('id', 'DESC')->get();
        return view('dashboard.products.index', compact('products'));
    }

    // Show all added products
    public function showAdd()
    {
        $categories = Category::all();
        return view('dashboard.products.create', compact('categories'));
    }

    // Show a single product by its ID
    public function show($id)
    {
        $product = Product::find($id);
        return view('dashboard.products.show', compact('product'));
    }

    // Show the form to create a new product
    public function create()
    {
        // Fetch all categories
        $categories = Category::all(); // Assuming you have a Category model
        
        // Pass the categories to the view
        return view('dashboard.products.create', compact('categories'));
    }

    // Store a new product in the database
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required'],
            'price' => ['required'],
            'description' => ['required'],
            'category_id' => ['required'],
        ]);

        Product::create([
            'name' => $request->input('name'),
            'price' => $request->input('price'),
            'description' => $request->input('description'),
            'category_id' => $request->category_id,
        ]);

        return redirect()->route('dashboard.products.index')->with(['message' => 'Product added', 'alert' => 'alert-success']);
    }

    // Show the form to edit an existing product
    public function edit($id)
    {
        $product = Product::find($id);
        $categories = Category::all();

        return view('dashboard.products.edit', compact('product', 'categories'));
    }

    // Update an existing product in the database
    public function update($id, Request $request)
    {
        $product = Product::find($id);

        $request->validate([
            'name' => ['required'],
            'price' => ['required'],
            'description' => ['required'],
            'category_id' => ['required'],
        ]);

        $product->name = $request->input('name');
        $product->price = $request->input('price');
        $product->description = $request->input('description');
        $product->category_id = $request->input('category_id');
        $product->save();
    
        return redirect()->route('dashboard.products.index')->with(['message' => 'Product updated', 'alert' => 'alert-success']);
    }

    // Delete a product from the database
    public function destroy($id)
    {
        $product = Product::find($id);
        $product->delete();

        return redirect()->route('dashboard.products.index')->with(['message' => 'Product deleted', 'alert' => 'alert-success']);
    }
}
