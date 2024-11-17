<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    protected $fillable = [
        'property_number', 'description', 'serial_number', 'engine_number', 'elc_number', 'office', 
        'date_purchase', 'accountable_person', 'acquisition_cost', 'user', 'status', 'inventory_remarks'
    ];

    public function getDateFormat()
    {
        return 'Y-m-d H:i:s';
    }
}