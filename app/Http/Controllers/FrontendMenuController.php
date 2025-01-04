<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class FrontendMenuController extends Controller
{
    // Method for displaying all products
    public function index()
    {
        // Fetch all products
        $products = Product::with('variations')->get();

        // Static categories for menu
        $categories = [
            1 => 'Espresso-Based Coffee',
            2 => 'Milktea',
            3 => 'Non-Coffee',
            4 => 'Snacks',
            5 => 'Waffle',
            6 => 'Ramen',
        ];

        // Pass data to the view
        return view('frontend.menu', compact('products', 'categories'))->with('selectedCategory', null);
    }

    // Method for displaying products by category
    public function category($id)
    {
        // Fetch products by category
        $products = Product::with('variations')->where('category_id', $id)->get();

        // Static categories for menu
        $categories = [
            1 => 'Espresso-Based Coffee',
            2 => 'Milktea',
            3 => 'Non-Coffee',
            4 => 'Snacks',
            5 => 'Waffle',
            6 => 'Ramen',
        ];

        // Pass data to the view
        return view('frontend.menu', compact('products', 'categories'))->with('selectedCategory', $id);
    }
}

