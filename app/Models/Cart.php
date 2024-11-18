<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Cart extends Model
{
    protected $fillable = ['user_id', 'product_id', 'quantity'];

    public static function addToCart($productId, $quantity = 1)
    {
        $userId = Auth::id(); // Get the currently authenticated user's ID

        // Check if the product already exists in the cart
        $cartItem = self::where('user_id', $userId)->where('product_id', $productId)->first();

        if ($cartItem) {
            // If it exists, update the quantity
            $cartItem->quantity += $quantity;
            $cartItem->save();
        } else {
            // If it doesn't exist, create a new cart item
            self::create([
                'user_id' => $userId,
                'product_id' => $productId,
                'quantity' => $quantity,
            ]);
        }
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