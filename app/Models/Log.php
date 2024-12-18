<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Inventory;
use App\Models\User;

class Log extends Model
{
    protected $fillable = [
        'inventory_id',
        'change_type',
        'quantity_changed',
        'remaining_quantity',
        'updated_by'
    ];

    public function inventory()
    {
        return $this->belongsTo(Inventory::class, 'inventory_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }
}
