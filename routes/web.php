<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\StatusController;
use App\Http\Controllers\OfficeController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PropertyController;

Route::get('/assets', [PropertyController::class, 'index'])->name('assets');

// Route to show the 'Add Asset' form
Route::get('/asset/create', [PropertyController::class, 'create'])->name('asset.create');

// Route to handle the form submission (store)
Route::post('/asset', [PropertyController::class, 'store'])->name('asset.store');

Route::get('/asset/create', [PropertyController::class, 'create'])->name('asset.create');
Route::post('/asset', [PropertyController::class, 'store'])->name('asset.store');

Route::get('/assets', [PropertyController::class, 'index'])->name('assets');

Route::patch('/asset/{id}', [PropertyController::class, 'update'])->name('asset.update');

Route::get('/asset/{id}/edit', [PropertyController::class, 'edit'])->name('asset.edit');

Route::get('/', function () {
    return view('welcome');
});

Route::post('/category', [CategoryController::class, 'store'])->name('category.store');
Route::get('/category/create', [CategoryController::class, 'create'])->name('category.create');
Route::patch('/category/{id}/', [CategoryController::class, 'update'])->name('category.update');
Route::get('/category/{id}/editcategory', [CategoryController::class, 'edit'])->name('category.editcategory');
// Route to show the 'Navigation pages' 
Route::get('/category', [CategoryController::class, 'index'])->middleware('auth')->name('category.index');
Route::get('/office', [OfficeController::class, 'index'])->middleware('auth')->name('office.index');
Route::get('/status', [StatusController::class, 'index'])->middleware('auth')->name('status.index');
Route::get('/users', [UsersController::class, 'index'])->middleware('auth')->name('users.index');

Route::get('/asset', [PropertyController::class, 'index'])
    ->middleware(['auth',   'verified'])->name('asset');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Import the authentication routes
require __DIR__.'/auth.php';
