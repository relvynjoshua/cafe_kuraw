<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'phone_number',
        'reservation_date',
        'reservation_time',
        'number_of_guests',
        'note',
        'status', // Add a status field (e.g., 'pending', 'confirmed', 'cancelled')
    ];

}
