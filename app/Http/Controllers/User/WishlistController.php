<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\Models\Wishlist;
use Carbon\Carbon;

class WishlistController extends Controller
{
    public function ViewWishList(){
        return view('frontend.wishlist.view_wishlist');
    }

    public function GetWishListProduct(){
        $wishlist=Wishlist::with('product')->where('user_id',Auth::id())->latest()->get();
        return response()->json($wishlist);

    }

    public function DeleteWishListProduct($id){
            Wishlist::where('user_id',Auth::id())->where('id',$id)->delete();
             return response()->json(['success' =>'Successfully Removed The Product']); 
    }
}
