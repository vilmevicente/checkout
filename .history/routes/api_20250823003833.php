use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

<?php


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
Route::get('/status', function () {
    return response()->json(['status' => 'API is running']);
});

// Example protected route (requires authentication)
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});