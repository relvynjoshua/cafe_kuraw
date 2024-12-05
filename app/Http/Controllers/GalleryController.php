<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GalleryController extends Controller
{
    public function index()
    {
        // All images
        $images  = [
            ['src' => 'gallery/meetings/1.jpg', 'alt' => 'Meeting 1', 'category' => 'one'],
            ['src' => 'gallery/meetings/2.jpg', 'alt' => 'Meeting 2', 'category' => 'one'],
            ['src' => 'gallery/moments/1.jpg', 'alt' => 'Moment 1', 'category' => 'two'],
            ['src' => 'gallery/moments/2.jpg', 'alt' => 'Moment 2', 'category' => 'two'],
            ['src' => 'gallery/moments/3.jpg', 'alt' => 'Moment 3', 'category' => 'two'],
            ['src' => 'gallery/moments/4.jpg', 'alt' => 'Moment 4', 'category' => 'two'],
            ['src' => 'gallery/moments/5.jpg', 'alt' => 'Moment 5', 'category' => 'two'],
            ['src' => 'gallery/moments/6.jpg', 'alt' => 'Moment 6', 'category' => 'two'],
            ['src' => 'gallery/moments/7.jpg', 'alt' => 'Moment 7', 'category' => 'two'],
            ['src' => 'gallery/moments/8.jpg', 'alt' => 'Moment 8', 'category' => 'two'],
            ['src' => 'gallery/moments/9.jpg', 'alt' => 'Moment 9', 'category' => 'two'],
            ['src' => 'gallery/moments/10.jpg', 'alt' => 'Moment 10', 'category' => 'two'],
            ['src' => 'gallery/moments/11.jpg', 'alt' => 'Moment 11', 'category' => 'two'],
            ['src' => 'gallery/location/1.jpg', 'alt' => 'Location 1', 'category' => 'three'],
            ['src' => 'gallery/location/2.jpg', 'alt' => 'Location 2', 'category' => 'three'],
            ['src' => 'gallery/location/3.jpg', 'alt' => 'Location 3', 'category' => 'three'],
            ['src' => 'gallery/location/4.jpg', 'alt' => 'Location 4', 'category' => 'three'],
        ];

        // Pass images to the view
        return view('frontend.gallery', compact('images'));
    }
}