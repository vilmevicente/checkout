<?php

use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\PagFanController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;


Route::get('/', [CheckoutController::class, 'index'])->name('checkout');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');



// Rotas da API PagFan
Route::prefix('pagfan')->group(function () {
    Route::get('balance', [PagFanController::class, 'getBalance']);
    Route::post('qrcode', [PagFanController::class, 'generateQrCode']);
    Route::post('payment', [PagFanController::class, 'makePayment']);
    Route::post('webhook', [PagFanController::class, 'webhook']);
});
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';


