<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PropertyController;
use App\Models\Landlord;
use Illuminate\Support\Facades\Auth;
/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/
Route::get('/', function () {
    return view('user.home');
})->name('public.home');

Route::get('/signup', [UserController::class, 'signup'])->name('user.signup');
Route::post('/signup', [UserController::class, 'signupSubmit'])->name('user.signup.submit');

// User Login Routes
Route::get('/login', [UserController::class, 'showLoginForm'])->name('user.login');
Route::post('/login', [UserController::class, 'login'])->name('user.login.submit');
Route::middleware(['auth:landlord'])->group(function () {
    Route::get('/user/home', [UserController::class, 'userHome'])->name('user.user_home');
});

// Protected Routes for Authenticated Users
Route::middleware(['auth'])->group(function () {
    Route::get('/user/home', [UserController::class, 'userHome'])->name('user.user_home');
    Route::get('/user/properties', [PropertyController::class, 'properties'])->name('user.properties');

    // Visitor-Specific Routes
    Route::middleware('role:visitor')->group(function () {
        Route::get('/user/profile', [UserController::class, 'profile'])->name('visitor.profile');
        Route::get('/properties', [PropertyController::class, 'showProperties'])->name('user.properties_list');
        Route::get('/properties/filter', [PropertyController::class, 'filterProperties'])->name('properties.filter');
        Route::get('/property/details/{id}', [PropertyController::class, 'showPropertyDetails'])->name('property.details');
        Route::get('/user/visit-requested-properties', [UserController::class, 'visitRequestedProperties'])->name('user.visit.requested.properties');
    });

    // Landlord-Specific Routes
    Route::middleware('role:landlord')->group(function () {
        Route::get('/landlord/profile', [UserController::class, 'landlordProfile'])->name('landlord.profile');
    });

    // Tenant-Specific Routes
    Route::middleware('role:tenant')->group(function () {
        Route::get('/tenant/profile', [UserController::class, 'tenantProfile'])->name('tenant.profile');
    });


    Route::get('/user/service', [UserController::class, 'service'])->name('user.service');
    Route::get('/user/profile/edit', [UserController::class, 'editProfile'])->name('visitor.edit_profile');
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
