<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\Product;
use App\Models\Wishlist;
use App\Models\ShipDivision;
use App\Models\Coupon;
use Carbon\Carbon;
use Gloudemans\Shoppingcart\Facades\Cart;
use Auth;


class CartController extends Controller
{
    public function AddToCart(Request $request,$id){
        if(Session::has('coupon')){
            Session::forget('coupon');
        }
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
// Start apply coupon
   public function ApplyCoupon(Request $request){
    $coupon = Coupon::where('coupon_name',$request->coupon_name)->where('coupon_validity','>=',Carbon::now()->format('Y-m-d'))->first();
    if ($coupon) {

        Session::put('coupon',[
            'coupon_name' => $coupon->coupon_name,
            'coupon_discount' => floatval($coupon->coupon_discount),
            'discount_amount' => round(Cart::total() * $coupon->coupon_discount/100), 
            'total_amount' => round(Cart::total() - Cart::total() * $coupon->coupon_discount/100)  
           ]);
           return response()->json(array(
               'validity'=>true,
               'success'=>'Coupon Applied Successfully'
           ));
        }
        else{
            return response()->json(['error'=>'Invalid Coupon']);
        }

   }
//    Start coupon calculation
public function CouponCalculation(){
    if(Session::has('coupon')){
        return response()->json(array(
            'subtotal'=>Cart::total(),
            'coupon_name'=>session()->get('coupon')['coupon_name'],
            'coupon_discount'=>session()->get('coupon')['coupon_discount'],
            'discount_amount'=>session()->get('coupon')['discount_amount'],
            'total_amount'=>session()->get('coupon')['total_amount'],

        )); 

    }else
    {
        return response()->json(array(
            'total'=>Cart::total(),
        ));
    }

}
// End  Coupon calculation

// Start coupon remove
 public function CouponRemove(){
     Session::forget('coupon');
     return response()->json(['success','Coupon Removed Successfully !']);
 }
// End Coupon Remove

// Start checkout
public function CheckoutCreate(){
  if(Auth::check()){
      if(Cart::total()>0){
        $carts = Cart::content();
        $cartQty = Cart::count();
        $cartTotal = Cart::total();
        $divisions=ShipDivision::orderby('division_name','ASC')->get();
        return view('frontend.checkout.checkout_view',compact('carts','cartQty','cartTotal','divisions'));
      }else{
        $notification=array(
            'message'=>'Shop At List One Product First!',
            'alert-type'=> 'error'
        );      
        return redirect()->to('/')->with($notification);        
      }

  }
  else
  {
    $notification=array(
        'message'=>'You Need To Login First',
        'alert-type'=> 'error'
    );      
    return redirect()->route('login')->with($notification);
  }
}
// End checkout
}
