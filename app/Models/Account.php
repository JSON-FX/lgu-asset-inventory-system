<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    protected $fillable = ['account_name'];

    public function properties()
    {
        return $this->hasMany(Property::class);
    }
}
