<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    // Show the list of categories (Web and API)
    public function index(Request $request)
    {
        // Get the search term
        $search = $request->input('search');

        // Fetch categories with optional search filter
        $categories = Category::when($search, function ($query, $search) {
            $query->where('name', 'like', "%$search%");
        })
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        // API Response
        if ($request->is('api/*')) {
            return response()->json([
                'status' => 'success',
                'categories' => $categories->items(),
                'pagination' => [
                    'current_page' => $categories->currentPage(),
                    'last_page' => $categories->lastPage(),
                    'total' => $categories->total(),
                ],
            ], 200);
        }

        // Web Response
        return view('dashboard.category.index', compact('categories'));
    }

    // Show a single category by its ID (Web and API)
    public function show($id, Request $request)
    {
        $category = Category::findOrFail($id);

        // API Response
        if ($request->is('api/*')) {
            return response()->json(['status' => 'success', 'category' => $category], 200);
        }

        // Web Response
        return view('dashboard.category.show', compact('category'));
    }

    // Store a new category in the database (Web and API)
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $category = Category::create([
            'name' => $request->name,
        ]);

        // API Response
        if ($request->is('api/*')) {
            return response()->json([
                'status' => 'success',
                'message' => 'Category added successfully!',
                'category' => $category,
            ], 201);
        }

        // Web Response
        return redirect()->route('dashboard.category.index')->with([
            'message' => 'Category added successfully!',
            'alert' => 'alert-success',
        ]);
    }

    // Update an existing category in the database (Web and API)
    public function update(Request $request, $id)
    {
        $category = Category::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $category->update([
            'name' => $request->name,
        ]);

        // API Response
        if ($request->is('api/*')) {
            return response()->json([
                'status' => 'success',
                'message' => 'Category updated successfully!',
                'category' => $category,
            ], 200);
        }

        // Web Response
        return redirect()->route('dashboard.category.index')->with([
            'message' => 'Category updated successfully!',
            'alert' => 'alert-success',
        ]);
    }

    // Delete a category from the database (Web and API)
    public function destroy($id, Request $request)
    {
        $category = Category::findOrFail($id);
        $category->delete();

        // API Response
        if ($request->is('api/*')) {
            return response()->json([
                'status' => 'success',
                'message' => 'Category deleted successfully!',
            ], 200);
        }

        // Web Response
        return redirect()->route('dashboard.category.index')->with([
            'message' => 'Category deleted successfully!',
            'alert' => 'alert-danger',
        ]);
    }
}
