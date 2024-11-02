<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ServiceRequestTenant;

class ServiceRequestTenantController extends Controller
{
    // Display a listing of service requests
    public function index()
    {
        $serviceRequests = ServiceRequestTenant::all();
        return view('service_requests.index', compact('serviceRequests'));
    }

    // Show the form for creating a new service request
    public function create()
    {
        return view('service_requests.create');
    }

    // Store a new service request in the database
    public function store(Request $request)
    {
        $request->validate([
            'service_type' => 'required|string|max:255',
            'problem_details' => 'required|string',
            'property_id' => 'required|integer',
            'preferred_date' => 'required|date',
            'urgency' => 'required|string',
        ]);

        ServiceRequestTenant::create($request->all());

        return redirect()->route('service_requests.index')->with('success', 'Service request created successfully.');
    }

    // Show a specific service request
    public function show(ServiceRequestTenant $serviceRequestTenant)
    {
        return view('service_requests.show', compact('serviceRequestTenant'));
    }

    // Show the form for editing a service request
    public function edit(ServiceRequestTenant $serviceRequestTenant)
    {
        return view('service_requests.edit', compact('serviceRequestTenant'));
    }

    // Update the specified service request in the database
    public function update(Request $request, ServiceRequestTenant $serviceRequestTenant)
    {
        $request->validate([
            'service_type' => 'required|string|max:255',
            'problem_details' => 'required|string',
            'property_id' => 'required|integer',
            'preferred_date' => 'required|date',
            'urgency' => 'required|string',
        ]);

        $serviceRequestTenant->update($request->all());

        return redirect()->route('service_requests.index')->with('success', 'Service request updated successfully.');
    }

    // Delete a specific service request from the database
    public function destroy(ServiceRequestTenant $serviceRequestTenant)
    {
        $serviceRequestTenant->delete();

        return redirect()->route('service_requests.index')->with('success', 'Service request deleted successfully.');
    }
}
