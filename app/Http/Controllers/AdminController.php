<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Property;
use App\Models\Landlord;
use App\Models\Tenant;
use App\Models\User;
//use App\Models\ServiceProvider;
use App\Models\VisitRequest; 


class AdminController extends Controller
{
    // Show the admin login form
    public function showLoginForm() {
        return view('admin.login'); // Adjust this to your actual login view path
    }

    // Handle the admin login
    public function login(Request $request) {
        // Validate the request
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ], [
            'email.required' => 'Email is required.',
            'email.email' => 'Email is not valid.',
            'password.required' => 'Password is required.',
        ]);

        $credentials = $request->only('email', 'password');

        // Attempt to log the admin in
       // Attempt to log the admin in
        if (Auth::guard('admin')->attempt($credentials)) {
            // Redirect to the admin dashboard on successful login
            return redirect()->route('admin.dashboard');
        } else {
            // Redirect back with an error message
            return redirect()->back()->withErrors(['Invalid credentials']);
        }

    }

    // Show the admin dashboard
    public function dashboard()
    {
        // Fetch totals from the database
        $totalProperties = Property::count();
        $totalLandlords = Landlord::count();
        $totalTenants = Tenant::count();
        //$totalServiceProviders = ServiceProvider::count();
    
        // Pass data to the view
        return view('admin.dashboard', compact('totalProperties', 'totalLandlords', 'totalTenants'));

        // return view('admin.dashboard'); // Update to your actual view name
    }




    //VISIT REQUESTS

    public function viewVisitRequests()
    {
        // Fetch pending visit requests with related visitor and property data
        $visitRequests = VisitRequest::with(['visitor', 'property']) ->get();

        $acceptedRequests = VisitRequest::with(['visitor', 'property'])
        ->where('status', 'accepted') // Fetch only accepted requests
        ->get();

        return view('admin.visit_requests', compact('visitRequests', 'acceptedRequests'));
    }

    public function updateRequestStatus($id, $status)
    {
        // Find the visit request and update the status
        $visitRequest = VisitRequest::findOrFail($id);
        $visitRequest->status = $status;
        $visitRequest->save();

        return redirect()->back()->with('success', 'Visit request ' . $status . ' successfully.');
    }

    public function removeVisitRequest($id)
    {
        // Find and delete the visit request
        $visitRequest = VisitRequest::find($id);
        if ($visitRequest) {
            $visitRequest->delete();
        }

        return redirect()->back()->with('success', 'Visit request removed successfully.');
    }

    public function changeToTenant($id)
    {
        // Find the visit request
        $visitRequest = VisitRequest::find($id);

        if ($visitRequest) {
            // Update the user's account type to 'tenant' and assign the property ID
            $user = $visitRequest->visitor; // Assuming `visitor` relationship is defined in VisitRequest model
            if ($user) {
                $user->account_type = 'tenant';
                $user->property_id = $visitRequest->property_id; // Assign property ID
                $user->save();
            }

            // Delete the visit request
            $visitRequest->delete();
        }

        return redirect()->back()->with('success', 'Visitor changed to tenant.');
    }





    // Logout the admin
    public function logout() {
        Auth::logout();
        return redirect()->route('admin.login');
    }

    public function propertyList()
    {
        return view('admin.property_list'); // Adjust path if needed
    }


}
