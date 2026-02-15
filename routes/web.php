<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

// Authentication Routes
Route::get('/login', [AuthController::class, 'showLogin'])->name('showLogin')->middleware('guest');
Route::post('/login', [AuthController::class, 'login'])->name('login')->middleware('guest');
Route::get('/register', [AuthController::class, 'showRegister'])->name('showRegister')->middleware('guest');
Route::post('/register', [AuthController::class, 'register'])->name('register')->middleware('guest');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Universal login (combined user/admin UI)
Route::get('/universal-login', function () { return view('auth.universal-login'); })->name('universal.login')->middleware('guest');
Route::post('/universal-login', [AuthController::class, 'universalLoginSubmit'])->name('universal.login.submit')->middleware('guest');

// Backwards-compatible user-specific routes
Route::get('/user/login', [AuthController::class, 'showLogin'])->name('user.login')->middleware('guest');
Route::get('/user/register', [AuthController::class, 'showRegister'])->name('user.register')->middleware('guest');
Route::post('/user/register', [AuthController::class, 'register'])->name('user.register.submit')->middleware('guest');

// Admin Dashboard
Route::get('/admin/dashboard', function () {
    return view('admin.dashboard');
})->name('admin.dashboard')->middleware('auth');

// Default redirect untuk authenticated users
Route::get('/', function () {
    return redirect()->route('admin.dashboard');
})->middleware('auth');

