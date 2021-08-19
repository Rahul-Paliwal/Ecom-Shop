<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Review;
use App\Models\Blog\BlogReview;
use Auth;
use Carbon\Carbon;
class ReviewController extends Controller
{
    public function ReviewStore(Request $request){
        
        $product = $request->product_id;
        $request->validate([
            'summary'=>'required',
            'comment'=>'required',
        ]);

        Review::insert([
            'product_id'=>$product,
            'user_id'=>Auth::id(),
            'comment'=>$request->comment,
            'summary'=>$request->summary,
            'created_at'=>Carbon::now(),
        ]);

        $notification = array(
            'message'=>'Review Added Successfully',
            'alert-type'=>'success',
        );
        return redirect()->back()->with($notification);


    }

    public function PendingReview(){
        $review=Review::where('status',0)->orderBy('id','DESC')->get();
        return view('backend.review.pending_review',compact('review'));
    }

    public function ReviewApprove($id){
        Review::where('id',$id)->update(['status'=>1]);
        $notification = array(
            'message'=>'Review Approved Successfully',
            'alert-type'=>'success',
        );
        return redirect()->back()->with($notification);

    } 

    public function PublishReview(){
        $review=Review::where('status',1)->orderBy('id','DESC')->get();
        return view('backend.review.publish_review',compact('review'));
    }

    public function DeleteReview($id){
        Review::findOrFail($id)->delete();
        $notification = array(
            'message'=>'Review Deleted Successfully',
            'alert-type'=>'success',
        );
        return redirect()->back()->with($notification);

    }

    /////////////////////////////////////Blog Review//////////////////////////////////////////////////////

    public function BlogReviewStore(Request $request){
        
        $blog = $request->blog_id;
        $request->validate([
            'name'=>'required',
            'email'=>'required',
            'summary'=>'required',
        ]);

        BlogReview::insert([
            'blog_id'=>$blog,
            'name'=>$request->name,
            'email'=>$request->email,
            'summary'=>$request->summary,
            'comments'=>$request->comments,
            'created_at'=>Carbon::now(),
        ]);

        $notification = array(
            'message'=>'Blog Review Added Successfully',
            'alert-type'=>'success',
        );
        return redirect()->back()->with($notification);


    }

    public function BlogPendingReview(){
        $review=BlogReview::where('status',0)->orderBy('id','DESC')->get();
        return view('backend.review.blog_pending_review',compact('review'));
    }

    public function BlogReviewApprove($id){
        BlogReview::where('id',$id)->update(['status'=>1]);
        $notification = array(
            'message'=>'Blog Review Approved Successfully',
            'alert-type'=>'success',
        );
        return redirect()->back()->with($notification);

    } 

    public function BlogPublishReview(){
        $review=BlogReview::where('status',1)->orderBy('id','DESC')->get();
        return view('backend.review.blog_publish_review',compact('review'));
    }

    public function BlogDeleteReview($id){
        BlogReview::findOrFail($id)->delete();
        $notification = array(
            'message'=>'Blog Review Deleted Successfully',
            'alert-type'=>'success',
        );
        return redirect()->back()->with($notification);

    }
}
