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
    NotificationController,
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
    // Eager load variations for all products
    $products = \App\Models\Product::with('variations')->get();

    // Define the static categories
    $categories = [
        1 => 'Espresso-Based Coffee',
        2 => 'Milktea',
        3 => 'Non-Coffee',
        4 => 'Snacks',
        5 => 'Waffle',
        6 => 'Ramen',
    ];

    // Pass the products, categories, and selectedCategory (null for "All") to the view
    return view('frontend.menu', compact('products', 'categories'))->with('selectedCategory', null);
})->name('menu');

Route::get('/menu/category/{id}', function ($id) {
    // Fetch products by category and eager load variations
    $products = \App\Models\Product::with('variations')->where('category_id', $id)->get();

    // Define the static categories
    $categories = [
        1 => 'Espresso-Based Coffee',
        2 => 'Milktea',
        3 => 'Non-Coffee',
        4 => 'Snacks',
        5 => 'Waffle',
        6 => 'Ramen',
    ];

    // Pass the products, categories, and selectedCategory (current category) to the view
    return view('frontend.menu', compact('products', 'categories'))->with('selectedCategory', $id);
})->name('menu.category');


// Gallery
Route::get('/gallery', [GalleryController::class, 'index'])->name('gallery.index');
Route::get('/gallery/{galleryItem}', [GalleryController::class, 'show'])->name('gallery.show');

// Public Reservation Page
Route::get('/reservation', [ReservationController::class, 'showReservationPage'])->name('reservation.page');
Route::post('/reservation', [ReservationController::class, 'store'])->name('reservation.store');
Route::get('/reservations/{id}', [ReservationController::class, 'show'])->name('reservation.show');


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

    // Route for resending OTP
    Route::post('/resend-otp', [OTPController::class, 'resendOTP']);

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
// Cashier dashboard
Route::get('/cashier/pos', [CashierController::class, 'showPOS'])->name('cashier.showPOS');

// Transactions route
Route::get('/cashier/transactions', [CashierController::class, 'transactions'])->name('cashier.transactions');
Route::post('/cashier/transactions/save-order', [OrderController::class, 'store'])->name('orders.store');

// Update status route
Route::put('/cashier/transactions/{id}/status', [CashierController::class, 'updateStatus'])->name('cashier.updateStatus');

Route::get('/cashier', [CashierController::class, 'index'])->name('cashier.index');
Route::post('/cashier/checkout', [CashierController::class, 'checkout'])->name('cashier.checkout');

Route::get('/cashier/products_list', [CashierController::class, 'masterItem'])->name('masteritem.index');

// Cashier Reservations
Route::get('/cashier/reservations', [CashierController::class, 'reservationIndex'])->name('cashierReservation.index');
Route::post('/cashier/reservations', [CashierController::class, 'storeReservation'])->name('cashierReservation.store');

// Order and Reservation History Routes
Route::get('/cashier/history', [CashierController::class, 'history'])->name('cashierHistory.index');

Route::get('/cashier/manage', [CashierController::class, 'manageOrders'])->name('cashierManage.index');
// Orders
Route::post('/cashier/orders/{id}/accept', [CashierController::class, 'acceptOrder'])->name('orders.accept');
Route::post('/cashier/orders/{id}/cancel', [CashierController::class, 'cancelOrder'])->name('orders.cancel');

// Reservations
Route::post('/cashier/reservations/{id}/accept', [CashierController::class, 'acceptReservation'])->name('reservations.accept');
Route::post('/cashier/reservations/{id}/cancel', [CashierController::class, 'cancelReservation'])->name('reservations.cancel');

Route::middleware(['auth'])->group(function () {
    Route::get('/cashier/profile', [CashierController::class, 'profile'])->name('cashierProfile.index');
    Route::post('/cashier/profile/update/{id}', [CashierController::class, 'update'])->name('cashier.update');
});

// Route to view settings page
Route::get('/cashier/settings', [CashierController::class, 'settings'])->name('cashierSettings.index');

// Route to update settings
Route::post('/cashier/settings', [CashierController::class, 'updateSettings'])->name('cashierSettings.update');

Route::post('/cashier/logout', [CashierController::class, 'logoutCashier'])->name('cashier.logoutCashier');


// ----------------------------
// Notification Routes
// ----------------------------
Route::post('/notifications/mark-read', function () {
    auth()->user()->unreadNotifications->markAsRead();
    return back();
})->name('notifications.mark-read');
Route::post('/notifications/{id}/mark-read', [NotificationController::class, 'markRead'])->name('notifications.mark-single-read');
Route::get('notifications/unread-count', [NotificationController::class, 'getNotifications'])->name('notifications.get-unread-count');

Route::get('/notifications/fetch', function () {
    return auth()->user()->unreadNotifications;
})->middleware('auth')->name('notifications.fetch');

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
        Route::get('/{order}', 'showDetails')->name('orders.showDetails');
        Route::post('/{order}/cancel', 'cancelOrder')->name('orders.cancelOrder');
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

    // Report Generation Routes
    Route::get('/reports/orders', [DashboardController::class, 'generateOrdersReport'])->name('dashboard.reports.orders');
    Route::get('/reports/reservations', [DashboardController::class, 'generateReservationsReport'])->name('dashboard.reports.reservations');

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

        // API route for product variations
        Route::get('/variations/{product}', 'getProductVariations')->name('getProductVariations');
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

    // Admin Profile
    Route::middleware(['auth'])->group(function () {
        Route::get('/admin/profile', [AdminController::class, 'profile'])->name('admin.profile');
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

// ORDER MODAL IN NOTIFICATION 
Route::get('/order/{id}/details', [OrderController::class, 'getOrderDetails'])->name('getOrderDetails');
