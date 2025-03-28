<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use App\Models\GalleryItem;

class GalleryController extends Controller
{
    public function index()
    {
        $galleryItems = GalleryItem::paginate(10); // Fetch 10 items per page
        return view('frontend.gallery.index', compact('galleryItems'));
    }


    public function show(GalleryItem $galleryItem)
    {
        return view('frontend.gallery.show', compact('galleryItem'));
    }
}