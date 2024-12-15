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


    //CHECKOUT CONTROLLER CODES
    // Method to display the checkout page
    public function checkout()
    {
    // Retrieve the authenticated user
    $user = Auth::user();
    $userId = Auth::id();

    // Retrieve cart items from the session
    $cart = Cart::where('user_id', $userId)->with('medicine')->get();
    
    // Calculate the total
    $total = 0;
    foreach ($cart as $item) {
        $total += $item->medicine->price * $item->quantity; // Assuming each Cart item has a relationship with Medicine
    }

    // Pass the user and cart to the view
    return view('checkout', compact('user', 'cart', 'total'));
    }

    // Method to process the checkout form submission
    public function processCheckout(Request $request)
    {
        // Validate the checkout information
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:15',
            'address' => 'required|string|max:255',
        ]);

        // Store the checkout information in the session or process it as needed
        session(['checkout_info' => $request->all()]);

        // Redirect to the pay page
        return redirect()->route('payment.show');
    }

    // Helper method to calculate the total from the cart
    private function calculateTotal($cart)
    {
        $total = 0;
        foreach ($cart as $item) {
            $total += $item->medicine->price * $item->quantity;
        }
        return $total;
    }
    

}