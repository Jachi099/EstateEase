<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    // Display the edit profile form
    public function edit()
    {
        $user = Auth::user();
        return view('profileu95admin', compact('user'));
    }

    // Update the user's profile information
    public function update(Request $request)
    {
        $user = Auth::user();

        // Validate input data
        $validated = $request->validate([
            'full_name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'password' => 'nullable|confirmed|min:8',
            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Update profile information
        $user->full_name = $validated['full_name'];
        $user->email = $validated['email'];

        // Update password if entered
        if ($request->filled('password')) {
            $user->password = Hash::make($validated['password']);
        }

        // Handle profile picture upload
        if ($request->hasFile('profile_picture')) {
            // Delete old profile picture if exists
            if ($user->profile_picture) {
                Storage::delete($user->profile_picture);
            }
            // Store new profile picture
            $path = $request->file('profile_picture')->store('profile_pictures');
            $user->profile_picture = $path;
        }

        // Save updated user data
        $user->save();

        // Redirect with success message
        return redirect()->back()->with('success', 'Profile updated successfully.');
    }

    // Delete the user's profile
    public function destroy()
    {
        $user = Auth::user();
        // Delete user profile picture if it exists
        if ($user->profile_picture) {
            Storage::delete($user->profile_picture);
        }
        $user->delete();
        return redirect('/')->with('success', 'Profile deleted successfully.');
    }
}
