<?php

namespace App\Http\Controllers;

use App\Models\Property;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    /**
     * Show the dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Query to count the number of properties by category_id
        $propertiesByCategory = Property::select('category_id', DB::raw('count(*) as total'))
            ->groupBy('category_id',)
            ->pluck('total', 'category_id');
            

        // Count the total number of properties
        $totalProperties = Property::count();

        // Pass data to the view
        return view('dashboard', compact('propertiesByCategory', 'totalProperties'));
    }
}
