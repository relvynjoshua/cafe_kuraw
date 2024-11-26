<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Facades\Log;

class CategoryController extends Controller
{
    // Show the list of categories
    public function index()
    {
        $categories = Category::orderBy('id', 'DESC')->paginate(10); // Show 10 categories per page
    return view('dashboard.category.index', compact('categories'));
    }

    // Show the form to add a new category
    public function create()
    {
        return view('dashboard.category.create');
    }

    // Show a single category by its ID
    public function show($id)
    {
        $category = Category::findOrFail($id); // Use findOrFail for better error handling
        return view('dashboard.category.show', compact('category'));
    }

    // Store a new category in the database
    public function store(Request $request)
    {
        // Validate the request
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        // Create the category
        Category::create([
            'name' => $request->name,
        ]);

        return redirect()->route('dashboard.category.index')->with([
            'message' => 'Category added successfully!',
            'alert' => 'alert-success',
        ]);
    }

    // Show the form to edit an existing category
    public function edit($id)
    {
        $category = Category::findOrFail($id); // Use findOrFail for better error handling
        return view('dashboard.category.edit', compact('category'));
    }

    // Update an existing category in the database
    public function update(Request $request, $id)
    {
        $category = Category::findOrFail($id);

        // Validate the request
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        // Update the category
        $category->update([
            'name' => $request->name,
        ]);

        return redirect()->route('dashboard.category.index')->with([
            'message' => 'Category updated successfully!',
            'alert' => 'alert-success',
        ]);
    }

    // Delete a category from the database
    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();

        return redirect()->route('dashboard.category.index')->with([
            'message' => 'Category deleted successfully!',
            'alert' => 'alert-danger',
        ]);
    }
}
