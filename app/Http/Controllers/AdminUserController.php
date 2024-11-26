<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

/**
 * Controller for managing regular users (customers) by administrators
 */
class AdminUserController extends Controller
{
    /**
     * Display a paginated list of all regular users
     */
    public function index()
    {
        $users = User::where('role', 'user')->paginate(10);
        return view('admin.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new user
     */
    public function create()
    {
        return view('admin.users.create');
    }

    /**
     * Store a newly created user in the database
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
        $validated['role'] = 'user';
        $validated['password'] = bcrypt($validated['password']);

        // Create the new user
        User::create($validated);

        return redirect()->route('admin.users.index')
            ->with('success', 'Customer created successfully');
    }

    /**
     * Show the form for editing a user
     * 
     * @param User $user The user to edit
     */
    public function edit(User $user)
    {
        // Ensure the user is actually a regular user
        if ($user->role !== 'user') {
            abort(403);
        }
        return view('admin.users.edit', compact('user'));
    }

    /**
     * Update the specified user in the database
     * 
     * @param Request $request Contains the form data
     * @param User $user The user to update
     */
    public function update(Request $request, User $user)
    {
        // Ensure the user is actually a regular user
        if ($user->role !== 'user') {
            abort(403);
        }

        // Validate the incoming request data
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        // Only update password if a new one was provided
        if (isset($validated['password'])) {
            $validated['password'] = bcrypt($validated['password']);
        } else {
            unset($validated['password']);
        }

        // Update the user's information
        $user->update($validated);

        return redirect()->route('admin.users.index')
            ->with('success', 'Customer updated successfully');
    }

    /**
     * Remove the specified user from the database
     * 
     * @param User $user The user to delete
     */
    public function destroy(User $user)
    {
        // Ensure the user is actually a regular user
        if ($user->role !== 'user') {
            abort(403);
        }
        
        // Delete the user
        $user->delete();
        return redirect()->route('admin.users.index')
            ->with('success', 'Customer deleted successfully');
    }
} 