<?php

namespace App\Http\Controllers;

use App\Models\Landlord;
use App\Models\Tenant;
use App\Models\Notification;
use App\Models\PropertyImage;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth; // Import Auth facade
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\Log;
use App\Models\Property; // Import the Property model
use Illuminate\Http\Request;

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
        'type' => 'required|string|max:255',
        'size' => 'required|numeric',
        'amenities' => 'nullable|array',
        'num_of_rooms' => 'required|integer|min:0', // Prevent negative numbers
        'num_of_bathrooms' => 'required|integer|min:0', // Prevent negative numbers
        'num_of_balcony' => 'nullable|integer|min:0', // Prevent negative numbers
        'floor' => 'nullable|string|max:255',
        'rent' => 'required|numeric|min:0', // Prevent negative rent
        'available_from' => 'nullable|date',
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
    ]);

    // Debugging: check incoming request data
    Log::info($request->all());

    $property = new Property($request->except('images'));
    $property->landlord_id = Auth::guard('landlord')->id();
    $property->amenities = json_encode($request->input('amenities')); // Store amenities as JSON

    $property->save();

    // Handle image uploads
    if ($request->hasFile('images')) {
        foreach ($request->file('images') as $image) {
            $path = $image->store('properties', 'public');

            // Save each image in the property_images table
            PropertyImage::create([
                'property_ID' => $property->property_ID,
                'image_path' => $path,
            ]);
        }
    }

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
    $property = Property::find($id);
    if (!$property) {
        abort(404);
    }

    $tenant = Tenant::where('property_ID', $id)->first(); // Fetch tenant info if it exists

    // Pass tenant profile picture if tenant exists
    $profilePicture = $landlord->picture ?? null; // Assuming `picture` is a field in the landlord table

    return view('landlord.property_details', compact('property', 'tenant', 'profilePicture'));
}



public function showNotifications()
{
    // Assuming you have a way to get the authenticated landlord
    $landlord = Auth::guard('landlord')->user();
    $profilePicture = $landlord->picture; // Adjust based on your actual field name

    // Fetch notifications as needed
    $notifications = Notification::where('landlord_id', $landlord->id)->get(); // Example query

    return view('landlord.notifications', compact('notifications', 'profilePicture'));
}


public function markAsRead($id)
{
    $notification = Notification::findOrFail($id);
    $notification->update(['is_read' => true]);

    return redirect()->back()->with('success', 'Notification marked as read.');
}

}
