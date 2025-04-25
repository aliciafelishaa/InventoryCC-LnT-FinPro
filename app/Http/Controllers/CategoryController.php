<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function categoryCreatePage(){
        return view('category.createCategory');
    }
    public function viewCategory(){
        $category = Category::all();
        return view('category.createCategory', compact('category'));
    }


    public function createCategory(Request $request){
        $request->validate([
            'category_name'=>['required']
        ]);

        Category::create([
            'category_name'=>$request->category_name
        ]);

        return redirect()->route('category.page')->with('success', 'New category successfully created!');
    }


}
