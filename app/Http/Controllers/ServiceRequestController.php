<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ServiceRequest;

class ServiceRequestController extends Controller
{
    // Display the service request form
    public function index()
    {
        return view('service-request.index'); // Create this view in Step 5
    }

    // Store service request data in the database
    public function store(Request $request)
    {
        // Validate form data
        $validatedData = $request->validate([
            'service_type' => 'required|string|max:255',
            'problem_details' => 'required|string',
            'property_id' => 'required|integer',
            'preferred_date' => 'required|date',
            'urgency' => 'required|string',
        ]);

        // Save data to the database
        ServiceRequest::create($validatedData);

        // Redirect to a success page or the same form with a success message
        return redirect()->route('service-request.index')->with('success', 'Service request submitted successfully!');
    }
}
