<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\VisitRequest; // Ensure you have created this model
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use App\Models\Property;
use Carbon\Carbon;


class VisitRequestController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'visit_date' => 'required|date',
            'visit_time' => 'required|date_format:H:i',
            'property_id' => 'required|exists:property,property_ID',
        ]);

        Log::info('Validation passed.');

        $visitor = Auth::guard('visitor')->user();

        $property = Property::find($request->property_id);
        if (!$property) {
            Log::error('Property not found.');
            return response()->json(['error' => 'Property not found.'], 404);
        }

        if ($request->visit_date < $property->available_from) {
            Log::info('Visit date before available date.');
            return response()->json([
                'error' => 'The property is not available for visits until ' . $property->available_from . '.'
            ], 400);
        }

        $today = now()->startOfDay();
        $maxDate = $today->copy()->addWeek();
        $visitDate = Carbon::parse($request->visit_date);

        if ($visitDate->lt($today) || $visitDate->gt($maxDate)) {
            Log::info('Visit date outside allowed range.');
            return response()->json([
                'error' => 'You can only request a visit within the next 7 days.'
            ], 400);
        }

        $visitTime = Carbon::createFromFormat('H:i', $request->visit_time);
        $startTime = Carbon::createFromFormat('H:i', '09:00');
        $endTime = Carbon::createFromFormat('H:i', '20:00');

        if ($visitTime->lt($startTime) || $visitTime->gt($endTime)) {
            Log::info('Visit time outside allowed range.');
            return response()->json([
                'error' => 'Visit times must be between 9:00 AM and 8:00 PM.'
            ], 400);
        }

        $pendingRequest = VisitRequest::where('user_id', $visitor->id)
            ->where('property_id', $request->property_id)
            ->where('status', 'pending')
            ->exists();

        if ($pendingRequest) {
            Log::info('Duplicate pending request.');
            return response()->json([
                'error' => 'You already have a pending visit request for this property.'
            ], 400);
        }

        $overlappingRequest = VisitRequest::where('user_id', $visitor->id)
            ->where('visit_date', $request->visit_date)
            ->whereIn('status', ['pending', 'approved'])
            ->exists();

        if ($overlappingRequest) {
            Log::info('Overlapping visit request.');
            return response()->json([
                'error' => 'You already have a scheduled visit on this date.'
            ], 400);
        }

        $otherVisitorRequest = VisitRequest::where('property_id', $request->property_id)
            ->where('visit_date', $request->visit_date)
            ->where('status', 'pending')
            ->exists();

        if ($otherVisitorRequest) {
            Log::info('Visit already booked by another visitor.');
            return response()->json([
                'error' => 'A visit has already been requested for this date.'
            ], 400);
        }
        $existingRequest = VisitRequest::where('property_id', $request->property_id)
        ->whereIn('status', ['pending', 'approved'])
        ->exists();

        if ($existingRequest) {
            Log::info('Another visitor has a pending or approved request for this property.');
            return response()->json([
                'error' => 'This property already has a pending or approved visit request. Please wait until it is completed or rejected.'
            ], 400);
        }


        try {
            VisitRequest::create([
                'user_id' => $visitor->id,
                'property_id' => $request->property_id,
                'visit_date' => $request->visit_date,
                'visit_time' => $request->visit_time,
                'status' => 'pending',
            ]);

            Log::info('Visit request stored successfully.');

            return response()->json(['success' => 'Visit request successfully created.']);
        } catch (\Exception $e) {
            Log::error('Error storing visit request: ' . $e->getMessage());
            return response()->json(['error' => 'Unable to process your request. Please try again later.'], 500);
        }
    }

    public function getBookedDates($propertyId)
    {
        $bookedVisits = VisitRequest::where('property_id', $propertyId)
            ->whereIn('status', ['pending', 'approved'])
            ->get(['visit_date']);

        return response()->json($bookedVisits);
    }


}
