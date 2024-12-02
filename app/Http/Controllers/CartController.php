<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Medicine;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index()
{
    // Get the authenticated user's ID
    $userId = Auth::id();

    // Fetch the cart items for the authenticated user
    $cart = Cart::where('user_id', $userId)->with('medicine')->get();

    // Calculate the total price of the cart
    $total = 0;
    foreach ($cart as $item) {
        $total += $item->medicine->price * $item->quantity; // Assuming each Cart item has a relationship with Medicine
    }

    // Pass the cart items and total to the view
    return view('cart', compact('cart', 'total'));
}

    public function addToCart(Request $request, $id)
    {
        // Validate the request
        $request->validate([
            'quantity' => 'required|integer|min:1',
        ]);

        // Find the medicine by ID
        $medicine = Medicine::findOrFail($id);

        // Add the medicine to the cart
        Cart::addToCart($medicine->id, $request->input('quantity'));

        // Optionally, you can add a success message to the session
        session()->flash('success', 'Medicine added to cart successfully!');

        // Redirect back to the medicine show page or wherever you want
        return redirect()->route('medicine.show', $id);
    }

    public function update(Request $request)
    {
        // Validate the request
        $request->validate([
            'itemId' => 'required|integer',
            'quantity' => 'required|integer|min:1',
        ]);

        // Find the cart item by ID
        $cartItem = Cart::where('id', $request->input('itemId'))->first();

        // Check if the item exists and update the quantity
        if ($cartItem) {
            $cartItem->quantity = $request->input('quantity');
            $cartItem->save(); // Save the updated item
            return response()->json(['success' => true]);
        }

        return response()->json(['success' => false, 'message' => 'Item not found.'], 404);
    }

    public function remove(Request $request)
    {
        // Validate the request
        $request->validate([
            'itemId' => 'required|integer',
        ]);

        // Find the cart item by ID and delete it
        $cartItem = Cart::where('id', $request->input('itemId'))->first();

        if ($cartItem) {
            $cartItem->delete(); // Remove the item from the cart
            return response()->json(['success' => true]);
        }

        return response()->json(['success' => false, 'message' => 'Item not found.'], 404);
    }
    
}