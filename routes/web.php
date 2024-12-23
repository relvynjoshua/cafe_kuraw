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
    OrderController,
    GalleryController,
    CartController,
    RewardController,
    AdminController,
    ProfileController,
    SettingsController,
    ContactController,
    AnalyticsController,
    ReportController,
    UserProfileController,
    AuthController,
    LoginController,
    RegisterController,
    OTPController,
    CashierController,
    HistoryController,
    LogController,
    CustomForgotPasswordController,
};

// ----------------------------
// Public Routes
// ----------------------------
Route::get('/', fn(): View => view('frontend.home'))->name('home');
Route::get('/about', fn(): View => view('frontend.about'))->name('about');

// Contact Page
Route::controller(ContactController::class)->group(function () {
    Route::get('/contact', 'index')->name('contact'); // Display contact form
    Route::post('/contact', 'store')->name('contact.process'); // Handle form submission
});

// Menu
Route::get('/menu', function () {
    $products = \App\Models\Product::with('variations')->get(); // Eager load variations
    return view('frontend.menu', compact('products'));
})->name('menu');

// Gallery
Route::get('/gallery', [GalleryController::class, 'index'])->name('gallery.index');
Route::get('/gallery/{galleryItem}', [GalleryController::class, 'show'])->name('gallery.show');

// Public Reservation Page
Route::get('/reservation', [ReservationController::class, 'showReservationPage'])->name('reservation.page');
Route::post('/reservation', [ReservationController::class, 'store'])->name('reservation.store');

// ----------------------------
// Authentication Routes
// ----------------------------
Route::controller(AuthController::class)->group(function () {
    Route::get('/login-signup', fn(): Factory|View => view('auth.login-signup'))->name('login-signup.form');
    Route::post('/register', 'register')->name('register');
    // Form for entering email
    Route::get('/register', function () {
        return view('register');
    });

    // Endpoint for sending OTP
    Route::post('/send-otp', [OTPController::class, 'sendOTP']);

    // Route for OTP verification
    Route::post('/verify-otp', [OTPController::class, 'verifyOTP']);

    // Login Route
    Route::post('/login-signup', [LoginController::class, 'login'])->name('login');
    Route::post('/register', [RegisterController::class, 'register'])->name('register');
    Route::get('/', fn() => view('frontend.home'))->name('home');

    // User Logout
    Route::post('/logout-user', 'logoutUser')->name('logout.user')->middleware('auth:web');

    // Admin Logout
    Route::post('/logout-admin', 'logoutAdmin')->name('logout.admin')->middleware('auth:admin');

    // ----------------------------
    // Password Reset Routes
    // ----------------------------
    Route::get('password/reset', [CustomForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
    Route::post('password/email', [CustomForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
    Route::get('password/reset/{token}', [CustomForgotPasswordController::class, 'showResetForm'])->name('password.reset');
    Route::post('password/reset', [CustomForgotPasswordController::class, 'reset'])->name('password.update');
});

// ----------------------------
// Cashier POS Routes
// ----------------------------
// Route to display the Cashier POS page
Route::get('/cashier', function () {
    return view('pos.cashierPOS');
})->name('cashier.index');

Route::get('/pos', function () {
    return view('pos.POS'); // This will render the POS.blade.php file
})->name('pos');

Route::get('/transactions', function () {
    return view('pos.transaction'); // Points to transaction.blade.php
})->name('transactions.index');

Route::get('/master-items', function () {
    return view('pos.masteritem'); // Points to masteritem.blade.php
})->name('masteritem.index');

Route::get('/cashier-reservation', function () {
    $bookedDates = ['2024-04-10', '2024-04-15']; // Example booked dates
    return view('pos.cashierReservation', ['bookedDates' => $bookedDates]);
})->name('cashierReservation.index');

Route::post('/cashier-reservation/store', function (\Illuminate\Http\Request $request) {
    // Reservation form processing logic
    return back()->with('success', 'Reservation submitted successfully!');
})->name('cashierReservation.store');


Route::get('/cashier-history', function () {
    return view('pos.cashier-order-history');
})->name('cashierHistory.index');

Route::get('/cashier-manage', function () {
    return view('pos.cashierManage');
})->name('cashierManage.index');

Route::get('/cashier/profile', [CashierController::class, 'profile'])->name('cashierProfile.index');

// Route to view settings page
Route::get('/cashier/settings', [CashierController::class, 'settings'])->name('cashierSettings.index');

// Route to update settings
Route::post('/cashier/settings', [CashierController::class, 'updateSettings'])->name('cashierSettings.update');

// ----------------------------
// Notification Routes
// ----------------------------
Route::post('/notifications/mark-read', function () {
    auth()->user()->unreadNotifications->markAsRead();
    return back();
})->name('notifications.mark-read');

// ----------------------------
// Analytics Routes
// ----------------------------
Route::get('/analytics', [AnalyticsController::class, 'index'])->name('analytics.index');

// ----------------------------
// Cart and Orders (Frontend)
// ----------------------------
Route::middleware(['auth'])->group(function () {
    // Cart
    Route::prefix('cart')->controller(CartController::class)->group(function () {
        Route::get('/', 'index')->name('cart.index');
        Route::post('/add', 'add')->name('cart.add');
        Route::post('/update', 'update')->name('cart.update');
        Route::delete('/remove', 'remove')->name('cart.remove');
        Route::post('/redeem', 'redeemPoints')->name('cart.redeem');
        Route::post('/checkout', 'checkout')->name('order.store');
    });

    // Orders
    Route::prefix('orders')->controller(OrderController::class)->group(function () {
        Route::get('/', 'myOrders')->name('orders.index');
        Route::get('/{order}', 'show')->name('orders.show');
        Route::post('/{order}/cancel', 'cancel')->name('orders.cancel');
    });
});

// ----------------------------
// Rewards (Frontend)
// ----------------------------
Route::middleware(['auth'])->group(function () {
    Route::prefix('rewards')->controller(RewardController::class)->group(function () {
        Route::get('/', 'show')->name('rewards'); // Display rewards page
        Route::post('/redeem', 'redeemPoints')->name('rewards.redeem'); // Redeem points
        Route::post('/apply-to-cart', 'applyPointsToCart')->name('rewards.apply'); // Apply points to cart
    });
});

// ----------------------------
// User Profile
// ----------------------------
Route::middleware(['auth'])->group(function () {
    Route::prefix('profile')->controller(UserProfileController::class)->group(function () {
        Route::get('/', 'show')->name('profile');
        Route::get('/edit', 'edit')->name('profile.edit');
        Route::put('/update', 'update')->name('profile.update');
    });
});

// ----------------------------
// Admin Dashboard Routes
// ----------------------------
Route::middleware(['auth'])->prefix('dashboard')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard.index');

    // Categories
    Route::prefix('category')->controller(CategoryController::class)->name('dashboard.category')->group(function () {
        Route::get('/', 'index')->name('.index');
        Route::get('/create', 'create')->name('.create');
        Route::post('/store', 'store')->name('.store');
        Route::get('/{id}', 'show')->name('.show');
        Route::get('/{id}/edit', 'edit')->name('.edit');
        Route::put('/{id}/update', 'update')->name('.update');
        Route::delete('/{id}/destroy', 'destroy')->name('.destroy');
    });

    // Products
    Route::prefix('products')->controller(ProductController::class)->name('dashboard.products')->group(function () {
        Route::get('/', 'index')->name('.index');
        Route::get('/add', 'showAdd')->name('.showAdd');
        Route::post('/add', 'store')->name('.store');
        Route::get('/{id}', 'show')->name('.show');
        Route::get('/{id}/edit', 'showEdit')->name('.showEdit');
        Route::put('/{id}/edit', 'update')->name('.update');
        Route::delete('/{id}/delete', 'destroy')->name('.destroy');
    });

    // Orders
    Route::prefix('orders')->controller(OrderController::class)->name('dashboard.orders.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/create', 'create')->name('create');
        Route::post('/', 'store')->name('store');
        Route::get('/{order}', 'show')->name('show');
        Route::get('/{order}/edit', 'edit')->name('edit');
        Route::put('/{order}/status', 'updateStatus')->name('updateStatus');
        Route::put('/{order}', 'update')->name('update');
        Route::delete('/{order}', 'destroy')->name('destroy');
    });

    // Inventory
    Route::prefix('inventory')->controller(InventoryController::class)->name('dashboard.inventory')->group(function () {
        Route::get('/', 'index')->name('.index');
        Route::get('/create', 'create')->name('.create');
        Route::post('/store', 'store')->name('.store');
        Route::get('/{id}/edit', 'edit')->name('.edit');
        Route::put('/{id}/update', 'update')->name('.update');
        Route::delete('/{id}/destroy', 'destroy')->name('.destroy');
        Route::post('/{id}/update-quantity', 'updateQuantity')->name('.updateQuantity');
    });

    // Suppliers
    Route::prefix('supplier')->controller(SupplierController::class)->name('dashboard.supplier')->group(function () {
        Route::get('/', 'index')->name('.index');
        Route::get('/create', 'create')->name('.create');
        Route::post('/store', 'store')->name('.store');
        Route::get('/{supplier}/edit', 'edit')->name('.edit');
        Route::put('/{supplier}/update', 'update')->name('.update');
        Route::delete('/{supplier}/destroy', 'destroy')->name('.destroy');
    });

    // Reservations
    Route::prefix('reservations')->controller(ReservationController::class)->name('dashboard.reservations')->group(function () {
        Route::get('/', 'index')->name('.index');
        Route::get('/create', 'create')->name('.create');
        Route::post('/store', 'store')->name('.store');
        Route::get('/{id}', 'show')->name('.show'); // Added 'show' route
        Route::get('/{id}/edit', 'edit')->name('.edit');
        Route::patch('/{id}/status', 'updateStatus')->name('.update-status');
        Route::put('/{id}/update', 'update')->name('.update');
        Route::delete('/{id}/destroy', 'destroy')->name('.destroy');
    });

    // Backend Gallery Management
    Route::prefix('dashboard/gallery')->controller(App\Http\Controllers\GalleryItemController::class)->name('dashboard.gallery.')->group(function () {
        Route::get('/', 'index')->name('index'); // dashboard.gallery.index
        Route::get('/create', 'create')->name('create'); // dashboard.gallery.create
        Route::post('/store', 'store')->name('store');
        Route::get('/{galleryItem}/edit', 'edit')->name('edit');
        Route::put('/{galleryItem}', 'update')->name('update');
        Route::delete('/{galleryItem}', 'destroy')->name('destroy');
    });

    // Profile Management
    Route::prefix('profile')->controller(ProfileController::class)->name('dashboard.profile')->group(function () {
        Route::get('/', 'index')->name('.index');
        Route::patch('/{user}/disable', 'disable')->name('.disable');
        Route::patch('/{user}/enable', 'enable')->name('.enable');
        Route::post('/{user}/restore', 'restore')->name('.restore');
    });

    // Settings
    Route::prefix('pages')->group(function () {
        Route::get('/settings', [SettingsController::class, 'index'])->name('dashboard.pages.settings');
    });

    // Generating Reports
    Route::prefix('reports')->name('dashboard.reports.')->group(function () {
        Route::get('/orders', [ReportController::class, 'orders'])->name('orders');
        Route::get('/reservations', [ReportController::class, 'reservations'])->name('reservations');
    });

    // Logs
    Route::prefix('logs')->name('dashboard.logs.')->group(function () {
        Route::get('/', [LogController::class, 'index'])->name('index');
        Route::get('/export-pdf/{timeframe?}', [LogController::class, 'exportPdf'])->name('pdf');
    });
});

// ----------------------------
// Utility Routes
// ----------------------------
Route::post('/clear-order-session', function () {
    session()->forget('order');
    return response()->json(['status' => 'success']);
})->name('clear.order.session');

// Fallback
Route::fallback(fn() => view('errors.404'))->name('fallback');
