<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PropertyController;
Route::get('/assets', [PropertyController::class, 'index'])->name('assets');

Route::patch('/asset/{id}', [PropertyController::class, 'update'])->name('asset.update');

Route::get('/asset/{id}/edit', [PropertyController::class, 'edit'])->name('asset.edit');

Route::get('/', function () {
    return view('welcome');
});

Route::get('/asset', [PropertyController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('asset');

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
