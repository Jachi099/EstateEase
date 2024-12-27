<?php

namespace App\Http\Controllers;

use App\Models\ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class ServiceProviderController extends Controller
{
    // Display the list of service providers

    public function index()
    {
        $serviceProviders = ServiceProvider::all(); // Get all service providers from the database
        return view('admin.serviceProvider', compact('serviceProviders'));
    }

    // Delete a service provider
    public function destroy($id)
    {
        $serviceProvider = ServiceProvider::findOrFail($id);
        $serviceProvider->delete();
        return redirect()->route('admin.serviceProviders')->with('success', 'Service provider deleted successfully.');
    }

 // Controller: ServiceProviderController

public function create()
{
    // Show the form to add a new service provider
    return view('admin.addProvider');
}

public function store(Request $request)
{
    // Validation
    $validatedData = $request->validate([
        'name' => 'required|string|max:255',
        'phone_number' => 'required|string|max:20',
        'email' => 'required|email|unique:service_providers,email',
        'address' => 'required|string|max:255',
        'specialization' => 'required|string|max:255',
        'hourly_rate' => 'required|numeric|min:0',
        'availability_status' => 'required|in:Available,Unavailable',
    ]);

    // Storing the new service provider
    $provider = ServiceProvider::create($validatedData);

    // Redirect to service provider list or show success message
    return redirect()->route('admin.addProvider')->with('success', 'Service Provider added successfully!');
}

}
