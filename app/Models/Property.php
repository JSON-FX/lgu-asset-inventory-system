<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
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
    public function getDateFormat()
    {
        return 'Y-m-d H:i:s';
    }

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