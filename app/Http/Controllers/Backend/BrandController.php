<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Brand;
use Image;

class BrandController extends Controller
{
    public function BrandView(){
        $brands=Brand::latest()->get();
        return view('backend.brand.brand_view',compact('brands'));
    }

    public function BrandStore(Request $request){
        $request->validate([
            'brand_name_en'=>'required',
            'brand_name_hi'=>'required',
            'brand_image'=>'required',
        ],[
            'brand_name_en.required'=>'Input Brand English Name',
            'brand_name_hi.required'=>'Input Brand Hindi Name',
 
        ]);
        $image=$request->file('brand_image');
        $name_gen=hexdec(uniquid()).'.'.$image->getClientOriginalExtension();
        Image::make($image)->resize(300,300)->save('upload/brand/'.$name_gen);
        $save_url='upload/brand/'.$name_gen;
        Brand::insert([
            'brand_name_en'=>$request->brand_name_en,
            'brand_name_hi'=>$request->brand_name_hi,
            'brand_slug_en'=>strtolower(str_replace(' ','-',$request->brand_name_en)),
            'brand_slug_hi'=>str_replace(' ','-',$request->brand_name_hi),
            'brand_image'=>$save_url,
            
        ]);
        $notification=array(
            'message'=>'Brand Inserted Successfully !',
            'alert-type'=>'success'
        );
        return redirect()->back()->with($notification);
    }
}