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
        $serviceProviders = ServiceProvider::all();
        return view('admin.service_providers', compact('serviceProviders'));
    }

    // Delete a service provider
    public function destroy($id)
    {
        $serviceProvider = ServiceProvider::findOrFail($id);
        $serviceProvider->delete();
        return redirect()->route('admin.serviceProviders')->with('success', 'Service provider deleted successfully.');
    }
}
