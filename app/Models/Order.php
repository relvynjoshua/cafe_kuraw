<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    // Allow mass assignment
    protected $fillable = [
        'user_id', // Include user_id if orders are associated with users
        'customer_name',
        'email',
        'phone',
        'address',
        'total_amount',
        'status',
        'payment_method',
        'delivery_method',
        'discount', // Include discount if it's used
        'reference_number',
        'proof_of_payment'
    ];


    // Define relationship with Product model
    public function products()
    {
        return $this->belongsToMany(Product::class)
            ->withPivot('quantity', 'price', 'variation')
            ->withTimestamps();
    }

    // Define relationship with User model
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Calculate total cost (sum of product quantities * prices)
    public function getTotalCostAttribute()
    {
        return $this->products->sum(function ($product) {
            return $product->pivot->quantity * $product->pivot->price;
        });
    }

    // Calculate the final amount after applying discounts
    public function getFinalAmountAttribute()
    {
        return max(0, $this->total_amount - ($this->discount ?? 0));
    }

    public function isCancelable()
    {
        return $this->status === 'pending';
    }

}