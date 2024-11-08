<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Validation\Rule;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return view('dashboard.category.index', compact('categories'));
    }

    public function create()
    {
        return view('dashboard.category.create');
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', Rule::unique('categories')->ignore($request->id)],
            'slug' => ['required', Rule::unique('categories')->ignore($request->id)],
        ]);

        Category::create($request->all());

        return redirect()->route('dashboard.category.index')->with(['message' => 'Category added', 'alert' => 'alert-success']);
    }

    public function show(Category $category)
    {
        return view('dashboard.category.show', compact('category'));
    }

    public function edit($id)
    {
        $category = Category::find($id);
      
        return view('dashboard.category.edit', compact('category'));
    }

    public function update($id, Request $request)
    {
        $category = Category::find($id);

        $request->validate([
            'name' => 'required',
        ]);

        $category->name = $request->name;

        $category->save();

        return redirect()->route('dashboard.category.index')->with(['message' => 'Category updated', 'alert' => 'alert-success']);
    }

    public function destroy($id)
    {
        $category = Category::find($id)->delete();

        return redirect()->route('dashboard.category.index')->with(['message' => 'Category deleted', 'alert' => 'alert-danger']);
    }
}


