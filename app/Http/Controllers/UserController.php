<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth; // Import Auth facade
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\Log;


class UserController extends Controller
{
    // Method to display the user homepage

    public function index()
    {
        return view('user.home'); // Updated to match the new view file name
    }

public function userHome()
{
    return view('user.user_home'); // Ensure this matches your view structure
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
            'full_name' => $validatedData['full_name'],
            'current_address' => $validatedData['current_address'],
            'phone_number' => $validatedData['phone_number'],
            'account_type' => $validatedData['account_type'],
            'email' => $validatedData['email'],
            'password' => Hash::make($validatedData['password']),
            'picture' => $picturePath
        ]);

        // Log the user in
        Auth::login($user);

        // Redirect to the user homepage with a success message
        return redirect()->route('user.user_home')->with('success', 'Registration successful!');
    }
    
    
}