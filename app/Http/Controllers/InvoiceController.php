<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Invoice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class InvoiceController extends Controller
{
    public function showForm(){
        $cartItems = Cart::where('user_id', Auth::id())->with('inventory')->get();
        return view('user.invoice', compact('cartItems'));
    }

    public function store(Request $request){
        $request->validate([
            'shipping_address' => 'required|string|min:10|max:100',
            'postal_code' => 'required|digits:5',
        ]);

        $cartItems = Cart::where('user_id', Auth::id())->with('inventory')->get();

        if ($cartItems->isEmpty()) {
            return redirect()->back()->with('error', 'Cart is empty.');
        }

        $total = 0;
        foreach ($cartItems as $item) {
            $total += $item->inventory->product_price * $item->quantity;
        }

        $invoice = Invoice::create([
            'invoice_number' => 'INV-' . strtoupper(Str::random(8)),
            'user_id' => Auth::id(),
            'shipping_address' => $request->shipping_address,
            'postal_code' => $request->postal_code,
            'total_price' => $total,
        ]);

        // (Optional) Kosongkan cart setelah checkout
        Cart::where('user_id', Auth::id())->delete();
        return redirect()->route('invoice.form')->with('success', 'Invoice generated successfully!');
    }
}
