<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\NotificationController;

// Authentication Routes
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

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
    Route::get('/orders', [OrderController::class, 'index']); // Get all orders (with optional search)
    Route::post('/orders', [OrderController::class, 'store']); // Create a new order
    Route::get('/orders/{order}', [OrderController::class, 'show']); // View details of a specific order
    Route::put('/orders/{order}', [OrderController::class, 'update']); // Update an existing order
    Route::patch('/orders/{order}/status', [OrderController::class, 'updateStatus']); // Update order status
    Route::delete('/orders/{order}', [OrderController::class, 'destroy']); // Delete an order

});
