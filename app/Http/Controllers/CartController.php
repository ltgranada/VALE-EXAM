<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    public function index()
    {
        $cart = Cart::getCart();
        return view('cart', compact('cart'));
    }

    public function addToCart(Request $request)
    {
        $productId = $request->input('product_id');
        $product = Product::find($productId);

        if (!$product) {
            return redirect()->route('products.index')->with('error', 'Product not found!');
        }

        $cart = session()->get('cart', []);

        if (isset($cart[$productId])) {
            $cart[$productId]['quantity']++; // Increment quantity if already in cart
        } else {
            $cart[$productId] = [
                'name' => $product->name,
                'price' => $product->price,
                'quantity' => 1, // Initialize quantity
            ];
        }

        session()->put('cart', $cart);
        return redirect()->route('products.index')->with('success', 'Product added to cart successfully!');
    }

    public function deleteProduct(Request $request)
    {
        if ($request->product_id) {
            $cart = session()->get('cart');

            if (isset($cart[$request->product_id])) {
                unset($cart[$request->product_id]); // Remove item from cart
                session()->put('cart', $cart);
            }
        }

        return redirect()->route('cart')->with('success', 'Product removed from cart successfully!');
    }

    

}
