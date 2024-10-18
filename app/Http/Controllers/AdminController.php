<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    // Show the admin login form
    public function showLoginForm() {
        return view('admin.login');
    }

    // Handle the admin login
    public function login(Request $request) {
        // Validate the request
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');

        // Attempt to log the admin in
        if (Auth::attempt($credentials)) {
            // Redirect to the admin dashboard on successful login
            return redirect()->route('admin.dashboard');
        } else {
            // Redirect back with an error message
            return redirect()->back()->withErrors(['Invalid credentials']);
        }
    }

    // Show the admin dashboard
    public function dashboard() {
        return view('admin.dashboard'); // Create this view next
    }

    // Logout the admin
    public function logout() {
        Auth::logout();
        return redirect()->route('admin.login');
    }
}
