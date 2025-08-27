<?php

use App\Http\Controllers\PagFanController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::prefix('pagfan')->group(function () {
    Route::get('balance', [PagFanController::class, 'getBalance']);
    Route::post('qrcode', [PagFanController::class, 'generateQrCode']);
    Route::post('payment', [PagFanController::class, 'makePayment']);
    Route::post('webhook', [PagFanController::class, 'webhook']);
});