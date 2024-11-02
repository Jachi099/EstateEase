<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Rental;
use Illuminate\Support\Facades\Auth;

class TenantRentalController extends Controller
{
    // Show rented properties
    public function index(Request $request)
    {
        $user = Auth::user();

        // Sort based on request parameter
        $sortBy = $request->get('sort', 'rented_date'); // Default sort by rented date

        // Fetch rentals for the logged-in user
        $rentals = Rental::where('user_id', $user->id)
            ->with('property')
            ->orderBy($sortBy, 'desc')
            ->get();

        return view('tenant.rented_properties', compact('rentals'));
    }
}
