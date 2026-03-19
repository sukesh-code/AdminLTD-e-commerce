<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;


class CategoryController extends Controller
{
    public function index()
    {
        $allData = Category::with('parent')->get();

        //  dd($allData);
        return view('admin.Category.all-category', compact('allData'));
    }


    public function show()
    {
        $parents = Category::whereNull('parent_id')->get();

        return view('admin.Category.add-category', compact('parents'));
    }



    public function create(Request $request)
    {
        $request->validate([
            'title' => 'required',
        ]);

        Category::create([
            'title' => $request->title,
            'parent_id' => $request->parent_id,
            'status' => $request->status
        ]);

        return redirect()->route('all.category.now');
    }
    public function showCategory()
    {

        $categories = Category::whereNull('parent_id')->get();

        return view('e-commerce.home', compact('categories'));
    }
}
