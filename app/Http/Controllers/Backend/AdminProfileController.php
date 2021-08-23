<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\User;
use Auth;

class AdminProfileController extends Controller
{
    public function AdminProfile(){
        $id = auth()->guard('admin')->user()->id;   
		$adminData = Admin::findOrFail($id);
        return view('admin.admin_profile_view',compact('adminData'));
    }
    public function AdminProfileEdit(){
        $id = auth()->guard('admin')->user()->id;   
		$editData = Admin::find($id);
        return view('admin.admin_profile_edit',compact('editData'));
    }
    public function AdminProfileStore(Request $request){
        $id = auth()->guard('admin')->user()->id;   
		$data = Admin::find($id);
        $data->name=$request->name;
        $data->email=$request->email;

        if($request->file('profile_photo_path')){
            $file=$request->file('profile_photo_path');
            @unlink(public_path('upload/admin_images/'.$data->profile_photo_path));
            $filename=date('ymdHi').$file->getClientOriginalName();
            $file->move(public_path('upload/admin_images'),$filename);
            $data['profile_photo_path']=$filename;
        }
        $data->save();
        $notification=array(
            'message'=>'Admin Profile Updated Successfully !',
            'alert-type'=>'success'
        );
        return redirect()->route('admin.profile')->with($notification);


    }
    public function AdminChangePass(){
        return view('admin.admin_change_password');
    }
    public function AdminUpdateChangePass(Request $request){
        $validateData=$request->validate([
            'oldpassword'=>'required',
            'password'=>'required|confirmed',


        ]);

        $hashedPassword = auth()->guard('admin')->user()->password;
        if(Hash::check($request->oldpassword,$hashedPassword)){
            $admin = Admin::find(Auth::id());
            $admin->password=Hash::make($request->password);
            $admin->save();
            Auth::logout();
             return redirect()->route('admin.logout');
        }
        else
        $notification=array(
            'message'=>'Password Incorrect!',
            'alert-type'=>'error'
        );
        return redirect()->back()->with($notification);
       
    }

    public function AllUsers(){
        $users=User::latest()->get();
        return view('backend.user.all_user',compact('users'));
    }
}
