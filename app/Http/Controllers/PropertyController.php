<?php

namespace App\Http\Controllers;

use App\Models\Property;
use Illuminate\Http\Request;

class PropertyController extends Controller
{
    /*
    public function index()
    {
        // Fetch all properties
        $properties = Property::paginate(3);

        // Return the view with properties data
        return view('admin.property_list', compact('properties'));
    } */

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



    /**
     * Display a listing of all properties of the landlord.
     */

    public function index_myPro()
    {
        $landlordId = auth()->user()->id; // Assuming landlord is authenticated
        $properties = Property::where('landlord_id', $landlordId)->get();
        return view('properties.index', compact('properties'));
    }


    /**
     * Show the form for creating a new property.
     */
    public function create()
    {
        return view('properties.create');
    }

    /**
     * Store a newly created property in the database.
     */
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
    }

    /**
     * Display the specified property details.
     */
    public function show(Property $property)
    {
        return view('properties.show', compact('property'));
    }

    /**
     * Show the form for editing an existing property.
     */
    public function edit(Property $property)
    {
        return view('properties.edit', compact('property'));
    }

    /**
     * Update the specified property in the database.
     */
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
    }

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

}
