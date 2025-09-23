<?php

use Illuminate\Support\Facades\Route;
use App\Models\Product;
use App\Models\RelatedProduct;
use Illuminate\Http\Request;

// Controllers
use App\Http\Controllers\{
    ProductController,
    OrderController,
    CartController,
    CheckoutController,
    ProfileController,
    NotificationController,
    DashboardController,
    PhoneController,
    AddressController,
    ContactController,
    PolicyController,
    HomeController,
    HomeFormController,
    NewsController,
    AchievementController,
};

// Admin Controllers
use App\Http\Controllers\Admin\{
    OrderController as AdminOrderController,
    ProductController as AdminProductController,
    CategoryController as AdminCategoryController,
    ReportController as AdminReportController,
    DashboardController as AdminDashboardController,
    CouponController,
    QuantityDiscountController,
    NewsController as AdminNewsController,
    AchievementController as AdminAchievementController
};

// Public Routes
Route::get('/', [HomeController::class, 'index'])->name('home');

// Static Pages Routes
Route::get('/about', function () {
    return view('about');
})->name('about');

Route::get('/services', function () {
    return view('services');
})->name('services');

Route::get('/contact', [App\Http\Controllers\ContactController::class, 'index'])->name('contact');

Route::get('/research-development', function () {
    return view('research-development');
})->name('research.development');

Route::get('/shop', function () {
    return view('shop');
})->name('shop');

// Products Routes (Public)
Route::prefix('products')->name('products.')->group(function () {
    Route::get('/', [ProductController::class, 'index'])->name('index');
    Route::post('/filter', [ProductController::class, 'filter'])->name('filter');
    Route::get('/{product}/details', [ProductController::class, 'getProductDetails'])->name('details');
    Route::get('/{product}', [ProductController::class, 'show'])->name('show');
});

// News Routes (Public)
Route::prefix('news')->name('news.')->group(function () {
    Route::get('/', [NewsController::class, 'index'])->name('index');
    Route::get('/{news:slug}', [NewsController::class, 'show'])->name('show');
});

// Achievements Routes (Public)
Route::prefix('achievements')->name('achievements.')->group(function () {
    Route::get('/', [AchievementController::class, 'index'])->name('index');
    Route::get('/{achievement:slug}', [AchievementController::class, 'show'])->name('show');
});

// Auth Routes
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    // Common Routes (for all authenticated users)
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/dashboard/stats', [DashboardController::class, 'getStats'])->name('dashboard.stats');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Notifications
    Route::prefix('notifications')->name('notifications.')->group(function () {
        Route::get('/', [NotificationController::class, 'index'])->name('index');
        Route::post('/{notification}/mark-as-read', [NotificationController::class, 'markAsRead'])->name('mark-as-read');
        Route::post('/mark-all-read', [NotificationController::class, 'markAllAsRead'])->name('mark-all-read');
    });

    // Customer Routes - Allow both admin and customer roles
    Route::middleware(['role:customer|admin'])->group(function () {


        // Phones
        Route::post('/phones', [PhoneController::class, 'store']);
        Route::get('/phones/{phone}', [PhoneController::class, 'show']);
        Route::put('/phones/{phone}', [PhoneController::class, 'update']);
        Route::delete('/phones/{phone}', [PhoneController::class, 'destroy']);
        Route::post('/phones/{phone}/make-primary', [PhoneController::class, 'makePrimary']);

        // Addresses
        Route::post('/addresses', [AddressController::class, 'store']);
        Route::get('/addresses/{address}', [AddressController::class, 'show']);
        Route::put('/addresses/{address}', [AddressController::class, 'update']);
        Route::delete('/addresses/{address}', [AddressController::class, 'destroy']);
        Route::post('/addresses/{address}/make-primary', [AddressController::class, 'makePrimary']);

        // Cart
        Route::prefix('cart')->name('cart.')->group(function () {
            Route::get('/', [CartController::class, 'index'])->name('index');
            Route::post('/add', [ProductController::class, 'addToCart'])->name('add');
            Route::get('/items', [ProductController::class, 'getCartItems'])->name('items');
            Route::patch('/update/{cartItem}', [CartController::class, 'updateQuantity'])->name('update');
            Route::delete('/remove/{cartItem}', [CartController::class, 'removeItem'])->name('remove');
            Route::post('/clear', [CartController::class, 'clear'])->name('clear');
        });

        // Checkout
        Route::controller(CheckoutController::class)->prefix('checkout')->name('checkout.')->group(function () {
            Route::get('/', 'index')->name('index');
            Route::post('/', 'store')->name('store')->middleware('web');
            Route::post('/apply-coupon', 'applyCoupon')->name('apply-coupon');
        });

        // Orders - Only for customers, not admins
        Route::middleware(['role:customer'])->prefix('orders')->name('orders.')->group(function () {
            Route::get('/', [OrderController::class, 'index'])->name('index');
            Route::get('/{order:uuid}', [OrderController::class, 'show'])->name('show');
        });

        // Customer Invoice Routes
        Route::prefix('customer/orders')->name('customer.orders.')->group(function () {
            Route::prefix('{uuid}/invoice')->name('invoice.')->group(function () {
                Route::get('/view', [App\Http\Controllers\Customer\InvoiceController::class, 'view'])->name('view');
                Route::post('/send', [App\Http\Controllers\Customer\InvoiceController::class, 'sendByEmail'])->name('send');
                Route::get('/data', [App\Http\Controllers\Customer\InvoiceController::class, 'getData'])->name('data');
            });
        });
    });

    // Admin Routes
    Route::middleware(['role:admin', \App\Http\Middleware\AdminPopupAuthMiddleware::class])
        ->prefix('admin')
        ->name('admin.')
        ->group(function () {
            // Dashboard
            Route::get('/dashboard/', [AdminDashboardController::class, 'index'])->name('dashboard');

            // Products Management
            Route::middleware(['permission:manage products'])->group(function () {
                Route::resource('products', AdminProductController::class);
                Route::resource('categories', AdminCategoryController::class);
            });

            // Coupons & Discounts Management
            Route::middleware(['permission:manage products'])->group(function () {
                Route::resource('coupons', CouponController::class);
                Route::post('coupons/generate-code', [CouponController::class, 'generateCode'])->name('coupons.generate-code');
            });

            // Orders Management
            Route::middleware(['permission:manage orders'])->group(function () {
                Route::get('/orders', [AdminOrderController::class, 'index'])->name('orders.index');
                Route::get('/orders/{order:uuid}', [AdminOrderController::class, 'show'])->name('orders.show');
                Route::put('/orders/{order:uuid}/status', [AdminOrderController::class, 'updateStatus'])
                    ->name('orders.update-status');
                Route::put('/orders/{order:uuid}/payment-status', [AdminOrderController::class, 'updatePaymentStatus'])
                    ->name('orders.update-payment-status');
                Route::patch('/orders/{order:uuid}/payment', [AdminOrderController::class, 'updatePayment'])
                    ->name('orders.update-payment');
                Route::get('/sales-statistics', [AdminOrderController::class, 'salesStatistics'])->name('sales.statistics');
                
                // Invoice Routes
                Route::prefix('orders/{uuid}/invoice')->name('orders.invoice.')->group(function () {
                    Route::get('/view', [App\Http\Controllers\Admin\InvoiceController::class, 'view'])->name('view');
                    Route::get('/download', [App\Http\Controllers\Admin\InvoiceController::class, 'download'])->name('download');
                    Route::post('/send', [App\Http\Controllers\Admin\InvoiceController::class, 'sendByEmail'])->name('send');
                    Route::get('/data', [App\Http\Controllers\Admin\InvoiceController::class, 'getData'])->name('data');
                });
            });

            // Reports Management
            Route::middleware(['permission:manage reports'])->group(function () {
                Route::get('/reports', [AdminReportController::class, 'index'])->name('reports.index');
            });

            // Quantity Discounts Routes
            Route::resource('quantity-discounts', QuantityDiscountController::class);

            // News Management Routes
            Route::patch('news/{id}/toggle-status', [AdminNewsController::class, 'toggleStatusById'])->name('news.toggle-status');
            Route::resource('news', AdminNewsController::class);

            // Achievements Management Routes
            Route::patch('achievements/{id}/toggle-status', [AdminAchievementController::class, 'toggleStatusById'])->name('achievements.toggle-status');
            Route::resource('achievements', AdminAchievementController::class);

            // Pages Management Routes
            Route::patch('pages/{page}/toggle-status', [App\Http\Controllers\Admin\PageController::class, 'toggleStatus'])->name('pages.toggle-status');
            Route::post('pages/update-order', [App\Http\Controllers\Admin\PageController::class, 'updateOrder'])->name('pages.update-order');
            Route::post('pages/upload-image', [App\Http\Controllers\Admin\PageController::class, 'uploadImage'])->name('pages.upload-image');
            Route::resource('pages', App\Http\Controllers\Admin\PageController::class);

            // Settings Management Routes
            Route::prefix('settings')->name('settings.')->group(function () {
                Route::get('general', [App\Http\Controllers\Admin\SettingsController::class, 'general'])->name('general');
                Route::post('general', [App\Http\Controllers\Admin\SettingsController::class, 'updateGeneral'])->name('general.update');
                Route::post('test-map', [App\Http\Controllers\Admin\SettingsController::class, 'testEmbeddedMap'])->name('test-map');
            });
        });
});


// Protected Cart Routes
Route::middleware(['auth:sanctum'])->group(function () {
    Route::post('/cart/add', [ProductController::class, 'addToCart'])->name('cart.add');
    Route::get('/cart/items', [ProductController::class, 'getCartItems'])->name('cart.items');
    Route::patch('/cart/items/{cartItem}', [ProductController::class, 'updateCartItem'])->name('cart.update-item');
    Route::delete('/cart/remove/{cartItem}', [ProductController::class, 'removeCartItem'])->name('cart.remove-item');
});

// مسارات لوحة تحكم العميل
Route::middleware('client')->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard');
    // ... باقي مسارات العميل
});



Route::post('/contact/submit', [App\Http\Controllers\ContactController::class, 'submit'])->name('contact.submit');
Route::post('/home-form/submit', [App\Http\Controllers\HomeFormController::class, 'submit'])->name('home-form.submit');

// مسارات السلة
Route::middleware(['auth'])->group(function () {
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::patch('/cart/items/{cartItem}', [CartController::class, 'updateItem'])->name('cart.items.update');
    Route::delete('/cart/items/{cartItem}', [CartController::class, 'removeItem'])->name('cart.items.remove');
    Route::get('/cart/count', [CartController::class, 'getCartCount'])->name('cart.count');
});

Route::get('/policy', [PolicyController::class, 'index'])->name('policy');

// Static Pages Routes - should be at the end to avoid conflicts
Route::get('/page/{slug}', [App\Http\Controllers\PageController::class, 'show'])->name('page.show');

Route::post('/admin/update-fcm-token', [App\Http\Controllers\Admin\DashboardController::class, 'updateFcmToken'])
    ->middleware(['auth', 'admin']);
