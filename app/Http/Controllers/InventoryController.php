<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Inventory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class InventoryController extends Controller
{
    //getPage
    public function viewHome(){
        return view('welcome');
    }
    public function viewUserDashboard(){
        return view('user.dashboard');
    }
    public function viewAdminDashboard(){
        return view('admin.dashboard');
    }

    public function createPage() {
        $category = Category::all();
        return view('admin.createProduct', compact('category'));
    }

    public function viewProduct() {
        $product = Inventory::all();
        $category = Category::all();
        return view('admin.product', compact('category', 'product'));
    }

    public function viewProductByCategory($id) {
        $product = Inventory::with('category')->where('category_id', $id)->get();
        $category = Category::all();
        return view('admin.product', compact('category', 'product'));
    }

    public function createProduct(Request $request){
        // $category = Category::all();
        // $product = Inventory::all();
        $request->validate([
            'product_name' => ['required', 'min:5', 'max:80'],
            'product_price' => ['required', 'integer', 'min:1'],
            'product_quantity' => ['required', 'integer', 'min:0'],
            'product_photo' => ['required'],
            'category_id' => 'required|exists:categories,id',
        ]);

        $fileName = $request->file('product_photo')->getClientOriginalName();
        $filePath = $request->file('product_photo')->storeAs('upload', $fileName, 'public');

        Inventory::create([
            'product_name' => $request->product_name,
            'product_price' => $request->product_price,
            'product_quantity' => $request->product_quantity,
            'product_photo' => $filePath,
            'category_id' => $request->category_id,
        ]);

        return redirect()->route('product.view.all')->with('success', 'Product created successfully!');
    }

    public function deleteProduct($id){
        $product = Inventory::find($id);

        if(Storage::disk('public')->exists($product->product_photo)){
            Storage::disk('public')->delete($product->product_photo);
        }

        $product->delete();
        return redirect()->route('product.view.all')->with('success', 'Product deleted successfully!');
    }

    public function updateProductPage($id){
        $productUpdate = Inventory::find($id);
        $category = Category::all();
        return view('admin.updateProduct', compact('productUpdate', 'category'));
    }

    public function updateProduct(Request $request, $id){
        $request->validate([
            'product_name' => ['required', 'min:5', 'max:80'],
            'product_price' => ['required', 'integer', 'min:1'],
            'product_quantity' => ['required', 'integer', 'min:0'],
            'product_photo' => ['required'],
            'category_id' => 'required|exists:categories,id',
        ]);

        $productUpdate = Inventory::find($id);

        // Simpan nilai default-nya adalah path gambar lama
        $filePath = $productUpdate->product_photo;

        // Jika user upload foto baru
        if ($request->hasFile('product_photo')) {
            // Hapus foto lama
            if (Storage::disk('public')->exists($productUpdate->product_photo)) {
                Storage::disk('public')->delete($productUpdate->product_photo);
            }

            // Upload yang baru
            $fileName = time() . '_' . $request->file('product_photo')->getClientOriginalName();
            $filePath = $request->file('product_photo')->storeAs('upload', $fileName, 'public');
        }
        if(!$productUpdate){
            return redirect()->route('product.view.all')->with('error', 'Product not found');
        }

        $productUpdate->update([
            'product_name' => $request->product_name,
            'product_price' => $request->product_price,
            'product_quantity' => $request->product_quantity,
            'product_photo' => $filePath,
            'category_id' => $request->category_id,
        ]);

        return redirect()->route('product.view.all')->with('success', 'Product updated successfully!');
    }

}
