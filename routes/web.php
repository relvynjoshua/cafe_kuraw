<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Contracts\View\View;
use Illuminate\Contracts\View\Factory;
use App\Http\Controllers\{
    ProductController,
    CategoryController,
    SupplierController,
    InventoryController,
    ReservationController,
    DashboardController,
    AdminController,
    AuthController
};

// Authentication Routes
Route::controller(AuthController::class)->group(function () {
    Route::get('/login-signup', fn(): Factory|View => view('auth.login-signup'))->name('login-signup.form');
    Route::post('/register', 'register')->name('register');
    Route::post('/login', 'login')->name('login');
    Route::middleware('auth')->post('/logout', 'logoutAccount')->name('logout');
});

// Frontend Routes
Route::get('/', fn(): View => view('frontend.home'))->name('home');
Route::get('/about', fn(): View => view('frontend.about'))->name('about');
Route::get('/menu', fn(): View => view('frontend.menu'))->name('menu');
Route::get('/gallery', fn(): View => view('frontend.gallery'))->name('gallery');
Route::get('/contact', fn(): View => view('frontend.contact'))->name('contact');

// Dashboard Routes
Route::middleware(['auth'])->prefix('dashboard')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    // Category Routes
    Route::prefix('category')->controller(CategoryController::class)->name('dashboard.category')->group(function () {
        Route::get('/', 'index')->name('.index'); // List categories
        Route::get('/create', 'create')->name('.create'); // Add category form
        Route::post('/store', 'store')->name('.store'); // Store category
        Route::get('/{id}', 'show')->name('.show'); // Show category
        Route::get('/{id}/edit', 'edit')->name('.edit'); // Edit category form
        Route::put('/{id}/update', 'update')->name('.update'); // Update category
        Route::delete('/{id}/destroy', 'destroy')->name('.destroy'); // Delete category
    });

    // Product Routes
Route::prefix('products')->controller(ProductController::class)->name('dashboard.products')->group(function () {
    Route::get('/', 'index')->name('.index'); // List products
    Route::get('/add', 'showAdd')->name('.showAdd'); // Add product form
    Route::post('/add', 'store')->name('.store'); // Store product
    Route::get('/{id}', 'show')->name('.show'); // Show product
    Route::get('/{id}/edit', 'showEdit')->name('.showEdit'); // Edit product form
    Route::put('/{id}/edit', 'update')->name('.update'); // Update product
    Route::delete('/{id}/delete', 'destroy')->name('.destroy'); // Delete product
});

    
Route::prefix('inventory')->controller(InventoryController::class)->group(function () {
    Route::get('/', 'index')->name('dashboard.inventory.index'); // List inventories
    Route::get('/create', 'create')->name('dashboard.inventory.create'); // Add inventory form
    Route::post('/store', 'store')->name('dashboard.inventory.store'); // Store inventory
    Route::get('/{id}/edit', 'edit')->name('dashboard.inventory.edit'); // Edit inventory form
    Route::put('/{id}/update', 'update')->name('dashboard.inventory.update'); // Update inventory
    Route::delete('/{id}/destroy', 'destroy')->name('dashboard.inventory.destroy'); // Delete inventory
    Route::get('/{id}', 'show')->name('dashboard.inventory.show'); // Show single inventory item
});
    // Supplier Routes
    Route::prefix('supplier')->controller(SupplierController::class)->name('dashboard.supplier.')->group(function () {
        Route::get('/', 'index')->name('index'); // List suppliers
        Route::get('/create', 'create')->name('create'); // Add supplier form
        Route::post('/store', 'store')->name('store'); // Store supplier
        Route::get('/{supplier}/edit', 'edit')->name('edit'); // Edit supplier form
        Route::put('/{supplier}/update', 'update')->name('update'); // Update supplier
        Route::delete('/{supplier}/destroy', 'destroy')->name('destroy'); // Delete supplier
    });
    
    Route::prefix('reservations')->group(function () {
        Route::get('/', [ReservationController::class, 'index'])->name('dashboard.reservations.index');
        Route::get('/create', [ReservationController::class, 'create'])->name('dashboard.reservations.create');
        Route::post('/store', [ReservationController::class, 'store'])->name('dashboard.reservations.store');
        Route::get('/{id}/edit', [ReservationController::class, 'edit'])->name('dashboard.reservations.edit');
        Route::put('/{id}/update', [ReservationController::class, 'update'])->name('dashboard.reservations.update');
        Route::delete('/{id}/destroy', [ReservationController::class, 'destroy'])->name('dashboard.reservations.destroy');
        Route::get('/{id}', [ReservationController::class, 'show'])->name('dashboard.reservations.show');
    });
    // Profile Routes
    Route::prefix('profile')->group(function () {
        Route::get('/', fn(): View => view('dashboard.profile.index'))->name('dashboard.profile.index');
        Route::get('/edit', fn(): View => view('dashboard.profile.edit'))->name('dashboard.profile.edit');
    });
});

// Fallback Route
Route::fallback(fn() => view('errors.404'))->name('fallback');
