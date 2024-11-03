<?php



namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tenant; // Import the Tenant model
use Illuminate\Support\Facades\Auth;
use App\Models\Property; // Import the Property model
use Illuminate\Support\Facades\Log;
use App\Models\ServiceRequest; // Import the Property model


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

    public function showServiceList()
    {
        // Retrieve the authenticated tenant
        $tenant = Auth::guard('tenant')->user();
    
        // Get the authenticated user's profile picture
        $profilePicture = $tenant->picture;
    
        // Retrieve properties that the tenant is renting
        $properties = Property::where('property_ID', $tenant->property_ID)->get();
    
        // Retrieve any existing service requests for this tenant
        $serviceRequests = ServiceRequest::where('tenant_id', $tenant->id)->get();
    
        return view('tenant.service', compact('profilePicture', 'properties', 'serviceRequests'));
    }
    
    

    // Method to handle service request submission
    public function requestService(Request $request)
    {
        $request->validate([
            'property_id' => 'required|exists:properties,property_ID',
            'service_type' => 'required|string',
            'service_date' => 'required|date',
            'service_time' => 'required|date_format:H:i',
            'description' => 'required|string|max:500',
        ]);

        // Create a new service request
        ServiceRequest::create([
            'tenant_id' => Auth::guard('tenant')->id(),
            'property_ID' => $request->property_id,
            'service_type' => $request->service_type,
            'service_date' => $request->service_date,
            'service_time' => $request->service_time,
            'description' => $request->description,
            'status' => 'pending',
        ]);

        return redirect()->route('tenant.service')->with('success', 'Service request submitted successfully!');
    }

    // Method to cancel a service request
    public function cancelServiceRequest($id)
    {
        $serviceRequest = ServiceRequest::findOrFail($id);

        if ($serviceRequest->status === 'pending') {
            $serviceRequest->status = 'canceled';
            $serviceRequest->save();
            return redirect()->route('tenant.service')->with('success', 'Service request canceled successfully.');
        }

        return redirect()->route('tenant.service')->with('error', 'Only pending requests can be canceled.');
    }


    public function showPropertiesList()
    {
        // Retrieve the authenticated tenant
        $tenant = Auth::guard('tenant')->user();
        
        // Retrieve the property the tenant has rented along with rental_start_date
        $properties = Property::where('property_ID', $tenant->property_ID)
            ->select('property_ID', 'type', 'img1', 'rent', 'size', 'floor', 'state', 'available_from')
            ->get();
        
        // Include the rental_start_date in the tenant's data
        $rentalStartDate = $tenant->rental_start_date;
    
        // Get the authenticated tenant's profile picture
        $profilePicture = $tenant->picture;
    
        return view('tenant.rented_property_list', compact('properties', 'profilePicture', 'rentalStartDate'));
    }
    

    public function showPropertyDetails($id)
{
    $property = Property::find($id);
    if (!$property) {
        abort(404);
    }

    $tenant = Tenant::where('property_ID', $id)->first(); // Fetch tenant info if it exists
    
    // Pass tenant profile picture if tenant exists
    $profilePicture = $tenant->picture ?? null; // Assuming `picture` is a field in the landlord table

    return view('tenant.details', compact('property', 'tenant', 'profilePicture'));
}

}
