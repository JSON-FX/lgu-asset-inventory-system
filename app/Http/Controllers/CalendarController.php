<?php

// app/Http/Controllers/CalendarController.php

namespace App\Http\Controllers;

use App\Models\CalendarEntry;
use App\Models\Property;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CalendarController extends Controller
{
    // Show the calendar view with asset data for each day
    public function index(Request $request)
    {
        // Get the current month or the one passed via the request
        $currentMonth = Carbon::parse($request->input('month', Carbon::now()->format('Y-m')));

        // Get the previous and next months
        $previousMonth = $currentMonth->copy()->subMonth();
        $nextMonth = $currentMonth->copy()->addMonth();

        // Get all entries for the current month
        $calendarEntries = CalendarEntry::whereYear('date', $currentMonth->year)
            ->whereMonth('date', $currentMonth->month)
            ->get();

        return view('calendar.index', compact('calendarEntries', 'currentMonth', 'previousMonth', 'nextMonth'));
    }

    // Show assets for a specific day when clicked on
 // app/Http/Controllers/CalendarController.php

    public function showDay($date)
    {
        // Parse the date using Carbon
        $day = Carbon::parse($date);
    
        // Fetch the calendar entry for the given date
        $calendarEntry = CalendarEntry::whereDate('date', $date)->first();
    
        // Fetch properties added on the given date
        $properties = Property::whereDate('created_at', $date)->get();
    
        if ($properties->isEmpty()) {
            // Handle the case where no properties are found for the given date
            $totalAssets = 0; // No assets for this day
        } else {
            // Count total assets (number of properties added on this day)
            $totalAssets = $properties->count();
        }
    
        // Pass the data to the view
        return view('calendar.showDay', compact('calendarEntry', 'properties', 'date', 'totalAssets', 'day'));
    }
 



    // Store asset data for a specific day (admin functionality)
    public function store(Request $request)
    {
        $request->validate([
            'date' => 'required|date',
            'total_assets' => 'required|numeric',
            'description' => 'nullable|string',
        ]);

        CalendarEntry::create($request->all());

        return redirect()->route('calendar.index')->with('success', 'Data added successfully!');
    }
    
}
