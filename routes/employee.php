<?php

use App\Http\Controllers\Employee\AuthenticationController;
use App\Http\Controllers\Employee\BookingController;
use App\Http\Controllers\Employee\GuestController;
use App\Http\Controllers\Employee\HomeController;

Route::prefix('employee')->group(function () {
    Route::get('login', [AuthenticationController::class, 'showLoginForm'])->name('employee.login.form');
    Route::post('login', [AuthenticationController::class, 'login'])->name('employee.login');

    Route::middleware('auth:employee')->group(function () {
        Route::get('home', [HomeController::class, 'index'])->name('employee.home');
        Route::post('logout', [AuthenticationController::class, 'logout'])->name('employee.logout');
        
        
        Route::resource('bookings', BookingController::class)->names('employee.bookings');
        Route::resource('guests', GuestController::class)->names('employee.guests');
        
        
        Route::prefix('ajax')->group(function () {
            Route::post('bookings', [BookingController::class, 'bookings'])->name('employee.ajax.bookings');
            Route::post('guests', [GuestController::class, 'guests'])->name('employee.ajax.guests');
        });

    });
});