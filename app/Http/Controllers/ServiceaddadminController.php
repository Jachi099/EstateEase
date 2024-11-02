<?php

use App\Models\ServiceAddAdmin;
use Illuminate\Http\Request;

class ServiceAddAdminController extends Controller
{
    // Display list of serviceaddadmin entries
    public function index()
    {
        $services = ServiceAddAdmin::all();
        return view('serviceaddadmin.index', compact('services'));
    }

    // Show form to add a new entry
    public function create()
    {
        return view('serviceaddadmin.create');
    }

    // Store new entry in the database
    public function store(Request $request)
    {
        $request->validate([
            'service_type' => 'required|string|max:255',
            'details' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images', 'public');
        }

        ServiceAddAdmin::create([
            'service_type' => $request->input('service_type'),
            'details' => $request->input('details'),
            'image_path' => $imagePath,
        ]);

        return redirect('/serviceaddadmin');
    }
}
?>