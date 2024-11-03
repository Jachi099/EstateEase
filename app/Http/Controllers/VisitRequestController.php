<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\VisitRequest; // Make sure to create this model
use Illuminate\Support\Facades\Auth;

class VisitRequestController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'visit_date' => 'required|date',
            'visit_time' => 'required',
        ]);

        // Check if the visitor is authenticated
        $visitor = Auth::user(); // Assuming visitors use the default auth guard

        // Check for existing visit requests for the same date by the same visitor
        $existingVisit = VisitRequest::where('user_id', $visitor->id)
            ->where('visit_date', $request->visit_date)
            ->first();

        if ($existingVisit) {
            return response()->json(['error' => 'You have already booked a visit for this date.'], 400);
        }

        // Store the visit request
        VisitRequest::create([
            'user_id' => $visitor->id,
            'visit_date' => $request->visit_date,
            'visit_time' => $request->visit_time,
        ]);

        return response()->json(['success' => 'Visit request booked successfully.']);
    }

    public function getBookedDates()
    {
        // Get all booked visits
        return VisitRequest::all(); // You might want to format this to return only necessary fields
    }
}
