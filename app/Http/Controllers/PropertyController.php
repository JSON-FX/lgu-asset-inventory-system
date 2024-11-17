<?php

namespace App\Http\Controllers;

use App\Models\Property;
use Illuminate\Http\Request;

class PropertyController extends Controller
{
    public function index()
    {
        // Retrieve all properties
        $properties = Property::all();

        // Pass data to the 'asset.blade.php' view
        return view('asset', compact('properties'));
    }

    public function edit($id)
    {
        // Find the property by ID
        $properties = Property::findOrFail($id);

        // Return the edit view with the property data
        return view('edit', compact('properties'));
    }

    public function update(Request $request, $id)
    {
        // Validate incoming data
        $request->validate([
            'description' => 'required|string|max:255',
            'property_number' => 'nullable|string|max:255|unique:properties,property_number,' . $id,
            'serial_number' => 'nullable|string|max:255',
            'office' => 'required|string|max:255',
            'date_purchase' => 'nullable|date',
            'accountable_person' => 'nullable|string|max:255',
            'acquisition_cost' => 'nullable|numeric',
            'status' => 'nullable|string|max:255',
            'inventory_remarks' => 'nullable|string|max:1000',
        ]);

        // Find the property by ID
        $properties = Property::findOrFail($id);

        // Update the property details with validated data
        $properties->update([
            'description' => $request->description,
            'property_number' => $request->property_number,
            'serial_number' => $request->serial_number,
            'office' => $request->office,
            'date_purchase' => $request->date_purchase,
            'accountable_person' => $request->accountable_person,
            'acquisition_cost' => $request->acquisition_cost,
            'status' => $request->status,
            'inventory_remarks' => $request->inventory_remarks,
        ]);

        // Redirect back to the asset list with a success message
        return redirect()->route('assets')->with('success', 'Asset updated successfully!');
    }
    public function create()
    {
        return view('add');  // Return the 'create' view for adding a new asset
    }

    // Store a new asset
    public function store(Request $request)
    {
        // Validate the incoming request data
        $request->validate([
            'property_number' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'serial_number' => 'nullable|string|max:255',
            'office' => 'required|string|max:255',
            'date_purchase' => 'required|date',
            'accountable_person' => 'required|string|max:255',
            'acquisition_cost' => 'required|numeric',
            'status' => 'required|string|max:255',
            'inventory_remarks' => 'nullable|string',
        ]);

        // Create a new asset
        Property::create([
            'property_number' => $request->property_number,
            'description' => $request->description,
            'serial_number' => $request->serial_number,
            'office' => $request->office,
            'date_purchase' => $request->date_purchase,
            'accountable_person' => $request->accountable_person,
            'acquisition_cost' => $request->acquisition_cost,
            'status' => $request->status,
            'inventory_remarks' => $request->inventory_remarks,
        ]);

        // Redirect to the assets list page with a success message
        return redirect()->route('assets')->with('success', 'Asset added successfully!');
    }
}

