<?php


namespace App\Http\Controllers;

use App\Models\Property;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // Import Auth facade

class Property1Controller extends Controller
{
    

    public function index(Request $request)
    {
        // Start with a base query
        $query = Property::query();

        // Apply location filter if provided
        if ($request->has('location') && $request->location != '') {
            $query->where('city', $request->location);
        }

        // Apply rent range filter if provided
        if ($request->has('rent_range') && $request->rent_range != '') {
            $range = explode('-', $request->rent_range);
            $query->whereBetween('rent', [$range[0], $range[1]]);
        }

        // Fetch properties (should retrieve all if no filters are applied)
        $properties = $query->get();

        // Return the view with filtered properties
        return view('admin.property_list', compact('properties'));
    }


    public function userPropertyList()
    {
        // Fetch all properties for initial page load
        $properties = Property::all();

        return view('user.property_list', compact('properties'));
    }

    public function filterUserProperties(Request $request)
    {
        // Define the base query
        $query = Property::query();

        // Filter based on location if provided
        if ($request->filled('location')) {
            $query->where('city', $request->location);
        }

        // Filter based on rent range if provided
        if ($request->filled('rent_range')) {
            [$min, $max] = explode('-', $request->rent_range);
            $query->whereBetween('rent', [(int)$min, (int)$max]);
        }

        // Execute the query
        $properties = $query->get();

        return view('user.property_list', compact('properties'));
    }


    
        
    // temp. commented
    /*
    public function index()
    {
        $properties = Property::where('landlord_id', Auth::guard('landlord')->id())->get(); // Fetch properties for the authenticated landlord
        return view('landlord.property_list_landlord', compact('properties')); // Return the property list view with properties
    } */
    
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













    
    /**
     * Display a listing of all properties of the landlord.
     */

    /*
    public function index_myPro()
    {
        $landlordId = auth()->user()->id; // Assuming landlord is authenticated
        $properties = Property::where('landlord_id', $landlordId)->get();
        return view('properties.index', compact('properties'));
    }
*/

    /**
     * Show the form for creating a new property.
     */

     /*
    public function create()
    {
        return view('properties.create');
    }*/

    /**
     * Store a newly created property in the database.
     */
    /*
    public function store(Request $request)
    {
        $request->validate([
        
            'st_no' => 'required|string',
            'city' => 'required|string',
            'state' => 'required|string',
            'country' => 'required|string',
            'type' => 'required|string',
            'size' => 'nullable|numeric',
            'amenities' => 'nullable|string',
            'num_of_rooms'=> 'required|integer',
            'num_of_bathrooms'=> 'required|integer',
            'rent'=> 'required|numeric',
            'img1' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'img2' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'img3' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'status' => 'required|string', 
            'landlord_id' => 'required|integer',
            'floor' => 'required|integer',
            'available_from' => 'required|date',

        ]);

        Property::create($request->all());

        return redirect()->route('properties.index')->with('success', 'Property added successfully.');
    }*/

    /**
     * Display the specified property details.
     */
    /*
    public function show(Property $property)
    {
        return view('properties.show', compact('property'));
    }*/

    /**
     * Show the form for editing an existing property.
     */
    /*
    public function edit(Property $property)
    {
        return view('properties.edit', compact('property'));
    }*/

    /**
     * Update the specified property in the database.
     */
    /*
    public function update(Request $request, Property $property)
    {
        $request->validate([
            'st_no' => 'required|string',
            'city' => 'required|string',
            'state' => 'required|string',
            'country' => 'required|string',
            'type' => 'required|string',
            'size' => 'nullable|numeric',
            'amenities' => 'nullable|string',
            'num_of_rooms'=> 'required|integer',
            'num_of_bathrooms'=> 'required|integer',
            'rent'=> 'required|numeric',
            'img1' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'img2' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'img3' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'status' => 'required|string', 
            'landlord_id' => 'required|integer',

        ]);

        $property->update($request->all());

        return redirect()->route('properties.index')->with('success', 'Property updated successfully.');
    }*/

    /**
     * Remove the specified property from the database.
     */
    /*
    public function destroy(Property $property)
    {
        $property->delete();

        return redirect()->route('properties.index')->with('success', 'Property deleted successfully.');
    }
    */




