<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    use HasFactory;
    protected $fillable = [
        'item_name',
        'quantity',
        'unit',
        'price',
        'expiry_date',
        'supplier',
        'description',
        'category',
        'location'
    ];
}