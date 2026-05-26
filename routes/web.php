<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

// Auth Routes
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Protected Routes
Route::middleware('auth')->group(function () {
    Route::get('/menu-utama', function () {
        return view('customer.dashboard');
    })->name('customer.dashboard')->middleware('role:customer');

    Route::get('/booking/{service}', function ($service) {
        return view('customer.booking', ['serviceKey' => $service]);
    })->name('customer.booking')->middleware('role:customer');

    Route::get('/admin/dashboard', [\App\Http\Controllers\AdminController::class, 'index'])->name('admin.dashboard')->middleware('role:admin');
    Route::post('/admin/users', [\App\Http\Controllers\AdminController::class, 'storeUser'])->middleware('role:admin');
    Route::put('/admin/users/{id}', [\App\Http\Controllers\AdminController::class, 'updateUser'])->middleware('role:admin');
    Route::delete('/admin/users/{id}', [\App\Http\Controllers\AdminController::class, 'deleteUser'])->middleware('role:admin');

    Route::get('/photographer/jadwal', function () {
        return view('photographer.dashboard');
    })->name('photographer.dashboard')->middleware('role:photographer');
});
