<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GalleryItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'description', 'category', 'image', 'slug',
    ];

    // Add slug for URL routing
    public function getRouteKeyName()
    {
        return 'slug'; // This will allow route model binding based on the slug
    }
}

