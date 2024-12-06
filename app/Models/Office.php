<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Office extends Model
{
    use SoftDeletes;

    protected $fillable = ['office_name'];

    // Define the relationship with Property
    public function properties()
    {
        return $this->hasMany(Property::class);
    }
}
