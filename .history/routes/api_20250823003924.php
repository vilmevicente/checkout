<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;



/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Example public route

use App\Http\Controllers\PagFanController;


// Rotas da API PagFan
Route::prefix('pagfan')->group(function () {
    Route::get('balance', [PagFanController::class, 'getBalance']);
    Route::post('qrcode', [PagFanController::class, 'generateQrCode']);
    Route::post('payment', [PagFanController::class, 'makePayment']);
    Route::post('webhook', [PagFanController::class, 'webhook']);
});
