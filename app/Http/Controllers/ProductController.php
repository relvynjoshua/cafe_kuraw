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
        $products = Product::all();
        return view('dashboard.product.index', compact('products'));
    }

    // Show a single product by its ID
    public function show($id)
    {
        $product = Product::find($id);
        return view('dashboard.product.show', compact('product'));
    }

    // Show the form to create a new product
    public function create()
    {
        // Fetch all categories
        $categories = Category::all(); // Assuming you have a Category model
        
        // Pass the categories to the view
        return view('dashboard.product.create', compact('categories'));
    }

    // Store a new product in the database
    public function store(Request $request)
    {
        $product = new Product();
        $product->name = $request->input('name');
        $product->price = $request->input('price');
        $product->description = $request->input('description');
        $product->save();

        return redirect()->route('dashboard.product.index');
    }

    // Show the form to edit an existing product
    public function edit($id)
    {
        $product = Product::find($id);
        return view('dashboard.product.edit', compact('product'));
    }

    // Update an existing product in the database
    public function update(Request $request, $id)
    {
        $product = Product::find($id);
        $product->name = $request->input('name');
        $product->price = $request->input('price');
        $product->description = $request->input('description');
        $product->save();

        return redirect()->route('dashboard.product.index');
    }

    // Delete a product from the database
    public function destroy($id)
    {
        $product = Product::find($id);
        $product->delete();

        return redirect()->route('dashboard.product.index');
    }
}
