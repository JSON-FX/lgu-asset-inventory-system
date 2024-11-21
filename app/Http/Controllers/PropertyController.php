<?php

namespace App\Http\Controllers;

namespace App\Http\Controllers;

use App\Models\Property;
use Illuminate\Http\Request;

class PropertyController extends Controller
{
    /**
     * Display a listing of the properties.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $properties = Property::all();
        return view('asset', compact('properties'));
    }

    /**
     * Show the form for editing the specified property.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $property = Property::findOrFail($id);  // Renamed to $property
        return view('action_asset.edit', compact('property'));  // Pass $property to view
    }

    /**
     * Update the specified property in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
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

        $property = Property::findOrFail($id);  // Renamed to $property
        $property->update($request->all());

        return redirect()->route('assets.index')->with('success', 'Asset updated successfully!');
    }

    /**
     * Show the form for creating a new property.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('action_asset.add');
    }

    /**
     * Store a newly created property in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'property_number' => 'required|string|max:255|unique:properties',
            'description' => 'required|string|max:255',
            'serial_number' => 'nullable|string|max:255',
            'office' => 'required|string|max:255',
            'date_purchase' => 'required|date',
            'accountable_person' => 'required|string|max:255',
            'acquisition_cost' => 'required|numeric',
            'status' => 'required|string|max:255',
            'inventory_remarks' => 'nullable|string',
        ]);

        Property::create($request->all());

        return redirect()->route('assets.index')->with('success', 'Asset added successfully!');
    }
}
