<?php

use App\Http\Controllers\DeviceTokenController;
use Illuminate\Support\Facades\Route;
use Laravel\Jetstream\Jetstream;

Route::group(['middleware' => config('jetstream.middleware', ['web'])], function () {
    $authMiddleware = config('jetstream.guard')
        ? 'auth:'.config('jetstream.guard')
        : 'auth';

    $authSessionMiddleware = config('jetstream.auth_session', false)
        ? config('jetstream.auth_session')
        : null;

    Route::group(['middleware' => array_values(array_filter([$authMiddleware, $authSessionMiddleware, 'verified']))], function () {
        // Device...
        if (Jetstream::hasApiFeatures()) {
            Route::get('/user/device-tokens', [DeviceTokenController::class, 'index'])->name('device-tokens.index');
            Route::post('/user/device-tokens', [DeviceTokenController::class, 'store'])->name('device-tokens.store');
            Route::put('/user/device-tokens/{token}', [DeviceTokenController::class, 'update'])->name('device-tokens.update');
            Route::delete('/user/device-tokens/{token}', [DeviceTokenController::class, 'destroy'])->name('device-tokens.destroy');
        }
    });
});
