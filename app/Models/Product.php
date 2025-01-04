<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Product extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'category_id', 'description', 'price', 'image'];

    /**
     * Define the relationship between the Product and Category model.
     * Each product belongs to a category.
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Define the relationship between the Product and Stock model.
     * Each product has one stock record.
     */
    public function stock()
    {
        return $this->hasOne(Stock::class);
    }

    /**
     * Define the many-to-many relationship between the Product and Order model.
     * A product can be in many orders, and an order can have many products.
     * Uses a pivot table to store additional data like quantity and price.
     */
    public function orders()
    {
        return $this->belongsToMany(Order::class, 'order_product')
            ->withPivot('quantity', 'price', 'variation')
            ->withTimestamps();
    }

    // Define the relationship with ProductVariation
    public function variations()
    {
        return $this->hasMany(ProductVariation::class);
    }
}
;
