<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Office;
use App\Models\Property;
use App\Models\Status;
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
        // Count the number of properties by category
        $propertiesByCategory = Category::count();

        // Count the number of properties by status
        $propertiesByStatus = Status::count();

        // Count the number of properties by office
        $propertiesByOffice = Office::count();

        // Count the total number of properties
        $totalProperties = Property::count();

        $totalTrash = Property::onlyTrashed()->count();


    

        // Pass data to the view
        return view('dashboard', compact('propertiesByCategory', 'propertiesByStatus', 'propertiesByOffice', 'totalProperties','totalTrash'));
    }
}
