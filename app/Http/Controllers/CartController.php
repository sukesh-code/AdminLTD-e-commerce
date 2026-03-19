<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{

    public function increment($id)
    {
        $user = Auth::user();

        $cart = Cart::where('user_id', $user->id)->where('product_id', $id)->firstOrFail();

        $cart->quantity += 1;
        $cart->save();

        $total = $cart->price * $cart->quantity;

        // Correct subtotal calculation
        $subtotal = Cart::where('user_id', $user->id)->get()->sum(function ($item) {
            return $item->price * $item->quantity;
        });

        return response()->json([
            'quantity' => $cart->quantity,
            'total' => $total,
            'subtotal' => $subtotal
        ]);
    }


    public function decrement($id)
    {
        $user = Auth::user();

        $cart = Cart::where('user_id', $user->id)->where('product_id', $id)->firstOrFail();

        $cart->quantity -= 1;

        if ($cart->quantity < 1) {
            $cart->delete();
            $total = 0; // row removed, total is 0
        } else {
            $cart->save();
            $total = $cart->price * $cart->quantity;
        }

        $subtotal = Cart::where('user_id', $user->id)->get()->sum(function ($item) {
            return $item->price * $item->quantity;
        });

        return response()->json([
            'quantity' => $cart->quantity ?? 0,
            'total' => $total,
            'subtotal' => $subtotal
        ]);
    }


    public function remove($id)
    {
        $user = Auth::user();

        Cart::where('user_id', $user->id)
            ->where('product_id', $id)
            ->delete();

        return redirect()->route('view.cart.page');
    }
}
