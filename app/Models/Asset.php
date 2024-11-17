<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Asset extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'description', 'asset_code', 'category_id', 'location_id', 'condition', 'status', 'purchase_date', 'purchase_price', 'serial_number'
    ];

    // Define the relationship with the Category model
    public function category()
    {
        return $this->belongsTo(Category::class);  // An asset belongs to one category
    }

    // Define the relationship with the Location model
    public function location()
    {
        return $this->belongsTo(Location::class);  // An asset belongs to one location
    }
}
