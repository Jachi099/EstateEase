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
    public function showProperties(Request $request)
    {
        // Start building the query for the Property model
        $query = Property::query();

        // Filter by location (thana)
        if ($request->filled('location')) {
            $query->where('thana', $request->location);
        }

        // Filter by rent range
        if ($request->filled('rent_range')) {
            [$minRent, $maxRent] = explode('-', $request->rent_range);
            $query->whereBetween('rent', [(int)$minRent, (int)$maxRent]);
        }

        // Apply sorting based on user selection
        if ($request->filled('sort')) {
            switch ($request->sort) {
                case 'rent_asc':
                    $query->orderBy('rent', 'asc');
                    break;
                case 'rent_desc':
                    $query->orderBy('rent', 'desc');
                    break;
                case 'type':
                    $query->orderBy('type', 'asc');
                    break;
                case 'availability':
                    // Join with tenants table to check property availability
                    $query->leftJoin('tenants', 'properties.property_ID', '=', 'tenants.property_ID')
                          ->select('properties.*') // Ensure only property columns are selected
                          ->orderByRaw("CASE WHEN tenants.property_ID IS NULL THEN 0 ELSE 1 END ASC")
                          ->orderBy('available_from', 'asc');
                    break;
            }
        }

        // Execute the query and get the properties
        $properties = $query->get();
        $profilePicture = $tenant->picture ?? null;

        // Render the properties view with the filtered and sorted properties
        return view('tenant.property_list', compact('properties', 'profilePicture'));
    }
    public function filterProperties(Request $request)
    {
        $location = $request->input('location'); // Location input corresponds to the 'thana' column in DB
        $rentRange = $request->input('rent_range'); // Format: "min-max"

        $query = Property::query();

        // Filter by thana (location)
        if ($location) {
            $query->where('thana', 'LIKE', "%{$location}%");
        }

        // Filter by rent range
        if ($rentRange) {
            [$minRent, $maxRent] = explode('-', $rentRange);
            $query->whereBetween('rent', [(float)$minRent, (float)$maxRent]);
        }

        // Get the filtered properties
        $properties = $query->get();

        // Retrieve the tenant's profile picture
        $user = Auth::guard('tenant')->user(); // Ensure the tenant guard is used
        $profilePicture = $tenant->picture ?? null;
        return view('tenant.property_list', compact('properties', 'profilePicture'));
    }

    public function showPropertyDetailsForPublic($id)
    {
        // Fetch the property by its ID or fail with a 404 error if not found
        $property = Property::findOrFail($id);

        // Check if the property has a tenant
        $tenant = Tenant::where('property_ID', $id)->first();

        // Default payment status
        $paymentStatus = 'unpaid';
        $tenantProfilePicture = null;

        if ($tenant) {
            // Fetch the latest payment for the tenant from tenant_payments table
            $latestPayment = $tenant->tenantPayments()->latest()->first();

            // Set payment status based on the latest payment
            if ($latestPayment && $latestPayment->status === 'paid') {
                $paymentStatus = 'paid';
            }

            // Get the tenant's profile picture if available
            $tenantProfilePicture = $tenant->picture ?? null;
        }

        // Pass data to the view
        return view('tenant.property_details', compact('property', 'paymentStatus', 'tenantProfilePicture', 'tenant'));
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

     return view('tenant.rented_property_list', compact('properties', 'profilePicture', 'tenant'));
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
    ], [
        'move_out_month.after_or_equal' => 'You can only request to move out starting next month or later.',  // Custom error message
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
            'message' => 'Tenant has requested to move out of property ID ' . $tenant->property_id . ' for ' . $moveOutRequest->move_out_month,
            'user_id' => $admin->id, // Assuming the admin's user ID is stored in the `user_id` field of the notification
            'status' => 'unread',
        ]);
    }

    // Redirect back with a success message
    return redirect()->route('tenant.rentedProperties')->with('success', 'Move-out request has been sent to the admin.');
}

public function viewServiceRequests()
{
    $tenant = Auth::guard('tenant')->user(); // Ensure tenant is authenticated

    if (!$tenant) {
        return redirect()->route('tenant.login')->with('error', 'You must be logged in to view service requests.');
    }
    $profilePicture = $tenant->picture ?? null;

    // Fetch tenant's service requests
    $serviceRequests = ServiceRequest::with('service')
        ->where('tenant_id', $tenant->id)
        ->get();

    return view('tenant.serviceRlist', compact('serviceRequests', 'profilePicture'));
}



    public function cancelServiceRequest($id)
    {
        $tenant = Auth::guard('tenant')->user(); // Ensure tenant is authenticated

        if (!$tenant) {
            return redirect()->route('tenant.login')->with('error', 'You must be logged in to cancel a service request.');
        }

        // Fetch the service request
        $serviceRequest = ServiceRequest::where('id', $id)
            ->where('tenant_id', $tenant->id)
            ->where('status', 'pending')
            ->whereNull('service_provider_id')
            ->first();

        if (!$serviceRequest) {
            return redirect()->back()->with('error', 'This service request cannot be canceled.');
        }

        // Cancel the service request
        $serviceRequest->delete();

        return redirect()->back()->with('success', 'Service request has been canceled.');
    }


    public function showServiceRequestForm(Request $request)

    {

        // Get the authenticated tenant
        $tenant = auth()->user();
        $tenantWithProperty = Tenant::with('property')->findOrFail($tenant->id);
        $services = Service::all();
        $profilePicture = $tenant->picture ?? null;
        $selectedUrgency = 'medium';  // Default urgency level

        // Ensure selectedService is set correctly
        $selectedService = null;
        if ($request->has('service_id') && $request->service_id) {
            $selectedService = Service::find($request->service_id);
        }

        // Handle the error case where service is not found
        if (!$selectedService) {
            return redirect()->back()->withErrors(['service_id' => 'Invalid service selected.']);
        }

        // Calculate costs
        $platformFee = 100;
        $laborCharge = $this->getLaborCharge($selectedService->type);
        $urgencyFee = $this->getUrgencyFee($selectedUrgency);
        $serviceCost = $selectedService->cost;
        $totalCost = $serviceCost + $platformFee + $laborCharge + $urgencyFee;

        return view('tenant.serviceRequestT', compact('services', 'tenantWithProperty', 'tenant', 'profilePicture', 'platformFee', 'laborCharge', 'urgencyFee', 'totalCost', 'selectedService'));
    }

    // Get Labor Charge based on Service Type
    private function getLaborCharge($serviceType)
    {
        // Example labor charge based on service type (this can be dynamic)
        switch ($serviceType) {
            case 'Plumbing':
                return 500;  // Example fixed labor charge for plumbing
            case 'HVAC':
                return 1500;  // Example fixed labor charge for HVAC
            case 'Electrical':
                return 1000;  // Example fixed labor charge for electrical work
            case 'Cleaning':
                return 300;   // Example fixed labor charge for cleaning
            case 'Carpentry':
                return 1200;  // Example fixed labor charge for carpentry
            default:
                return 0;
        }
    }

    // Get Urgency Fee based on urgency level
    private function getUrgencyFee($urgency)
    {
        switch ($urgency) {
            case 'low':
                return 0;    // No extra fee for low urgency
            case 'medium':
                return 10;   // 10% extra for medium urgency
            case 'high':
                return 20;   // 20% extra for high urgency
            default:
                return 0;
        }
    }

    public function createServiceRequest(Request $request)
    {
        // Validate form data
        $request->validate([
            'service_id' => 'required|exists:services,id',
            'description' => 'required|string|max:255',
            'property_id' => 'required|exists:properties,id', // Ensure 'id' is the correct column name
            'service_date' => 'required|date|after:today',
            'urgency' => 'required|in:low,medium,high'
        ]);

        // Get the service details
        $service = Service::findOrFail($request->service_id);  // Use findOrFail for better error handling
        $laborCost = $service->cost;  // Assuming the cost is the labor cost
        $urgencyFee = $this->getUrgencyFee($request->urgency); // Get urgency fee based on urgency level
        $platformFee = ($laborCost + $urgencyFee) * 0.10;  // 10% platform fee
        $totalCost = $laborCost + $urgencyFee + $platformFee;

        // Create the service request
        $serviceRequest = new ServiceRequest();
        $serviceRequest->tenant_id = auth()->user()->id;
        $serviceRequest->service_id = $request->service_id;
        $serviceRequest->description = $request->description;
        $serviceRequest->property_id = $request->property_id;
        $serviceRequest->service_date = $request->service_date;
        $serviceRequest->urgency = $request->urgency;
        $serviceRequest->status = 'pending';
        $serviceRequest->labor_cost = $laborCost;
        $serviceRequest->urgency_fee = $urgencyFee;
        $serviceRequest->platform_fee = $platformFee;
        $serviceRequest->total_cost = $totalCost;
        $serviceRequest->save();

        // Redirect or return response
        return redirect()->route('tenant.serviceRequests')->with('success', 'Service request submitted successfully.');
    }

}
