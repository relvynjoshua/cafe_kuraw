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

    // Ensure 'id' is used as the route key
    public function getRouteKeyName()
    {
        return 'id';
    }
}

