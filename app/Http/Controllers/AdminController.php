<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Property;
use App\Models\Landlord;
use App\Models\Tenant;
use App\Models\Payment;
use App\Models\TenantPayment;
use App\Notifications\TenantAssignedNotification;
use App\Models\Notification;
use App\Models\Service;
use App\Models\ServiceProvider;

use App\Models\User;
use Illuminate\Support\Facades\Log;

//use App\Models\ServiceProvider;
use App\Models\VisitRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;


class AdminController extends Controller
{
    // Show the admin login form
    public function showLoginForm() {
        return view('admin.login'); // Adjust this to your actual login view path
    }

    // Handle the admin login
    public function login(Request $request) {
        // Validate the request
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ], [
            'email.required' => 'Email is required.',
            'email.email' => 'Email is not valid.',
            'password.required' => 'Password is required.',
        ]);

        $credentials = $request->only('email', 'password');

        // Attempt to log the admin in
       // Attempt to log the admin in
        if (Auth::guard('admin')->attempt($credentials)) {
            // Redirect to the admin dashboard on successful login
            return redirect()->route('admin.dashboard');
        } else {
            // Redirect back with an error message
            return redirect()->back()->withErrors(['Invalid credentials']);
        }

    }

    // Show the admin dashboard
    public function dashboard()
    {
        // Fetch totals from the database

            $totalProperties = Property::count(); // Assuming you have a Property model
            $totalServiceProviders = ServiceProvider::count(); // Assuming you have a ServiceProvider model
            $totalLandlords = Landlord::count(); // Assuming you have a Landlord model
            $totalTenants = Tenant::count(); // Assuming you have a Tenant model
            $totalServices = Service::count(); // Assuming you have a Service model

            return view('admin.dashboard', compact('totalProperties', 'totalServiceProviders', 'totalLandlords', 'totalTenants', 'totalServices'));


    }



    //VISIT REQUESTS

   public function viewVisitRequests()
{
    // Fetch all visit requests where status is either 'pending' or 'rejected'
    $visitRequests = VisitRequest::with(['visitor', 'property'])
        ->whereIn('status', ['pending', 'rejected']) // Only fetch 'pending' and 'rejected'
        ->orderByRaw("FIELD(status, 'pending') DESC") // Ensure 'pending' status comes first
        ->get();

    // Fetch all accepted visit requests
    $acceptedRequests = VisitRequest::with(['visitor', 'property'])
        ->where('status', 'accepted') // Only fetch 'accepted' requests
        ->get();

    // Return the view with the filtered visit requests
    return view('admin.visitor', compact('visitRequests', 'acceptedRequests'));
}



public function updateRequestStatus($id, $status)
{
    // Validate that the status is either 'accepted' or 'rejected'
    if (!in_array($status, ['accepted', 'rejected'])) {
        return redirect()->back()->with('error', 'Invalid status.');
    }

    // Find the visit request and update the status
    $visitRequest = VisitRequest::findOrFail($id);
    $visitRequest->status = $status;
    $visitRequest->save();

    // After updating, redirect back with a success message
    return redirect()->back()->with('success', 'Visit request ' . $status . ' successfully.');
}


    public function removeVisitRequest($id)
    {
         // Find the visit request by its ID
    $visitRequest = VisitRequest::findOrFail($id);

    // Update the status to 'canceled'
    $visitRequest->status = 'canceled';
    $visitRequest->save(); // Save the updated status

    // Redirect back with a success message
    return redirect()->back()->with('success', 'Visit request has been canceled.');
    }
    public function changeToTenant($id)
    {
        // Find the accepted visit request
        $visitRequest = VisitRequest::findOrFail($id);

        // Check if the visitor exists
        $visitor = $visitRequest->visitor;

        if ($visitor) {
            // Retrieve the payment for the visitor from the payments table
            $payment = Payment::join('visit_requests', 'visit_requests.user_id', '=', 'payments.visitor_id')
                              ->where('payments.status', 'confirmed') // Ensure payment is confirmed
                              ->where('visit_requests.property_id', $visitRequest->property_id) // Check if the payment is for the same property
                              ->where('payments.visitor_id', $visitor->id) // Make sure it's the correct visitor
                              ->first();

            // Check if payment is confirmed and associated with the correct property
            if (!$payment) {
                return redirect()->back()->with('error', 'The visitor must have a confirmed payment for the property to be changed to a tenant.');
            }

            // If payment exists, retrieve rent from it or assign a default value
            $rent = $payment ? $payment->amount : 0;

            // Create a new tenant entry based on the visitor's information
            $tenant = new Tenant([
                'full_name' => $visitor->full_name,
                'email' => $visitor->email,
                'password' => $visitor->password,
                'picture' => $visitor->picture,

                'current_address' => $visitor->current_address,
                'phone_number' => $visitor->phone_number,
                'account_type' => 'tenant',
                'property_ID' => $visitRequest->property_id,
                'rental_start_date' => now(),
                'rent' => $rent,
            ]);

            // Temporarily disable password hashing by using a closure to avoid hashing password
            $tenant->setDisablePasswordHashing(true);
            $tenant->save();

            // Transfer the payment to the tenant_payments table with the correct status
            TenantPayment::create([
                'tenant_id' => $tenant->id,
                'amount' => $payment->amount,
                'status' => 'paid',
                'payment_method' => $payment->payment_method,
                'payment_date' => $payment->payment_date,
            ]);

            // Delete the visitor and visit request
            $visitor->delete();
            $visitRequest->delete();

            // Now, send the notification to the landlord (property owner)

            // Send notification to the landlord (property owner)

// Find the landlord associated with the property
$landlord = Property::find($visitRequest->property_id)->landlord;

if ($landlord) {
    // Create the notification for the landlord
    Notification::create([
        'landlord_id' => $landlord->landlord_id, // Ensure landlord_id is set correctly
        'message' => "Your property has been assigned a new tenant: {$payment->amount} TK",
        'status' => 'unread', // Initially mark as unread
    ]);
}


            // Redirect back with success message
            return redirect()->back()->with('success', 'Visitor changed to tenant successfully.');
        }

        return redirect()->back()->with('error', 'No visitor found.');
    }


    // Logout the admin
    public function logout() {
        Auth::logout();
        return redirect()->route('admin.login');
    }

    public function propertyList()
    {
        return view('admin.property_list'); // Adjust path if needed
    }


// AdminController.php
public function showTenant()
{
    $visitRequests = VisitRequest::with(['visitor', 'property'])->get();

    $acceptedRequests = VisitRequest::with(['visitor', 'property'])
        ->where('status', 'accepted') // Fetch only accepted requests
        ->get();

    // Fetch all tenants (or apply filters if needed)
    $tenants = Tenant::all();

    return view('admin.tenant', compact('visitRequests', 'acceptedRequests', 'tenants'));
}













public function showServices()
{
    // Fetch all services
    $services = Service::all();

    // Pass the services to the view
    return view('admin.service', compact('services'));
}



public function create()
{
    $services = Service::all();

    return view('admin.add_service', compact('services')); // Path to your Blade file
}

// Handle the form submission and store the service in the database
public function store(Request $request)
{
    // Validate the input data
    $request->validate([
        'type' => 'required|string|max:255',
        'picture' => 'required|image|mimes:jpg,png,jpeg,gif|max:2048',
        'cost' => 'required|numeric|min:0',
        'description' => 'required|string',
    ]);

    // Handle the file upload
    if ($request->hasFile('picture')) {
        // Store the picture in the 'public' directory directly
        $picturePath = $request->file('picture')->move(public_path('service_pictures'), $request->file('picture')->getClientOriginalName());
    }

    // Create the service in the database
    Service::create([
        'type' => $request->input('type'),
        'picture' => 'service_pictures/' . $request->file('picture')->getClientOriginalName(),
        'cost' => $request->input('cost'),
        'description' => $request->input('description'),
    ]);

    // Redirect back with a success message
    return redirect()->route('admin.add_service')->with('success', 'Service added successfully!');
}








public function editProfile()
{
    // Log the current admin authentication status
    Log::info('Checking if admin is authenticated:', ['authenticated' => auth()->guard('admin')->check()]);

    if (!auth()->guard('admin')->check()) {
        Log::info('Admin is not authenticated, redirecting to home.');
        return redirect('/'); // If not authenticated, redirect to the main page
    }

    $admin = auth()->guard('admin')->user();
    Log::info('Admin is authenticated:', ['admin' => $admin]); // Log the authenticated admin details
    
    return view('admin.profile', compact('admin'));
}

public function updateProfile(Request $request)
{
    // Log request data and validation status
    Log::info('Updating admin profile', ['request_data' => $request->all()]);
    
    $request->validate([
        'email' => 'required|email|unique:admins,email,' . auth()->id(),
        'password' => 'nullable|confirmed|min:8',
    ]);
    
    $admin = auth()->guard('admin')->user();
    Log::info('Admin found for update:', ['admin' => $admin]);
    
    // Check if a new password is provided and hash it before saving
    if ($request->password) {
        Log::info('Updating admin password');
        $admin->password = Hash::make($request->password);
    }

    $admin->save();
    Log::info('Admin profile updated successfully:', ['admin' => $admin]);

    return back()->with('success', 'Profile updated successfully.');
}
public function showProperties(Request $request)
{
    $properties = Property::select( /* ... */ );
    // Handle the query, sorting, etc.
    $admin = Auth::guard('admin')->user();
    $profilePicture = $admin->picture;

    return view('admin.property_list', compact('properties', 'profilePicture'));
}

public function filterProperties(Request $request)
{
    $properties = Property::query(); // Filter properties as per the request
    $admin = Auth::guard('admin')->user();
    $profilePicture = $admin->picture;

    return view('admin.property_list', compact('properties', 'profilePicture'));
}

}
