<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\ProductInventory;
use Illuminate\Http\Request;

class ProductController extends Controller
{


    public function viewProductImage(int $id)
    {
        $product = Product::findOrFail($id);

        // Navbar ke liye categories
        $categories = Category::whereNull('parent_id')->get();

        return view('e-commerce.view-product', compact('product', 'categories'));
    }


}




