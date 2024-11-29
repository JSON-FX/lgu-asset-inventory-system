<?php


namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

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
}
