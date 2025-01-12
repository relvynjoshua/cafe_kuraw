<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\UserProfileController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\FrontendMenuController;
use App\Http\Controllers\RewardController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\OTPController;

// Authentication Routes
// Authentication and OTP Routes
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/check-email', [RegisterController::class, 'checkEmailAvailability']); // Check email availability
Route::post('/otp/send', [OTPController::class, 'sendOTP']); // Send OTP
Route::post('/otp/verify', [OTPController::class, 'verifyOTP']); // Verify OTP


// Routes protected by Sanctum middleware
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logoutAccount']);
    Route::get('/user', fn(Request $request) => $request->user());

    // Reservation Routes
    Route::get('/reservations/booked-dates', [ReservationController::class, 'showReservationPage']);
    Route::get('/reservations', [ReservationController::class, 'index']);
    Route::post('/reservations', [ReservationController::class, 'store']);
    Route::get('/reservations/{id}', [ReservationController::class, 'show']);
    Route::put('/reservations/{id}', [ReservationController::class, 'update']);
    Route::patch('/reservations/{id}/status', [ReservationController::class, 'updateStatus']);
    Route::delete('/reservations/{id}', [ReservationController::class, 'destroy']);

    // Order Routes
    Route::get('/orders', [OrderController::class, 'myOrders']); // Fetch user's orders
    Route::get('/orders/{id}', [OrderController::class, 'getOrderDetails']); // Fetch order details
    Route::post('/orders/{order}/status', [OrderController::class, 'updateStatus']); // Update order status

    Route::get('/cart', [CartController::class, 'index']);
    Route::get('/cart/count', [CartController::class, 'cartCount']);
    Route::post('/cart/add', [CartController::class, 'add']);
    Route::post('/cart/update', [CartController::class, 'update']);
    Route::post('/cart/remove', [CartController::class, 'remove']);
    Route::post('/cart/checkout', [CartController::class, 'checkout']);
    Route::post('/cart/clear', [CartController::class, 'clearCart']);

    Route::get('/profile', [UserProfileController::class, 'show']); // Show user profile
    Route::put('/profile', [UserProfileController::class, 'update']); // Update user profile


    Route::get('/products', [ProductController::class, 'index']); // List products
    Route::get('/products/all', [ProductController::class, 'allProducts']);
    Route::get('/products/{id}', [ProductController::class, 'show']); // Get a single product
    Route::post('/products', [ProductController::class, 'store']); // Create a product
    Route::put('/products/{id}', [ProductController::class, 'update']); // Update a product
    Route::delete('/products/{id}', [ProductController::class, 'destroy']); // Delete a product

    Route::get('/categories', [CategoryController::class, 'index']);
    Route::get('/categories/{id}', [CategoryController::class, 'show']);
    Route::post('/categories', [CategoryController::class, 'store']);
    Route::put('/categories/{id}', [CategoryController::class, 'update']);
    Route::delete('/categories/{id}', [CategoryController::class, 'destroy']);

    Route::get('/rewards', [RewardController::class, 'apiShow']); // Get reward points and history
    Route::post('/rewards/redeem', [RewardController::class, 'apiRedeemPoints']); // Redeem points for discount
    Route::post('/rewards/apply-to-cart', [RewardController::class, 'apiApplyPointsToCart']); // Apply points to cart
});