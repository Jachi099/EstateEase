<?php

use Illuminate\Support\Facades\Route;

// routes/web.php
//tenantdashboard
use App\Http\Controllers\TenantController;

Route::get('/tenant-dashboard', [TenantController::class, 'showDashboard'])->name('tenant.dashboard');
Route::get('/tenant-payment-history', [TenantController::class, 'paymentHistory'])->name('tenant.paymentHistory');
Route::get('/tenant-service-requests', [TenantController::class, 'serviceRequests'])->name('tenant.serviceRequests');


//serviceadmin panel

use App\Http\Controllers\ServiceAdminController;

Route::get('/service-admin', [ServiceController::class, 'index'])->name('service.admin');
Route::get('/service-admin/profile', [ServiceController::class, 'profile'])->name('service.profile');
Route::get('/service-admin/add', [ServiceController::class, 'add'])->name('service.add');
Route::get('/service-admin/check-requests', [ServiceController::class, 'checkRequests'])->name('service.checkRequests');

//serviceaddadmin

use App\Http\Controllers\ServiceAddAdminController;

Route::get('/serviceaddadmin', [ServiceAddAdminController::class, 'index']);
Route::get('/serviceaddadmin/create', [ServiceAddAdminController::class, 'create']);
Route::post('/serviceaddadmin', [ServiceAddAdminController::class, 'store']);


//Servicereqadmin

use App\Http\Controllers\ServiceRequestAdminController;

Route::get('/service-requests', [ServiceRequestAdminController::class, 'index']); // List pending requests
Route::get('/service-requests/history', [ServiceRequestAdminController::class, 'history']); // List request history
Route::get('/service-requests/{id}', [ServiceRequestAdminController::class, 'show']); // Show details of a request
Route::post('/service-requests/{id}/update', [ServiceRequestAdminController::class, 'update']); // Update request status

//add_service_provider_admin


use App\Http\Controllers\AddServiceProviderAdminController;

Route::get('/service-providers/create', [AddServiceProviderAdminController::class, 'create'])->name('service-providers.create');
Route::post('/service-providers', [AddServiceProviderAdminController::class, 'store'])->name('service-providers.store');



//adminprofile

use App\Http\Controllers\ProfileController;

// Route to show the edit profile form
Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit')->middleware('auth');

// Route to update the profile
Route::post('/profile/edit', [ProfileController::class, 'update'])->name('profile.update')->middleware('auth');

// Route to delete the profile
Route::post('/profile/delete', [ProfileController::class, 'destroy'])->name('profile.delete')->middleware('auth');



//tenantprofileedit


use App\Http\Controllers\TenantProfileController;

// Show the edit profile page
Route::get('/tenant/profile/edit', [TenantProfileController::class, 'edit'])
    ->name('tenant.profile.edit')
    ->middleware('auth');

// Update the tenant profile
Route::post('/tenant/profile/edit', [TenantProfileController::class, 'update'])
    ->name('tenant.profile.update')
    ->middleware('auth');

  // Rented properties route
    use App\Http\Controllers\TenantRentalController;

    
Route::get('/tenant/rented-properties', [TenantRentalController::class, 'index'])
    ->name('tenant.rented_properties')
    ->middleware('auth');

//servicereqtenant

use App\Http\Controllers\ServiceRequestTenantController;

Route::resource('service_requests', ServiceRequestTenantController::class);

?>