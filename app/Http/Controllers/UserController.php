<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    // Method to display the user homepage
    public function index()
    {
        return view('user.home'); // Ensure this path matches the view file location
    }
}
