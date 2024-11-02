<?php



namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tenant; // Import the Tenant model
use Illuminate\Support\Facades\Auth;

class TenantController extends Controller
{


    public function profile()
    {
        // Get the authenticated tenant
        $tenant = Auth::guard('tenant')->user();

        // Return the tenant profile view with tenant data
        return view('tenant.profile', ['tenant' => $tenant]);
    }

    public function editProfile()
    {
        // Get the authenticated tenant
        $tenant = Auth::guard('tenant')->user();

        // Return the edit profile view with tenant data
        return view('tenant.edit_profile', ['tenant' => $tenant]);
    }

    public function updateProfile(Request $request)
    {
        // Validate request data
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            // Add other validation rules as needed
        ]);

        // Get the authenticated tenant
        $tenant = Auth::guard('tenant')->user();

        // Update tenant details
        $tenant->name = $request->name;
        $tenant->email = $request->email;
        // Update other fields as necessary

        return redirect()->route('tenant.profile')->with('success', 'Profile updated successfully!');
    }
}
