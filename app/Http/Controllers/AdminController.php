<?php

namespace App\Http\Controllers;

// Import necessary classes
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Order;
use App\Models\Mug;

/**
 * Controller for handling admin-related functionality
 */
class AdminController extends Controller
{
    /**
     * Display the admin dashboard with summary statistics
     * 
     * @return \Illuminate\View\View
     */
    public function dashboard()
    {
        return view('admin.dashboard', [
            // Count of all regular users
            'totalUsers' => User::where('role', 'user')->count(),
            
            // Count of all merchant users
            'totalMerchants' => User::where('role', 'merchant')->count(),
            
            // Total number of mugs in the system
            'totalMugs' => Mug::count(),
        ]);
    }
}