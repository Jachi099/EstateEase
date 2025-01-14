<?php

namespace App\Http\Controllers;

use App\Models\ServiceRequest;
use App\Models\ServiceProvider;
use Illuminate\Http\Request;

class ServiceRequestController extends Controller
{
    public function index()
    {
        // Fetch pending service requests (those awaiting action)
        $pendingRequests = ServiceRequest::with(['tenant', 'property', 'service'])
            ->where('status', 'pending') // Only get pending requests
            ->orderBy('created_at', 'desc')
            ->get();

        // Fetch completed service requests (approved or rejected)
        $completedRequests = ServiceRequest::with(['tenant', 'property', 'service'])
            ->whereIn('status', ['approved', 'rejected']) // Get approved or rejected requests
            ->orderBy('created_at', 'desc')
            ->get();

        // Filter service providers based on service type (specialization) and area (thana)
        $providers = ServiceProvider::whereIn('specialization', $pendingRequests->pluck('service.type')->toArray())
            ->whereIn('address', $pendingRequests->pluck('property.thana')->toArray())
            ->get();

        return view('admin.serviceReqs', compact('pendingRequests', 'completedRequests', 'providers'));
    }


    public function update(Request $request, $id)
    {
        $serviceRequest = ServiceRequest::findOrFail($id);
        $serviceRequest->status = $request->input('status');
        $serviceRequest->save();

        return redirect()->route('admin.service-requests')->with('success', 'Service request updated successfully.');
    }

    public function assignProvider(Request $request, $id)
    {
        // Get the service request
        $serviceRequest = ServiceRequest::findOrFail($id);

        // Get the selected provider
        $provider = ServiceProvider::findOrFail($request->provider_id);

        // Assign the provider to the service request
        $serviceRequest->service_provider_id = $provider->id;

        // Change provider's availability status to 'unavailable'
        $provider->availability_status = 'unavailable';
        $provider->save();

        // Save the service request
        $serviceRequest->save();

        // Redirect back with success message
        return redirect()->route('admin.service-requests')->with('success', 'Provider assigned successfully');
    }



}
