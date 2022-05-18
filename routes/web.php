<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    if (\Illuminate\Support\Facades\Auth::check()) {
        return redirect('/dashboard');
    }

    return redirect('/login');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard', [
            'totalGuests' => \App\Models\Table::totalGuests(),
            'revenueThisMonth' => \App\Models\OrderProduct::revenueThisMonth(),
            'productsSoldThisMonth' => \App\Models\OrderProduct::productsSoldThisMonth()->count(),
            'reservationsToday' => \App\Models\Reservation::reservationsToday(),
            'currentTables' => \App\Models\Table::currentTables()
        ]);
    })->name('dashboard');
});

// Import Jetstream routes.
require_once __DIR__ . '/jetstream.php';
