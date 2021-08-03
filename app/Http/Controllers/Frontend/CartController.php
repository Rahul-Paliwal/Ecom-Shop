<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Wishlist;
use Carbon\Carbon;
use Gloudemans\Shoppingcart\Facades\Cart;
use Auth;


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
                    'size' => $request->size,
                    'color' => $request->color
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
                    'size' => $request->size,
                    'color' => $request->color
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
    
    // Start add-to-wishlist
    public function AddToWishList(Request $request, $product_id){
        if(Auth::check()){
                $exists=Wishlist::where('user_id',Auth::id())->where('product_id',$product_id)->first();
                if(!$exists){
                    Wishlist::insert([
                        'user_id'=>Auth::id(),
                        'product_id'=>$product_id,
                        'created_at'=>Carbon::now(),
                    ]);
                }
                else
                {
                    return response()->json(['error'=>'Product is already on your wishlist!']);
                }
                return response()->json(['success'=>'Successfully Added To Your Wishlist']);
        }
        else{
            return response()->json(['error'=>'Plz First LogIn Your Account Or Register']);
    
        }
    }
}
