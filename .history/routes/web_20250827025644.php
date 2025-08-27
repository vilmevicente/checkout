<?php

use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\PagFanController;
use App\Http\Controllers\Admin\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\Admin\UpsellController;
use App\Http\Controllers\Admin\ConfigController;
use App\Http\Controllers\Admin\ProductController;





// Rotas de perfil
Route::middleware('auth')->group(function () {
    
    
});


// Admin Routes
Route::prefix('admin')->name('admin.')->middleware(['auth', 'verified'])->group(function () {
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    // Banners
    Route::resource('banners', BannerController::class);
    Route::post('banners/order', [BannerController::class, 'updateOrder'])->name('banners.order');
    
    
    Route::resource('products', ProductController::class);
    
    Route::get('/profile', [AdminProfileController::class, 'edit'])->name('profile.edit');
Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Upsells
    Route::resource('upsells', UpsellController::class);
    Route::post('upsells/order', [UpsellController::class, 'updateOrder'])->name('upsells.order');
    
    // Configuration
     Route::prefix('config')->group(function () {
        Route::get('/', [ConfigController::class, 'edit'])->name('config.edit');
        Route::put('/', [ConfigController::class, 'update'])->name('config.update');
        Route::post('/test-smtp', [ConfigController::class, 'testSmtp'])->name('config.test-smtp');
     });
});

// Frontend Routes (for checkout page)
Route::get('/checkout/{slug}', [CheckoutController::class, 'index'])->name('checkout');
Route::post('/checkout/process', [CheckoutController::class, 'process'])->name('checkout.process');


require __DIR__.'/auth.php';
