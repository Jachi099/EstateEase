<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PropertyController;
use App\Http\Controllers\LandlordController;

use App\Http\Controllers\TenantController;

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
// Protected Routes for All Authenticated Users
Route::middleware(['auth:landlord'])->group(function () {
    Route::get('/landlord/home', [UserController::class, 'landlordHome'])->name('landlord.user_home');
    Route::get('/landlord/profile', [LandlordController::class, 'profile'])->name('landlord.profile');
    Route::get('/landlord/edit-profile', [LandlordController::class, 'editProfile'])->name('landlord.edit_profile');
});

Route::middleware(['auth:tenant'])->group(function () {
    Route::get('/tenant/home', [UserController::class, 'tenantHome'])->name('tenant.user_home');
    Route::get('/tenant/profile', [TenantController::class, 'tenantProfile'])->name('tenant.profile');
    Route::get('/tenant/edit-profile', [TenantController::class, 'editProfile'])->name('tenant.edit_profile');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/visitor/home', [UserController::class, 'visitorHome'])->name('visitor.user_home');
    Route::get('/user/profile', [UserController::class, 'profile'])->name('visitor.profile');
    Route::get('/user/edit-profile', [UserController::class, 'editProfile'])->name('visitor.edit_profile');
    Route::get('/user/properties', [PropertyController::class, 'properties'])->name('user.properties');
    // Visitor-Specific Routes
        Route::get('/properties', [PropertyController::class, 'showProperties'])->name('user.properties_list');
        Route::get('/properties/filter', [PropertyController::class, 'filterProperties'])->name('properties.filter');
        Route::get('/property/details/{id}', [PropertyController::class, 'showPropertyDetails'])->name('property.details');
        Route::get('/user/visit-requested-properties', [UserController::class, 'visitRequestedProperties'])->name('user.visit.requested.properties');
        Route::post('/logout', [UserController::class, 'logout'])->name('user.logout');
        Route::get('/user/service', [UserController::class, 'service'])->name('user.service');
        Route::get('/user/profile/edit', [UserController::class, 'editProfile'])->name('visitor.edit_profile');
        Route::post('/user/profile/update', [UserController::class, 'updateProfile'])->name('user.profile.update');
    });

    // Property-related routes
   


    // Landlord-Specific Routes
 


    // User logout route

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
