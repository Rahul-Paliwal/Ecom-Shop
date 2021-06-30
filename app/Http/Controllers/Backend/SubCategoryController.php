<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SubCategory;
use App\Models\Category;
use App\Models\SubSubCategory;

class SubCategoryController extends Controller
{
    public function SubCategoryView(){
        $categories=Category::orderBy('category_name_en','ASC')->get();
        $subcategory=SubCategory::latest()->get();
        return view('backend.category.subcategory_view',compact('subcategory','categories'));
    }
    public function SubCategoryStore(Request $request){
        $request->validate([
            'category_id'=>'required',
            'subcategory_name_en'=>'required',
            'subcategory_name_hi'=>'required',
        ],
        [
            'category_id.required'=>'Please Select Any Option',
            'subcategory_name_en.required'=>'Input SubCategory English Name',
            'subcategory_name_hi.required'=>'Input SubCategory Hindi Name',
 
        ]);
        SubCategory::insert([
            'category_id'=>$request->category_id,
            'subcategory_name_en'=>$request->subcategory_name_en,
            'subcategory_name_hi'=>$request->subcategory_name_hi,
            'subcategory_slug_en'=>strtolower(str_replace(' ','-',$request->subcategory_name_en)),
            'subcategory_slug_hi'=>str_replace(' ','-',$request->subcategory_name_hi),
            
        ]);
        $notification=array(
            'message'=>'SubCategory Inserted Successfully !',
            'alert-type'=>'success'
        );
        return redirect()->back()->with($notification);
    }
    public function SubCategoryEdit($id){
        $categories=Category::orderBy('category_name_en','ASC')->get();
        $subcategory=SubCategory::findOrFail($id);
        return view('backend.category.subcategory_edit',compact('subcategory','categories'));
    }

    public function SubCategoryUpdate(Request $request){
        $subcategory_id=$request->id;
        
            SubCategory::findOrFail($subcategory_id)->update([
                'category_id'=>$request->category_id,
                'subcategory_name_en'=>$request->subcategory_name_en,
                'subcategory_name_hi'=>$request->subcategory_name_hi,
                'subcategory_slug_en'=>strtolower(str_replace(' ','-',$request->subcategory_name_en)),
                'subcategory_slug_hi'=>str_replace(' ','-',$request->subcategory_name_hi),
                
            ]);
            $notification=array(
                'message'=>'SubCategory Updated Successfully !',
                'alert-type'=>'info'
            );
            return redirect()->route('all.subcategory')->with($notification);
    }
    public function SubCategoryDelete($id){
        $subcategory=SubCategory::findOrFail($id);
        SubCategory::findOrFail($id)->delete();
        $notification=array(
            'message'=>'SubCategory Deleted Successfully !',
            'alert-type'=>'error'
        );
        return redirect()->back()->with($notification);
    }
    ////////////// For Sub SubCategory ////////

    public function SubSubCategoryView(){
        $categories=Category::orderBy('category_name_en','ASC')->get();
        $subsubcategory=SubSubCategory::latest()->get();
        return view('backend.category.sub_subcategory_view',compact('subsubcategory','categories'));
    }
    public function GetSubCategory($category_id){
        $subcat=SubCategory::where('category_id',$category_id)->orderBy('subcategory_name_en','ASC')->get();
        return json_encode($subcat);
    }
    public function GetSubSubCategory($subcategory_id){
        $subsubcat=SubSubCategory::where('subcategory_id',$subcategory_id)->orderBy('subsubcategory_name_en','ASC')->get();
        return json_encode($subsubcat);
    }
    public function SubSubCategoryStore(Request $request){
        $request->validate([
            'category_id'=>'required',
            'subcategory_id'=>'required',
            'subsubcategory_name_en'=>'required',
            'subsubcategory_name_hi'=>'required',
        ],
        [
            'category_id.required'=>'Please Select Any Option',
            'subcategory_id.required'=>'Please Select Any Option',
            'subsubcategory_name_en.required'=>'Input Sub SubCategory English Name',
            'subsubcategory_name_hi.required'=>'Input Sub SubCategory Hindi Name',
 
        ]);
        SubSubCategory::insert([
            'category_id'=>$request->category_id,
            'subcategory_id'=>$request->subcategory_id,
            'subsubcategory_name_en'=>$request->subsubcategory_name_en,
            'subsubcategory_name_hi'=>$request->subsubcategory_name_hi,
            'subsubcategory_slug_en'=>strtolower(str_replace(' ','-',$request->subsubcategory_name_en)),
            'subsubcategory_slug_hi'=>str_replace(' ','-',$request->subsubcategory_name_hi),
            
        ]);
        $notification=array(
            'message'=>'Sub SubCategory Inserted Successfully !',
            'alert-type'=>'success'
        );
        return redirect()->back()->with($notification); 
    }
    public function SubSubCategoryEdit($id){
        $categories=Category::orderBy('category_name_en','ASC')->get();
        $subcategories=SubCategory::orderBy('subcategory_name_en','ASC')->get();
        $subsubcategory=SubSubCategory::findOrFail($id);
        return view('backend.category.sub_subcategory_edit',compact('subsubcategory','categories','subcategories'));
    }
    public function SubSubCategoryUpdate(Request $request){
        $subsubcategory_id=$request->id;
        
        SubSubCategory::findOrFail($subsubcategory_id)->update([
            'category_id'=>$request->category_id,
            'subcategory_id'=>$request->subcategory_id,
            'subsubcategory_name_en'=>$request->subsubcategory_name_en,
            'subsubcategory_name_hi'=>$request->subsubcategory_name_hi,
            'subsubcategory_slug_en'=>strtolower(str_replace(' ','-',$request->subsubcategory_name_en)),
            'subsubcategory_slug_hi'=>str_replace(' ','-',$request->subsubcategory_name_hi),
            
        ]);
        $notification=array(
            'message'=>'Sub SubCategory Updated Successfully !',
            'alert-type'=>'info'
        );
        return redirect()->route('all.subsubcategory')->with($notification);   
    }
    public function SubSubCategoryDelete($id){
        $subcategory=SubSubCategory::findOrFail($id);
        SubSubCategory::findOrFail($id)->delete();
        $notification=array(
            'message'=>'SubCategory Deleted Successfully !',
            'alert-type'=>'error'
        );
        return redirect()->back()->with($notification);
    }
}
