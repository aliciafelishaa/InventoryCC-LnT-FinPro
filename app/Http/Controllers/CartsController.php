<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Category;
use App\Models\Inventory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartsController extends Controller
{
    public function cartPage(){
        $cartItems = Cart::where('user_id', Auth::id())->with('inventory')->get();
        return view('user.cartpage', compact('cartItems'));
    }

    public function cartAdd($id){
        $product = Inventory::findOrFail($id);

        $cartItem = Cart::firstOrNew([
            'user_id' => Auth::id(),
            'inventory_id' => $id,
        ]);

        if ($cartItem->exists && $cartItem->quantity >= $product->product_quantity) {
            return redirect()->back()->with('error', 'Quantity cannot exceed available stock.');
        }

        $cartItem->quantity = $cartItem->quantity + 1;
        $cartItem->save();

        return redirect()->back()->with('success', 'Product added to cart successfully!');
    }

    public function cartUpdate(Request $request, $id){
        $product = Inventory::findOrFail($id);

        $cartItem = Cart::where('user_id', Auth::id())->where('inventory_id', $id)->first();

        if (!$cartItem) {
            return redirect()->back()->with('error', 'Item not found in cart.');
        }

        $action = $request->input('action');

        if ($action === 'increase') {
            if ($cartItem->quantity < $product->product_quantity) {
                $cartItem->quantity++;
                $cartItem->save();
            } else {
                return redirect()->back()->with('error', 'Quantity cannot exceed available stock.');
            }
        } elseif ($action === 'decrease') {
            if ($cartItem->quantity > 1) {
                $cartItem->quantity--;
                $cartItem->save();
            } else {
                $cartItem->delete();
            }
        }

        return redirect()->back();
    }


}
