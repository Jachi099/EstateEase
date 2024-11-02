<?php

use App\Models\ServiceRequestAdmin;
use Illuminate\Http\Request;

class ServiceRequestAdminController extends Controller
{
    // List all pending service requests
    public function index()
    {
        $pendingRequests = ServiceRequestAdmin::where('status', 'pending')->get();
        return view('service_requests.index', compact('pendingRequests'));
    }

    // Show history of all service requests
    public function history()
    {
        $allRequests = ServiceRequestAdmin::all();
        return view('service_requests.history', compact('allRequests'));
    }

    // Show details for a specific service request
    public function show($id)
    {
        $ServiceRequestAdmin = SServiceRequestAdmin::findOrFail($id);
        return view('service_requests.show', compact('serviceRequest'));
    }

    // Update the status of a service request
    public function update(Request $request, $id)
    {
        $ServiceRequestAdmin= ServiceRequestAdmin::findOrFail($id);
        $ServiceRequestAdmin->update([
            'status' => $request->input('status'),
        ]);

        return redirect('/service-requests');
    }
}
