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
        'status',
    ];

    // Accessor for formatted reservation ID
    public function getReservationIdAttribute()
    {
        return 'RES' . str_pad($this->id, 3, '0', STR_PAD_LEFT); // Prefix with RES and pad with zeros
    }

    /**
     * Define relationship: A reservation belongs to a user.
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id'); // Ensure 'user_id' exists in the reservations table
    }
}
