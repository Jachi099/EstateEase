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
  
    public function profile()
    {
        // Get the authenticated landlord
        $landlord = auth()->guard('landlord')->user();

        // Get the profile picture
        $profilePicture = $landlord->picture ?? null;

        // Pass the profile information to the view
        return view('landlord.profile', compact('landlord', 'profilePicture'));
    }

}  