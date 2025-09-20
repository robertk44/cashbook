<?php

use App\Http\Controllers\BookingController;
use App\Http\Controllers\CashBoxController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'home'])->name('home');
Route::get('/login', [HomeController::class, 'showLoginForm'])->name('login');
Route::post('/login', [HomeController::class, 'login']);
Route::get('/register', [HomeController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [HomeController::class, 'register']);
Route::post('/logout', [HomeController::class, 'logout'])->name('logout');

Route::group(['middleware' => 'auth'], function () {
    Route::resource('cashboxes', CashBoxController::class);
    Route::resource('cashboxes.bookings', BookingController::class)->shallow();
});
