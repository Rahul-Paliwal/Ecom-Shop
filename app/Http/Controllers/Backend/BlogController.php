<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Blog\BlogPostCategory;
use App\Models\Blog\BlogPost;
use Carbon\Carbon;
use Image;

class BlogController extends Controller
{
    public function BlogCategory(){
        $blogcategory = BlogPostCategory::latest()->get();
        return view('backend.blog.category.category_view',compact('blogcategory'));
    }

    public function BlogCategoryStore(Request $request){
        $request->validate([
            'blog_category_name_en'=>'required',
            'blog_category_name_hi'=>'required',
        ],
        [
            'blog_category_name_en.required'=>'Input Blog Category English Name',
            'blog_category_name_hi.required'=>'Input Blog Category Hindi Name',
 
        ]);
        BlogPostCategory::insert([
            'blog_category_name_en'=>$request->blog_category_name_en,
            'blog_category_name_hi'=>$request->blog_category_name_hi,
            'blog_category_slug_en'=>strtolower(str_replace(' ','-',$request->blog_category_name_en)),
            'blog_category_slug_hi'=>str_replace(' ','-',$request->blog_category_name_hi),
            'created_at'=>Carbon::now(),

            
            
        ]);
        $notification=array(
            'message'=>'Blog Category Inserted Successfully !',
            'alert-type'=>'success'
        );
        return redirect()->back()->with($notification);
    }
    
    public function BlogCategoryEdit($id){
        $blogcategory=BlogPostCategory::findOrFail($id);
        return view('backend.blog.category.category_edit',compact('blogcategory'));
    }

    public function BlogCategoryUpdate(Request $request){
        $blogcategory_id=$request->id;
        
            BlogPostCategory::findOrFail($blogcategory_id)->update([
                'blog_category_name_en'=>$request->blog_category_name_en,
                'blog_category_name_hi'=>$request->blog_category_name_hi,
                'blog_category_slug_en'=>strtolower(str_replace(' ','-',$request->blog_category_name_en)),
                'blog_category_slug_hi'=>str_replace(' ','-',$request->blog_category_name_hi),
                'updated_at'=>Carbon::now(),
                
            ]);
            $notification=array(
                'message'=>'Blog Category Updated Successfully !',
                'alert-type'=>'info'
            );
            return redirect()->route('blog.category')->with($notification);

        
      

    }

    public function BlogCategoryDelete($id){
        $blogcategory=BlogPostCategory::findOrFail($id);
        BlogPostCategory::findOrFail($id)->delete();
        $notification=array(
            'message'=>'Blog Category Deleted Successfully !',
            'alert-type'=>'error'
        );
        return redirect()->back()->with($notification);
    }

    ////////// Admin view blog post///////////

    public function ViewBlogPost(){
        $blogpost = BlogPost::with('category')->latest()->get();
        return view('backend.blog.post.post_view',compact('blogpost'));
    }

    public function AddBlogPost(){
        $blogcategory=BlogPostCategory::latest()->get();
        $blogpost = BlogPost::latest()->get();
        return view('backend.blog.post.post_add',compact('blogpost','blogcategory'));
    }

    public function StoreBlogPost(Request $request){
        $request->validate([
            'post_title_en'=>'required',
            'post_title_hi'=>'required',
            'post_image'=>'required',
        ],
        [
            'post_title_en.required'=>'Input Title Name in English',
            'post_title_hi.required'=>'Input Title Name in Hindi',
 
        ]);
        $image=$request->file('post_image');
        $name_gen=hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
        Image::make($image)->resize(786,430)->save('upload/blog/'.$name_gen);
        $save_url='upload/blog/'.$name_gen;
        
        BlogPost::insert([
            'category_id'=>$request->category_id,
            'post_title_en'=>$request->post_title_en,
            'post_title_hi'=>$request->post_title_hi,
            'post_slug_en'=>strtolower(str_replace(' ','-',$request->post_title_en)),
            'post_slug_hi'=>str_replace(' ','-',$request->post_title_hi),
            'post_image'=>$save_url,
            'post_details_en'=>$request->post_details_en,
            'post_details_hi'=>$request->post_details_hi,
            'created_at'=>Carbon::now(),
            
        ]);
        $notification=array(
            'message'=>'Post Inserted Successfully !',
            'alert-type'=>'success'
        );
        return redirect()->route('view.blog_post')->with($notification);
    }

    public function BlogPostEdit($id){
        $blogpost=BlogPost::findOrFail($id);
        return view('backend.blog.post.post_edit',compact('blogpost'));
    }

    public function BlogPostUpdate(Request $request){
        $category_id=$request->id;
        $old_img=$request->old_image;
        if($request->file('post_image')){
            unlink($old_img);
            $image=$request->file('post_image');
            $name_gen=hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
            Image::make($image)->resize(300,300)->save('upload/blog/'.$name_gen);
            $save_url='upload/blog/'.$name_gen;
            BlogPost::findOrFail($category_id)->update([
                'category_id'=>$request->category_id,
                'post_title_en'=>$request->post_title_en,
                'post_title_hi'=>$request->post_title_hi,
                'post_slug_en'=>strtolower(str_replace(' ','-',$request->post_title_en)),
                'post_slug_hi'=>str_replace(' ','-',$request->post_title_hi),
                'post_image'=>$save_url,
                'post_details_en'=>$request->post_details_en,
                'post_details_hi'=>$request->post_details_hi,
                'created_at'=>Carbon::now(),
                
            ]);
            $notification=array(
                'message'=>'Blog Post Updated Successfully !',
                'alert-type'=>'info'
            );
            return redirect()->route('view.blog_post')->with($notification);

        }
        else
        {
            BlogPost::findOrFail($category_id)->update([
                'category_id'=>$request->category_id,
                'post_title_en'=>$request->post_title_en,
                'post_title_hi'=>$request->post_title_hi,
                'post_slug_en'=>strtolower(str_replace(' ','-',$request->post_title_en)),
                'post_slug_hi'=>str_replace(' ','-',$request->post_title_hi),
                'post_details_en'=>$request->post_details_en,
                'post_details_hi'=>$request->post_details_hi,
                'created_at'=>Carbon::now(), 
            ]);
            $notification=array(
                'message'=>'Blog Post Updated Without Image Successfully !',
                'alert-type'=>'info'
            );
            return redirect()->route('view.blog_post')->with($notification); 
        }

    }

    public function BlogPostDelete($id){
        $blogpost=BlogPost::findOrFail($id);
        $img=$blogpost->photo_image;
        BlogPost::findOrFail($id)->delete();
        $notification=array(
            'message'=>'Blog Post Deleted Successfully !',
            'alert-type'=>'error'
        );
        return redirect()->back()->with($notification);
    }
}
