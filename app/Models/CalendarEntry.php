<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CalendarEntry extends Model
{
    use HasFactory;

    protected $fillable = [
        'date',
        'total_assets',
        'description',
    ];

    protected $casts = [
        'date' => 'datetime',
    ];

    // Method to get total assets for a specific date
    public static function getTotalAssetsForDate($date)
    {
        return self::whereDate('date', $date)->sum('total_assets');
    }
}
