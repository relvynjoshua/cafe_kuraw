<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens; // Add this for Sanctum
use Illuminate\Support\Facades\DB;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasApiTokens; // Add HasApiTokens here for Sanctum support

    protected $fillable = [
        'firstname',
        'email',
        'password',
        'is_active',
        'reward_points', // Ensure reward_points is fillable
        'role',          // Include role if it's used
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // Check if user is an admin
    public function isAdmin()
    {
        return $this->role === 'admin';
    }

    public function scopeActive($query)
{
    return $query->where('is_active', 1);
}


    // Relationship with Order model
    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    // Relationship with PointsHistory model
    public function pointsHistory()
    {
        return $this->hasMany(PointsHistory::class);
    }

    // Add reward points to the user and log the activity
    public function addRewardPoints($points, $activity = null)
    {
        DB::transaction(function () use ($points, $activity) {
            $this->increment('reward_points', $points);

            $this->pointsHistory()->create([
                'activity' => $activity ?? 'Reward points added',
                'points' => $points,
            ]);
        });
    }

    // Redeem reward points and log the activity
    public function redeemRewardPoints($points, $activity = null)
    {
        if ($points > $this->reward_points) {
            throw new \Exception('Insufficient reward points.');
        }

        DB::transaction(function () use ($points, $activity) {
            $this->decrement('reward_points', $points);

            $this->pointsHistory()->create([
                'activity' => $activity ?? 'Reward points redeemed',
                'points' => -$points,
            ]);
        });
    }
}
