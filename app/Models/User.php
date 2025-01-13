<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\DB;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasApiTokens;

    protected $fillable = [
        'firstname',
        'email',
        'password',
        'is_active',
        'reward_points',
        'role',
        'cart_items',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'cart_items' => 'string',
    ];

    public function isAdmin()
    {
        return $this->role === 'admin';
    }

    public function isCashier()
    {
        return $this->role === 'cashier';
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', 1);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function pointsHistory()
    {
        return $this->hasMany(PointsHistory::class);
    }

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

    public function setCartItems(array $items): void
    {
        try {
            $this->update(['cart_items' => json_encode($items)]);
        } catch (\Exception $e) {
            \Log::error("Failed to set cart items for user {$this->id}: {$e->getMessage()}");
            throw new \RuntimeException('Failed to update the cart items.');
        }
    }

    public function clearCart(): void
    {
        try {
            $this->update(['cart_items' => json_encode([])]);
        } catch (\Exception $e) {
            \Log::error("Failed to clear cart for user {$this->id}: {$e->getMessage()}");
            throw new \RuntimeException('Failed to clear the cart.');
        }
    }

    public function getCartItems(): array
    {
        return json_decode($this->cart_items, true) ?? [];
    }

    public function addCartItem(string $itemId, array $itemDetails): void
    {
        $cart = $this->getCartItems();

        if (isset($cart[$itemId])) {
            $cart[$itemId]['quantity'] += $itemDetails['quantity'];
        } else {
            $cart[$itemId] = $itemDetails;
        }

        $this->setCartItems($cart);
    }

    public function removeCartItem(string $itemId): void
    {
        $cart = $this->getCartItems();

        if (isset($cart[$itemId])) {
            unset($cart[$itemId]);
            $this->setCartItems($cart);
        }
    }

    public function getCartCount(): int
    {
        return collect($this->getCartItems())->sum(fn($item) => $item['quantity'] ?? 0);
    }
}
