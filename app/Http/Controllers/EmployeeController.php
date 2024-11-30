<?php

namespace App\Http\Controllers;
use App\Models\Employee;
use Illuminate\Http\Request;

class EmployeeController   extends Controller
{
    public function index()
    {
        // Retrieve all properties
        $employee = Employee::all();

        // Pass data to the 'category.blade.php' view
        return view('users', compact('employee'));
    
    }
    public function edit($id)
    {
        // Find the category by ID
        $employee = Employee::findOrFail($id);

        // Return the edit view with the employee data
        return view('action_users.editusers', compact('employee'));
    }

    public function update(Request $request, $id)
    {
        // Validate incoming data
        $request->validate([
            'employee_name' => 'required|string|unique:employees,employee_name',

        ]);

        // Find the employee by ID
        $employee = Employee::findOrFail($id);

        // Update only the employee name
        $employee->update([
            'employee_name' => $request->employee_name,
        ]);

        // Redirect back to the employee list with a success message
        return redirect()->route('users.index')->with('success', 'employee updated successfully!');
    }
    public function create()
    {
        
        return view('action_users.addusers');  // Return the 'create' view for adding a new asset
    }

    // Store a new asset
    public function store(Request $request)
    {
        // Validate the incoming request data
        $request->validate([
            'employee_name' => 'required|string|unique:employees,employee_name',
        ], [
            'employee_name.unique' => 'User Name is already taken.',  // Custom error message
        ]);

        // Create a new asset
        Employee::create([
            'employee_name' => $request->employee_name,
        ]);

        // Redirect to the assets list page with a success message
        return redirect()->route('users.index')->with('success', 'employee added successfully!');
    }
    
}