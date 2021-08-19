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
        Image::make($image)->resize(917,1000)->save('upload/products/thumbnil/'.$name_gen);
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
        Image::make($img)->resize(917,1000)->save('upload/products/multi_image/'.$make_name);
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
        return redirect()->route('manage-product')->with($notification);

        // //////// End Multi Image Upload Start //////////
    }

    public function ManageProduct(Request $request)
    {
        $products=Product::latest()->get();
        return view('backend.product.product_view',compact('products')); 
    }
    public function EditProduct($id){
            $multiImgs=MultiImg::where('product_id',$id)->get();
            $categories=Category::latest()->get();
            $brands=Brand::latest()->get();
            $subcategory=SubCategory::latest()->get();
            $subsubcategory=SubSubCategory::latest()->get();
            $products=Product::findOrFail($id);
            return view('backend.product.product_edit',compact('categories','brands','subcategory','subsubcategory','products','multiImgs'));

    }
    public function UpdateProductData(Request $request){
        $product_id= $request->id;
        Product::findOrFail($product_id)->update([
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
            'status'=>1,
            'created_at'=>Carbon::now(),
        ]);
        $notification = array(
            'message'=>'Product Updated Without Image Successfully',
            'alert-type'=>'info',
        );
        return redirect()->route('manage-product')->with($notification);
    }
    /////////// MULTI IMAGE UPDATE  ////////////////////////////////
    public function MultiImgUpdate(Request $request){
        $imgs = $request->multi_img;

		foreach ($imgs as $id => $img) {
	    $imgDel = MultiImg::findOrFail($id);
	    unlink($imgDel->photo_name);

    	$make_name = hexdec(uniqid()).'.'.$img->getClientOriginalExtension();
    	Image::make($img)->resize(917,1000)->save('upload/products/multi_image/'.$make_name);
    	$uploadPath = 'upload/products/multi_image/'.$make_name;

    	MultiImg::where('id',$id)->update([
    		'photo_name' => $uploadPath,
    		'updated_at' => Carbon::now(),

    	]);

	 } 

       $notification = array(
			'message' => 'Product Image Updated Successfully',
			'alert-type' => 'info'
		);

        return redirect()->back()->with($notification);
        

    }
    ///////////////////////// THUMBNIL IMAGE UPDATE ////////////////////////
    public function ThumbnilImgUpdate(Request $request){
        $pro_id = $request->id;
        $oldimage=$request->old_img;
         unlink($oldimage);   
		$image=$request->file('product_thumbnil');
    	$name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
    	Image::make($image)->resize(917,1000)->save('upload/products/thumbnil/'.$name_gen);
    	$save_url = 'upload/products/thumbnil/'.$name_gen;

    	Product::findOrFail($pro_id)->update([
    		'product_thumbnil' => $save_url,
    		'updated_at' => Carbon::now(),

    	]);

	 

       $notification = array(
			'message' => 'Product Image Thumbnil Updated Successfully',
			'alert-type' => 'info'
		);

        return redirect()->back()->with($notification);
        

    }

    ///////////////Multi Img Delete ////////////////////// 
    public function MultiImgDelete($id)
    {
            $oldimg = MultiImg::findOrFail($id);
            unlink($oldimg->photo_name);
            MultiImg::findOrFail($id)->delete();
            $notification = array(
                'message' => 'Product Image Deleted Successfully',
                'alert-type' => 'error'
            );
    
            return redirect()->back()->with($notification);

    }


    public function ProductInActive($id){
        Product::findOrFail($id)->update(['status'=>0]);
        $notification = array(
            'message' => 'Product InActive',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }

    public function ProductActive($id){
        Product::findOrFail($id)->update(['status'=>1]);
        $notification = array(
            'message' => 'Product Active',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
        
    }
    

    public function ProductDelete($id){
        $product = Product::findOrFail($id);
        unlink($product->product_thumbnil);
        Product::findOrFail($id)->delete();
        $images=MultiImg::where('product_id','$id')->get();
        foreach($images as $img)
        {
            unlink($img->photo_name);
            MultiImg::where('product_id','$id')->delete();
        }

        $notification = array(
            'message' => 'Product Deleted Successfully!',
            'alert-type' => 'error'
        );

        return redirect()->back()->with($notification);

    }
    
    /////////////////////////---------Stock-----//////////////////////
    public function ProductStock(Request $request)
    {
        $products=Product::latest()->get();
        return view('backend.product.product_stock',compact('products')); 
    }
}
