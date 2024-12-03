<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Log; // Use your Log model or database query to fetch logs


class LogController extends Controller
{
    public function show()
    {
        // Fetch logs with their related user data
        $logs = Log::with('user')->get();
        return view('action_asset.log', ['logs' => $logs]);
    }
}
