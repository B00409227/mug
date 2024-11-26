<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

/**
 * Controller for managing merchant users by administrators
 */
class AdminMerchantController extends Controller
{
    /**
     * Display a paginated list of all merchants
     */
    public function index()
    {
        $merchants = User::where('role', 'merchant')->paginate(10);
        return view('admin.merchants.index', compact('merchants'));
    }

    /**
     * Show the form for creating a new merchant
     */
    public function create()
    {
        return view('admin.merchants.create');
    }

    /**
     * Store a newly created merchant in the database
     * 
     * @param Request $request Contains the form data
     */
    public function store(Request $request)
    {
        // Validate the incoming request data
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        // Set the role and encrypt the password
        $validated['role'] = 'merchant';
        $validated['password'] = bcrypt($validated['password']);

        // Create the new merchant user
        User::create($validated);

        return redirect()->route('admin.merchants.index')
            ->with('success', 'Merchant created successfully');
    }

    /**
     * Show the form for editing a merchant
     * 
     * @param User $merchant The merchant to edit
     */
    public function edit(User $merchant)
    {
        // Ensure the user is actually a merchant
        if ($merchant->role !== 'merchant') {
            abort(403);
        }
        return view('admin.merchants.edit', compact('merchant'));
    }

    /**
     * Update the specified merchant in the database
     * 
     * @param Request $request Contains the form data
     * @param User $merchant The merchant to update
     */
    public function update(Request $request, User $merchant)
    {
        // Ensure the user is actually a merchant
        if ($merchant->role !== 'merchant') {
            abort(403);
        }

        // Validate the incoming request data
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($merchant->id)],
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        // Only update password if a new one was provided
        if (isset($validated['password'])) {
            $validated['password'] = bcrypt($validated['password']);
        } else {
            unset($validated['password']);
        }

        // Update the merchant's information
        $merchant->update($validated);

        return redirect()->route('admin.merchants.index')
            ->with('success', 'Merchant updated successfully');
    }

    /**
     * Remove the specified merchant from the database
     * 
     * @param User $merchant The merchant to delete
     */
    public function destroy(User $merchant)
    {
        // Ensure the user is actually a merchant
        if ($merchant->role !== 'merchant') {
            abort(403);
        }

        // Optional: Delete associated mugs or transfer them to another merchant
        // $merchant->mugs()->delete();
        
        // Delete the merchant
        $merchant->delete();
        return redirect()->route('admin.merchants.index')
            ->with('success', 'Merchant deleted successfully');
    }
} 