<?php

// app/Models/Category.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    // Optional: Define the table name if different from 'categories'
    // protected $table = 'categories';

    // Optional: Define the primary key if not 'id'
    // protected $primaryKey = 'id';

    // Optional: Disable timestamps if you don't want to use them
    // public $timestamps = false;

    // Define the relationship with the `Asset` model
    public function assets()
    {
        return $this->hasMany(Asset::class);
    }
}
