<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'firstname',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function isAdmin() {
        return $this->role === 'admin';
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function pointsHistory()
    {
        return $this->hasMany(PointsHistory::class);
    }

    /**
     * Add reward points to the user
     */
    public function addRewardPoints($points, $activity = null)
    {
        DB::transaction(function () use ($points, $activity) {
            // Increment reward points
            $this->increment('reward_points', $points);

            // Log the activity in the PointsHistory table
            $this->pointsHistory()->create([
                'activity' => $activity ?? 'Reward points added',
                'points' => $points,
            ]);
        });
    }

    /**
     * Redeem reward points from the user
     */
    public function redeemRewardPoints($points, $activity = null)
    {
        if ($points > $this->reward_points) {
            throw new \Exception('Insufficient reward points.');
        }

        DB::transaction(function () use ($points, $activity) {
            // Decrement reward points
            $this->decrement('reward_points', $points);

            // Log the activity in the PointsHistory table
            $this->pointsHistory()->create([
                'activity' => $activity ?? 'Reward points redeemed',
                'points' => -$points,
            ]);
        });
    }
}
