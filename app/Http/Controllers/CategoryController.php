<?php

namespace App\Http\Controllers;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        // Retrieve all properties
        $category = Category::all();

        // Pass data to the 'category.blade.php' view
        return view('category', compact('category'));
    
    }
    public function edit($id)
    {
        // Find the category by ID
        $category = Category::findOrFail($id);

        // Return the edit view with the category data
        return view('action_category.editcategory', compact('category'));
    }

    public function update(Request $request, $id)
    {
        // Validate incoming data
        $request->validate([
            'category_name' => 'required|string|max:255',
        ]);

        // Find the category by ID
        $category = Category::findOrFail($id);

        // Update only the category name
        $category->update([
            'category_name' => $request->category_name,
        ]);

        // Redirect back to the category list with a success message
        return redirect()->route('category.index')->with('success', 'Category updated successfully!');
    }
    public function create()
    {
        return view('action_category.addcategory');  // Return the 'create' view for adding a new asset
    }

    // Store a new asset
    public function store(Request $request)
    {
        // Validate the incoming request data
        $request->validate([
            'category_name' => 'required|string|max:255'
        ]);

        // Create a new asset
        Category::create([
            'category_name' => $request->category_name,
        ]);

        // Redirect to the assets list page with a success message
        return redirect()->route('category.index')->with('success', 'Category added successfully!');
    }
    
}