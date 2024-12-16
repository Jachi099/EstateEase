<?php



namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Notification;
use App\Models\MoveOutRequest;

use Illuminate\Http\Request;
use App\Models\Tenant; // Import the Tenant model
use Illuminate\Support\Facades\Auth;
use App\Models\Property; // Import the Property model
use Illuminate\Support\Facades\Log;
use App\Models\ServiceRequest; // Import the Property model
use App\Models\TenantPayment; // Import the Property model

use App\Models\Service; // Import the Property model

class TenantController extends Controller
{
    public function showProperties()
    {
        // Retrieve properties with the necessary details
        $properties = Property::select(
                'property_ID', 'status', 'img1', 'num_of_rooms', 'num_of_bathrooms',
                'floor', 'city', 'state', 'rent', 'available_from'
            )
            ->get();

        // Get the authenticated user's profile picture
        $user = Auth::user();
        $profilePicture = $user->picture;

        return view('tenant.property_list', compact('properties', 'profilePicture'));
    }


    public function profile()
    {
        // Get the authenticated landlord
        $tenant = Auth::guard('tenant')->user();

        // Check if the landlord exists
        if (!$tenant) {
            return redirect()->route('tenant.user_home')->with('error', 'Profile not found.');
        }

        // Pass the landlord's information to the profile view
        return view('tenant.profile', [
            'profilePicture' => $tenant->picture ?? null,
            'name' => $tenant->full_name,
            'email' => $tenant->email,
            'phone' => $tenant->phone_number ?? null,
            'address' => $tenant->current_address ?? null,
            'account_type' => $tenant->account_type,
        ]);
    }

    public function editProfile()
    {
        // Get the authenticated tenant
        $tenant = Auth::guard('tenant')->user();

        // Return the edit profile view with tenant data
        return view('tenant.edit_profile', ['tenant' => $tenant]);
    }

    public function updateProfile(Request $request)
    {
        // Validate request data
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            // Add other validation rules as needed
        ]);

        // Get the authenticated tenant
        $tenant = Auth::guard('tenant')->user();

        // Update tenant details
        $tenant->name = $request->name;
        $tenant->email = $request->email;
        // Update other fields as necessary

        return redirect()->route('tenant.profile')->with('success', 'Profile updated successfully!');
    }



 // In your Controller
 public function showRentedProperties()
 {
     // Get the authenticated tenant
     $tenant = Auth::guard('tenant')->user();

     if (!$tenant) {
         return redirect()->back()->with('error', 'Tenant not found.');
     }

     // Get the current date and calculate the deadline for payment (10th of the current month)
     $currentDate = now();
     $paymentDeadline = now()->startOfMonth()->addDays(10); // 10th of the current month

     // Fetch the properties where the tenant has rented, and check payment status
     $properties = Property::where('property_ID', $tenant->property_ID)
         ->with(['tenantPayments' => function ($query) use ($currentDate, $paymentDeadline) {
             $query->where('payment_date', '>=', $paymentDeadline)
                 ->orWhere('payment_date', null); // Null payment_date means unpaid
         }])
         ->get()
         ->sortByDesc(function ($property) {
             // Check if any tenant has unpaid status
             $isOverdue = $property->tenantPayments->isEmpty() || $property->tenantPayments->last()->status != 'paid';
             return $isOverdue ? 1 : 0; // Sort overdue properties first
         });

     // Get the tenant's profile picture
     $profilePicture = $tenant->picture;

     return view('tenant.rented_property_list', compact('properties', 'profilePicture'));
 }

 public function showRentedPropertyDetails($property_id)
{
    // Get the authenticated tenant
    $tenant = Auth::guard('tenant')->user(); // Ensure the tenant is authenticated

    if (!$tenant) {
        return redirect()->route('tenant.login')->with('error', 'You must be logged in to view this property.');
    }

    // Fetch the property with the provided property ID
    $property = Property::findOrFail($property_id);

    // Fetch the tenant associated with the property
    $tenantForProperty = Tenant::where('property_ID', $property_id)
                               ->where('id', $tenant->id) // Ensure this tenant is the one who rented the property
                               ->first();

    if (!$tenantForProperty) {
        return redirect()->back()->with('error', 'You are not renting this property.');
    }

    // Get the tenant's profile picture
    $profilePicture = $tenant->picture ?? null;

    // Fetch the latest payment for this tenant
    $latestPayment = $tenantForProperty->tenantPayments()->latest()->first();

    // Determine the payment status (paid or overdue)
    if ($latestPayment) {
        $paymentStatus = ($latestPayment->status == 'paid') ? 'Paid' : 'Overdue';
    } else {
        $paymentStatus = 'Overdue'; // No payment found, marked as overdue
    }

    // Use the authenticated tenant's ID to check for payment status
    $tenantPayment = TenantPayment::where('tenant_id', $tenant->id) // Use $tenant->id instead of $tenantId
                                  ->whereMonth('payment_date', now()->month)
                                  ->first();

    // Check if the tenant has paid for the current month
    $hasPaid = $tenantPayment ? true : false;

    // Pass the property, tenant details, payment status, and profile picture to the view
    return view('tenant.renteddetails', compact('hasPaid', 'property', 'paymentStatus', 'profilePicture', 'tenant', 'tenantForProperty'));
}



public function requestMoveOut(Request $request)
{
    // Validate the form data
    $request->validate([
        'move_out_month' => 'required|date|after_or_equal:'.now()->addMonth()->toDateString(),
        'tenant_id' => 'required|exists:tenants,id', // Ensure tenant exists
    ]);

    // Fetch tenant information
    $tenant = Tenant::findOrFail($request->tenant_id);

    // Create the move-out request
    $moveOutRequest = new MoveOutRequest();
    $moveOutRequest->tenant_id = $tenant->id;
    $moveOutRequest->move_out_month = $request->move_out_month;
    $moveOutRequest->status = 'pending'; // Initial status, pending admin approval
    $moveOutRequest->save();

    // Notify the admin
    $admin = Admin::where('role', 'admin')->first(); // Assuming you have an admin role
    if ($admin) {
        Notification::create([
            'message' => 'Tenant ' . $tenant->full_name . ' has requested to move out of property ID ' . $tenant->property_id . ' for ' . $moveOutRequest->move_out_month,
            'user_id' => $admin->id, // Assuming the admin's user ID is stored in the `user_id` field of the notification
            'status' => 'unread',
        ]);
    }

    // Redirect back with a success message
    return redirect()->route('tenant.rentedProperties')->with('success', 'Move-out request has been sent to the admin.');
}


public function showServiceRequests()
{
    // Retrieve the authenticated tenant
    $tenant = Auth::guard('tenant')->user();

    // Get service requests related to this tenant

    // Fetch the service requests for the tenant, ordered by created_at descending
    $serviceRequests = ServiceRequest::where('tenant_id', $tenant->id)
        ->orderBy('created_at', 'desc')
        ->get();

    // Get the authenticated tenant's profile picture
    $profilePicture = $tenant->picture; // Ensure 'picture' column exists in your tenants table

    return view('tenant.service', compact('serviceRequests', 'profilePicture'));
}

// Cancel service request
public function cancelServiceRequest($id)
{
    $serviceRequest = ServiceRequest::find($id);

    if ($serviceRequest) {
        $serviceRequest->status = 'canceled';
        $serviceRequest->save();

        session()->flash('success', 'Service request canceled successfully.');
    } else {
        session()->flash('error', 'Service request not found.');
    }

    return redirect()->back();
}



public function requestService(Request $request)
{
Log::info('RequestService method called.');

    $request->validate([
        'property_id' => 'required|exists:property,property_ID',
        'service_type' => 'required|string|max:255',
        'service_date' => 'required|date|after_or_equal:today',
        'service_time' => 'required|date_format:H:i',
        'description' => 'required|string|max:500',
    ]);

    Log::info('Validation passed.');

    $serviceRequest = ServiceRequest::create([
        'tenant_id' => Auth::guard('tenant')->id(),
        'property_ID' => $request->property_id,
        'service_type' => $request->service_type,
        'service_date' => $request->service_date,
        'service_time' => $request->service_time,
        'description' => $request->description,
        'status' => 'pending',
    ]);

    Log::info('Service request created: ', $serviceRequest->toArray());

    $property = Property::findOrFail($request->property_id);
    Log::info('Property found: ' . $property->property_ID);

    $landlordId = $property->landlord_id;

    if ($landlordId) {
        Log::info('Landlord ID exists, creating notification for landlord ID: ' . $landlordId);
        Notification::create([
            'landlord_id' => $landlordId,
            'message' => 'A tenant has requested a service for property ' . $property->type,
            'status' => 'unread',
        ]);
        Log::info('Notification created successfully.');
    } else {
        Log::error('No landlord ID found for property ID: ' . $property->property_ID);
    }

    return redirect()->route('tenant.service')->with('success', 'Service request submitted successfully!');
}




public function showServiceRequestForm()
{
    // Retrieve the authenticated tenant
    $tenant = Auth::guard('tenant')->user();

    // Get the tenant's profile picture
    $profilePicture = $tenant->picture;

    // Retrieve properties for the authenticated tenant
    $properties = Property::where('property_ID', $tenant->property_ID)->get();

    // Return the view with properties and profile picture
    return view('tenant.request_service', compact('properties', 'profilePicture'));
}

public function storeServiceRequest(Request $request)
{
    // Validate the request
    $validatedData = $request->validate([
        'property_id' => 'required|exists:property,property_ID',
        'service_type' => 'required|string|max:255',
        'service_date' => 'required|date',
        'service_time' => 'required|date_format:H:i',
        'description' => 'required|string|max:500',
    ]);

    // Create a new service request
    ServiceRequest::create([
        'tenant_id' => Auth::guard('tenant')->id(),
        'property_ID' => $validatedData['property_id'],
        'service_type' => $validatedData['service_type'],
        'service_date' => $validatedData['service_date'],
        'service_time' => $validatedData['service_time'],
        'description' => $validatedData['description'],
    ]);

    // Redirect back with success message
    return redirect()->route('tenant.service')->with('success', 'Service request submitted successfully!');
}

}
