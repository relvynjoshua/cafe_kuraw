<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OtpCode extends Model
{
    use HasFactory;

    // Allow mass assignment for these columns
    protected $fillable = ['email', 'otp', 'expires_at'];
}