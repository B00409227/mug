<?php

namespace App\Http\Controllers;

// Import necessary classes
use App\Models\Mug;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MugController extends Controller
{
    /**
     * Display a paginated list of mugs with search and sorting functionality
     */
    public function index(Request $request)
    {
        $query = Mug::query();

        // Filter mugs based on search term if provided
        if ($request->has('search')) {
            $search = $request->get('search');
            $query->where('name', 'like', "%{$search}%");
        }

        // Apply sorting based on user selection
        switch ($request->get('sort')) {
            case 'price_low':
                $query->orderBy('price', 'asc');
                break;
            case 'price_high':
                $query->orderBy('price', 'desc');
                break;
            case 'newest':
            default:
                $query->orderBy('created_at', 'desc');
                break;
        }

        $mugs = $query->paginate(12); // Adjust the number as needed
        
        return view('mugs.index', compact('mugs'));
    }

    /**
     * Display mugs belonging to the currently authenticated merchant
     */
    public function merchantMugs()
    {
        $mugs = Mug::where('user_id', auth()->id())->paginate(12);
        return view('merchant.mugs.index', compact('mugs'));
    }

    /**
     * Show the form for creating a new mug
     */
    public function create()
    {
        return view('merchant.mugs.create');
    }

    /**
     * Store a newly created mug in the database
     * Handles image upload and validation
     */
    public function store(Request $request)
    {
        // Validate incoming request data
        $validated = $request->validate([
            'name' => 'required|max:255',
            'description' => 'required',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'image' => 'required|image|mimes:jpeg,png,jpg,webp|max:2048'
        ]);

        // Handle image upload if present
        if ($request->hasFile('image')) {
            // Store image in public storage under 'mugs' directory
            $imagePath = $request->file('image')->store('mugs', 'public');
            $validated['image'] = $imagePath;
        }

        // Create new mug record with validated data
        Mug::create([
            'user_id' => auth()->id(),
            'name' => $validated['name'],
            'description' => $validated['description'],
            'price' => $validated['price'],
            'stock' => $validated['stock'],
            'image' => $validated['image'],
            'is_active' => true
        ]);

        return redirect()->route('merchant.dashboard')->with('success', 'Mug created successfully!');
    }

    /**
     * Show the form for editing a specific mug
     * Includes authorization check
     */
    public function edit(Mug $mug)
    {
        // Verify user has permission to update this mug
        $this->authorize('update', $mug);
        return view('merchant.mugs.edit', compact('mug'));
    }

    /**
     * Update the specified mug in the database
     * Handles image replacement and validation
     */
    public function update(Request $request, Mug $mug)
    {
        // Verify user has permission to update this mug
        $this->authorize('update', $mug);

        // Validate incoming request data
        $validated = $request->validate([
            'name' => 'required|max:255',
            'description' => 'required',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048'
        ]);

        // Handle image replacement if new image is uploaded
        if ($request->hasFile('image')) {
            // Delete old image if it exists
            if ($mug->image) {
                Storage::disk('public')->delete($mug->image);
            }
            // Store new image
            $validated['image'] = $request->file('image')->store('mugs', 'public');
        }

        $mug->update($validated);

        return redirect()->route('merchant.dashboard')->with('success', 'Mug updated successfully!');
    }

    /**
     * Remove the specified mug from the database
     * Includes cleanup of associated image file
     */
    public function destroy(Mug $mug)
    {
        // Verify user has permission to delete this mug
        $this->authorize('delete', $mug);
        
        // Clean up associated image file if it exists
        if ($mug->image) {
            Storage::disk('public')->delete($mug->image);
        }
        
        $mug->delete();

        return redirect()->route('merchant.dashboard')->with('success', 'Mug deleted successfully!');
    }

    /**
     * Display the specified mug
     */
    public function show(Mug $mug)
    {
        return view('mugs.show', compact('mug'));
    }
} 