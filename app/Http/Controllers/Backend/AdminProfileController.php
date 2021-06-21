<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\Admin;
use Auth;

class AdminProfileController extends Controller
{
    public function AdminProfile(){
        $adminData=Admin::find(1);
        return view('admin.admin_profile_view',compact('adminData'));
    }
    public function AdminProfileEdit(){
        $editData=Admin::find(1);
        return view('admin.admin_profile_edit',compact('editData'));
    }
    public function AdminProfileStore(Request $request){
        $data=Admin::find(1);
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
        $hashedPassword=Admin::find(1)->password;
        if(Hash::check($request->oldpassword,$hashedPassword)){
            $admin=Admin::find(1);
            $admin->password=Hash::make($request->password);
            $admin->save();
            Auth::logout();
             return redirect()->route('admin.logout');
        }
        else
        $notification=array(
            'message'=>'Password Incoorect!',
            'alert-type'=>'error'
        );
        return redirect()->back()->with($notification);
       
    }
}
