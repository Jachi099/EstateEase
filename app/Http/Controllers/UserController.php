<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth; // Import Auth facade
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\Log;
use App\Models\Landlord;
use App\Models\Tenant;
use App\Models\Property;
use GuzzleHttp\Client;
use App\Models\Service;



class UserController extends Controller
{
    // Method to display the user homepage

    public function index()
    {
        return view('user.home'); // Updated to match the new view file name
    }







    public function profile()
    {
        // Get the authenticated user
        $user = Auth::user();

        // Initialize an array to hold the profile data
        $profileData = null;

        // Determine the user's account type and retrieve the relevant information
        if ($user->account_type === 'landlord') {
            $profileData = Landlord::where('email', $user->email)->first(['name', 'email', 'phone', 'picture']);
        } elseif ($user->account_type === 'tenant') {
            $profileData = Tenant::where('email', $user->email)->first(['full_name', 'email', 'current_address', 'phone_number', 'picture']);
        } else { // Assuming visitor is the default case
            $profileData = User::where('email', $user->email)->first(['full_name', 'email', 'current_address', 'phone_number', 'picture']);
        }

        // Check if profile data is retrieved
        if (!$profileData) {
            return redirect()->route('visitor.user_home')->with('error', 'Profile not found.');
        }

        // Pass the user's information to the profile view
        return view('visitor.profile', [
            'profilePicture' => $profileData->picture ?? null,
            'name' => $profileData->full_name ?? $profileData->name, // Use name based on account type
            'email' => $profileData->email,
            'phone' => $profileData->phone_number ?? $profileData->phone ?? null,
            'address' => $profileData->current_address ?? null,
            'account_type' => $user->account_type,
        ]);
    }


    public function editProfile(Request $request)
    {
        // Get the authenticated user
        $user = Auth::user();

        // Check if the user is a valid instance of the User model
        if (!$user instanceof User) {
            return redirect()->route('visitor.profile')->with('error', 'User not found.');
        }

        // Prepare the profile picture path
        $profilePicture = $user->picture; // Adjust according to your User model's picture attribute

        // Return the edit profile view with the user data and profile picture
        return view('visitor.edit_profile', compact('user', 'profilePicture'));
    }

    public function updateProfile(Request $request)
{
    // Validate request data
    $request->validate([
        'full_name' => 'nullable|string|max:255',
        'current_address' => 'nullable|string|max:255',
        'phone_number' => 'nullable|string|max:15',
        'email' => 'nullable|email|max:255',
        'password' => 'nullable|string|min:6|confirmed',
        'picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    // Get the authenticated user
    $user = Auth::user();

    // Check if the user is a valid instance of User model
    if (!$user instanceof User) {
        return redirect()->route('visitor.profile')->with('error', 'User not found.');
    }

    // Prepare an array of attributes to update
    $data = $request->only(['full_name', 'current_address', 'phone_number', 'email']);

    // Handle password if provided
    if ($request->filled('password')) {
        $data['password'] = Hash::make($request->input('password'));
    }

    // Handle picture upload if present
    if ($request->hasFile('picture')) {
        $data['picture'] = $request->file('picture')->store('profile_pictures', 'public');
    }

    // Debugging: Check the data array
    // dd($data); // Uncomment this to see the values being saved

    // Update the user attributes
    foreach ($data as $key => $value) {
        if ($value !== null) { // Only update fields that are provided
            $user->$key = $value;
        }
    }

    // Save the updated user instance
    $user->save(); // Ensure $user is a valid User instance here

    return redirect()->route('visitor.profile')->with('success', 'Profile updated successfully.');
}



    // Method to display the properties page
    public function properties(Request $request)
    {
        $query = Property::query();

        if ($request->filled('location')) {
            $query->where('thana', $request->location);
        }

        if ($request->filled('rent_range')) {
            [$minRent, $maxRent] = explode('-', $request->rent_range);
            $query->whereBetween('rent', [(int)$minRent, (int)$maxRent]);
        }

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
                        // Join with the tenant table to check for tenants
                        $query->leftJoin('tenants', 'property.property_ID', '=', 'tenants.property_ID')
                              ->select('property.*')
                              ->orderByRaw("CASE WHEN tenants.property_ID IS NULL THEN 0 ELSE 1 END ASC")
                              ->orderBy('available_from', 'asc');
                        break;

            }
        }

        $properties = $query->get();
        return view('user.properties', compact('properties'));
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
            if ($latestPayment && $latestPayment->status == 'paid') {
                $paymentStatus = 'paid';
            }

            // Get the tenant's profile picture if available
            $tenantProfilePicture = $tenant->picture ?? null;
        }

        // Pass data to the view
        return view('user.details', compact('property', 'paymentStatus', 'tenantProfilePicture', 'tenant'));
    }


    public function service(Request $request)
    {
        // Check if there is a search query
        $query = $request->get('query', '');

        // If there is a search query, filter services
        if ($query) {
            $services = Service::where('type', 'LIKE', '%' . $query . '%')
                               ->orWhere('description', 'LIKE', '%' . $query . '%')
                               ->get();
        } else {
            // If no search query, get all services
            $services = Service::all();
        }

        // Get the service count
        $serviceCount = $services->count();

        // Pass the services and service count to the view
        return view('user.service', compact('services', 'serviceCount'));
    }


    // Method to display the signup page
    public function signup()
    {
        return view('user.signup'); // Ensure this path matches your view file
    }
    public function signupSubmit(Request $request)
    {
        // Validate the input data
        $validatedData = $request->validate([
            'full_name' => 'required|string|max:255',
            'current_address' => 'required|string|max:255',
            'phone_number' => 'required|numeric|digits_between:10,15',
            'account_type' => 'required|in:landlord,visitor',
            'email' => 'required|email|unique:users,email|unique:landlord,email',
            'password' => [
                'required',
                'confirmed',
                Password::min(8)
                    ->mixedCase()
                    ->letters()
                    ->numbers()
                    ->symbols()
            ],
            'picture' => 'required|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        // Get the email address from the validated data
        $email = $validatedData['email'];

        // Abstract API validation code...

        // Store the profile picture
        $picturePath = $request->file('picture')->store('profile_pictures', 'public');

        // Handle account creation based on account type (landlord or visitor)
        if ($validatedData['account_type'] === 'landlord') {
            $landlord = Landlord::create([
                'name' => $validatedData['full_name'],
                'current_address' => $validatedData['current_address'],

                'email' => $validatedData['email'],
                'phone' => $validatedData['phone_number'],
                'password' => Hash::make($validatedData['password']),
                'picture' => $picturePath,
                'account_type' => 'landlord'
            ]);

            // Log the landlord in using the default web guard
            Auth::guard('landlord')->login($landlord); // For landlords

            // Debugging: Log the authentication session
            Log::info('Landlord logged in successfully', ['landlord_id' => $landlord->id]);

            // Redirect to the landlord's homepage
            return redirect()->route('landlord.user_home')->with('success', 'Registration successful!');
        } else {
            $user = User::create([
                'full_name' => $validatedData['full_name'],
                'current_address' => $validatedData['current_address'],
                'phone_number' => $validatedData['phone_number'],
                'account_type' => 'visitor',
                'email' => $validatedData['email'],
                'password' => Hash::make($validatedData['password']),
                'picture' => $picturePath
            ]);

            // Log the user in using the default web guard
            Auth::guard('visitor')->login($user); // For visitors

            // Debugging: Log the authentication session
            Log::info('Visitor logged in successfully', ['user_id' => $user->id]);

            // Redirect to the visitor's homepage
            return redirect()->route('visitor.user_home')->with('success', 'Registration successful!');
        }
    }

    // UserController.php
    public function showLoginForm()
    {
        return view('user.login'); // Return the login view
    }


    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        Log::info('Login attempt for email: ' . $request->email);

        // Attempt to find a landlord
        $landlord = Landlord::where('email', $request->email)->first();
        if ($landlord) {
            Log::info('Landlord found: ' . $landlord->email);

            if (Auth::guard('landlord')->attempt($request->only('email', 'password'))) {
                Log::info('Landlord login successful: ' . $landlord->email);
                return redirect()->route('landlord.user_home')->with('success', 'Logged in successfully as landlord!');
            } else {
                Log::warning('Landlord login failed: Invalid credentials');
                return back()->withErrors(['email' => 'Invalid landlord credentials. Please try again.'])->withInput();
            }
        }

        // Attempt to find a visitor
        $visitor = User::where('email', $request->email)->first();
        if ($visitor) {
            Log::info('Visitor found: ' . $visitor->email);
            if (Auth::guard('visitor')->attempt($request->only('email', 'password'))) {
                Log::info('Visitor login successful: ' . $visitor->email);
                return redirect()->route('visitor.user_home')->with('success', 'Logged in successfully as visitor!');
            } else {
                Log::warning('Visitor login failed: Invalid credentials');
                return back()->withErrors(['email' => 'Invalid visitor credentials. Please try again.'])->withInput();
            }
        }

        // Attempt to find a tenant
        $tenant = Tenant::where('email', $request->email)->first();
        if ($tenant) {
            Log::info('Tenant found: ' . $tenant->email);

            if (Auth::guard('tenant')->attempt($request->only('email', 'password'))) {
                Log::info('Tenant login successful: ' . $tenant->email);
                return redirect()->route('tenant.user_home')->with('success', 'Logged in successfully as tenant!');
            } else {
                Log::warning('Tenant login failed: Invalid credentials');
                return back()->withErrors(['email' => 'Invalid tenant credentials. Please try again.'])->withInput();
            }



        }

        Log::warning('No user found for email: ' . $request->email);

        // If no user is found
        return back()->withErrors(['email' => 'No user found with that email. Please check your credentials and try again.'])->withInput();
    }

public function logout(Request $request)
{
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();

    return redirect('/login')->with('success', 'You have been logged out.');
}



public function landlordHome()
{
    // Get the authenticated landlord
    $landlord = auth()->guard('landlord')->user();

    // Get the profile picture
    $profilePicture = $landlord->picture ?? null; // Assuming `picture` is a field in the landlord table

    // Pass the picture to the view
    return view('landlord.home', compact('profilePicture'));
}

public function tenantHome()
{
    // Get the authenticated tenant
    $tenant = auth()->guard('tenant')->user();

    if (!$tenant) {
        return redirect()->route('login')->with('error', 'Please log in first.'); // Adjust this according to your routing
    }

    // Get the profile picture
    $profilePicture = $tenant->picture ?? null; // Assuming `picture` is a field in the tenant table

    // Pass the picture to the view
    return view('tenant.home', compact('profilePicture'));
}

public function visitorHome()
{
    // Get the authenticated visitor using the 'visitor' guard
    $visitor = Auth::guard('visitor')->user();

    // Check if the visitor is authenticated
    if (!$visitor) {
        return redirect()->route('login')->with('error', 'Please log in first.'); // Adjust this according to your routing
    }

    // Get the profile picture path from the visitor object
    $profilePicture = $visitor->picture ?? null; // Ensure this field exists in the users table

    // Pass the profile picture to the view
    return view('visitor.home', compact('profilePicture'));
}
public function requestVisit(Request $request)
{
    // Validate the request
    $request->validate([
        'date' => 'required|date',
        'property_id' => 'required|exists:property,property_ID'
    ]);

    // Logic to store the visit request in the database
    // Check if the date is already booked, then save it or return an error

    return response()->json(['success' => 'Visit request submitted successfully!']);
}


public function showProperties(Request $request)
{
    // Start the query to retrieve properties
    $properties = Property::select(
            'property.property_ID', 'property.status', 'property.num_of_rooms', 'property.num_of_bathrooms',
            'property.floor', 'property.city', 'property.thana', 'property.house_no', 'property.area', 'property.rent', 'property.available_from', 'property.type'
        )
        ->with(['propertyImages' => function($query) {
            $query->limit(1);
        }])
        ->with('tenant'); // Include tenant data for each property

    // Apply sorting as per the request
    if ($request->has('sort')) {
        $sortOption = $request->input('sort');
        switch ($sortOption) {
            case 'rent_asc':
                $properties = $properties->orderBy('property.rent', 'asc');
                break;
            case 'rent_desc':
                $properties = $properties->orderBy('property.rent', 'desc');
                break;
            case 'type':
                $properties = $properties->orderBy('property.type', 'asc');
                break;
            case 'availability':
                // Sort by availability: available properties first (tenant_id is NULL)
                $properties = $properties->leftJoin('tenants', 'property.property_ID', '=', 'tenants.property_ID')
                                          ->orderByRaw("IF(tenants.id IS NULL, 1, 0) DESC");
                break;
            case 'available_date':
                // Sort by available date (ascending)
                $properties = $properties->orderBy('property.available_from', 'asc');
                break;
            default:
                $properties = $properties->orderBy('property.created_at', 'desc');
                break;
        }
    } else {
        // Default sort: Available properties come first
        $properties = $properties->leftJoin('tenants', 'property.property_ID', '=', 'tenants.property_ID')
                                  ->orderByRaw("IF(tenants.id IS NULL, 1, 0) DESC")
                                  ->orderBy('property.created_at', 'desc'); // Add fallback sort
    }
    $properties = $properties->get();

    // Retrieve authenticated user and profile picture
    $user = Auth::user();
    $profilePicture = $user->picture;

    return view('visitor.property_list', compact('properties', 'profilePicture'));
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

    $properties = $query->get();

    // Retrieve the user's profile picture
    $user = Auth::user();
    $profilePicture = $user->picture;

    return view('visitor.property_list', compact('properties', 'profilePicture'));
}


    // In PropertyController.php
    public function showPropertyDetails($id)
    {
        // Fetch the property by its ID or fail with a 404 error if not found
        $property = Property::findOrFail($id);

        // Get the authenticated user's profile picture (for the visitor)
        $user = Auth::user();
        $profilePicture = $user ? $user->picture : null; // Check if a user is authenticated

        // Fetch tenant details for the given property ID
        $tenant = Tenant::where('property_ID', $id)->first();

        // Determine the payment status
        if ($tenant) {
            // Fetch the latest payment for the tenant
            $latestPayment = $tenant->payments()->latest()->first();

            // Set the payment status to 'paid' or 'unpaid' based on the latest payment status
            $paymentStatus = $latestPayment && $latestPayment->status == 'paid' ? 'paid' : 'unpaid';

            // Get the tenant's profile picture
            $tenantProfilePicture = $tenant->picture ?? null;
        } else {
            // If no tenant exists, set payment status to 'unpaid' by default
            $paymentStatus = 'unpaid';
            $tenantProfilePicture = null;
        }

        // Pass the property, payment status, and profile pictures to the view
        return view('visitor.details', compact('property', 'profilePicture', 'paymentStatus', 'tenantProfilePicture', 'tenant'));
    }


    public function visitRequestedProperties(Request $request)
    {
        // Get the authenticated user
        $user = Auth::user();

        // Fetch properties where the visitor has requested a visit, sorted by the latest visit date
        $properties = Property::whereHas('visitRequests', function ($query) use ($request) {
            $query->where('user_id', $request->user()->id)  // Use 'user_id' instead of 'visitor_id'
                  ->orderBy('visit_date', 'desc'); // Sort visit requests by the latest visit date
        })
        ->with('visitRequests') // Include visitRequests to get the date and other related data
        ->get();

        // Prepare the data to pass to the view
        $profilePicture = $user->picture; // Assuming 'picture' is the attribute for the user's profile picture

        return view('visitor.visit_req_list', compact('properties', 'profilePicture'));
    }



// UserController.php
public function showBookedPropertyDetails($property_id)
{
    $user = Auth::user();

    // Fetch the property with the provided property ID
    $property = Property::findOrFail($property_id); // Fetch property

    // Fetch the visit request for this property and the current authenticated user
    $visitRequest = $property->visitRequests()->where('user_id', $user->id)->first();

    // Initialize tenant as null
    $tenant = Tenant::where('property_ID', $property_id)->first();

    // Determine the payment status
    if ($tenant) {
        // Fetch the latest payment for the tenant
        $latestPayment = $tenant->payments()->latest()->first();

        // Set the payment status to 'paid' or 'unpaid' based on the latest payment status
        $paymentStatus = $latestPayment && $latestPayment->status == 'paid' ? 'paid' : 'unpaid';

        // Get the tenant's profile picture
        $profilePicture = $user->picture ?? null;
    } else {
        // If no tenant exists, set payment status to 'unpaid' by default
        $paymentStatus = 'unpaid';
        $profilePicture = null;
    }

    // Pass the property, visitRequest, tenant, profile picture, and payment status to the view
    return view('visitor.bookedproperty_details', compact('property', 'visitRequest', 'profilePicture', 'paymentStatus', 'tenant'));
}



public function cancelVisitRequest($property_id)
{
    $user = Auth::user();

    // Fetch the property with the provided property ID
    $property = Property::findOrFail($property_id);

    // Fetch the visit request for this property and the current authenticated user
    $visitRequest = $property->visitRequests()->where('user_id', $user->id)->first();

    // Check if the visit request exists and its status is 'pending'
    if ($visitRequest && $visitRequest->status == 'pending') {
        // Update the status to 'canceled'
        $visitRequest->update(['status' => 'canceled']);

        // Optionally, you can redirect with a success message
        return redirect()->route('visitor.bookedproperty_details', $property_id)
                         ->with('success', 'Visit request has been canceled.');
    }

    // If the request is not pending, redirect with an error message
    return redirect()->route('visitor.bookedproperty_details', $property_id)
                     ->with('error', 'You can only cancel a pending visit request.');
}



}
