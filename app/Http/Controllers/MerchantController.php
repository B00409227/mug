<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/**
 * Handles merchant-specific functionality and views.
 */
class MerchantController extends Controller
{
    /**
     * Display the merchant's dashboard with their mugs.
     * 
     * @return \Illuminate\View\View
     */
    public function dashboard()
    {
        /** @var User $user */
        $user = Auth::user();
        // Get paginated list of mugs belonging to the authenticated merchant
        $mugs = $user->mugs()->paginate(10);
        
        return view('merchant.dashboard', compact('mugs'));
    }
} 