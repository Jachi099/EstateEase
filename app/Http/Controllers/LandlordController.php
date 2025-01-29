<?php

namespace App\Http\Controllers;

use App\Models\Landlord;
use App\Models\Tenant;
use App\Models\Notification;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth; // Import Auth facade
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\Log;
use App\Models\Property; // Import the Property model
use Illuminate\Http\Request;
use App\Models\PropertyImage;


class LandlordController extends Controller
{

    public function profile()
    {
        // Get the authenticated landlord
        $landlord = Auth::guard('landlord')->user();

        // Check if the landlord exists
        if (!$landlord) {
            return redirect()->route('landlord.user_home')->with('error', 'Profile not found.');
        }

        // Pass the landlord's information to the profile view
        return view('landlord.profile', [
            'profilePicture' => $landlord->picture ?? null,
            'name' => $landlord->name,
            'email' => $landlord->email,
            'phone' => $landlord->phone ?? null,
            'address' => $landlord->current_address ?? null,
            'account_type' => $landlord->account_type,
        ]);
    }

public function showAddPropertyForm()
{
    return view('landlord.add_property');
}


public function showPropertiesList(Request $request)
{
    // Get the authenticated landlord
    $landlord = Auth::guard('landlord')->user();

    // Fetch properties added by the landlord
    $properties = Property::where('landlord_id', $landlord->landlord_id);

    // Handle sorting logic based on the selected option
    if ($request->has('sort')) {
        $sortOption = $request->input('sort');

        switch ($sortOption) {
            case 'rent_asc':
                $properties = $properties->orderBy('rent', 'asc');
                break;
            case 'rent_desc':
                $properties = $properties->orderBy('rent', 'desc');
                break;
            case 'type':
                $properties = $properties->orderBy('type', 'asc');
                break;
            case 'availability':
                $properties = $properties->orderByRaw("IF(tenant_id IS NULL, 0, 1) DESC"); // Available properties first
                break;
            default:
                $properties = $properties->orderBy('created_at', 'desc'); // Default sort by most recent
                break;
        }
    } else {
        // Default sort by most recent
        $properties = $properties->orderBy('created_at', 'desc');
    }

    // Fetch properties based on the sorting
    $properties = $properties->get();

    // Initialize an array to hold tenant information for each property
    $tenants = [];

    // Fetch tenant info for each property if it exists
    foreach ($properties as $property) {
        $tenants[$property->property_ID] = Tenant::where('property_ID', $property->property_ID)->first();
    }

    // Get the profile picture
    $profilePicture = $landlord->picture ?? null; // Assuming `picture` is the correct attribute

    // Pass properties, tenants, and profile picture to the view
    return view('landlord.property_list_landlord', compact('properties', 'tenants', 'profilePicture'));
}

public function storeProperty(Request $request)
{
    // Validation rules
    $request->validate([
        'house_no' => 'required|string|max:255',
        'area' => 'required|string|max:255',
        'thana' => 'required|string|max:255',
        'city' => 'required|string|max:255',
        'postal_code' => 'required|string|max:10', // Validate postal code
        'type' => 'required|string|max:255',
        'size' => 'required|numeric|min:0', // Prevent negative sizes
        'amenities' => 'nullable|array',
        'num_of_rooms' => 'required|integer|min:0', // Prevent negative numbers
        'num_of_bathrooms' => 'required|integer|min:0', // Prevent negative numbers
        'num_of_balcony' => 'nullable|integer|min:0', // Prevent negative numbers
        'floor' => 'nullable|string|max:255',
        'rent' => 'required|numeric|min:0', // Prevent negative rent
        'available_from' => 'nullable|date|after:today', // Ensure it's a future date if provided
        'images' => 'required|array|min:3|max:15',
        'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
    ], [
        'images.min' => 'You must upload at least 3 images.',
        'images.max' => 'You can upload a maximum of 15 images only.',
        'images.required' => 'At least 3 images are required to add a property.',
        'num_of_rooms.min' => 'Number of rooms cannot be negative.',
        'num_of_bathrooms.min' => 'Number of bathrooms cannot be negative.',
        'num_of_balcony.min' => 'Number of balconies cannot be negative.',
        'rent.min' => 'Rent cannot be negative.',
        'size.min' => 'Size cannot be negative.',
        'postal_code.required' => 'Postal code is required.',
        'postal_code.max' => 'Postal code cannot exceed 10 characters.',
        'available_from.after' => 'The available date must be a future date.',
    ]);

    // Debugging: check incoming request data
    Log::info($request->all());

    // Create the property using the validated request data
    $property = new Property($request->except('images'));
    $property->landlord_id = Auth::guard('landlord')->id();
    $property->amenities = json_encode($request->input('amenities')); // Store amenities as JSON

    // Save the property
    $property->save();

    // Handle image uploads
    if ($request->hasFile('images')) {
        foreach ($request->file('images') as $image) {
            // Save the image directly in the 'public/properties' folder
            $fileName = time() . '_' . $image->getClientOriginalName();
            $destinationPath = public_path('properties');
            $image->move($destinationPath, $fileName);

            // Save each image in the property_images table
            PropertyImage::create([
                'property_ID' => $property->property_ID,
                'image_path' => 'properties/' . $fileName,
            ]);
        }
    }

    // Redirect back to the properties list with a success message
    return redirect()->route('landlord.properties_list')->with('success', 'Property added successfully!');
}




    public function landlordHome()
{
    // Get the authenticated landlord
    $landlord = auth()->guard('landlord')->user();

    // Get the profile picture
    $profilePicture = $landlord->picture ?? null; // Assuming `picture` is a field in the landlord table

    // Pass the picture to the view
    return view('landlord.user_home', compact('profilePicture'));
}

public function addProperty(Request $request)
{
    // Get the authenticated landlord
    $landlord = Auth::guard('landlord')->user();

    // Check if the landlord is a valid instance of the Landlord model
    if (!$landlord instanceof Landlord) {
        return redirect()->route('login')->with('error', 'You must be logged in to add a property.');
    }

    // Prepare the profile picture path
    $profilePicture = $landlord->picture ?? null; // Assuming `picture` is a field in the landlord table

    // Return the add property view with the landlord data and profile picture
    return view('landlord.add_property', compact('landlord', 'profilePicture'));
}

public function showPropertyDetails($id)
{
    // Fetch the property by its ID
    $property = Property::find($id);

    // If the property doesn't exist, return a 404 error
    if (!$property) {
        abort(404);
    }

    // Fetch tenant information for the given property ID (if a tenant exists)
    $tenant = Tenant::where('property_ID', $id)->first();

    // Determine the payment status and fetch the profile picture for the tenant
    if ($tenant) {
        // Fetch the latest payment for the tenant using the defined relationship
        $latestPayment = $tenant->tenantPayments()->latest()->first();

        // Set the payment status to 'paid' or 'unpaid' based on the latest payment status
        $paymentStatus = $latestPayment && $latestPayment->status === 'paid' ? 'paid' : 'unpaid';

        // Get the tenant's profile picture, ensuring the correct path for public storage
        $tenantProfilePicture = $tenant->picture ? asset($tenant->picture) : null;
    } else {
        // If no tenant exists, set payment status to 'unpaid' by default
        $paymentStatus = 'unpaid';
        $tenantProfilePicture = null; // No tenant, so no profile picture
    }

    // Get the landlord's profile picture (for the landlord's own profile picture)
    $landlord = Auth::guard('landlord')->user();
    $landlordProfilePicture = $landlord->picture ? asset($landlord->picture) : null;

    // Pass the property, tenant, profile pictures, and payment status to the view
    return view('landlord.property_details', compact('property', 'tenant', 'tenantProfilePicture', 'landlordProfilePicture', 'paymentStatus'));
}


public function editProfile(Request $request)
{
    // Get the authenticated landlord
    $landlord = Auth::guard('landlord')->user(); // Use the landlord guard

    // Check if the landlord is a valid instance of the Landlord model
    if (!$landlord instanceof Landlord) {
        return redirect()->route('landlord.profile')->with('error', 'Landlord not found.');
    }

    // Prepare the profile picture path
    $profilePicture = $landlord->picture; // Adjust according to your Landlord model's picture attribute

    // Return the edit profile view with the landlord data and profile picture
    return view('landlord.edit_profile', compact('landlord', 'profilePicture'));
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

    // Get the authenticated landlord
    $landlord = Auth::guard('landlord')->user(); // Use the landlord guard

    // Check if the landlord is a valid instance of Landlord model
    if (!$landlord instanceof Landlord) {
        return redirect()->route('landlord.profile')->with('error', 'Landlord not found.');
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

    // Update the landlord attributes
    foreach ($data as $key => $value) {
        if ($value !== null) { // Only update fields that are provided
            $landlord->$key = $value;
        }
    }

    // Save the updated landlord instance
    $landlord->save(); // Ensure $landlord is a valid Landlord instance here

    return redirect()->route('landlord.profile')->with('success', 'Profile updated successfully.');
}


}
