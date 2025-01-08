<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Office;
use App\Models\Property;
use App\Models\Status;
use App\Models\CalendarEntry;
use Illuminate\Http\Request;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        // Count the number of properties by category
        $propertiesByCategory = Category::count();

        // Count the number of properties by status
        $propertiesByStatus = Status::count();

        // Count the number of properties by office
        $propertiesByOffice = Office::count();

        // Count the total number of properties
        $totalProperties = Property::count();

        // Count the number of properties in the trash
        $totalTrash = Property::onlyTrashed()->count();

        // Get the current month or the selected month
        $currentMonth = Carbon::parse($request->input('month', Carbon::now()->format('Y-m')));

        // Get the previous and next months
        $previousMonth = $currentMonth->copy()->subMonth();
        $nextMonth = $currentMonth->copy()->addMonth();

        // Get all calendar entries for the current month
        $calendarEntries = CalendarEntry::whereYear('date', $currentMonth->year)
            ->whereMonth('date', $currentMonth->month)
            ->get();

        // Get offices with their respective property count
        $officesWithProperties = Office::withCount('properties')
            ->orderBy('properties_count', 'desc')
            ->take(5)
            ->get();

        // Fetch properties to display on the dashboard
        $properties = Property::with(['category', 'office', 'status', 'employee', 'accounts'])
            ->get();

        // Pass all the data to the view
        return view('dashboard', compact(
            'propertiesByCategory',
            'propertiesByStatus',
            'propertiesByOffice',
            'totalProperties',
            'totalTrash',
            'officesWithProperties',
            'calendarEntries',
            'currentMonth',
            'previousMonth',
            'nextMonth',
            'properties'  // Pass the properties data
        ));
    }
}
