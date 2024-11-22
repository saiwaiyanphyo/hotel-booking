<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\Web\AdminController;
use App\Http\Controllers\Web\AuthenticationController;
use App\Http\Controllers\Web\RoomController;
use App\Http\Controllers\Web\RoomTypeController;
use App\Http\Controllers\Web\EmployeeController;
use App\Http\Controllers\Web\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    if (Auth::guard('admin')->check()) {
        return redirect()->route('admin.home');
    }
    
    if (Auth::guard('employee')->check()) {
        return redirect()->route('employee.home');
    }
    return redirect()->route('employee.login.form');
});

Route::prefix('/admin')->group(function () {
    Route::get('login', [AuthenticationController::class, 'showLoginForm'])->name('admin.login.form');
    Route::post('login', [AuthenticationController::class, 'login'])->name('admin.login');

    Route::middleware('auth:admin')->group(function () {
        Route::get('home', [HomeController::class, 'index'])->name('admin.home');
        Route::post('logout', [AuthenticationController::class, 'logout'])->name('admin.logout');

        Route::resource('room-types', RoomTypeController::class)->names('admin.room-types');
        Route::resource('employees', EmployeeController::class)->names('admin.employees');
        Route::resource('rooms', RoomController::class)->names('admin.rooms');
        
        Route::prefix('ajax')->group(function () {
            Route::post('room-types', [RoomTypeController::class, 'roomTypes'])->name('ajax.room-types');
            Route::post('employees', [EmployeeController::class, 'employees'])->name('ajax.employees');
            Route::post('rooms', [RoomController::class, 'rooms'])->name('ajax.rooms');
            Route::post('monthly_income', [HomeController::class, 'monthly_income'])->name('ajax.monthly_income');

        });

    });
});