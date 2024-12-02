<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Cart extends Model
{
    protected $fillable = ['user_id', 'medicine_id', 'quantity'];

    public function medicine()
    {
        return $this->belongsTo(Medicine::class, 'medicine_id');
    }

    public static function addToCart($medicineId, $quantity = 1)
    {
        $userId = Auth::id(); // Get the currently authenticated user's ID

        // Check if the medicine already exists in the cart for this user
        $cartItem = self::where('user_id', $userId)->where('medicine_id', $medicineId)->first();

        if ($cartItem) {
            // If it exists, update the quantity
            $cartItem->quantity += $quantity;
            $cartItem->save();
        } else {
            // If it doesn't exist, create a new cart item
            self::create([
                'user_id' => $userId, // Store the user ID
                'medicine_id' => $medicineId,
                'quantity' => $quantity,
            ]);
        }
    }

    public static function add($medicine, $quantity)
    {
        // Assuming you have a session-based cart
        $cart = session()->get('cart', []);

        // Check if the medicine is already in the cart
        if(isset($cart[$medicine->id])) {
            $cart[$medicine->id]['quantity'] += $quantity; // Update quantity
        } else {
            $cart[$medicine->id] = [
                'name' => $medicine->name,
                'quantity' => $quantity,
                'price' => $medicine->price, // Assuming you have a price attribute
            ];
        }

        // Save the cart back to the session
        session()->put('cart', $cart);
    }

    public static function getCart()
    {
        $userId = Auth::id(); // Get the currently authenticated user's ID
        return self::where('user_id', $userId)->get();
    }

    public static function clearCart()
    {
        $userId = Auth::id(); // Get the currently authenticated user's ID
        self::where('user_id', $userId)->delete();
    }
}