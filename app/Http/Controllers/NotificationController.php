<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Notification;

class NotificationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth'); // Ensure the user is authenticated
    }

    // This method will show the landlord's notifications
    public function index()
    {
        $landlord = Auth::guard('landlord')->user(); // Get the currently authenticated landlord

        if ($landlord) {
            // Fetch the landlord's notifications
            $notifications = Notification::where('landlord_id', $landlord->landlord_id)
                                         ->orderBy('created_at', 'desc')
                                         ->get();

            // Get the profile picture (assuming the column is 'profile_picture')
            $profilePicture = $landlord->picture ?? null; // Assuming `picture` is a field in the landlord table

            return view('landlord.notifications', compact('notifications', 'profilePicture'));
        }

        return redirect()->back()->with('error', 'Landlord not found');
    }

    // This method will mark the notification as read
    public function markAsRead($id)
    {
        $landlord = Auth::guard('landlord')->user(); // Get the currently authenticated landlord

        if ($landlord) {
            // Find the notification and mark it as read
            $notification = Notification::where('id', $id)
                                         ->where('landlord_id', $landlord->id) // Ensure it's the correct landlord
                                         ->first();

            if ($notification) {
                $notification->update(['status' => 'read']); // Mark as read
            }
        }

        return redirect()->back();
    }
}
