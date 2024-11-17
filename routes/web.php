<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Testcontroller;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/asset', function () {
    return view('asset');
})->middleware(['auth', 'verified'])->name('asset');


// Define the route for asset view
Route::get('/asset', [AdminController::class, 'index'])->name('asset'); // Adding the 'asset' route name


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
