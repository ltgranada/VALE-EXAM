<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Medicine;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Log;
use Srmklive\PayPal\Services\PayPal as PayPalClient;

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
            'address_1' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'province' => 'required|string|max:255',
            'postal_code' => 'required|string|max:10',
        ]);

        $userId = Auth::id();

        // Store the checkout information in the session or process it as needed
        /// session(['checkout_info' => $request->all()]);

        // Retrieve cart items from the session
        $cart = Cart::where('user_id', $userId)->with('medicine')->get();

        // Calculate the total
        $total = 0;
        foreach ($cart as $item) {
            $total += $item->medicine->price * $item->quantity; // Assuming each Cart item has a relationship with Medicine
        }

        // Create transaction
        DB::beginTransaction();

        $transaction = Transaction::create([
            'user_id' => $userId,
            'customer_name' => $request->input('name'),
            'customer_email' => $request->input('email'),
            'customer_phone' => $request->input('phone'),
            'shipping_address' => $request->input('address_1') . ' ' . $request->input('city') . ' ' . $request->input('province') . ' ' . $request->input('postal_code'),
            'total_price' => $total,
        ]);

        // Add items to the transaction
        foreach ($cart as $item) {
            $transaction->items()->create([
                'medicine_id' => $item->medicine_id,
                'quantity' => $item->quantity,
                'price' => $item->medicine->price,
            ]);
        }

        // Commit the transaction
        DB::commit();

        $paypal = new PayPalClient();
        $paypal->setApiCredentials(config('paypal'));
        $paypal->getAccessToken();

        if (count($cart) == 0) {
            return redirect()->route('checkout')->with('error', 'Your cart is empty.');
        }

        // Create a payment
        $items = [];
        $subtotal = 0.00;

        foreach ($transaction->items as $item) {
            $items[] = [
                'name' => $item->medicine->name,
                'description' => $item->medicine->description,
                'category' => 'PHYSICAL_GOODS',
                'quantity' => $item->quantity,
                'price' => $item->medicine->price,
                'sku' => $item->medicine->id,
                'unit_amount' => [
                    'currency_code' => 'PHP',
                    'value' => $item->medicine->price,
                ]
            ];

            $subtotal += $item->medicine->price * $item->quantity;
        }

        $response = $paypal->createOrder([
            "intent" => "CAPTURE",
            "purchase_units" => [
                0 => [
                    "invoice_id" => $transaction->id,
                    "items" => $items,
                    "amount" => [
                        "currency_code" => "PHP",
                        "value" => $subtotal,
                        "breakdown" => [
                            'item_total' => [
                                'currency_code' => 'PHP',
                                'value' => $subtotal
                            ]
                        ]
                    ],
                    "shipping" => [
                        "type" => "SHIPPING",
                        "address" => [
                            "address_line_1" => $request->input('address_1'),
                            "admin_area_2" => $request->input('city'),
                            "admin_area_1" => $request->input('province'),
                            "postal_code" => $request->input('postal_code'),
                            "country_code" => "PH"
                        ]
                    ]
                ]
            ],
            "payment_source" => [
                "paypal" => [
                    "experience_context" => [
                        "brand_name" => "Granada Drugs",
                        "user_action" => "PAY_NOW",
                        "shipping_preference" => "SET_PROVIDED_ADDRESS",
                        "return_url" => env('FRONTEND_URL') . '/checkout/process-payment?id=' . base64_encode($transaction->id),
                        "cancel_url" => env('FRONTEND_URL') . '/checkout/cancelled?id=' . base64_encode($transaction->id),
                    ]
                ]
            ]
        ]);

        // Redirect to the pay page
        if (isset($response['id']) && $response['id'] != null) {
            // Get the checkout URL
            return redirect($response['links'][1]['href']);
        } else {
            Log::error($response);
            return redirect()->route('checkout.index')->with('error', 'Failed to create payment.');
        }
    }

    public function processPayment(Request $request)
    {
        if ($request->query('token') == null) {
            return redirect()->route('checkout.index');
        }

        $transactionId = base64_decode(request('id'));
        $transaction = Transaction::findOrFail($transactionId);

        // Check if the transaction is already paid
        $payment = $this->capturePaymentOrder($request->query('token'));

        if ($payment['status'] != 'COMPLETED') {
            return redirect()->route('checkout.index')->with('error', 'Payment failed. Please try again.');
        }

        // Update the transaction status
        DB::beginTransaction();

        $transaction->payment()->create([
            'payment_id' => $payment['purchase_units'][0]['payments']['captures'][0]['id'],
            'amount_paid' => $payment['purchase_units'][0]['payments']['captures'][0]['seller_receivable_breakdown']['gross_amount']['value'],
            'net_amount' => $payment['purchase_units'][0]['payments']['captures'][0]['seller_receivable_breakdown']['net_amount']['value'],
            'fee' => $payment['purchase_units'][0]['payments']['captures'][0]['seller_receivable_breakdown']['paypal_fee']['value'],
            'status' => 'paid',
        ]);

        DB::commit();

        // Clear cart contents
        Cart::where('user_id', Auth::id())->delete();

        return redirect()->route('checkout.index')->with('success', 'Payment successful. Thank you for your purchase!');
    }

    private function capturePaymentOrder($token)
    {
        $paypal = new PayPalClient();
        $paypal->setApiCredentials(config('paypal'));
        $paypal->getAccessToken();

        $response = $paypal->capturePaymentOrder($token);

        if (isset($response['status']) && $response['status'] == 'COMPLETED') {
            return $response;
        }

        throw new \Exception('Failed to capture payment order');
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
