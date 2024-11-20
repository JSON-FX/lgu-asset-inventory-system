<?php

namespace App\Http\Controllers;
use App\Models\Users;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    public function index()
    {
        // Retrieve all properties
        $users = Users::all();

        // Pass data to the 'category.blade.php' view
        return view('users', compact('users'));
    
    }
}