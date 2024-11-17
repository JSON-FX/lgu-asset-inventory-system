<?php

namespace App\Http\Controllers;

use App\Models\Asset;  // Make sure to import the Asset model
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        // Fetch all assets with their related category and location
        $assets = Asset::with(['category', 'location'])->get(); // Eager load category and location

        // Return the 'asset' view with the assets data
        return view('asset', compact('assets'));
    }
}
