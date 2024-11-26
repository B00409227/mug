<?php

namespace App\Http\Controllers;

use App\Models\Mug;
use Illuminate\Http\Request;

/**
 * Handles shopping cart operations including adding, viewing, removing items and checkout.
 */
class CartController extends Controller
{
    /**
     * Add a mug to the shopping cart.
     *
     * @param Request $request The incoming request containing quantity
     * @param Mug $mug The mug model to be added
     * @return \Illuminate\Http\RedirectResponse
     */
    public function add(Request $request, Mug $mug)
    {
        // Get the requested quantity or default to 1
        $quantity = $request->input('quantity', 1);
        
        // Get existing cart from session or create empty array
        $cart = session()->get('cart', []);
        
        // If mug already exists in cart, increment quantity
        // Otherwise, add new mug with details to cart
        if (isset($cart[$mug->id])) {
            $cart[$mug->id]['quantity'] += $quantity;
        } else {
            $cart[$mug->id] = [
                'name' => $mug->name,
                'quantity' => $quantity,
                'price' => $mug->price,
                'image' => $mug->image
            ];
        }
        
        // Save updated cart back to session
        session()->put('cart', $cart);
        return redirect()->back()->with('success', 'Mug added to cart!');
    }

    /**
     * Display the shopping cart contents.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $cart = session()->get('cart', []);
        return view('cart.index', compact('cart'));
    }

    /**
     * Remove an item from the shopping cart.
     *
     * @param int $id The ID of the mug to remove
     * @return \Illuminate\Http\RedirectResponse
     */
    public function remove($id)
    {
        $cart = session()->get('cart', []);
        
        // Remove item if it exists in cart
        if(isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);
        }
        
        return redirect()->back()->with('success', 'Item removed from cart successfully!');
    }

    /**
     * Process the checkout and clear the cart.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function checkout()
    {
        $cart = session()->get('cart', []);
        
        // Prevent checkout if cart is empty
        if(empty($cart)) {
            return redirect()->back()->with('error', 'Cart is empty');
        }

        // Clear the cart from session
        session()->forget('cart');
        
        // Redirect to mugs page with success message
        return redirect()->route('mugs.index')->with('checkout-success', 'Thank you for your purchase! Your order is on its way.');
    }
} 