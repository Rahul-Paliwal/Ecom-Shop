<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Blog\BlogPost;
use App\Models\Blog\BlogPostCategory;


class HomeBlogController extends Controller
{
   public function AddBlogPost(){
        $blogcategory = BlogPostCategory::latest()->get();  
        $blogpost = BlogPost::latest()->get();
        return view('frontend.blog.blog_list',compact('blogpost','blogcategory'));
   }

   public function BlogPostDetail($id){
        $blogcategory = BlogPostCategory::latest()->get();
        $blogpost = BlogPost::findOrFail($id);
        return view('frontend.blog.blog_details',compact('blogpost','blogcategory'));
   }

   public function HomeBlogPostCategory($category_id){
        $blogcategory = BlogPostCategory::latest()->get();  
        $blogpost = BlogPost::where('category_id',$category_id)->orderBy('id','DESC')->latest()->get();
    return view('frontend.blog.blog_cat_list',compact('blogpost','blogcategory'));
   }
}