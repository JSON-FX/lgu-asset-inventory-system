<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use App\Models\Log; // Import the Log model

class Property extends Model
{
    use SoftDeletes;
    use HasFactory;

    protected $fillable = [
        'property_number',
        'description',
        'serial_number',
        'engine_number',
        'elc_number',
        'office_id',
        'category_id',
        'status_id',
        'employee_id',
        'date_purchase',
        'acquisition_cost',
        'inventory_remarks',
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
    }
}
