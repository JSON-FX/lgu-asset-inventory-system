<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Log; // Import the Log model

class Property extends Model
{
    use SoftDeletes;
    use HasFactory;

    protected $fillable = [
        'property_number',
        'description',
        'serial_number',
        'elc_number',
        'engine_number',
        'chasis_number',
        'plate_number',
        'office_id',
        'category_id',
        'status_id',
        'account_id',
        'employee_id',
        'employee_id2',
        'date_purchase',
        'acquisition_cost',
        'qty',
        'inventory_remarks',
        'image_path',
        
        
    ];

    // Define the custom date format for storing dates in the database
    public function getDateFormat()
    {
        return 'Y-m-d H:i:s';
    }

    // Cast attributes to appropriate data types
    protected $casts = [
        'date_purchase' => 'datetime',
        'deleted_at' => 'datetime',
    ];

    // Relationships
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function office()
    {
        return $this->belongsTo(Office::class);
    }

    public function status()
    {
        return $this->belongsTo(Status::class);
    }

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
    public function accounts()
    {
        return $this->belongsTo(Account::class);
    }

    protected static function booted()
    {
        static::created(function ($property) {
            Log::create([
                'activity' => 'Asset created: ' . $property->property_number,
                'model_type' => 'Property',
                'model_id' => $property->id,
                'user_id' => auth()->check() ? auth()->id() : null, // Check if authenticated
            ]);
        });

        static::updated(function ($property) {
            Log::create([
                'activity' => 'Asset updated: ' . $property->property_number,
                'model_type' => 'Property',
                'model_id' => $property->id,
                'user_id' => auth()->check() ? auth()->id() : null, // Check if authenticated
            ]);
        });

        static::deleted(function ($property) {
            Log::create([
                'activity' => 'Asset deleted: ' . $property->property_number,
                'model_type' => 'Property',
                'model_id' => $property->id,
                'user_id' => auth()->check() ? auth()->id() : null, // Check if authenticated
            ]);
        });
        static::created(function ($property) {
            // Get the date when the property was created
            $date = $property->created_at->format('Y-m-d');  // Use the created_at date of the property
        
            // Count how many properties were added on this day
            $totalAssets = Property::whereDate('created_at', $date)->count();  // Count the number of properties created on the same day
        
            // Find or create the CalendarEntry for the given date
            $calendarEntry = CalendarEntry::firstOrNew(['date' => $date]);
        
            // Update the total_assets count with the number of properties added that day
            $calendarEntry->total_assets = $totalAssets;
        
            // Save the updated calendar entry
            $calendarEntry->save();
        });
        
        
    }
    public function employee2()
    {
        return $this->belongsTo(Employee::class, 'employee_id2');

    }
    public function account()
    {
        return $this->belongsTo(Account::class);
    }

    
    


}
