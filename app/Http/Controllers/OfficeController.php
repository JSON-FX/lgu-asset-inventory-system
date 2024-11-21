<?php

namespace App\Http\Controllers;
use App\Models\Office;
use Illuminate\Http\Request;

class OfficeController extends Controller
{
    public function index()
    {
        // Retrieve all properties
        $office = Office::all();

        // Pass data to the 'category.blade.php' view
        return view('office', compact('office'));
    
    }
    public function edit($id)
    {
        // Find the category by ID
        $office = Office::findOrFail($id);

        // Return the edit view with the office data
        return view('action_office.editoffice', compact('office'));
    }

    public function update(Request $request, $id)
    {
        // Validate incoming data
        $request->validate([
            'office_name' => 'required|string|max:255',
        ]);

        // Find the office by ID
        $office = Office::findOrFail($id);

        // Update only the office name
        $office->update([
            'office_name' => $request->office_name,
        ]);

        // Redirect back to the office list with a success message
        return redirect()->route('office.index')->with('success', 'office updated successfully!');
    }
    public function create()
    {
        return view('action_office.addoffice');  // Return the 'create' view for adding a new asset
    }

    // Store a new asset
    public function store(Request $request)
    {
        // Validate the incoming request data
        $request->validate([
            'office_name' => 'required|string|max:255'
        ]);

        // Create a new asset
        Office::create([
            'office_name' => $request->office_name,
        ]);

        // Redirect to the assets list page with a success message
        return redirect()->route('office.index')->with('success', 'office added successfully!');
    }
    
}