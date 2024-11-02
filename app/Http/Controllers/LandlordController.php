<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth; // Import Auth facade
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\Log;


class LandlordController extends Controller
{
    
            // LandlordController.php

    public function showLoginForm()
    {
        return view('landlord.login'); // Ensure this matches your view structure
    }

    public function login(Request $request)
    {
        // Validate the input data
        $request->validate([
            'Email' => 'required|Email',
            'password' => 'required|string',
        ]);

        // Attempt to log the user in
        if (Auth::attempt($request->only('email', 'password'))) {
            // If successful, redirect to the user homepage
            return redirect()->route('landlord.landlordu95dashboard')->with('success', 'Logged in successfully!');
        }

        // If unsuccessful, redirect back with an error message
        return back()->with('error', 'Invalid credentials. Please try again.');
    }

    
    
    
    // Method to display the user homepage
    public function userHome()
    {
        return view('landlord.landlordu95dashboard'); // Ensure this matches your view structure
    }


    // Method to display the properties page
    public function properties()
    {
        return view('landlord.properties'); // Ensure this path matches your view file
    }

    // Method to display the service page
    public function service()
    {
        return view('landlord.service'); // Ensure this path matches your view file
    }

    // Method to display the signup page
    public function signup()
    {
        return view('landlord.signup'); // Ensure this path matches your view file
    }

    // Method to handle the signup form submission
    public function signupSubmit(Request $request)
    {
        // Log the incoming request
        Log::info('Signup form submitted', $request->all());

        // Validate the input data
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|numeric|digits_between:10,15',
            'account_type' => 'required|in:landlord,visitor',
            'email' => 'required|email|unique:users,email',
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

        // Create the new user record in the database
        $user = User::create([
            'name' => $validatedData['Name'],
            'email' => $validatedData['Email'],
            'phone' => $validatedData['Phone'],
            'password' => Hash::make($validatedData['password']),
            'picture' => $picturePath,
            'account_type' => $validatedData['account_type']
        ]);

        // Log the user in
        Auth::login($user);

        // Redirect to the user homepage with a success message
        return redirect()->route('landlord.landlordu95dashboard')->with('success', 'Registration successful!');
    }



}