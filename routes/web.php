<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\TwoChatController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [\App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard');

    // Shop Routes
    Route::get('/shops/create', [ShopController::class, 'create'])->name('shops.create');
    Route::post('/shops', [ShopController::class, 'store'])->name('shops.store');
    Route::get('/shops/{shop}/manage', [ShopController::class, 'manage'])->name('shops.manage');
    Route::get('/shops/{shop}/edit', [ShopController::class, 'edit'])->name('shops.edit');
    Route::put('/shops/{shop}', [ShopController::class, 'update'])->name('shops.update');
    Route::get('/shops', [ShopController::class, 'index'])->name('shops.index');
    Route::get('/shops/{shop}', [ShopController::class, 'show'])->name('shops.show');
    // Route::get('/shops/{shop}/qr', [ShopController::class, 'qr'])->name('shops.qr');
    // Route::get('/shops/{shop}/analytics', [ShopController::class, 'analytics'])->name('shops.analytics');

    // Product Routes
    Route::get('/products', [ProductController::class, 'index'])->name('products.index');
    Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');
    Route::post('/products', [ProductController::class, 'store'])->name('products.store');
    Route::get('/products/{product}/edit', [ProductController::class, 'edit'])->name('products.edit');
    Route::put('/products/{product}', [ProductController::class, 'update'])->name('products.update');
    Route::delete('/products/{product}', [ProductController::class, 'destroy'])->name('products.destroy');

    // Profile Routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::post('/profile/import-products', [ProfileController::class, 'importProducts'])->name('profile.import-products');

    // Search Routes
    Route::get('/search', [\App\Http\Controllers\SearchController::class, 'index'])->name('search');

    // Feedback routes
    Route::get('/feedback', [FeedbackController::class, 'index'])->name('feedback.index');
    Route::get('/feedback/create', [FeedbackController::class, 'create'])->name('feedback.create');
    Route::post('/feedback', [FeedbackController::class, 'store'])->name('feedback.store');

    // 2Chat Routes
    Route::get('/2chat/products', [TwoChatController::class, 'getProducts'])->name('2chat.products');
});

require __DIR__ . '/auth.php';
