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
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\ServiceRequestController;


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

Route::get('/property/{id}', [UserController::class, 'showPropertyDetailsForPublic'])->name('user.details');

Route::get('user/properties', [UserController::class, 'properties'])->name('user.properties');
Route::get('/user/service', [UserController::class, 'service'])->name('user.service');

// Protected Routes for All Authenticated Users
Route::middleware(['auth:landlord'])->group(function () {
    Route::get('/landlord/home', [UserController::class, 'landlordHome'])->name('landlord.user_home');
    Route::get('/landlord/add-property', [LandlordController::class, 'addProperty'])->name('landlord.add_property');
    Route::get('/landlord/profile', [LandlordController::class, 'profile'])->name('landlord.profile');
    Route::post('/landlord/store-property', [LandlordController::class, 'storeProperty'])->name('landlord.store_property');
    Route::get('/landlord/property/{id}', [LandlordController::class, 'showPropertyDetails'])->name('landlord.property_details');
    Route::get('landlord/notifications', [NotificationController::class, 'index'])->name('landlord.notifications');
Route::post('notifications/{id}/mark-as-read', [NotificationController::class, 'markAsRead'])->name('notifications.markAsRead');
// Add this route for the property list
Route::get('/landlord/properties', [LandlordController::class, 'showPropertiesList'])->name('landlord.properties_list');

Route::get('/landlord/edit-profile', [LandlordController::class, 'editProfile'])->name('landlord.edit_profile');
Route::post('/landlord/update-profile', [LandlordController::class, 'updateProfile'])->name('landlord.update_profile');

// Add this route for the property list

});

Route::middleware(['auth:tenant'])->group(function () {
    Route::get('/tenant/home', [UserController::class, 'tenantHome'])->name('tenant.user_home');
    Route::get('/tenant/profile', [TenantController::class, 'profile'])->name('tenant.profile');

    Route::get('/tenant/edit-profile', [TenantController::class, 'editProfile'])->name('tenant.edit_profile');
    Route::post('/tenant/update-profile', [TenantController::class, 'updateProfile'])->name('tenant.update_profile');



    // Define a route for showing all properties
    Route::get('/tenant/properties', [TenantController::class, 'showProperties'])->name('tenant.property_list');
    Route::get('/tenant/properties/filter', [UserController::class, 'filterProperties'])->name('tenant.filter');
    Route::get('/tenant/properties/details/{id}', [TenantController::class, 'showPropertyDetailsForPublic'])->name('tenant.details');
    Route::get('/tenant/home/visit-requested-properties', [UserController::class, 'visitRequestedProperties'])->name('tenant.visit_req_list');


    // Define a separate route for showing rented properties, if needed
    Route::get('/rented-properties', [TenantController::class, 'showRentedProperties'])->name('tenant.rentedProperties');

    Route::get('/rented-property/{property_id}', [TenantController::class, 'showRentedPropertyDetails'])->name('tenant.showRentedPropertyDetails');
    Route::post('/payment/process/{tenant_id}', [PaymentController::class, 'processTenantPayment'])->name('tenant.payment.process');
    Route::post('/tenant/move-out-request', [TenantController::class, 'requestMoveOut'])->name('tenant.moveOutRequest');


    Route::get('/service-requests', [TenantController::class, 'viewServiceRequests'])->name('tenant.serviceRlist');
    Route::put('/service-requests/{id}/cancel', [TenantController::class, 'cancelServiceRequest'])->name('tenant.cancelServiceRequest');

    // Show the service request form
// Show the service request form
Route::get('/tenant/service-request-form', [TenantController::class, 'showServiceRequestForm'])->name('tenant.serviceRequestT');

// Submit the service request
Route::post('/tenant/service-request-form', [TenantController::class, 'createServiceRequest'])->name('tenant.createServiceRequest');



    Route::get('/check-tenant/{propertyId}', function ($propertyId) {
        $hasTenant = Tenant::where('property_ID', $propertyId)->exists();
        return response()->json(['hasTenant' => $hasTenant]);
    });

    // Store payment for a tenant
Route::post('/tenant/{tenantId}/payment', [PaymentController::class, 'storePayment'])->name('payment.store');

// Show payment history for a tenant
Route::get('/tenant/{tenantId}/payments', [PaymentController::class, 'showPayments'])->name('payment.history');

Route::delete('/delete-profile', [UserController::class, 'deleteProfile'])->name('profile.delete');

});


Route::middleware(['auth:visitor'])->group(function () {
    Route::get('/visitor/home', [UserController::class, 'visitorHome'])->name('visitor.user_home');
    Route::get('/visitor/profile', [UserController::class, 'profile'])->name('visitor.profile');
    Route::post('/visit-requests', [VisitRequestController::class, 'store'])->middleware('auth'); // Ensure only authenticated users can book visits
    Route::post('/visit/request', [UserController::class, 'requestVisit'])->name('visit.request');
// web.php (routes file)

Route::post('/visit-request/cancel/{property_id}', [UserController::class, 'cancelVisitRequest'])->name('visitor.cancelVisitRequest');


    Route::get('/visitor/properties', [UserController::class, 'showProperties'])->name('visitor.property_list');

        Route::get('/visitor/properties/filter', [UserController::class, 'filterProperties'])->name('visitor.filter');
        Route::get('/visitor/properties/details/{id}', [UserController::class, 'showPropertyDetails'])->name('visitor.details');
        Route::get('/visitor/home/visit-requested-properties', [UserController::class, 'visitRequestedProperties'])->name('visitor.visit_req_list');


        Route::get('/booked-property-details/{property_id}', [UserController::class, 'showBookedPropertyDetails'])->name('visitor.bookedproperty_details');

        Route::post('/payment/session/{visitor_id}', [PaymentController::class, 'createCheckoutSession'])->name('payment.session');
        
        Route::get('/payment-success/{visitor_id}/', [PaymentController::class, 'paymentSuccess'])->name('payment.success');
        Route::get('/payment-cancel/{visitor_id}/', [PaymentController::class, 'paymentCancel'])->name('payment.cancel');
        
        Route::get('/user/profile/edit', [UserController::class, 'editProfile'])->name('visitor.edit_profile');
        Route::post('/user/profile/update', [UserController::class, 'updateProfile'])->name('user.profile.update');




        Route::delete('/delete-profile', [UserController::class, 'deleteProfile'])->name('profile.delete');




    });

    Route::get('/logout', function (Request $request) {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/')->with('success', 'You have been logged out.');
    })->name('user.logout');
    

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


    Route::patch('admin/visit-requests/{id}/{status}', [AdminController::class, 'updateRequestStatus'])->name('admin.updateRequestStatus');
    Route::patch('admin/remove-visit-request/{id}', [AdminController::class, 'removeVisitRequest'])->name('admin.removeVisitRequest');
    Route::patch('admin/change-to-tenant/{id}', [AdminController::class, 'changeToTenant'])->name('admin.changeToTenant');


Route::get('/admin/service-providers', [ServiceProviderController::class, 'index'])->name('admin.serviceProvider');
Route::delete('/admin/service-providers/{id}', [ServiceProviderController::class, 'destroy'])->name('admin.serviceProviders.delete');


Route::get('/admin/service-requests', [ServiceRequestController::class, 'index'])->name('admin.service-requests');
Route::put('/admin/service-requests/{id}/update', [ServiceRequestController::class, 'update'])->name('admin.service-request.update');
// Correct route for assigning provider (using POST method)
Route::post('/admin/service-requests/{id}/assign', [ServiceRequestController::class, 'assignProvider'])->name('admin.service-request.assign');


Route::get('admin/add-provider', [ServiceProviderController::class, 'create'])->name('admin.addProvider');

// Route to handle the form submission and store the new provider
Route::post('admin/add-provider', [ServiceProviderController::class, 'store'])->name('admin.storeProvider');

  /*   |--------------------------------------------------------------------------
    | Property Routes
    |--------------------------------------------------------------------------
    */

    Route::get('/admin/visitor', [AdminController::class, 'viewVisitRequests'])->name('admin.visitor');

    // web.php (or routes file)
Route::get('/admin/tenant', [AdminController::class, 'showTenant'])->name('admin.tenant');




// Admin Services
Route::get('/admin/services', [AdminController::class, 'showServices'])->name('admin.services');
Route::get('/admin/services/{id}/edit', [AdminController::class, 'editService'])->name('admin.services.edit');
Route::delete('/admin/services/{id}', [AdminController::class, 'deleteService'])->name('admin.services.destroy');


Route::get('/admin/services/create', [AdminController::class, 'create'])->name('admin.add_service');

// Store the new service
Route::post('/admin/services', [AdminController::class, 'store'])->name('admin.services.store');

Route::middleware(['auth:admin'])->group(function () {

    // Log when a route is accessed by an admin
    Route::get('/admin/profile', function() {
        Log::info('Admin is accessing profile page');
        return view('admin.profile');
    })->name('admin.profile.edit');

    Route::post('/admin/profile', function(Request $request) {
        Log::info('Admin is updating profile', ['request' => $request->all()]);
        // Handle profile update logic here
        return back()->with('success', 'Profile updated successfully');
    })->name('admin.profile.update');

    // Example for the properties route
    Route::get('/admin/properties', function() {
        Log::info('Admin is accessing properties page');
        // Handle properties logic here
        return view('admin.property_list');
    })->name('admin.property_list');

    // Log when the logout route is accessed
    Route::post('/logout', function () {
        Log::info('Admin logging out');
        Auth::guard('admin')->logout();
        return redirect('/');
    })->name('logout');
});