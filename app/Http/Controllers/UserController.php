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


class UserController extends Controller
{
    // Method to display the user homepage

    public function index()
    {
        return view('user.home'); // Updated to match the new view file name
    }

 public function visitRequestedProperties()
 {
     // Get the authenticated user
     $user = Auth::user();
 
     // Prepare the data to pass to the view
     $profilePicture = $user->picture; // Adjust this according to your user model's attribute
 
     // You can also fetch other properties as needed
     // $requestedProperties = ...; // Logic to get requested properties
 
     return view('user.visit_requested_list', compact('profilePicture')); // Pass the profile picture to the view
 }
 
 public function userHome()
 {
     $user = Auth::user();
     Log::info('Redirected to user home for: ' . $user->email);
     return view('user.user_home', ['profilePicture' => $user->picture]);
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
            return redirect()->route('user.user_home')->with('error', 'Profile not found.');
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
        return view('user.edit_profile', compact('user', 'profilePicture'));
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
    public function properties()
    {
        return view('user.properties'); // Ensure this path matches your view file
    }

    // Method to display the service page
    public function service()
    {
        return view('user.service'); // Ensure this path matches your view file
    }

    // Method to display the signup page
    public function signup()
    {
        return view('user.signup'); // Ensure this path matches your view file
    }

    // Method to handle the signup form submission
    public function signupSubmit(Request $request)
{
    // Log the incoming request
    Log::info('Signup form submitted', $request->all());

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

    // Store profile picture
    $picturePath = $request->file('picture')->store('profile_pictures', 'public');

    // Check if account type is landlord or visitor
    if ($validatedData['account_type'] === 'landlord') {
        // Create a new landlord record in the landlord table
        $landlord = Landlord::create([
            'name' => $validatedData['full_name'],
            'email' => $validatedData['email'],
            'phone' => $validatedData['phone_number'],
            'password' => Hash::make($validatedData['password']),
            'picture' => $picturePath,
            'account_type' => 'landlord'
        ]);

        // Log the landlord in (optional: you may use a different method if landlord login differs)
        Auth::login($landlord);

        // Redirect to the landlord dashboard or homepage
        return redirect()->route('user.user_home')->with('success', 'Registration successful!');
    } else {
        // Create a new user record in the users table for visitors
        $user = User::create([
            'full_name' => $validatedData['full_name'],
            'current_address' => $validatedData['current_address'],
            'phone_number' => $validatedData['phone_number'],
            'account_type' => 'visitor',
            'email' => $validatedData['email'],
            'password' => Hash::make($validatedData['password']),
            'picture' => $picturePath
        ]);

        // Log the visitor in
        Auth::login($user);

        // Redirect to the visitor's homepage or user home
        return redirect()->route('user.user_home')->with('success', 'Registration successful!');
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

    // Attempt to find a landlord first
    $landlord = Landlord::where('email', $request->email)->first();
    if ($landlord) {
        Log::info('Landlord found: ' . $landlord->email);

        if (Auth::guard('landlord')->attempt($request->only('email', 'password'))) {
            Log::info('Landlord login successful: ' . $landlord->email);
            return redirect()->route('user.user_home')->with('success', 'Logged in successfully as landlord!');
        } else {
            Log::warning('Landlord login failed: Invalid credentials');
        }
    }

    // Attempt to find a visitor if landlord not found
    $visitor = User::where('email', $request->email)->first();
    if ($visitor) {
        Log::info('Visitor found: ' . $visitor->email);

        if (Auth::guard('web')->attempt($request->only('email', 'password'))) {
            Log::info('Visitor login successful: ' . $visitor->email);
            return redirect()->route('user.user_home')->with('success', 'Logged in successfully as visitor!');
        } else {
            Log::warning('Visitor login failed: Invalid credentials');
        }
    }

    // Attempt to find a tenant if neither landlord nor visitor is found
    $tenant = Tenant::where('email', $request->email)->first();
    if ($tenant) {
        Log::info('Tenant found: ' . $tenant->email);

        if (Auth::guard('tenant')->attempt($request->only('email', 'password'))) {
            Log::info('Tenant login successful: ' . $tenant->email);
            return redirect()->route('user.user_home')->with('success', 'Logged in successfully as tenant!');
        } else {
            Log::warning('Tenant login failed: Invalid credentials');
        }
    }

    Log::warning('No user found for email: ' . $request->email);
    
    // If no login attempts were successful, return back with an error message
    return back()->with('error', 'Invalid credentials. Please try again.');
}

    

public function logout(Request $request)
{
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();

    return redirect('/login')->with('success', 'You have been logged out.');
}





}  