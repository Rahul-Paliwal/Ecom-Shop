<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Brand;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\SubSubCategory;
use App\Models\Product;
use App\Models\MultiImg;
use Carbon\Carbon;
use Image;

class ProductController extends Controller
{
    public function AddProduct(){
        $categories=Category::latest()->get();
        $brands=Brand::latest()->get();
        return view('backend.product.product_add',compact('categories','brands'));
    }
    public function StoreProduct(Request $request){

        $image=$request->file('product_thumbnil');
        $name_gen=hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
        Image::make($image)->resize(917,1000)->save('upload/products/thumbnil'.$name_gen);
        $save_url='upload/products/thumbnil/'.$name_gen;
        
       
        $product_id = Product::insertGetId([
            'brand_id'=>$request->brand_id,
            'category_id'=>$request->category_id,
            'subcategory_id'=>$request->subcategory_id,
            'subsubcategory_id'=>$request->subsubcategory_id,
            'product_name_en'=>$request->product_name_en,
            'product_name_hi'=>$request->product_name_hi,
            'product_slug_en'=>strtolower(str_replace('','-',$request->product_name_en)),
            'product_slug_hi'=>str_replace('','-',$request->product_name_hi),
            'product_code'=>$request->product_code,
            'product_qty'=>$request->product_qty,
            'product_tags_en'=>$request->product_tags_en,
            'product_tags_hi'=>$request->product_tags_hi,
            'product_size_en'=>$request->product_size_en,
            'product_size_hi'=>$request->product_size_hi,
            'product_color_en'=>$request->product_color_en,
            'product_color_hi'=>$request->product_color_hi,
            'selling_price'=>$request->selling_price,
            'discount_price'=>$request->discount_price,
            'short_descp_en'=>$request->short_descp_en,
            'short_descp_hi'=>$request->short_descp_hi,
            'long_descp_en'=>$request->long_descp_en,
            'long_descp_hi'=>$request->long_descp_hi,
            'hot_deals'=>$request->hot_deals,
            'featured'=>$request->featured,
            'special_offer'=>$request->special_offer,
            'special_deals'=>$request->special_deals,
            'product_thumbnil'=>$save_url,
            'status'=>1,
            'created_at'=>Carbon::now(),
        ]);
        
        // //////// Multi Image Upload Start //////////
            $images = $request->file('multi_img');
            foreach($images as $img){
                $make_name=hexdec(uniqid()).'.'.$img->getClientOriginalExtension();
        Image::make($img)->resize(917,1000)->save('upload/products/multi_image'.$make_name);
        $upload_path='upload/products/multi_image/'.$make_name;
        MultiImg::insert([
            'product_id'=>$product_id,
            'photo_name'=>$upload_path,
            'created_at'=>Carbon::now(),


        ]);


        }
        $notification = array(
            'message'=>'Product Inserted Successfully',
            'alert-type'=>'success',
        );
        return redirect()->back()->with($notification);

        // //////// End Multi Image Upload Start //////////
    }
}
