<?php

namespace App\Http\Controllers;

use App\Models\AddServiceProviderAdmin;
use Illuminate\Http\Request;

class AddServiceProviderAdminController extends Controller
{
    public function create()
    {
        return view('addserviceu95provideru95admin');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'full_name' => 'required|string|max:255',
            'service_type' => 'required|string|max:255',
            'email' => 'required|email|unique:add_service_provider_admins,email',
            'phone_number' => 'required|string|max:15',
            'service_area' => 'required|string|max:255',
            'experience' => 'required|string|max:255',
            'profile_picture' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('profile_picture')) {
            $path = $request->file('profile_picture')->store('profile_pictures', 'public');
            $validatedData['profile_picture'] = $path;
        }

        AddServiceProviderAdmin::create($validatedData);

        return redirect()->back()->with('success', 'Service Provider added successfully!');
    }
}
