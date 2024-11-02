<?php

namespace App\Http\Controllers;

use App\Models\Tenant; // Import the Tenant model

class TenantController extends Controller
{
    // Show tenant dashboard
    public function showDashboard()
    {
        // Fetch tenant details from the database
        $tenant = Tenant::find(1); // Example: fetch the tenant with ID 1

        // Pass tenant data to the view
        return view('tenantu95dashboard', ['tenant' => $tenant]);
    }

    // Show payment history
    public function paymentHistory()
    {
        $tenant = Tenant::find(1);

        return view('tenant-payment-history', ['tenant' => $tenant]);
    }

    // Show service requests
    public function serviceRequests()
    {
        $tenant = Tenant::find(1);

        return view('tenant-service-requests', ['tenant' => $tenant]);
    }
}
