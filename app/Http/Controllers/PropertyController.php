<?php

namespace App\Http\Controllers;

use App\Models\Property;
use App\Models\Category;
use App\Models\Office;
use App\Models\Status;
use App\Models\Employee;
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
        $properties = Property::with(['category', 'office', 'status', 'employee'])->get();
        return view('asset', compact('properties'));
    }

    /**
     * Show the form for creating a new property.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $categories = Category::all();
        $offices = Office::all();
        $statuses = Status::all();
        $employees = Employee::all();

        return view('action_asset.addasset', compact('categories', 'offices', 'statuses', 'employees'));
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
            'category_id' => 'required|exists:categories,id',
            'office_id' => 'required|exists:offices,id',
            'status_id' => 'required|exists:statuses,id',
            'employee_id' => 'required|exists:employees,id',
            'date_purchase' => 'nullable|date',
            'acquisition_cost' => 'nullable|numeric',
            'inventory_remarks' => 'nullable|string',
            
        ]);
        

        Property::create($request->all());

        return redirect()->route('asset')->with('success', 'Asset added successfully!');
    }

    /**
     * Show the form for editing the specified property.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $property = Property::findOrFail($id);
        $categories = Category::all();
        $offices = Office::all();
        $statuses = Status::all();
        $employees = Employee::all();

        return view('action_asset.edit', compact('property', 'categories', 'offices', 'statuses', 'employees'));
    }
    public function view($id)
    {
        $property = Property::findOrFail($id);
        $categories = Category::all();
        $offices = Office::all();
        $statuses = Status::all();
        $employees = Employee::all();

        return view('action_asset.view', compact('property', 'categories', 'offices', 'statuses', 'employees'));
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
        $property = Property::findOrFail($id);

        $request->validate([
            'property_number' => 'required|string|max:255|unique:properties,property_number,' . $property->id,
            'description' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'office_id' => 'required|exists:offices,id',
            'status_id' => 'required|exists:statuses,id',
            'employee_id' => 'required|exists:employees,id',
            'date_purchase' => 'nullable|date',
            'acquisition_cost' => 'nullable|numeric',
            'inventory_remarks' => 'nullable|string',
        ]);

        $property->update($request->all());

        return redirect()->route('asset')->with('success', 'Asset updated successfully!');
    }

    /**
     * Remove the specified property from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $property = Property::findOrFail($id);
        $property->delete();

        return redirect()->route('asset')->with('success', 'Asset deleted successfully!');
    }
}
