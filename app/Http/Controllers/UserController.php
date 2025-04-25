<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Inventory;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function viewProduct() {
        $product = Inventory::all();
        $category = Category::all();
        return view('user.productlist', compact('category', 'product'));
    }

    public function viewProductByCategory($id) {
        $product = Inventory::with('category')->where('category_id', $id)->get();
        $category = Category::all();
        return view('user.productlist', compact('category', 'product'));
    }
}
