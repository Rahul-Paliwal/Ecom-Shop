<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Gloudemans\Shoppingcart\Facades\Cart;

class CartPageController extends Controller
{
    public function MyCart(){
        return view('frontend.wishlist.view_cart');
    }

    public function GetCartProduct(){
        $carts =Cart::content();
        $cartQty=Cart::count();
        $cartTotal=Cart::total();

        return response()->json(array(
            'carts'=>$carts,
            'cartQty'=>$cartQty,
            'cartTotal'=>round($cartTotal)

        ));
    }

    public function DeleteCartProduct($rowId){
        Cart::remove($rowId);
        return response()->json(['success'=>'Successfully Removed From Your Cart']);

    }

    public function CartIncrement($rowId){
        $row=Cart::get($rowId);
        Cart::update($rowId,$row->qty+1);
        return response()->json(['increment']);

    }

    public function CartDecrement($rowId){
        $row=Cart::get($rowId);
        Cart::update($rowId,$row->qty-1);
        return response()->json(['decrement']);

    }
}
