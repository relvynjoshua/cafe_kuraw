<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\PointsHistory;

class RewardController extends Controller
{
    /**
     * Display the user's reward points page.
     */
    public function show()
    {
        $user = Auth::user();
        $pointsHistory = $user->pointsHistory()->orderBy('created_at', 'desc')->get();

        return view('frontend.rewards', compact('user', 'pointsHistory'));
    }

    /**
     * Redeem reward points for a discount in the cart.
     */
    public function redeemPoints(Request $request)
    {
        $user = Auth::user();

        // Validate the redemption request
        $request->validate([
            'points' => 'required|integer|min:1|max:' . $user->reward_points,
        ]);

        $pointsToRedeem = $request->input('points');

        // Check if points have already been redeemed for this session
        if (session()->has('cart_discount')) {
            return back()->withErrors(['error' => 'Points have already been redeemed for this session.']);
        }

        // Deduct points from the user
        $user->decrement('reward_points', $pointsToRedeem);

        // Log the redemption in PointsHistory
        PointsHistory::create([
            'user_id' => $user->id,
            'activity' => 'Redeemed points for discount',
            'points' => -$pointsToRedeem,
        ]);

        // Store the discount in the session
        session(['cart_discount' => $pointsToRedeem]);

        return redirect()->route('cart.index')->with('success', "$pointsToRedeem points successfully redeemed.");
    }

    /**
     * Automatically apply points to the cart during checkout.
     */
    public function applyPointsToCart(Request $request)
    {
        $user = Auth::user();
        $cart = session()->get('cart', []);

        $totalPrice = collect($cart)->sum(fn($item) => $item['price'] * $item['quantity']);

        // Determine the maximum points that can be applied
        $pointsToApply = min($user->reward_points, $totalPrice);

        // Check if points have already been applied
        if (session()->has('cart_discount')) {
            return back()->withErrors(['error' => 'Points have already been applied to your cart.']);
        }

        // Store the applied points as a discount in the session
        session(['cart_discount' => $pointsToApply]);

        return back()->with('success', "$pointsToApply points applied to your cart.");
    }

    /**
     * Clear the redeemed points session after checkout is completed.
     */
    public function clearDiscountSession()
    {
        session()->forget('cart_discount');
    }
}
