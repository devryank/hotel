<?php

use Illuminate\Support\Facades\Route;

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
    return redirect()->route('login');
});

Route::get('/dashboard', function () {
    if (Auth::id() == '1') {
        return redirect()->route('dashboard.booking.index');
    } else {
        return redirect()->route('dashboard.service.index');
    }
})->middleware(['auth'])->name('dashboard');
Route::name('dashboard.')
    ->prefix('dashboard')
    ->middleware(['auth'])
    ->group(function () {
        Route::get('/booking', [App\Http\Controllers\BookingController::class, 'index'])->name('booking.index');
        Route::get('/booking/create', [App\Http\Controllers\BookingController::class, 'create'])->name('booking.create');
        Route::post('/booking/store', [App\Http\Controllers\BookingController::class, 'store'])->name('booking.store');
        Route::put('/booking/{id}/paid', [App\Http\Controllers\BookingController::class, 'paid'])->name('booking.paid');
        Route::delete('/booking/{id}/destroy', [App\Http\Controllers\BookingController::class, 'destroy'])->name('booking.destroy');

        Route::get('/service', [App\Http\Controllers\ServiceController::class, 'index'])->name('service.index');
        Route::get('/service/create', [App\Http\Controllers\ServiceController::class, 'create'])->name('service.create');
        Route::put('/service/{id}/clear', [App\Http\Controllers\ServiceController::class, 'clear'])->name('service.clear');
        Route::post('/service/store', [App\Http\Controllers\ServiceController::class, 'store'])->name('service.store');
    });

require __DIR__ . '/auth.php';
