<?php

use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', function () {
    return view('pages.home');
});

Route::get('/about', function () {
    $company = 'Kuraw Coffee Shop';
    return view('pages.about', ['company' => $company]);
});

Route::get('/menu', function () {
    return view('pages.menu');
});

Route::get('/gallery', function () {
    return view('pages.gallery');
});

Route::get('/contact', function () {
    return view('pages.contact');
});


use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\StockController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\ReservationController;

Route::resource('products', ProductController::class);
Route::resource('categories', CategoryController::class);
Route::resource('stocks', StockController::class);

Route::get('/dashboard/index', function () {
    return view('dashboard.index');
});


Route::resource('inventory', InventoryController::class);
Route::resource('reservation', ReservationController::class);

Route::get('/inventory', [InventoryController::class, 'index'])->name('inventory.index');
Route::get('/reservations', [ReservationController::class, 'index'])->name('reservation.index');
