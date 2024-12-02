<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $fillable = [
        'user_id', 'name', 'phone_number','email', 'password'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
