<?php

namespace App\Http\Controllers;

use App\Models\ServiceRequest;
use App\Models\ServiceProvider;
use Illuminate\Http\Request;

class ServiceRequestController extends Controller
{

    public function index()
    {
        $serviceRequests = ServiceRequest::with(['tenant', 'property', 'service'])
            ->orderBy('created_at', 'desc')
            ->get();

        // Filter service providers based on service type (specialization) and area (thana)
        $providers = ServiceProvider::whereIn('specialization', $serviceRequests->pluck('service.type')->toArray())
            ->whereIn('address', $serviceRequests->pluck('property.thana')->toArray()) // Assuming 'thana' is part of the 'address'
            ->get();

        return view('admin.servicereqs', compact('serviceRequests', 'providers'));
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
        $serviceRequest = ServiceRequest::find($id);

        // Get the selected provider
        $provider = ServiceProvider::find($request->provider_id);

        // Assign the provider to the service request
        $serviceRequest->service_provider_id = $provider->id;
        $serviceRequest->save();

        return redirect()->route('admin.servicereqs')->with('success', 'Provider assigned successfully');
    }


}
