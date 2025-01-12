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

}
