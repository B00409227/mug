<?php

namespace App\Http\Controllers;

// Import necessary classes
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    /**
     * Show the form for editing the user's profile
     */
    public function edit()
    {
        return view('profile.edit', [
            'user' => Auth::user()
        ]);
    }

    /**
     * Update the user's profile information
     * Handles both basic info updates and password changes
     */
    public function update(Request $request)
    {
        /** @var User $user */
        $user = Auth::user();
        
        // Validate incoming request data
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            // Ensure email is unique except for current user
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            // Password fields are optional but must follow rules if provided
            'current_password' => 'nullable|required_with:new_password',
            'new_password' => 'nullable|min:8|confirmed',
        ]);

        // Handle password update if requested
        if ($request->filled('current_password')) {
            // Verify current password is correct
            if (!Hash::check($request->current_password, $user->password)) {
                return back()->withErrors(['current_password' => 'The current password is incorrect.']);
            }
            // Hash and set new password
            $user->password = Hash::make($validated['new_password']);
        }

        // Update basic profile information
        $user->name = $validated['name'];
        $user->email = $validated['email'];
        $user->save();

        // Redirect back with success message
        return back()->with('success', 'Profile updated successfully.');
    }
}
