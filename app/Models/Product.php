<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['name', 'description', 'price', 'category_id'];

    public function category() {
        return $this->belongsTo(Category::class);
    }

    public function stock() {
        return $this->hasOne(Stock::class);
    }
}

