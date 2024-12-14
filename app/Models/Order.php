<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    // Fillable properties to allow mass assignment
    protected $fillable = [
        'customer_name', 
        'email', 
        'phone', 
        'total_amount', 
        'status',
        'payment_method', 
        'delivery_method'  // Ensure both fields are fillable
    ];

    public function products()
    {
        return $this->belongsToMany(Product::class)
                    ->withPivot('quantity', 'price', 'variation')
                    ->withTimestamps();
    }

    public function getTotalCostAttribute()
    {
        return $this->products->sum(function ($product) {
            return $product->pivot->quantity * $product->pivot->price;
        });
    }

    public function getFinalAmountAttribute()
    {
        return max(0, $this->total_amount - $this->discount);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
