<?php

use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\PagFanController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\Admin\UpsellController;
use App\Http\Controllers\Admin\ConfigController;
use App\Http\Controllers\Admin\ProductController as AdminProductController;
use App\Http\Controllers\ProductController;


Route::get('/', [CheckoutController::class, 'index'])->name('checkout');


// Rotas de perfil
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


// Admin Routes
Route::prefix('admin')->name('admin.')->middleware(['auth', 'verified'])->group(function () {
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    // Banners
    Route::resource('banners', BannerController::class);
    Route::post('banners/order', [BannerController::class, 'updateOrder'])->name('banners.order');
    

    Route::resource('products', AdminProductController::class);
Route::resource('upsells', UpsellController::class);


    // Upsells
    Route::resource('upsells', UpsellController::class);
    Route::post('upsells/order', [UpsellController::class, 'updateOrder'])->name('upsells.order');
    
    // Configuration
    Route::get('config', [ConfigController::class, 'edit'])->name('config.edit');
    Route::put('config', [ConfigController::class, 'update'])->name('config.update');
    Route::get('config/discount-rules', [ConfigController::class, 'getDiscountRules'])->name('config.discount-rules');
    Route::post('config/discount-rules', [ConfigController::class, 'updateDiscountRules'])->name('config.discount-rules.update');
});

// Frontend Routes (for checkout page)
Route::get('/checkout', function () {
    $banners = App\Models\Banner::where('is_active', true)->orderBy('order')->get();
    $upsells = App\Models\Upsell::where('is_active', true)->orderBy('order')->get();
    $config = App\Models\CheckoutConfig::all()->keyBy('key');
    
    return view('checkout', compact('banners', 'upsells', 'config'));
})->name('checkout');


require __DIR__.'/auth.php';
