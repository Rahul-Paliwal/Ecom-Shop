<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use Gloudemans\Shoppingcart\Facades\Cart;


class CartController extends Controller
{
    public function AddToCart(Request $request,$id){
        $product = Product::findOrFail($id);
        if($product->discount_price==NULL){
            Cart::add([
                'id' => $id,
                'name' => $request->product_name,
                'qty' => $request->qty, 
                'price' => $product->selling_price,
                'weight' => 1,
                'options' => 
                [
                    'image' => $product->product_thumbnil,
                    'size' => $request->color,
                    'color' => $request->size
                ],
                ]);
                return response()->json(['success'=>'Successfully Added On Your Cart ']);

        }
        else{
            Cart::add([
                'id' => $id,
                'name' => $request->product_name,
                'qty' => $request->qty, 
                'price' => $product->discount_price,
                'weight' => 1,
                'options' => 
                [
                    'image' => $product->product_thumbnil,
                    'size' => $request->color,
                    'color' => $request->size
                ],
                ]);
                return response()->json(['success'=>'Successfully Added On Your Cart ']);
        }

    }

    public function AddMiniCart(){
        $carts =Cart::content();
        $cartQty=Cart::count();
        $cartTotal=Cart::total();

        return response()->json(array(
            'carts'=>$carts,
            'cartQty'=>$cartQty,
            'cartTotal'=>round($cartTotal)

        ));
    }

    public function DelMiniCart($rowId){
        Cart::remove($rowId);
        return response()->json(['success'=>'Product Removed From Your Cart']);

    }
    
}
