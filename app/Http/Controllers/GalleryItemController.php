<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\GalleryItem;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class GalleryItemController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        $galleryItems = GalleryItem::when($search, function ($query, $search) {
            $query->where('title', 'like', "%$search%")
                ->orWhere('category', 'like', "%$search%");
        })
            ->orderBy('created_at', 'desc')
            ->paginate(10); // Use paginate instead of get()

        return view('dashboard.gallery.index', compact('galleryItems'));
    }

    public function create()
    {
        return view('dashboard.gallery.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'category' => 'nullable|string|max:255',
            'image' => 'required|image',
        ]);

        $imagePath = $request->file('image')->store('gallery', 'public');

        GalleryItem::create([
            'title' => $validated['title'],
            'description' => $validated['description'],
            'category' => $validated['category'],
            'image' => $imagePath,
            'slug' => Str::slug($validated['title']),
        ]);

        return redirect()->route('dashboard.gallery.index')->with('success', 'Gallery item created successfully.');
    }

    public function edit(GalleryItem $galleryItem)
    {
        return view('dashboard.gallery.edit', compact('galleryItem'));
    }

    public function update(Request $request, GalleryItem $galleryItem)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'category' => 'nullable|string|max:255',
            'image' => 'nullable|image',
        ]);

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('gallery', 'public');
            $galleryItem->update(['image' => $imagePath]);
        }

        $galleryItem->update($validated);

        return redirect()->route('dashboard.gallery.index')->with('success', 'Gallery item updated successfully.');
    }

    public function destroy(GalleryItem $galleryItem)
    {
        $galleryItem->delete();
        return redirect()->route('dashboard.gallery.index')->with('success', 'Gallery item deleted successfully.');
    }
}

