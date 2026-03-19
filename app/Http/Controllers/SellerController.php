<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SellerController extends Controller
{

    public function purchasedUsers()
    {



        $sellerId = Auth::id();

        $orders = OrderDetail::with(['product', 'order.user_rel'])
            ->whereHas('product', function ($query) use ($sellerId) {
                $query->where('user_id', $sellerId); // Only products of this seller
            })
            ->get();

        return view('e-commerce.seller.seller-product', compact('orders'));
    }


    public function orderPage($id)
    {



        $orders = Order::with('orderDetails_rel.product')->get();

        return view('e-commerce.seller.order-page', compact('orders'));
    }


    public function invoicePage($id)
    {

        $order = Order::with('orderDetails_rel.product', 'user_rel')->findOrFail($id);


        return view('e-commerce.seller.invoice', compact('order'));
    }
}
