<?php

namespace App\Http\Controllers;

use App\Models\Landlord;
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


public function showPropertiesList()
{
    // Get the authenticated landlord
    $landlord = Auth::guard('landlord')->user();

    // Fetch properties added by the landlord
    $properties = Property::where('landlord_id', $landlord->landlord_id)->get();

    // Get the profile picture
    $profilePicture = $landlord->picture ?? null; // Assuming `picture` is the correct attribute

    // Pass properties and profile picture to the view
    return view('landlord.property_list_landlord', compact('properties', 'profilePicture'));
}

public function storeProperty(Request $request)
{
    $request->validate([
        'st_no' => 'required|string|max:255',
        'city' => 'required|string|max:255',
        'state' => 'required|string|max:255',
        'country' => 'required|string|max:255',
        'type' => 'required|string|max:255',
        'size' => 'required|string|max:255',
        'amenities' => 'nullable|string',
        'num_of_rooms' => 'required|integer',
        'num_of_bathrooms' => 'required|integer',
        'rent' => 'required|numeric',
        'floor' => 'nullable|string|max:255',
        'available_from' => 'nullable|date',
        'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // Validation for multiple images
    ]);

    $property = new Property($request->except('images'));
    $property->landlord_id = Auth::guard('landlord')->id();

    // Handle image uploads
    if ($request->hasFile('images')) {
        $imagePaths = [];
        foreach ($request->file('images') as $image) {
            $imagePaths[] = $image->store('properties', 'public');
        }
        // You can store $imagePaths as JSON or as individual fields depending on your database setup
        $property->images = json_encode($imagePaths); // Assuming images is a JSON field in the Property model
    }

    $property->save();

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


}  