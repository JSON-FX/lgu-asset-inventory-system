<?php

namespace App\Http\Controllers;
use App\Models\Status;
use Illuminate\Http\Request;

class StatusController extends Controller
{
    public function index()
    {
        // Retrieve all properties
        $status = Status::all();

        // Pass data to the 'category.blade.php' view
        return view('status', compact('status'));
    
    }
}