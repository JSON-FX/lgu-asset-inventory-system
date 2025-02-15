<?php

namespace App\Http\Controllers;

use App\Models\Account;
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
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;
use Barryvdh\DomPDF\Facade\Pdf;
use Intervention\Image\Facades\Image;
use Spatie\ImageOptimizer\OptimizerChainFactory;
use Carbon\Carbon;
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
        $accounts = Account::all();

        // Fetch properties based on filters
        $query = Property::with(['category', 'office', 'status', 'employee', 'accounts']);

        if ($request->has('acquisition_cost_filter') && $request->acquisition_cost_filter != '') {
            if ($request->acquisition_cost_filter == 'above_50k') {
                $query->where('acquisition_cost', '>=', 50000);
            } elseif ($request->acquisition_cost_filter == 'below_50k') {
                $query->where('acquisition_cost', '<', 50000);
            }
        }

        $properties = $query->get();

        return view('asset', compact('properties', 'categories', 'offices', 'statuses', 'employees','accounts'));
    }
    public function exportPARToExcel($propertyId)
    {
        // Retrieve the property from the database
        $property = Property::with(['category', 'office', 'status', 'employee','accounts'])->find($propertyId);

        // Path to the template Excel file
        $templatePath = public_path('assets/templates/par_template.xlsx');

        // Load the template Excel file
        $spreadsheet = IOFactory::load($templatePath);
        

        // Get the active sheet
        $sheet = $spreadsheet->getActiveSheet();
        $icsNumber = \Carbon\Carbon::now()->format('Y-m') . '-' . $property->id;
        $sheet->setCellValue('E7','PAR #. '. $icsNumber);
        $imagePath = storage_path('app/public/' . $property->image_path);

    // Insert the image into cell C26
        $drawing = new Drawing();
        $drawing->setName('Property Image');
        $drawing->setDescription('Image of the Property');
        $drawing->setPath($imagePath); // Path to the image file
        $drawing->setHeight(100); // Set image height (optional)
        $drawing->setCoordinates('D27'); // Cell where the image will be placed
        $drawing->setWorksheet($sheet);
        
        // Set values in the spreadsheet using property data
        // $sheet->setCellValue('G14', $property->id); 
        $sheet->setCellValue('A8', 'Fund Cluster: '.($property->account->account_name));
        $sheet->setCellValue('E8', 'PR#: '.($property->property_number));  // Property No.
        $sheet->setCellValue('D11', $property->serial_number);   // Serial No.
        $sheet->setCellValue('C11', $property->description);     // Description
        // $sheet->setCellValue('C11', $property->category->category_name); // Category
        $sheet->setCellValue('A7', 'Entity Name: '.($property->office->office_name));   
        $sheet->setCellValue('A50', $property->office->office_name);  // Office
        // $sheet->setCellValue('A41', $property->status->status_name);     // Status
        $sheet->setCellValue('F48', $property->employee->employee_name); // User
        $sheet->setCellValue('A48', $property->employee->employee_name); // User
        $sheet->setCellValue('E11', \Carbon\Carbon::parse($property->date_purchase)->format('F j, Y')); // Date Purchased
        $sheet->setCellValue('F11', number_format($property->acquisition_cost, 2)); 
        $sheet->setCellValue('G11', number_format($property->acquisition_cost, 2)); // Acquisition Cost
        // $sheet->setCellValue('E40', $property->inventory_remarks);  // Inventory Remarks

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
        $property = Property::with(['category', 'office', 'status', 'employee','account'])->find($propertyId);
        
        // Path to the template Excel file
        $templatePath = public_path('assets/templates/ics_template.xlsx');

        // Load the template Excel file
        $spreadsheet = IOFactory::load($templatePath);

        // Get the active sheet
        $sheet = $spreadsheet->getActiveSheet();
        $icsNumber = \Carbon\Carbon::now()->format('Y-m') . '-' . $property->id;
        $sheet->setCellValue('H10', $icsNumber);
        $imagePath = storage_path('app/public/' . $property->image_path);

    // Insert the image into cell C26
        $drawing = new Drawing();
        $drawing->setName('Property Image');
        $drawing->setDescription('Image of the Property');
        $drawing->setPath($imagePath); // Path to the image file
        $drawing->setHeight(100); // Set image height (optional)
        $drawing->setCoordinates('D24'); // Cell where the image will be placed
        $drawing->setWorksheet($sheet);
        
        // Set values in the spreadsheet using property data
        $sheet->setCellValue('G14', $property->id); 
        $sheet->setCellValue('C10', $property->account->account_name);
        $sheet->setCellValue('E39', $property->account->account_name);
        $sheet->setCellValue('G11', 'PR#: '.($property->property_number));  // Property No.
        $sheet->setCellValue('B2', $property->serial_number);   // Serial No.
        $sheet->setCellValue('E14', $property->description);     // Description
        $sheet->setCellValue('C11', $property->category->category_name); // Category
        $sheet->setCellValue('A51', $property->office->office_name);   
        $sheet->setCellValue('F51', $property->office->office_name);  // Office
        $sheet->setCellValue('A41', $property->status->status_name);     // Status
        $sheet->setCellValue('F48', $property->employee2->employee_name); // User
        $sheet->setCellValue('A48', $property->employee->employee_name); // User
        $sheet->setCellValue('E38', \Carbon\Carbon::parse($property->date_purchase)->format('F j, Y')); // Date Purchased
        $sheet->setCellValue('C14', number_format($property->acquisition_cost, 2));
        $sheet->setCellValue('A14', number_format($property->qty, 0));   // Acquisition Cost
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
        $accounts = Account::all();
        $employees = Employee::all();

        return view('action_asset.addasset', compact('categories', 'offices', 'statuses', 'employees','accounts'));
    }

    /**
     * Store a newly created property in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    

     public function store(Request $request)
     {
         // Validate the other form fields
         $validated = $request->validate([
             'property_number' => 'required|string|max:255',
             'description' => 'required|string',
             'category_id' => 'required|exists:categories,id',
             'office_id' => 'required|exists:offices,id',
             'status_id' => 'required|exists:statuses,id',
             'employee_id' => 'required|exists:employees,id',
             'employee_id2' => 'required|exists:employees,id',
             'account_id' => 'required|exists:accounts,id',
             'date_purchase' => 'nullable|date',
             'acquisition_cost' => 'nullable|numeric',
             'qty' => 'required|integer',
             'engine_number' => 'nullable|string',
             'elc_number' => 'nullable|string',
             'chasis_number' => 'nullable|string',
             'plate_number' => 'nullable|string',
             'inventory_remarks' => 'nullable|string',
             'serial_number' => 'nullable|string|max:255',
         ]);
     
         // Validate image upload
         if ($request->hasFile('image') && $request->file('image')->isValid()) {
             $image = $request->file('image');
     
            
            // Get the file extension
            $extension = $image->getClientOriginalExtension();

            // Create a new filename based on the property number
            $imageName = $request->property_number . '.' . $extension;

            // Store the image using the new name
            $imagePath = $image->storeAs('images', $imageName, 'public');

            // Full path of the uploaded image for optimization
            $imageFullPath = storage_path("app/public/{$imagePath}");
     
             // Resize the image (optional, set max width or height)
             $this->resizeAndCompressImage($imageFullPath);
         } else {
             // Handle error: No image uploaded or invalid image
             return back()->withErrors(['image' => 'Invalid image upload']);
         }
     
         // Store the property details along with the image path
         Property::create([
             'property_number' => $request->property_number,
             'description' => $request->description,
             'category_id' => $request->category_id,
             'office_id' => $request->office_id,
             'status_id' => $request->status_id,
             'account_id' => $request->account_id,
             'employee_id' => $request->employee_id,
             'employee_id2' => $request->employee_id2,
             'date_purchase' => $request->date_purchase,
             'acquisition_cost' => $request->acquisition_cost,
             'qty' => $request->qty,
             'inventory_remarks' => $request->inventory_remarks,
             'serial_number' => $request->serial_number,
             'chasis_number' => $request->chasis_number,
             'plate_number' => $request->plate_number,
             'engine_number' => $request->engine_number,
             'elc_number' => $request->elc_number,
             'image_path' => $imagePath,  // Store the image path in the database
         ]);
     
         session()->flash('success', 'Asset Added successfully!');
         // Redirect or return success message
         return redirect()->route('assetlist.index')->with('success', 'Property added successfully!');
     }
     
     /**
      * Resize and compress the image.
      */
     protected function resizeAndCompressImage($imagePath)

     {
        
         $image = Image::make($imagePath);
     
         // Resize the image to a maximum width of 1200px while maintaining aspect ratio
         $image->resize(1200, null, function ($constraint) {
             $constraint->aspectRatio();
             $constraint->upsize(); // Prevent enlarging smaller images
         });
     
         // Save the resized image (overwrite the original)
         $image->save($imagePath, 50);  // 70 represents the quality percentage (0-100)
     
         // Now apply Spatie Image Optimizer to compress the resized image
         $this->compressImage($imagePath);
     }
     
     /**
      * Compress the image without resizing it.
      */
     protected function compressImage($imagePath)
     {
         $optimizerChain = OptimizerChainFactory::create();
     
         // Optimize (compress) the uploaded image (without resizing)
         $optimizerChain->optimize($imagePath);
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
        $accounts = Account::all();
        

        return view('action_asset.edit', compact('property', 'categories', 'offices', 'statuses', 'employees', 'accounts'));
    }
    public function view($id)
    {
        $property = Property::findOrFail($id);
        $categories = Category::all();
        $offices = Office::all();
        $statuses = Status::all();
        $employees = Employee::all();
        $accounts = Account::all();

        return view('asset', compact('property', 'categories', 'offices', 'statuses', 'employees', 'accounts'));
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
    // Find the existing property
    $property = Property::findOrFail($id);

    // Validate the request input
    $request->validate([
        'property_number' => [
            'required',
            'string',
            'max:255',
            Rule::unique('properties', 'property_number')->ignore($property->id)
        ],
        'serial_number' => [
            'nullable',
            'string',
            Rule::unique('properties')->ignore($property->id),
        ],
        'description' => 'required|string|max:255',
        'category_id' => 'required|exists:categories,id',
        'office_id' => 'required|exists:offices,id',
        'status_id' => 'required|exists:statuses,id',
        'account_id' => 'required|exists:accounts,id',
        'employee_id' => 'required|exists:employees,id',
        'date_purchase' => 'nullable|date',
        'acquisition_cost' => 'nullable|numeric',
        'qty' => 'nullable|numeric|required',
        'inventory_remarks' => 'nullable|string',
        'engine_number' => 'nullable|string',
        'elc_number' => 'nullable|string',
        'chasis_number' => 'nullable|string',
        'plate_number' => 'nullable|string',
        'image' => 'nullable|image|mimes:jpg,jpeg,png,gif', // Image validation
    ]);
        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            // Delete the old image if it exists
            if ($property->image_path && file_exists(storage_path('app/public/' . $property->image_path))) {
                unlink(storage_path('app/public/' . $property->image_path));
            }

            // Handle the new image upload
            $image = $request->file('image');
            
            // Get the file extension
            $extension = $image->getClientOriginalExtension();
            
            // Create a new filename based on the property number
            $imageName = $request->property_number . '.' . $extension;

            // Store the new image using the new name
            $imagePath = $image->storeAs('images', $imageName, 'public'); 

            // Set the image path for the request
            $request->merge(['image_path' => $imagePath]);
        }

        // Update the property details
        $property->update($request->except('image')); // Exclude 'image' from mass assignment as it's handled above

        session()->flash('success', 'Asset updated successfully!');
        // Redirect with success message
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
    public function generatePDF()
    {
        $property = new Property();
        return $property->generatePDF();

    }
    public function searchProperties(Request $request)
    {
        $categories = Category::all();
        $offices = Office::all();
        $statuses = Status::all();
        $employees = Employee::all();
        $accounts = Account::all();
        $searchQuery = $request->input('query');
        
        // Fetch properties that match the query for either 'property_number' or 'description'
        $properties = Property::with(['status', 'category', 'office', 'employee', 'employee2', 'account'])
                            ->where('property_number', 'LIKE', '%' . $searchQuery . '%')
                            ->orWhere('description', 'LIKE', '%' . $searchQuery . '%')
                            ->get(['property_number','id', 'description','acquisition_cost','image_path','serial_number','employee_id','employee_id2','office_id','account_id','elc_number','engine_number','chasis_number','plate_number','inventory_remarks','status_id',]);
        
        // Return the results to a new view for displaying the search results
        return view('search-results', compact('properties', 'searchQuery', 'categories', 'offices', 'statuses', 'employees', 'accounts'));
    }
    public function index2(Request $request)
    {
        $perPage = request()->get('per_page', 10); // Default to 10 if no 'per_page' query parameter is provided

        // Load related data for properties with pagination
        $properties = Property::with(['office', 'category', 'status', 'account', 'employee', 'employee2'])
                       ->paginate($perPage); // Paginate the results
        // Load additional data for dropdowns or other purposes
        $categories = Category::all();
        $offices = Office::all();
        $statuses = Status::all();
        $employees = Employee::all();
        $accounts = Account::all();
        
        $query = Property::with(['category', 'office', 'status', 'employee', 'accounts']);

        if ($request->has('acquisition_cost_filter') && $request->acquisition_cost_filter != '') {
            if ($request->acquisition_cost_filter == 'above_50k') {
                $query->where('acquisition_cost', '>=', 50000);
            } elseif ($request->acquisition_cost_filter == 'below_50k') {
                $query->where('acquisition_cost', '<', 50000);
            }
        }

        $properties = $query->get();

        // Return the view with the required data
        return view('properties.index', compact('properties', 'categories', 'statuses', 'accounts', 'employees', 'offices'));
    }


    public function export(Request $request)
    {
        $selectedIds = $request->input('selected_ids');

        $properties = Property::with(['office', 'category', 'status', 'account', 'employee', 'employee2'])
            ->whereIn('id', $selectedIds)
            ->get();

        // Export to PDF or Excel
        $pdf = PDF::loadView('properties.export', compact('properties'));
        return $pdf->download('properties.pdf');
    }
    
    public function exportSelectedPropertiesToExcel(Request $request)
    {
        try {
            // Get the selected property IDs from the request
            $selectedIds = $request->input('selected_ids');
            
            // Check if the selectedIds array is not empty
            if (empty($selectedIds)) {
                return response()->json(['error' => 'No properties selected.'], 400);
            }
    
            // Retrieve the selected properties from the database
            $properties = Property::with(['category', 'office', 'status', 'employee', 'account'])
                                  ->whereIn('id', $selectedIds)
                                  ->get();
    
            // Check if properties were found
            if ($properties->isEmpty()) {
                return response()->json(['error' => 'No properties found for the selected IDs.'], 404);
            }
    
            // Path to the template Excel file
            $templatePath = public_path('assets/templates/ics_template.xlsx');
            
            // Check if the template exists
            if (!file_exists($templatePath)) {
                return response()->json(['error' => 'Template file not found.'], 500);
            }
    
            // Load the template Excel file
            $spreadsheet = IOFactory::load($templatePath);
            $sheet = $spreadsheet->getActiveSheet();
        
            $rowIndex = 10; // Start from row 10 for the first property
        
            foreach ($properties as $property) {
                // Set ICS Number
                $icsNumber = \Carbon\Carbon::now()->format('Y-m') . '-' . $property->id;
                $sheet->setCellValue('H' . $rowIndex, $icsNumber);
                
                // Set property data in the spreadsheet
                $sheet->setCellValue('G' . $rowIndex, $property->id); 
                $sheet->setCellValue('C' . $rowIndex, $property->account->account_name);
                $sheet->setCellValue('E' . $rowIndex, $property->description);     // Description
                $sheet->setCellValue('C' . ($rowIndex + 1), $property->category->category_name); // Category
                $sheet->setCellValue('A' . $rowIndex, $property->serial_number);   // Serial No.
                $sheet->setCellValue('F' . $rowIndex, $property->status->status_name);     // Status
                $sheet->setCellValue('A' . ($rowIndex + 1), $property->employee->employee_name); // User
                $sheet->setCellValue('E' . ($rowIndex + 2), \Carbon\Carbon::parse($property->date_purchase)->format('F j, Y')); // Date Purchased
                $sheet->setCellValue('C' . ($rowIndex + 3), number_format($property->acquisition_cost, 2)); // Acquisition Cost
                $sheet->setCellValue('F' . ($rowIndex + 3), number_format($property->qty, 0));   // Quantity
                $sheet->setCellValue('E' . ($rowIndex + 4), $property->inventory_remarks);  // Inventory Remarks
                
                // Insert the image into the spreadsheet (if needed)
                $imagePath = storage_path('app/public/' . $property->image_path);
                if (file_exists($imagePath)) {
                    $drawing = new \PhpOffice\PhpSpreadsheet\Worksheet\Drawing();
                    $drawing->setName('Property Image');
                    $drawing->setDescription('Image of the Property');
                    $drawing->setPath($imagePath); // Path to the image file
                    $drawing->setHeight(100); // Set image height (optional)
                    $drawing->setCoordinates('D' . ($rowIndex + 1)); // Cell where the image will be placed
                    $drawing->setWorksheet($sheet);
                }
        
                // Move to the next row for the next property
                $rowIndex += 6; // Increase the row index for the next property (adjust as needed)
            }
        
            // Save the modified Excel file and return it as a downloadable stream
            $writer = new Xlsx($spreadsheet);
        
            return response()->stream(function() use ($writer) {
                $writer->save('php://output');
            }, 200, [
                'Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
                'Content-Disposition' => 'attachment; filename="properties_export.xlsx"',
            ]);
    
        } catch (\Exception $e) {
            // Log the error message
            Log::error('Error exporting properties: ' . $e->getMessage());
    
            // Return a generic error response
            return response()->json(['error' => 'Error exporting the selected properties.'], 500);
        }
    }
}