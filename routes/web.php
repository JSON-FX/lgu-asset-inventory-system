<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\StatusController;
use App\Http\Controllers\OfficeController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PropertyController;
use App\Http\Controllers\DashboardController;
use App\Exports\PropertiesExport;
use Maatwebsite\Excel\Facades\Excel;

Route::get('/properties/export', function () {
    return Excel::download(new PropertiesExport, 'properties.xlsx');
})->name('asset.export');

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

// Index of all assets
Route::get('/assetlist', [PropertyController::class, 'index'])->name('assets.index');

// Show form to create a new asset
Route::get('/create', [PropertyController::class, 'create'])->name('asset.create');


// Store a newly created asset in storage
Route::post('/asset', [PropertyController::class, 'store'])->name('asset.store');

// Show the form to edit the specified asset
Route::get('/asset/{id}/edit', [PropertyController::class, 'edit'])->name('asset.edit');

// Update the specified asset in storage
Route::put('/asset/{asset}', [PropertyController::class, 'update'])->name('asset.update');

// If you need a route to show a single asset, you might want to add:
// Route::get('/asset/{id}', [PropertyController::class, 'show'])->name('asset.show');
Route::get('/calendar', function () {
    return view('apps-calendar');}); 
// Home route
Route::get('/', function () {
    return view('welcome');
}); 
Route::get('/ecommerce-orders', function () {
    return view('ecommerce-orders');
}); 
Route::get('/form-elements', function () {
    return view('form-elements');
}); 
Route::get('/ecommerce-customers', function () {
    return view('ecommerce-customers');
}); 
Route::get('/ecommerce-add-product', function () {
    return view('ecommerce-add-product');
}); 
Route::get('/tables-datatable', function () {
    return view('tables-datatable');
}); 
Route::get('/form-elements', [PropertyController::class, 'create'])->name('asset.create');
Route::get('/form-elements', [PropertyController::class, 'store'])->name('asset.store');
// Route to show the 'Users Actions' 
Route::post('/users', [EmployeeController::class, 'store'])->name('users.store');
Route::get('/users/create', [EmployeeController::class, 'create'])->name('users.create');
Route::put('/users/{users}/', [EmployeeController::class, 'update'])->name('users.update');
Route::get('/users/{id}/editusers', [EmployeeController::class, 'edit'])->name('users.editusers');

// Route to show the 'Status Actions' 
Route::post('/status', [StatusController::class, 'store'])->name('status.store');
Route::get('/status/create', [StatusController::class, 'create'])->name('status.create');
Route::put('/status/{status}/', [StatusController::class, 'update'])->name('status.update');
Route::get('/status/{id}/editstatus', [StatusController::class, 'edit'])->name('status.editstatus');

// Route to show the 'Office Actions' 
Route::post('/office', [OfficeController::class, 'store'])->name('office.store');
Route::get('/office/create', [OfficeController::class, 'create'])->name('office.create');
Route::put('/office/{office}/', [OfficeController::class, 'update'])->name('office.update');
Route::get('/office/{id}/editoffice', [OfficeController::class, 'edit'])->name('office.editoffice');

// Route to show the 'Category Actions' 
Route::post('/category', [CategoryController::class, 'store'])->name('category.store');
Route::get('/category/create', [CategoryController::class, 'create'])->name('category.create');
Route::put('/category/{category}/', [CategoryController::class, 'update'])->name('category.update');
Route::get('/category/{id}/editcategory', [CategoryController::class, 'edit'])->name('category.editcategory');

// Route to show the 'Navigation pages' 
Route::get('/category', [CategoryController::class, 'index'])->middleware('auth')->name('category.index');
Route::get('/office', [OfficeController::class, 'index'])->middleware('auth')->name('office.index');
Route::get('/status', [StatusController::class, 'index'])->middleware('auth')->name('status.index');
Route::get('/users', [EmployeeController::class, 'index'])->middleware('auth')->name('users.index');

Route::get('/asset', [PropertyController::class, 'index'])
    ->middleware(['auth',   'verified'])->name('asset');



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Import the authentication routes
require __DIR__.'/auth.php';
