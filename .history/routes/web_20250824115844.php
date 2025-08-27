<?php

use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\PagFanController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', [CheckoutController::class, 'index'])->name('checkout');

// Rotas do menu principal
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/home', function () {
        return view('pages.home'); // Cria a view em resources/views/pages/home.blade.php
    })->name('home');

    Route::get('/banners', function () {
        return view('pages.banners'); // Cria a view em resources/views/pages/banners.blade.php
    })->name('banners.index');

    Route::get('/upsellers', function () {
        return view('pages.upsellers'); // Cria a view em resources/views/pages/upsellers.blade.php
    })->name('upsellers');

    Route::get('/config', function () {
        return view('pages.config'); // Cria a view em resources/views/pages/config.blade.php
    })->name('config');
});

// Rotas de perfil
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
