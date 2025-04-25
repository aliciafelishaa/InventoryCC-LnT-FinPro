<?php

namespace App\Http\Controllers;

use App\Models\Inventory;
use Illuminate\Http\Request;

class CartsController extends Controller
{
    public function cartPage(){
        $product = Inventory::all();
        return view('user.cartpage', compact('product'));
    }


}
