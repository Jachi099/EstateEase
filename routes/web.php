<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/

// Public homepage route, accessible to everyone
Route::get('/', function() {
    return view('user.home'); // Updated to point to the correct path
})->name('public.home');

// User signup page
Route::get('/signup', [UserController::class, 'signup'])->name('user.signup');
Route::post('/signup', [UserController::class, 'signupSubmit'])->name('user.signup.submit');

/*
|--------------------------------------------------------------------------
| User Routes (Protected for Logged-In Users Only)
|--------------------------------------------------------------------------
*/

// Group of routes for authenticated users only
Route::middleware(['auth'])->group(function () {
    // User-specific homepage
    Route::get('/user/home', [UserController::class, 'userHome'])->name('user.home'); // Now points to userHome method

    // Properties and service pages for logged-in users
    Route::get('/properties', [UserController::class, 'properties'])->name('user.properties');
    Route::get('/service', [UserController::class, 'service'])->name('user.service');
});

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/

// Admin login routes
Route::get('admin/login', [AdminController::class, 'showLoginForm'])->name('admin.login');
Route::post('admin/login', [AdminController::class, 'login']);

// Protected routes for admins only
Route::middleware(['auth:admin'])->group(function () {
    Route::get('admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::post('admin/logout', [AdminController::class, 'logout'])->name('admin.logout');
});
