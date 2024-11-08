<?php

use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

// Route::get('/', function () {
//     return view('pages.home');
// });

// Route::get('/about', function () {
//     $company = 'Kuraw Coffee Shop';
//     return view('pages.about', ['company' => $company]);
// });

// Route::get('/menu', function () {
//     return view('pages.menu');
// });

// Route::get('/gallery', function () {
//     return view('pages.gallery');
// });

// Route::get('/contact', function () {
//     return view('pages.contact');
// });


use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SignoutController;


// Route::resource('products', ProductController::class);
// Route::resource('categories', CategoryController::class);
// Route::resource('stocks', StockController::class);
// Route::get('/dashboard', function () { return view('dashboard.index'); })->name('dashboard');
// Route::resource('inventory', InventoryController::class);
// Route::resource('reservation', ReservationController::class);
// Route::get('/inventory', [InventoryController::class, 'index'])->name('inventory.index');
// Route::get('/reservations', [ReservationController::class, 'index'])->name('reservation.index');


Route::prefix('dashboard')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    Route::prefix('product')->group(function () {
        Route::get('/', [ProductController::class, 'index'])->name('dashboard.product.index');
        Route::post('/create', [ProductController::class, 'create'])->name('dashboard.product.create');
        Route::post('/{id}/edit', [ProductController::class, 'edit'])->name('dashboard.product.edit');
        Route::get('/{id}', [ProductController::class, 'show'])->name('dashboard.product.show');
    });

    Route::prefix('supplier')->group(function () {
        Route::get('/', [SupplierController::class, 'index'])->name('dashboard.supplier.index');
        Route::post('/create', [SupplierController::class, 'create'])->name('dashboard.supplier.create');
        Route::post('/{id}/edit', [SupplierController::class, 'edit'])->name('dashboard.supplier.edit');
        Route::get('/{id}', [SupplierController::class, 'show'])->name('dashboard.supplier.show');
    });

    Route::prefix('category')->group(function () {
        Route::get('/', [CategoryController::class, 'index'])->name('dashboard.category.index');
        Route::get('/create', [CategoryController::class, 'create'])->name('dashboard.category.create');
        Route::post('/{id}/edit', [CategoryController::class, 'edit'])->name('dashboard.category.edit');
        Route::get('/{id}', [CategoryController::class, 'show'])->name('dashboard.category.show');
        Route::post('/store', [CategoryController::class, 'store'])->name('dashboard.category.store');
        Route::put('/{id}/update', [CategoryController::class, 'update'])->name('dashboard.category.update');
        Route::delete('/{id}/destroy', [CategoryController::class, 'destroy'])->name('dashboard.category.destroy');
    });

    Route::prefix('profile')->group(function () {
        Route::get('/', function () { return view('dashboard.profile.index'); })->name('dashboard.profile.index');
        Route::post('/edit', function () { return view('dashboard.profile.edit'); })->name('dashboard.profile.edit');
    });

    Route::prefix('inventory')->group(function () {
        Route::get('/', [InventoryController::class, 'index'])->name('dashboard.inventory.index');
        Route::post('/create', [InventoryController::class, 'create'])->name('dashboard.inventory.create');
        Route::post('/{id}/edit', [InventoryController::class, 'edit'])->name('dashboard.inventory.edit');
        Route::get('/{id}', [InventoryController::class, 'show'])->name('dashboard.inventory.show');
    });

    Route::prefix('reservation')->group(function () {
        Route::get('/', [ReservationController::class, 'index'])->name('dashboard.reservation.index');
        Route::post('/create', [ReservationController::class, 'create'])->name('dashboard.reservation.create');
        Route::post('/{id}/edit', [ReservationController::class, 'edit'])->name('dashboard.reservation.edit');
        Route::get('/{id}', [ReservationController::class, 'show'])->name('dashboard.reservation.show');
    });

});

// Frontend

Route::get('/', function () {
    return view('frontend.home');
});

Route::get('/about', function () {
    $company = 'Kuraw Coffee Shop';
    return view('frontend.about', ['company' => $company]);
});

Route::get('/menu', function () {
    return view('frontend.menu');
});

Route::get('/gallery', function () {
    return view('frontend.gallery');
});

Route::get('/contact', function () {
    return view('frontend.contact');
});

Route::get('/enum', function () {
    return view('frontend.menu');
});


// Route::middleware('auth')->group(function(){

//     Route::get('/signout', [SignoutController::class, 'signOut'])->name('logout');

//     // Profile
//     Route::get('/profile', [ProfileController::class, 'index'])->name('dashboard.profile.index');
//     Route::get('/profile/edit', [ProfileController::class, 'showEdit'])->name('dashboard.profile.edit');
//     Route::post('/profile/update', [ProfileController::class, 'update'])->name('dashboard.profile.update');

//     // Dashboard
//     Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');

//     // Product
//     Route::controller(ProductController::class)->prefix('product')->name('product')->group(function () {
//         Route::get('/', 'index');
//         Route::get('/add', 'showAdd')->name('.showAdd');
//         Route::post('/add', 'store')->name('.store');
//         Route::get('/{id}/delete', 'destroy')->name('.destroy');
//         Route::get('/{id}/edit', 'showEdit')->name('.showEdit');
//         Route::post('/{id}/edit', 'update')->name('.update');
//     });
// });

// Product
Route::controller(ProductController::class)->prefix('product')->name('product')->group(function () {
    Route::get('/', 'index');
    Route::get('/add', 'showAdd')->name('.showAdd');
    Route::post('/add', 'store')->name('.store');
    Route::get('/{id}/delete', 'destroy')->name('.destroy');
    Route::get('/{id}/edit', 'showEdit')->name('.showEdit');
    Route::post('/{id}/edit', 'update')->name('.update');
});