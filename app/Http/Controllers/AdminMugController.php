<?php

namespace App\Http\Controllers;

use App\Models\Mug;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminMugController extends Controller
{
    // Shows the list of all mugs to the admin
    // This is what loads when you visit /admin/mugs
    public function index()
    {
        // Get all mugs from database, 10 per page
        // 'with('user')' loads the merchant info for each mug to avoid database slowdown
        $mugs = Mug::with('user')->paginate(10);
        
        // Show the admin view with the mugs data
        return view('admin.mugs.index', compact('mugs'));
    }

    // Shows the form to create a new mug
    // This loads when you visit /admin/mugs/create
    public function create()
    {
        return view('admin.mugs.create');
    }

    // Handles saving a new mug to the database
    // This runs when you submit the create mug form
    public function store(Request $request)
    {
        // Check if all the submitted data is valid
        $validated = $request->validate([
            'name' => 'required|string|max:255',        // Mug must have a name
            'description' => 'required|string',         // Must have a description
            'price' => 'required|numeric|min:0',        // Price must be a positive number
            'stock' => 'required|integer|min:0',        // Stock must be a whole number
            'image' => 'required|image|mimes:webp,jpeg,png,jpg,gif|max:2048' // Must be an image file
        ]);

        // If an image was uploaded with the form
        if ($request->hasFile('image')) {
            // Get the original filename
            $filename = $request->file('image')->getClientOriginalName();
            // Store the image in the public storage folder
            $path = $request->file('image')->storeAs('mugs', $filename, 'public');
            $validated['image'] = $path;
        }

        // Add the current user's ID to the mug data
        $validated['user_id'] = auth()->id();
        
        // Create the new mug in the database
        Mug::create($validated);

        // Redirect back to the mug list with a success message
        return redirect()->route('admin.mugs.index')
            ->with('success', 'Mug created successfully');
    }

    // Shows the form to edit an existing mug
    // This loads when you visit /admin/mugs/{mug}/edit
    public function edit(Mug $mug)
    {
        return view('admin.mugs.edit', compact('mug'));
    }

    // Handles updating an existing mug
    // This runs when you submit the edit mug form
    public function update(Request $request, Mug $mug)
    {
        // Validate all the submitted data
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'image' => 'nullable|image|mimes:webp,jpeg,png,jpg,gif|max:2048'
        ]);

        // If a new image was uploaded
        if ($request->hasFile('image')) {
            // Delete the old image if it exists
            if ($mug->image && Storage::disk('public')->exists($mug->image)) {
                Storage::disk('public')->delete($mug->image);
            }
            
            // Save the new image
            $filename = $request->file('image')->getClientOriginalName();
            $path = $request->file('image')->storeAs('mugs', $filename, 'public');
            $validated['image'] = $path;
        }

        // Update the mug in the database
        $mug->update($validated);

        // Redirect back to mug list with success message
        return redirect()->route('admin.mugs.index')
            ->with('success', 'Mug updated successfully');
    }

    // Handles deleting a mug
    // This runs when you click the delete button
    public function destroy(Mug $mug)
    {
        // Delete the mug from the database
        $mug->delete();
        
        // Redirect back with success message
        return redirect()->route('admin.mugs.index')
            ->with('success', 'Mug deleted successfully');
    }
} 