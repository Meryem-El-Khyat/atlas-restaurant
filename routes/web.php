<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Routes d'authentification
Route::get('/', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Routes pour l'administrateur
Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/reservations', [AdminController::class, 'reservations'])->name('admin.reservations');
    Route::post('/reservations', [AdminController::class, 'storeReservation'])->name('admin.reservations.store');
    Route::get('/statistics', [AdminController::class, 'statistics'])->name('admin.statistics');
});

// Routes pour l'utilisateur
Route::middleware(['auth'])->prefix('user')->group(function () {
    Route::get('/dashboard', [UserController::class, 'dashboard'])->name('user.dashboard');
    Route::get('/profile', [UserController::class, 'profile'])->name('user.profile');
    Route::get('/reservation', [UserController::class, 'showReservationForm'])->name('user.reservation');
    Route::post('/reservation', [UserController::class, 'storeReservation'])->name('user.reservation.store');
    Route::post('/reservation/{id}/cancel', [UserController::class, 'cancelReservation'])->name('user.reservation.cancel');
});


