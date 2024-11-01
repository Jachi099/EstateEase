<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\LandlordController;
use App\Http\Controllers\PropertyController;

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

// User login page
Route::get('/login', [UserController::class, 'showLoginForm'])->name('user.login');
Route::post('/login', [UserController::class, 'login'])->name('user.login.submit');

/*
|--------------------------------------------------------------------------
| User Routes (Protected for Logged-In Users Only)
|--------------------------------------------------------------------------
*/

// Group of routes for authenticated users only
Route::middleware(['auth'])->group(function () {
    // User-specific homepage
    Route::get('/user/home', [UserController::class, 'userHome'])->name('user.user_home'); // Now points to userHome method

    // Landlord profile page
Route::get('/landlord/profile', [UserController::class, 'landlordProfile'])->name('landlord.profile');

    // Properties and service pages for logged-in users
    Route::get('/properties', [UserController::class, 'properties'])->name('user.properties');
    Route::get('/service', [UserController::class, 'service'])->name('user.service');
    Route::get('/user/profile', [UserController::class, 'profile'])->name('user.profile');
   

    // In routes/web.php
 Route::get('/user/properties', [PropertyController::class, 'showProperties'])->name('user.properties_list');
    Route::get('/properties/filter', [PropertyController::class, 'filterProperties'])->name('properties.filter');
Route::get('/property/details/{id}', [PropertyController::class, 'showPropertyDetails'])->name('property.details');





    // Route for visiting requested properties
// Route for visiting requested properties
Route::get('/user/visit-requested-properties', [UserController::class, 'visitRequestedProperties'])->name('user.visit.requested.properties');


    // Route for the profile edit page
    Route::get('/user/profile/edit', [UserController::class, 'editProfile'])->name('user.edit_profile');
    Route::post('/user/profile/update', [UserController::class, 'updateProfile'])->name('user.profile.update');

// User logout route
Route::post('/logout', [UserController::class, 'logout'])->name('user.logout');


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
    Route::get('/admin/property-list', [AdminController::class, 'propertyList'])->name('admin.property_list');

});


/*
|--------------------------------------------------------------------------
| Landlord Routes
|--------------------------------------------------------------------------
*/

Route::get('landlord/login', [LandlordController::class, 'showLoginForm'])->name('landlord.login');
Route::post('landlord/login', [LandlordController::class, 'login'])->name('landlord.login.submit');

Route::middleware(['auth:landlord'])->group(function () {
    Route::get('landlord/landlordu95dashboard', [LandlordController::class, 'dashboard'])->name('landlord.dashboard');
    Route::get('landlord/properties', [LandlordController::class, 'properties'])->name('landlord.properties');
    Route::post('landlord/logout', [LandlordController::class, 'logout'])->name('landlord.logout');
});


/*
|--------------------------------------------------------------------------
| Property Routes
|--------------------------------------------------------------------------
*/

Route::resource('properties', PropertyController::class);
