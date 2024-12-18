<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Inventory extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'inventories';

    protected $fillable = [
        'item_name',
        'category_id',
        'supplier_id',
        'quantity',
        'unit',
        'price',
        'expiry_date',
        'description',
        'location',
        'is_expirable',
        'low_stock_threshold'
    ];


    // Define the relationship to the Category model
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function supplier()
    {
        return $this->belongsTo(Supplier::class, 'supplier_id');
    }

    public function logs()
    {
        return $this->hasMany(Log::class, 'item_id');
    }
}
