<?php

namespace App\Http\Controllers;
use App\Models\Account;
use Illuminate\Http\Request;

class AccountController   extends Controller
{
    public function index()
    {
        // Retrieve all properties
        $account = Account::all();

        // Pass data to the 'category.blade.php' view
        return view('account', compact('account'));
    
    }
    public function showPropertiesByAccount()
    {
        // Retrieve properties grouped by specific statuses
        $accounts = account::whereIn('account_name', ['Unserviceable', 'Serviceable', 'Maintenance'])
            ->with('properties.account') // Eager load properties and their categories
            ->get();

        // Pass the statuses and associated properties to the view
        return view('properties_by_status', compact('accounts'));
    }

    public function edit($id)
    {
        // Find the category by ID
        $account = account::findOrFail($id);

        // Return the edit view with the account data
        return view('action_account.editaccount', compact('account'));
    }

    public function update(Request $request, $id)
    {
        // Validate incoming data
        $request->validate([
            'account_name' => 'required|string|max:255',
        ]);

        // Find the account by ID
        $account = account::findOrFail($id);

        // Update only the account name
        $account->update([
            'account_name' => $request->account_name,
        ]);

        // Redirect back to the account list with a success message
        return redirect()->route('account.index')->with('success', 'account updated successfully!');
    }
    public function create()
    {
        return view('action_account.addaccount');  // Return the 'create' view for adding a new asset
    }

    // Store a new asset
    public function store(Request $request)
    {
        // Validate the incoming request data
        $request->validate([
            'account_name' => 'required|string|max:255'
        ]);

        // Create a new asset
        account::create([
            'account_name' => $request->account_name,
        ]);

        // Redirect to the assets list page with a success message
        return redirect()->route('account.index')->with('success', 'account added successfully!');
    }
    
}