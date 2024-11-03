<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\VisitRequest; // Ensure you have created this model
use Illuminate\Support\Facades\Auth;

class VisitRequestController extends Controller
{
    public function store(Request $request)
    {
        // Validate incoming request data
        $request->validate([
            'visit_date' => 'required|date',
            'visit_time' => 'required',
            'property_id' => 'required|exists:property,property_ID', // Ensure property ID is valid
        ]);

        // Check if the visitor is authenticated
        $visitor = Auth::guard('visitor')->user(); // Assuming visitors use the 'visitor' guard

        // Check for existing visit requests for the same property by the same visitor
        $existingVisit = VisitRequest::where('user_id', $visitor->id)
            ->where('property_id', $request->property_id) // Change from property_Id to property_id
            ->where('status', 'pending') // Only check for pending requests
            ->first();

        if ($existingVisit) {
            return response()->json(['error' => 'You have already requested a visit for this property.'], 400);
        }

        // Store the visit request
        VisitRequest::create([
            'user_id' => $visitor->id,
            'property_id' => $request->property_id, // Ensure this matches your input
            'visit_date' => $request->visit_date,
            'visit_time' => $request->visit_time,
            'status' => 'pending' // Set initial status as 'pending'
        ]);

        return response()->json(['success' => 'Visit request booked successfully.']);
    }

    public function getBookedDates($propertyId)
    {
        // Retrieve booked visits for a specific property
        $bookedVisits = VisitRequest::where('property_id', $propertyId)
            ->whereIn('status', ['pending', 'approved']) // Only consider pending and approved visits
            ->get(['visit_date', 'visit_time']); // Added visit_time to provide more details if needed

        return response()->json($bookedVisits);
    }
}
