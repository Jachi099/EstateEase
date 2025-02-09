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

        $user = Auth::guard('tenant')->user(); // Ensure the tenant guard is used

        $profilePicture = $user->picture ?? null; // Assuming `picture` is a field in the tenant table

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
        return view('tenant.details', compact('property', 'paymentStatus', 'tenantProfilePicture', 'tenant'));
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

    public function editProfile(Request $request)
    {
        // Get the authenticated tenant
        $tenant = Auth::guard('tenant')->user(); // Use the tenant guard
    
        // Check if the tenant is a valid instance of the Tenant model
        if (!$tenant instanceof Tenant) {
            return redirect()->route('tenant.profile')->with('error', 'Tenant not found.');
        }
    
        // Prepare the profile picture path
        $profilePicture = $tenant->picture; // Adjust according to your Tenant model's picture attribute
    
        // Return the edit profile view with the tenant data and profile picture
        return view('tenant.edit_profile', compact('tenant', 'profilePicture'));
    }
    

    public function updateProfile(Request $request)
    {
        // Validate request data
        $request->validate([
            'full_name' => 'nullable|string|max:255',
            'current_address' => 'nullable|string|max:255',
            'phone_number' => 'nullable|string|max:15',
            'email' => 'nullable|email|max:255',
            'password' => 'nullable|string|min:6|confirmed',
            'picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
    
        // Get the authenticated tenant
        $tenant = Auth::guard('tenant')->user(); // Use the tenant guard
    
        // Check if the tenant is a valid instance of Tenant model
        if (!$tenant instanceof Tenant) {
            return redirect()->route('tenant.profile')->with('error', 'Tenant not found.');
        }
    
        // Prepare an array of attributes to update
        $data = $request->only(['full_name', 'current_address', 'phone_number', 'email']);
    
        // Handle password if provided
        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->input('password'));
        }
    
        // Handle picture upload if present
        if ($request->hasFile('picture')) {
            $data['picture'] = $request->file('picture')->store('profile_pictures', 'public');
        }
    
        // Debugging: Check the data array
        // dd($data); // Uncomment this to see the values being saved
    
        // Update the tenant attributes
        foreach ($data as $key => $value) {
            if ($value !== null) { // Only update fields that are provided
                $tenant->$key = $value;
            }
        }
    
        // Save the updated tenant instance
        $tenant->save(); // Ensure $tenant is a valid Tenant instance here
    
        return redirect()->route('tenant.profile')->with('success', 'Profile updated successfully.');
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

    // Fetch tenant's service requests with provider data
    $serviceRequests = ServiceRequest::with(['service', 'serviceProvider'])
        ->where('tenant_id', $tenant->id)
        ->orderByDesc('requested_date') // Sort by latest requested date
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
        ->whereNull('service_provider_id') // Ensuring no provider is assigned yet
        ->first();

    if (!$serviceRequest) {
        return redirect()->back()->with('error', 'This service request cannot be canceled.');
    }

    // Update the service request status to canceled
    $serviceRequest->status = 'cancelled'; // Set status as canceled
    $serviceRequest->save(); // Save the changes

    return redirect()->back()->with('success', 'Service request has been canceled.');
}



    public function showServiceRequestForm(Request $request)
    {
        Log::info('Service Request Form Loaded');

        // Make sure the tenant is authenticated
        $tenant = auth()->user();
        if (!$tenant) {
            return redirect()->route('login')->withErrors(['error' => 'You must be logged in to access this page.']);
        }

        // Load tenant with the property association
        $tenantWithProperty = Tenant::with('property')->find($tenant->id);
        if (!$tenantWithProperty || !$tenantWithProperty->property) {
            return redirect()->route('tenant.dashboard')->withErrors(['error' => 'You must be assigned to a property to make a service request.']);
        }

        // Get all services
        $services = Service::all();
        $profilePicture = $tenant->picture ?? null;
        $selectedUrgency = 'medium';
        $selectedService = null;

        // Get selected service from query parameter if provided
        if ($request->has('service_id')) {
            $selectedService = Service::find($request->service_id);
            if (!$selectedService) {
                return redirect()->route('tenant.serviceRequestT')->withErrors(['service_id' => 'Invalid service selected.']);
            }
        }

        // Define fees
        $platformFee = 100; // A fixed platform fee
        $laborCharge = $selectedService ? $this->getLaborCharge($selectedService->type) : 0;
        $urgencyFee = $this->getUrgencyFee($selectedUrgency);
        $serviceCost = $selectedService ? $selectedService->cost : 0;
        $totalCost = $serviceCost + $platformFee + $laborCharge + $urgencyFee;

        return view('tenant.serviceRequestT', compact('services', 'tenantWithProperty', 'tenant', 'profilePicture', 'platformFee', 'laborCharge', 'urgencyFee', 'totalCost', 'selectedService'));
    }

    // Get Labor Charge based on Service Type
    private function getLaborCharge($serviceType)
    {
        switch ($serviceType) {
            case 'Plumbing':
                return 500;
            case 'HVAC':
                return 1500;
            case 'Electrical':
                return 1000;
            case 'Cleaning':
                return 300;
            case 'Carpentry':
                return 1200;
            default:
                return 0;
        }
    }

    // Get Urgency Fee based on urgency level
    private function getUrgencyFee($urgency)
    {
        switch ($urgency) {
            case 'low':
                return 0;
            case 'medium':
                return 10;
            case 'high':
                return 20;
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
            'property_id' => 'required|exists:property,property_ID',
            'service_date' => 'required|date|after:today', // Ensures the date is after today
            'urgency' => 'required|in:low,medium,high'
        ], [
            // Custom validation messages
            'service_date.after' => 'The service date must be a future date.',
            'service_date.required' => 'Please provide a service date.',
            'service_date.date' => 'Please provide a valid date.',
        ]);

        // Get the service details
        $service = Service::findOrFail($request->service_id);
        $laborCost = $service->cost;
        $urgencyFee = $this->getUrgencyFee($request->urgency);
        $platformFee = ($laborCost + $urgencyFee) * 0.10;
        $totalCost = $laborCost + $urgencyFee + $platformFee;

        // Convert the service date to a Carbon instance (this includes both date and time)
        $serviceDate = \Carbon\Carbon::parse($request->service_date);

        // Check if a service request with the same service type, date, and property already exists
        $existingRequest = ServiceRequest::where('tenant_id', auth()->user()->id)
            ->where('service_id', $request->service_id)
            ->where('property_ID', $request->property_id)
            ->whereDate('requested_date', $serviceDate) // Ensure we match the date
            ->exists();

        if ($existingRequest) {
            return redirect()->back()->withErrors(['error' => 'You already have a service request for this service on the selected date for this property. Please choose another date or service.']);
        }

        // Create the service request
        $serviceRequest = new ServiceRequest();
        $serviceRequest->tenant_id = auth()->user()->id;
        $serviceRequest->service_id = $request->service_id;
        $serviceRequest->description = $request->description;
        $serviceRequest->property_ID = $request->property_id;
        $serviceRequest->requested_date = $serviceDate; // Store both date and time
        $serviceRequest->urgency = $request->urgency;
        $serviceRequest->status = 'pending';
        $serviceRequest->labor_cost = $laborCost;
        $serviceRequest->urgency_fee = $urgencyFee;
        $serviceRequest->platform_fee = $platformFee;
        $serviceRequest->total_cost = $totalCost;
        $serviceRequest->save();

        // Return success message after form submission
        return redirect()->route('tenant.serviceRequestT')->with('success', 'Service request submitted successfully.');
    }




    public function deleteProfile(Request $request)
{
    $tenant = Auth::guard('tenant')->user(); // Get the authenticated tenant
    
    // Check if the tenant has a related unpaid payment
    $payment = TenantPayment::where('tenant_id', $tenant->id)
                            ->where('status', 'unpaid')  // Only allow deletion if payment is unpaid
                            ->first();
    
    // If payment is confirmed, don't allow deletion
    if (!$payment) {
        // Proceed to delete the tenant profile and related data
        $tenant->delete(); // Delete tenant profile

        // Optionally, delete related data if needed, such as visit requests or other relations
        // $tenant->visitRequests()->delete(); // Uncomment this if you need to delete visit requests

        return response()->json(['success' => true, 'message' => 'Profile deleted successfully.']);
    } else {
        return response()->json(['success' => false, 'message' => 'Profile cannot be deleted after payment.']);
    }
}

}
