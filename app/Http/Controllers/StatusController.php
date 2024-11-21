<?php

namespace App\Http\Controllers;
use App\Models\Status;
use Illuminate\Http\Request;

class StatusController   extends Controller
{
    public function index()
    {
        // Retrieve all properties
        $status = Status::all();

        // Pass data to the 'category.blade.php' view
        return view('status', compact('status'));
    
    }
    public function edit($id)
    {
        // Find the category by ID
        $status = Status::findOrFail($id);

        // Return the edit view with the status data
        return view('action_status.editstatus', compact('status'));
    }

    public function update(Request $request, $id)
    {
        // Validate incoming data
        $request->validate([
            'status_name' => 'required|string|max:255',
        ]);

        // Find the status by ID
        $status = Status::findOrFail($id);

        // Update only the status name
        $status->update([
            'status_name' => $request->status_name,
        ]);

        // Redirect back to the status list with a success message
        return redirect()->route('status.index')->with('success', 'status updated successfully!');
    }
    public function create()
    {
        return view('action_status.addstatus');  // Return the 'create' view for adding a new asset
    }

    // Store a new asset
    public function store(Request $request)
    {
        // Validate the incoming request data
        $request->validate([
            'status_name' => 'required|string|max:255'
        ]);

        // Create a new asset
        Status::create([
            'status_name' => $request->status_name,
        ]);

        // Redirect to the assets list page with a success message
        return redirect()->route('status.index')->with('success', 'status added successfully!');
    }
    
}