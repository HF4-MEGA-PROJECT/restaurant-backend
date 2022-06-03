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

Route::middleware('auth:sanctum')->group(static function () {
    Route::apiResource('category', \App\Http\Controllers\CategoryController::class);
    Route::apiResource('category.children', \App\Http\Controllers\CategoryChildController::class)->only(['index']);
    Route::apiResource('category.products', \App\Http\Controllers\ProductChildController::class)->only(['index']);
    Route::apiResource('product', \App\Http\Controllers\ProductController::class);
    Route::apiResource('reservation', \App\Http\Controllers\ReservationController::class);
    Route::apiResource('setting', \App\Http\Controllers\SettingController::class);
    Route::apiResource('group', \App\Http\Controllers\GroupController::class);
    Route::apiResource('order', \App\Http\Controllers\OrderController::class);
    Route::apiResource('order_product', \App\Http\Controllers\OrderProductController::class);
    Route::apiResource('ingredient', \App\Http\Controllers\IngredientController::class);
    Route::apiResource('product_ingredient', \App\Http\Controllers\ProductIngredientController::class);

    Route::get('/orders', [\App\Http\Controllers\AppController::class, 'orders']);
    Route::get('/group/{group}/orders', [\App\Http\Controllers\AppController::class, 'groupOrders']);
});

Route::get('/menu', [\App\Http\Controllers\PWAController::class, 'menu']);
Route::get('/hours', [\App\Http\Controllers\PWAController::class, 'hours']);
Route::post('/reserve', [\App\Http\Controllers\PWAController::class, 'reserve']);
