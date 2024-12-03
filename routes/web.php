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
        AdminController,
        ProfileController,
        SettingsController,
        ContactController,
        AuthController
    };

    // Contact Page and Form Submission
    Route::controller(ContactController::class)->group(function () {
        Route::get('/contact', 'index')->name('contact'); // Display contact form
        Route::post('/contact', 'store')->name('contact.process'); // Handle form submission
    });

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
    Route::get('/gallery', function (): View {
        $galleryImages = [
            ['src' => 'assets/img/gallery/moments/1.jpg', 'alt' => 'Moment 1', 'category' => 'two'],
            ['src' => 'assets/img/gallery/moments/2.jpg', 'alt' => 'Moment 2', 'category' => 'two'],
            ['src' => 'assets/img/gallery/location/1.jpg', 'alt' => 'Location 1', 'category' => 'three'],
        ];

        return view('frontend.gallery', compact('galleryImages'));
    })->name('gallery');
    Route::get('/contact', fn(): View => view('frontend.contact'))->name('contact');

    // Public Reservation Page
    Route::get('/reservation', [ReservationController::class, 'showReservationPage'])->name('reservation.page'); // Display reservation page
    Route::post('/reservation', [ReservationController::class, 'store'])->name('reservation.store'); // Handle reservation form submission

    // Admin Dashboard Routes
    Route::middleware(['auth'])->prefix('dashboard')->group(function () {
        Route::get('/', [DashboardController::class, 'index'])->name('dashboard.index');

        // Category Routes
        Route::prefix('category')->controller(CategoryController::class)->name('dashboard.category')->group(function () {
            Route::get('/', 'index')->name('.index');
            Route::get('/create', 'create')->name('.create');
            Route::post('/store', 'store')->name('.store');
            Route::get('/{id}', 'show')->name('.show');
            Route::get('/{id}/edit', 'edit')->name('.edit');
            Route::put('/{id}/update', 'update')->name('.update');
            Route::delete('/{id}/destroy', 'destroy')->name('.destroy');
        });

        // Product Routes
        Route::prefix('products')->controller(ProductController::class)->name('dashboard.products')->group(function () {
            Route::get('/', 'index')->name('.index');
            Route::get('/add', 'showAdd')->name('.showAdd');
            Route::post('/add', 'store')->name('.store');
            Route::get('/{id}', 'show')->name('.show');
            Route::get('/{id}/edit', 'showEdit')->name('.showEdit');
            Route::put('/{id}/edit', 'update')->name('.update');
            Route::delete('/{id}/delete', 'destroy')->name('.destroy');
        });

        // Order Routes
        Route::prefix('orders')->controller(OrderController::class)->name('dashboard.orders.')->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('/create', 'create')->name('create');
            Route::post('/', 'store')->name('store');
            Route::get('/{order}', 'show')->name('show'); // Change {id} to {order}
            Route::get('/{order}/edit', 'edit')->name('edit'); // Change {id} to {order}
            Route::put('/{order}', 'update')->name('update'); // Change {id} to {order}
            Route::delete('/{order}', 'destroy')->name('destroy'); // Change {id} to {order}
            Route::get('/{order}/products', 'showProducts')->name('products'); // Change {id} to {order}
        });
        

        // Inventory Routes
        Route::prefix('inventory')->controller(InventoryController::class)->group(function () {
            Route::get('/', 'index')->name('dashboard.inventory.index');
            Route::get('/create', 'create')->name('dashboard.inventory.create');
            Route::post('/store', 'store')->name('dashboard.inventory.store');
            Route::get('/{id}/edit', 'edit')->name('dashboard.inventory.edit');
            Route::put('/{id}/update', 'update')->name('dashboard.inventory.update');
            Route::delete('/{id}/destroy', 'destroy')->name('dashboard.inventory.destroy');
            Route::get('/{id}', 'show')->name('dashboard.inventory.show');
        });

        // Supplier Routes
        Route::prefix('supplier')->controller(SupplierController::class)->name('dashboard.supplier.')->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('/create', 'create')->name('create');
            Route::post('/store', 'store')->name('store');
            Route::get('/{supplier}/edit', 'edit')->name('edit');
            Route::put('/{supplier}/update', 'update')->name('update');
            Route::delete('/{supplier}/destroy', 'destroy')->name('destroy');
        });

        // Reservations Routes (Admin)
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
            Route::get('/', [ProfileController::class, 'index'])->name('dashboard.profile.index');
            Route::get('/{id}/edit', [ProfileController::class, 'edit'])->name('dashboard.profile.edit');
            Route::put('/{id}', [ProfileController::class, 'update'])->name('dashboard.profile.update');
        });

        // Settings Routes
        Route::prefix('pages')->group(function () {
            Route::get('/settings', [SettingsController::class, 'index'])->name('dashboard.pages.settings');
        });
    });

    // Fallback Route
    Route::fallback(fn() => view('errors.404'))->name('fallback');
