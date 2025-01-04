<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['name'];

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function scopeLimitedCategories($query)
    {
        return $query->whereIn('id', [1, 2, 3, 4, 5, 6]);
    }

}

