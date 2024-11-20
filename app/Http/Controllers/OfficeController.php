<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Office;

class OfficeController extends Controller
{
    public function index()
    {
        // Retrieve all properties
        $office = Office::all();

        // Pass data to the 'category.blade.php' view
        return view('office', compact('office'));
    
    }
}