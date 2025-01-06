<?php

namespace App\Http\Controllers;
use App\Models\Log;
use App\Models\Property;
use App\Models\Category;
use App\Models\Office;
use App\Models\Status;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
class PropertyController extends Controller
{
    /**
     * Display a listing of the properties.
     *
     * @return \Illuminate\View\View
     */
    
     public function index(Request $request)
    {
        $categories = Category::all();
        $offices = Office::all();
        $statuses = Status::all();
        $employees = Employee::all();

        // Fetch properties based on filters
        $query = Property::with(['category', 'office', 'status', 'employee']);

        if ($request->has('acquisition_cost_filter') && $request->acquisition_cost_filter != '') {
            if ($request->acquisition_cost_filter == 'above_50k') {
                $query->where('acquisition_cost', '>=', 50000);
            } elseif ($request->acquisition_cost_filter == 'below_50k') {
                $query->where('acquisition_cost', '<', 50000);
            }
        }

        $properties = $query->get();

        return view('asset', compact('properties', 'categories', 'offices', 'statuses', 'employees'));
    }
    public function exportPARToExcel($propertyId)
    {
        // Retrieve the property from the database
        $property = Property::with(['category', 'office', 'status', 'employee'])->find($propertyId);

        // Path to the template Excel file
        $templatePath = public_path('assets/templates/par_template.xlsx');

        // Load the template Excel file
        $spreadsheet = IOFactory::load($templatePath);

        // Get the active sheet
        $sheet = $spreadsheet->getActiveSheet();
        $icsNumber = \Carbon\Carbon::now()->format('Y-m') . '-' . $property->id;
        $sheet->setCellValue('E7','PAR #. '. $icsNumber);
        
        // Set values in the spreadsheet using property data
        $sheet->setCellValue('G14', $property->id); 
        $sheet->setCellValue('E8', 'PR#: '.($property->property_number));  // Property No.
        $sheet->setCellValue('D14', $property->serial_number);   // Serial No.
        $sheet->setCellValue('C11', $property->description);     // Description
        $sheet->setCellValue('C11', $property->category->category_name); // Category
        $sheet->setCellValue('A7', $property->office->office_name);   
        $sheet->setCellValue('A50', $property->office->office_name);  // Office
        $sheet->setCellValue('A41', $property->status->status_name);     // Status
        $sheet->setCellValue('F48', $property->employee->employee_name); // User
        $sheet->setCellValue('A48', $property->employee->employee_name); // User
        $sheet->setCellValue('E11', \Carbon\Carbon::parse($property->date_purchase)->format('m-d-Y')); // Date Purchased
        $sheet->setCellValue('F11', '₱' . number_format($property->acquisition_cost, 2)); 
        $sheet->setCellValue('G11', '₱' . number_format($property->acquisition_cost, 2)); // Acquisition Cost
        $sheet->setCellValue('E40', $property->inventory_remarks);  // Inventory Remarks

        // Save the modified Excel file
        $writer = new Xlsx($spreadsheet);

        // Define output path
        return response()->stream(function() use ($writer) {
            $writer->save('php://output');  // Output the file directly to the browser
        }, 200, [
            'Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',  // Excel MIME type
            'Content-Disposition' => 'attachment; filename="property_' . $property->description . '_export.xlsx"',  // Download prompt with file name
        ]);
    }
    public function exportICSToExcel($propertyId)
    {
        // Retrieve the property from the database
        $property = Property::with(['category', 'office', 'status', 'employee'])->find($propertyId);

        // Path to the template Excel file
        $templatePath = public_path('assets/templates/ics_template.xlsx');

        // Load the template Excel file
        $spreadsheet = IOFactory::load($templatePath);

        // Get the active sheet
        $sheet = $spreadsheet->getActiveSheet();
        $icsNumber = \Carbon\Carbon::now()->format('Y-m') . '-' . $property->id;
        $sheet->setCellValue('H10', $icsNumber);
        
        // Set values in the spreadsheet using property data
        $sheet->setCellValue('G14', $property->id); 
        $sheet->setCellValue('G11', 'PR#: '.($property->property_number));  // Property No.
        $sheet->setCellValue('B2', $property->serial_number);   // Serial No.
        $sheet->setCellValue('E14', $property->description);     // Description
        $sheet->setCellValue('C11', $property->category->category_name); // Category
        $sheet->setCellValue('A51', $property->office->office_name);   
        $sheet->setCellValue('F51', $property->office->office_name);  // Office
        $sheet->setCellValue('A41', $property->status->status_name);     // Status
        $sheet->setCellValue('F48', $property->employee->employee_name); // User
        $sheet->setCellValue('A48', $property->employee->employee_name); // User
        $sheet->setCellValue('E38', \Carbon\Carbon::parse($property->date_purchase)->format('m-d-Y')); // Date Purchased
        $sheet->setCellValue('D14', '₱' . number_format($property->acquisition_cost, 2));  // Acquisition Cost
        $sheet->setCellValue('E40', $property->inventory_remarks);  // Inventory Remarks

        // Save the modified Excel file
        $writer = new Xlsx($spreadsheet);

        // Define output path
        return response()->stream(function() use ($writer) {
            $writer->save('php://output');  // Output the file directly to the browser
        }, 200, [
            'Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',  // Excel MIME type
            'Content-Disposition' => 'attachment; filename="property_' . $property->description . '_export.xlsx"',  // Download prompt with file name
        ]);
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
            'date_purchase' => 'nullable|date|required|string',
            'acquisition_cost' => 'nullable|numeric|required',
            'inventory_remarks' => 'nullable|string',
            'serial_number' => 'required|string|unique:properties',
            
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

        return view('asset', compact('property', 'categories', 'offices', 'statuses', 'employees'));
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
            'property_number' => [
                'required',
                'string',
                'max:255',
                Rule::unique('properties', 'property_number')->ignore($property->id)
            ],
            'serial_number' => [
                'required',
                'string',
                Rule::unique('properties')->ignore($property->id),
            ],
            'description' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'office_id' => 'required|exists:offices,id',
            'status_id' => 'required|exists:statuses,id',
            'employee_id' => 'required|exists:employees,id',
            'date_purchase' => 'nullable|date|required|string',
            'acquisition_cost' => 'nullable|numeric|required',
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
    public function trash()
    {
        // Fetch only soft-deleted properties
        $trashedProperties = Property::onlyTrashed()->get();

        // Return a view and pass the data
        return view('action_asset.trash', compact('trashedProperties'));
    }
    public function restore($id)
    {
        // Find the soft-deleted property and restore it
        $property = Property::onlyTrashed()->findOrFail($id);
        $property->restore();

        return redirect()->route('asset.trash')->with('success', 'Property restored successfully!');
    }
    public function forceDelete($id)
    {
        // Find the soft-deleted property and permanently delete it
        $property = Property::onlyTrashed()->findOrFail($id);
        $deletedAt = $property->deleted_at;
        $property->forceDelete();

        return redirect()->route('asset.trash')->with('success', 'Property permanently deleted!');
    }



}
