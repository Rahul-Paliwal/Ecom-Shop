@extends('frontend.main_master')
@section('content')
<div class="body-content">
    <div class="container">
        <div class="row">
        @include('frontend.common.user_sidebar')
            <div class="col-md-2">
            
            </div>
            <div class="col-md-6">
                <div class="card">
                <h3 class="text-center"><span class="text-danger">Hiii...</span><strong>{{Auth::user()->name}}</strong>Update Your Profile</h3>
                    <div class="card-body">
                        <form method="post" accept="" action="{{route('user.profile.store')}}" enctype="multipart/form-data" >
                        @csrf
                        <div class="form-group">
                            <label class="info-title" for="exampleInputEmail1">Name <span>*</span></label>
                            <input type="text" id="name" name="name" value="{{$user->name}}" class="form-control" >
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                <strong>{{$message}}</strong>
                                </span>
                            @enderror
		                </div>

                        <div class="form-group">
                            <label class="info-title" for="exampleInputEmail1">Email <span>*</span></label>
                            <input type="email" id="email" name="email" value="{{$user->email}}" class="form-control" >
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                <strong>{{$message}}</strong>
                                </span>
                            @enderror
		                </div>

                        
                        <div class="form-group">
                            <label class="info-title" for="exampleInputEmail1">Phone <span>*</span></label>
                            <input type="text" id="phone" name="phone" value="{{$user->phone}}" class="form-control" >
                            @error('phone')
                                <span class="invalid-feedback" role="alert">
                                <strong>{{$message}}</strong>
                                </span>
                            @enderror
		                </div>

                        <div class="form-group">
                            <label class="info-title" for="exampleInputEmail1">User Image <span>*</span></label>
                            <input type="file" id="profile_photo_path" name="profile_photo_path"  class="form-control" >
                      
		                </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-danger">Update</button>
                        </div>
  

                        </form>
                    </div>
                </div>
            </div>
       
        </div>
    </div>

</div>

@endsection