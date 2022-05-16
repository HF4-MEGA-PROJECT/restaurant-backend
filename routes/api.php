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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::apiResource('category', \App\Http\Controllers\CategoryController::class);
Route::apiResource('product', \App\Http\Controllers\ProductController::class);
Route::apiResource('reservation', \App\Http\Controllers\ReservationController::class);
Route::apiResource('setting', \App\Http\Controllers\SettingController::class);
Route::apiResource('table', \App\Http\Controllers\TableController::class);
Route::apiResource('order', \App\Http\Controllers\OrderController::class);
Route::apiResource('order_product', \App\Http\Controllers\OrderProductController::class);
Route::apiResource('ingredient', \App\Http\Controllers\IngredientController::class);
