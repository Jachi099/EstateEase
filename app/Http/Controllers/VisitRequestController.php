<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\VisitRequest; // Ensure you have created this model
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class VisitRequestController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'visit_date' => 'required|date',
            'visit_time' => 'required',
            'property_id' => 'required|exists:property,property_ID' // Validate property ID
        ]);
    
        // Check if the visitor is authenticated
        $visitor = Auth::guard('visitor')->user(); // Assuming visitors use the 'visitor' guard
    
        // Check if the visitor has already made a pending request for this property
        $existingVisit = VisitRequest::where('user_id', $visitor->id)
            ->where('property_id', $request->property_id)
            ->where('status', 'pending') // Only check for pending requests
            ->first();
    
        if ($existingVisit) {
            return response()->json(['error' => 'You have already requested a visit for this property and it is still pending.'], 400);
        }
    
        // Check if any visit request (pending or approved) exists for the same date for this property
        $bookedVisit = VisitRequest::where('property_id', $request->property_id)
            ->where('visit_date', $request->visit_date)
            ->whereIn('status', ['pending', 'approved']) // Check for all booked statuses
            ->exists();
    
        if ($bookedVisit) {
            return response()->json(['error' => 'The selected date is already booked for this property.'], 400);
        }
    
        // Store the visit request
        VisitRequest::create([
            'user_id' => $visitor->id,
            'user_phn' => $visitor->phn,
            'property_id' => $request->property_id, // Include the property ID
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
            ->get(['visit_date']);
    
        return response()->json($bookedVisits);
    }
    
}
