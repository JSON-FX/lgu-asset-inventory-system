<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\StatusController;
use App\Http\Controllers\OfficeController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PropertyController;
use App\Http\Controllers\DashboardController;
use App\Exports\PropertiesExport;
use App\Http\Controllers\AccountController;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Http\Controllers\LogController;
use App\Http\Controllers\CalendarController;
use App\Http\Controllers\ExcelController;


// Home-Index route/login page
Route::get('/', function () {
    return view('auth.login');
}); 

Route::middleware(['auth'])->group(function () {
    //ICS-PAR GENERATOR
    Route::get('property/export-ICS/{propertyId}', [PropertyController::class, 'exportICSToExcel'])->name('property.export');
    Route::get('property/export-PAR/{propertyId}', [PropertyController::class, 'exportPARToExcel'])->name('property2.export');

    // Route to show the 'Dashboard Actions' 
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    //Route to show the 'Calendar Actions' 
    Route::get('calendar', [CalendarController::class, 'index'])->name('calendar.index');
    Route::get('calendar/{date}', [CalendarController::class, 'showDay'])->name('calendar.showDay');
    Route::post('calendar', [CalendarController::class, 'store'])->name('calendar.store');

    // Route to show the 'Asset Actions' 
    Route::get('/asset-list', [PropertyController::class, 'index'])->name('assetlist.index');
    Route::post('/add-asset', [PropertyController::class, 'store'])->name('asset.store');
    Route::get('/add-asset', [PropertyController::class, 'create'])->name('assetlist.create');
    Route::put('/update-asset/{assetlist}/', [PropertyController::class, 'update'])->name('assetlist.update');
    Route::get('/asset/delete/{id}', [PropertyController::class, 'destroy'])->name('assetlist.delete');//softdelete
    Route::get('/asset/{id}/edit', [PropertyController::class, 'edit'])->name('assetlist.editassetlist');
    Route::get('/asset/{id}/view', [PropertyController::class, 'view'])->name('asset.view');
    Route::get('/asset/trash', [PropertyController::class, 'trash'])->name('asset.trash');//trash view,
    Route::get('/asset/restore/{id}', [PropertyController::class, 'restore'])->name('asset.restore');
    Route::delete('/asset/force-delete/{id}', [PropertyController::class, 'forceDelete'])->name('asset.forceDelete');//permanent delete'
    Route::get('/log', [LogController::class, 'show'])->name('asset.log');


    // Route to show the 'Users Actions' 
    Route::post('/users', [EmployeeController::class, 'store'])->name('users.store');
    Route::get('/users/create', [EmployeeController::class, 'create'])->name('users.create');
    Route::put('/users/{users}/', [EmployeeController::class, 'update'])->name('users.update');
    Route::get('/users/{id}/editusers', [EmployeeController::class, 'edit'])->name('users.editusers');
    
    // Route to show the 'Account Actions' 
    Route::post('/account', [AccountController::class, 'store'])->name('account.store');
    Route::get('/account/create', [AccountController::class, 'create'])->name('account.create');
    Route::put('/account/{account}/', [AccountController::class, 'update'])->name('account.update');
    Route::get('/account/{id}/editstatus', [AccountController::class, 'edit'])->name('account.editstatus');
    Route::get('/asset-by-account', [AccountController::class, 'showPropertiesByStatus'])->name('properties.by.account');
    // Route to show the 'Status Actions' 
    Route::post('/status', [StatusController::class, 'store'])->name('status.store');
    Route::get('/status/create', [StatusController::class, 'create'])->name('status.create');
    Route::put('/status/{status}/', [StatusController::class, 'update'])->name('status.update');
    Route::get('/status/{id}/editstatus', [StatusController::class, 'edit'])->name('status.editstatus');
    Route::get('/asset-by-status', [StatusController::class, 'showPropertiesByStatus'])->name('properties.by.status');

    // Route to show the 'Office Actions' 
    Route::post('/office', [OfficeController::class, 'store'])->name('offices.store');
    Route::get('/office/create', [OfficeController::class, 'create'])->name('offices.create');
    Route::put('/office/{office}/', [OfficeController::class, 'update'])->name('offices.update');
    Route::get('/office/{id}/editoffice', [OfficeController::class, 'edit'])->name('offices.editoffice');

    // Route to show the 'Category Actions' 
    Route::post('/category', [CategoryController::class, 'store'])->name('category.store');
    Route::get('/category/create', [CategoryController::class, 'create'])->name('category.create');
    Route::put('/category/{category}/', [CategoryController::class, 'update'])->name('category.update');
    Route::get('/category/{id}/editcategory', [CategoryController::class, 'edit'])->name('category.editcategory');
    Route::get('/category-assets', [CategoryController::class, 'showPropertiesByCategory'])->name('category.properties');

    // Route to show the 'Navigation pages' 
    Route::get('/category', [CategoryController::class, 'index'])->middleware('auth')->name('category.index');
    Route::get('/office', [OfficeController::class, 'index'])->middleware('auth')->name('office.index');
    Route::get('/status', [StatusController::class, 'index'])->middleware('auth')->name('status.index');
    Route::get('/users', [EmployeeController::class, 'index'])->middleware('auth')->name('users.index');
    Route::get('/asset', [PropertyController::class, 'index',])->middleware(['auth',   'verified'])->name('asset');
    Route::get('/account', [AccountController::class, 'index'])->middleware('auth')->name('account.index');

    // Route to show the 'Profile pages' 
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Export Excel modal File routes
    Route::get('/properties/exportexcel/{id}', function ($id) {
        return Excel::download(new PropertiesExport($id), 'asset.xlsx');
    })->name('asset.exportexcel');


    // Export PDF modal File routes
    Route::get('/properties/{id}/exportpdf', function ($id) {
        $property = App\Models\Property::with(['category', 'office', 'status', 'employee'])->findOrFail($id); // Fetch property and relationships
        return Pdf::loadView('properties.pdf', compact('property'))
                ->stream('property-' . $property->id . '.pdf'); // Generate and download PDF
    })->name('asset.exportpdf');
});



// Import the authentication routes
require __DIR__.'/auth.php';
