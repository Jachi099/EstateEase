<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Property1Controller;

use App\Http\Controllers\LandlordController;
use App\Http\Controllers\VisitRequestController;
use App\Http\Controllers\ServiceProviderController;
use App\Http\Controllers\TenantController;
use App\Http\Controllers\PaymentController;
use App\Models\Tenant; // Ensure you have created this model


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


Route::get('/user/properties', [UserController::class, 'properties'])->name('user.properties');
Route::get('/user/service', [UserController::class, 'service'])->name('user.service');

Route::get('/user/properties/filter', [UserController::class, 'filterPropertiesUser'])->name('user.filter');
Route::get('/user/properties/details/{id}', [UserController::class, 'showPropertyDetailsUser'])->name('user.details');
// Protected Routes for All Authenticated Users
Route::middleware(['auth:landlord'])->group(function () {
    Route::get('/landlord/home', [UserController::class, 'landlordHome'])->name('landlord.user_home');
    Route::get('/landlord/add-property', [LandlordController::class, 'addProperty'])->name('landlord.add_property');
    Route::get('/landlord/profile', [LandlordController::class, 'profile'])->name('landlord.profile');
    Route::get('/landlord/edit-profile', [LandlordController::class, 'editProfile'])->name('landlord.edit_profile');
    Route::post('/landlord/store-property', [LandlordController::class, 'storeProperty'])->name('landlord.store_property');
    Route::get('/landlord/property/{id}', [LandlordController::class, 'showPropertyDetails'])->name('landlord.property_details');
    Route::get('/landlord/notifications', [LandlordController::class, 'showNotifications'])->name('landlord.notifications');
    Route::post('/notifications/{id}/read', [LandlordController::class, 'markAsRead'])->name('notifications.markAsRead');

// Add this route for the property list
Route::get('/landlord/properties', [LandlordController::class, 'showPropertiesList'])->name('landlord.properties_list');


// Add this route for the property list

});

Route::middleware(['auth:tenant'])->group(function () {
    Route::get('/tenant/home', [UserController::class, 'tenantHome'])->name('tenant.user_home');
    Route::get('/tenant/profile', [TenantController::class, 'profile'])->name('tenant.profile');
    Route::get('/tenant/edit-profile', [TenantController::class, 'editProfile'])->name('tenant.edit_profile');

    // Define a route for showing all properties
    Route::get('/tenant/properties', [TenantController::class, 'showProperties'])->name('tenant.property_list');

    // Define a separate route for showing rented properties, if needed
    Route::get('/tenant/rented-properties', [TenantController::class, 'showPropertiesList'])->name('tenant.rented_properties_list');
    Route::get('/tenant/service', [TenantController::class, 'showServiceRequests'])->name('tenant.service');

    Route::get('/check-tenant/{propertyId}', function ($propertyId) {
        $hasTenant = Tenant::where('property_ID', $propertyId)->exists();
        return response()->json(['hasTenant' => $hasTenant]);
    });

    // Store payment for a tenant
Route::post('/tenant/{tenantId}/payment', [PaymentController::class, 'storePayment'])->name('payment.store');

// Show payment history for a tenant
Route::get('/tenant/{tenantId}/payments', [PaymentController::class, 'showPayments'])->name('payment.history');

    // Cancel a service request
    Route::post('/tenant/service/cancel/{id}', [TenantController::class, 'cancelServiceRequest'])->name('tenant.service.cancel');
    Route::get('/tenant/service/request', [TenantController::class, 'showServiceRequestForm'])->name('tenant.service.request.form');
    Route::post('/tenant/service/request', [TenantController::class, 'storeServiceRequest'])->name('tenant.service.request');
    Route::get('/tenant/property/{id}', [TenantController::class, 'showPropertyDetails'])->name('tenant.property_details');
});


Route::middleware(['auth:visitor'])->group(function () {
    Route::get('/visitor/home', [UserController::class, 'visitorHome'])->name('visitor.user_home');
    Route::get('/visitor/profile', [UserController::class, 'profile'])->name('visitor.profile');
    Route::get('/visitor/edit-profile', [UserController::class, 'editProfile'])->name('visitor.edit_profile');
    Route::post('/visit-requests', [VisitRequestController::class, 'store'])->middleware('auth'); // Ensure only authenticated users can book visits
    Route::post('/visit/request', [UserController::class, 'requestVisit'])->name('visit.request');
// web.php (routes file)
Route::get('/booked-property-details/{property_id}', [UserController::class, 'showBookedPropertyDetails'])->name('visitor.bookedproperty_details');

Route::post('/visit-request/cancel/{property_id}', [UserController::class, 'cancelVisitRequest'])->name('visitor.cancelVisitRequest');


    Route::get('/visitor/properties', [UserController::class, 'showProperties'])->name('visitor.property_list');

        Route::get('/visitor/properties/filter', [UserController::class, 'filterProperties'])->name('visitor.filter');
        Route::get('/visitor/properties/details/{id}', [UserController::class, 'showPropertyDetails'])->name('visitor.details');
        Route::get('/visitor/home/visit-requested-properties', [UserController::class, 'visitRequestedProperties'])->name('visitor.visit_req_list');
        Route::get('/visitor/property/{property_id}', [UserController::class, 'showBookedPropertyDetails'])->name('visitor.bookedproperty_details');


        Route::get('/payment/{visitor_id}', [PaymentController::class, 'showPaymentPage'])->name('payment.page');

        // Route to process the payment
        Route::post('/payment/{visitor_id}', [PaymentController::class, 'processPayment'])->name('payment.process');

        // Route to show payment success or failure
        Route::get('/payment/success/{payment}', function ($payment) {
            return view('payment.success', compact('payment'));
        })->name('payment.success');

        Route::get('/payment/failed/{payment}', function ($payment) {
            return view('payment.failed', compact('payment'));
        })->name('payment.failed');









        Route::post('/logout', [UserController::class, 'logout'])->name('user.logout');
        Route::get('/user/profile/edit', [UserController::class, 'editProfile'])->name('visitor.edit_profile');
        Route::post('/user/profile/update', [UserController::class, 'updateProfile'])->name('user.profile.update');








    });



    // Property-related routes

/*
    | Admin Routes
    |--------------------------------------------------------------------------
    */

    // Admin login routes
    Route::get('/admin/login', [AdminController::class, 'showLoginForm'])->name('admin.login');
    Route::post('/admin/login', [AdminController::class, 'login'])->name('admin.login');


    // Protected routes for admins only
    Route::middleware(['auth:admin'])->group(function () {
        //Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
        Route::post('/admin/logout', [AdminController::class, 'logout'])->name('admin.logout');
        //Route::get('/admin/property-list', [AdminController::class, 'propertyList'])->name('admin.property_list');

    });

    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');

    // Route for the admin to view all properties
    Route::get('/admin/properties', [Property1Controller::class, 'index'])->name('admin.properties.index');
    Route::get('/admin/property-list', [Property1Controller::class, 'index'])->name('admin.property_list');

    Route::patch('admin/visit-requests/{id}/{status}', [AdminController::class, 'updateRequestStatus'])->name('admin.updateRequestStatus');
    Route::patch('admin/remove-visit-request/{id}', [AdminController::class, 'removeVisitRequest'])->name('admin.removeVisitRequest');
    Route::patch('admin/change-to-tenant/{id}', [AdminController::class, 'changeToTenant'])->name('admin.changeToTenant');


   Route::get('/admin/service-providers', [ServiceProviderController::class, 'index'])->name('admin.serviceProviders');
Route::delete('/admin/service-providers/{id}', [ServiceProviderController::class, 'destroy'])->name('admin.serviceProviders.delete');
  /*   |--------------------------------------------------------------------------
    | Property Routes
    |--------------------------------------------------------------------------
    */
    Route::get('/properties', [Property1Controller::class, 'index'])->name('properties.index');

    Route::get('/admin/visitor', [AdminController::class, 'viewVisitRequests'])->name('admin.visitor');

    // web.php (or routes file)
Route::get('/admin/tenant', [AdminController::class, 'showTenant'])->name('admin.tenant');
