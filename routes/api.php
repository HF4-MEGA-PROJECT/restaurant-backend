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

Route::middleware('auth:sanctum')->apiResource('category', \App\Http\Controllers\CategoryController::class);
Route::middleware('auth:sanctum')->apiResource('category.children', \App\Http\Controllers\CategoryChildController::class)->only(['index']);
Route::middleware('auth:sanctum')->apiResource('category.products', \App\Http\Controllers\ProductChildController::class)->only(['index']);
Route::middleware('auth:sanctum')->apiResource('product', \App\Http\Controllers\ProductController::class);
Route::middleware('auth:sanctum')->apiResource('reservation', \App\Http\Controllers\ReservationController::class);
Route::middleware('auth:sanctum')->apiResource('setting', \App\Http\Controllers\SettingController::class);
Route::middleware('auth:sanctum')->apiResource('group', \App\Http\Controllers\GroupController::class);
Route::middleware('auth:sanctum')->apiResource('order', \App\Http\Controllers\OrderController::class);
Route::middleware('auth:sanctum')->apiResource('order_product', \App\Http\Controllers\OrderProductController::class);
Route::middleware('auth:sanctum')->apiResource('ingredient', \App\Http\Controllers\IngredientController::class);
Route::middleware('auth:sanctum')->apiResource('product_ingredient', \App\Http\Controllers\ProductIngredientController::class);

Route::middleware('auth:sanctum')->get('/orders', [\App\Http\Controllers\AppController::class, 'orders']);

Route::get('/menu', [\App\Http\Controllers\PWAController::class, 'menu']);
Route::get('/hours', [\App\Http\Controllers\PWAController::class, 'hours']);
Route::post('/reserve', [\App\Http\Controllers\PWAController::class, 'reserve']);
