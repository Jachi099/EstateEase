<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Property;
use Illuminate\Support\Facades\Auth; // Import Auth facade


class PropertyController extends Controller
{
    public function index()
{
    $properties = Property::where('landlord_id', Auth::guard('landlord')->id())->get(); // Fetch properties for the authenticated landlord
    return view('landlord.property_list_landlord', compact('properties')); // Return the property list view with properties
}

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

    return view('user.property_list', compact('properties', 'profilePicture'));
}
public function filterProperties(Request $request)
{
    $location = $request->input('location');
    $rentRange = $request->input('rent_range');  // Format: "min-max"

    $query = Property::query();

    if ($location) {
        $query->where('city', 'LIKE', "%{$location}%");
    }

    if ($rentRange) {
        [$minRent, $maxRent] = explode('-', $rentRange);
        $query->whereBetween('rent', [(float)$minRent, (float)$maxRent]);
    }

    $properties = $query->get();

    $user = Auth::user();
    $profilePicture = $user->picture;

    return view('user.property_list', compact('properties', 'profilePicture'));
}

// In PropertyController.php
public function showPropertyDetails($id)
{
    $property = Property::findOrFail($id);
    return view('property.details', compact('property'));
}

}
