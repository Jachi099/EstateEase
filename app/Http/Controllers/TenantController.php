<?php



namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tenant; // Import the Tenant model
use Illuminate\Support\Facades\Auth;
use App\Models\Property; // Import the Property model


class TenantController extends Controller
{
    public function showProperties(Request $request)
    {
        // Start building the query for the Property model
        $query = Property::query();

        // Filter by location (thana)
        if ($request->filled('location')) {
            $query->where('thana', $request->location);
        }

        // Filter by rent range
        if ($request->filled('rent_range')) {
            [$minRent, $maxRent] = explode('-', $request->rent_range);
            $query->whereBetween('rent', [(int)$minRent, (int)$maxRent]);
        }

        // Apply sorting based on user selection
        if ($request->filled('sort')) {
            switch ($request->sort) {
                case 'rent_asc':
                    $query->orderBy('rent', 'asc');
                    break;
                case 'rent_desc':
                    $query->orderBy('rent', 'desc');
                    break;
                case 'type':
                    $query->orderBy('type', 'asc');
                    break;
                case 'availability':
                    // Join with tenants table to check property availability
                    $query->leftJoin('tenants', 'properties.property_ID', '=', 'tenants.property_ID')
                          ->select('properties.*') // Ensure only property columns are selected
                          ->orderByRaw("CASE WHEN tenants.property_ID IS NULL THEN 0 ELSE 1 END ASC")
                          ->orderBy('available_from', 'asc');
                    break;
            }
        }

        // Execute the query and get the properties
        $properties = $query->get();
        $profilePicture = $tenant->picture ?? null;

        // Render the properties view with the filtered and sorted properties
        return view('tenant.property_list', compact('properties', 'profilePicture'));
    }
    public function filterProperties(Request $request)
    {
        $location = $request->input('location'); // Location input corresponds to the 'thana' column in DB
        $rentRange = $request->input('rent_range'); // Format: "min-max"

        $query = Property::query();

        // Filter by thana (location)
        if ($location) {
            $query->where('thana', 'LIKE', "%{$location}%");
        }

        // Filter by rent range
        if ($rentRange) {
            [$minRent, $maxRent] = explode('-', $rentRange);
            $query->whereBetween('rent', [(float)$minRent, (float)$maxRent]);
        }

        // Get the filtered properties
        $properties = $query->get();

        // Retrieve the tenant's profile picture
        $user = Auth::guard('tenant')->user(); // Ensure the tenant guard is used
        $profilePicture = $tenant->picture ?? null;
        return view('tenant.property_list', compact('properties', 'profilePicture'));
    }

    public function showPropertyDetailsForPublic($id)
    {
        // Fetch the property by its ID or fail with a 404 error if not found
        $property = Property::findOrFail($id);

        // Check if the property has a tenant
        $tenant = Tenant::where('property_ID', $id)->first();

        // Default payment status
        $paymentStatus = 'unpaid';
        $tenantProfilePicture = null;

        if ($tenant) {
            // Fetch the latest payment for the tenant from tenant_payments table
            $latestPayment = $tenant->tenantPayments()->latest()->first();

            // Set payment status based on the latest payment
            if ($latestPayment && $latestPayment->status === 'paid') {
                $paymentStatus = 'paid';
            }

            // Get the tenant's profile picture if available
            $tenantProfilePicture = $tenant->picture ?? null;
        }

        // Pass data to the view
        return view('tenant.property_details', compact('property', 'paymentStatus', 'tenantProfilePicture', 'tenant'));
    }

    public function profile()
    {
        // Get the authenticated landlord
        $tenant = Auth::guard('tenant')->user();

        // Check if the landlord exists
        if (!$tenant) {
            return redirect()->route('tenant.user_home')->with('error', 'Profile not found.');
        }

        // Pass the landlord's information to the profile view
        return view('tenant.profile', [
            'profilePicture' => $tenant->picture ?? null,
            'name' => $tenant->full_name,
            'email' => $tenant->email,
            'phone' => $tenant->phone_number ?? null,
            'address' => $tenant->current_address ?? null,
            'account_type' => $tenant->account_type,
        ]);
    }

}
