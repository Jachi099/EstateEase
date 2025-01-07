<?php

namespace App\Http\Controllers;

use App\Models\ServiceProvider;
use App\Models\Service;

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
    $services = Service::all(); // Example in controller
return view('admin.addProvider', compact('services'));

    // Show the form to add a new service provider
}


public function store(Request $request)
{
    // Validation
    $validatedData = $request->validate([
        'name' => 'required|string|max:255',
        'phone_number' => 'required|string|max:20',
        'email' => 'nullable|email|unique:service_providers,email',
        'address' => 'required|string|max:255',
        'specialization' => 'required|string|max:255',
        'availability_status' => 'nullable|in:Available,Unavailable',
        'picture' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
    ]);

    // Handle Picture Upload
    if ($request->hasFile('picture')) {
        $picturePath = $request->file('picture')->store('service_provider_pictures', 'public');  // Store in the 'public' disk
        $validatedData['picture'] = $picturePath;
    }

    // Set default availability status if not provided
    if (!isset($validatedData['availability_status'])) {
        $validatedData['availability_status'] = 'Available'; // Default to "Available"
    }

    // Storing the new service provider
    $provider = new ServiceProvider($validatedData);

    // Save the provider
    if ($provider->save()) {
        // Redirect with success message
        return redirect()->route('admin.addProvider')->with('success', 'Service Provider added successfully!');
    } else {
        // Redirect with failure message
        return redirect()->route('admin.addProvider')->with('error', 'Failed to save the service provider');
    }
}





}
