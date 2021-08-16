@extends('admin.admin_master')
@section('admin')

	  <div class="container-full">
		<!-- Content Header (Page header) -->
		

		<!-- Main content -->
		<section class="content">
		  <div class="row">
          <div class="col-!2">

<div class="box">
   <div class="box-header with-border">
     <h3 class="box-title">Total Users <span class=" badge badge-pill badge-danger">{{count($users)}}</span> </h3>
   </div>
   <!-- /.box-header -->
   <div class="box-body">
       <div class="table-responsive">
         <div id="example1_wrapper" class="dataTables_wrapper container-fluid dt-bootstrap4">
         <div class="row">
         <div class="col-sm-12 col-md-6">
         <div class="dataTables_length" id="example1_length">
         
         </div></div>
         <div class="col-sm-12 col-md-6"><div id="example1_filter" class="dataTables_filter"></div></div></div>
         <div class="row">
         <div class="col-sm-12">
         <table id="example1" class="table table-bordered table-striped dataTable" role="grid" aria-describedby="example1_info">
           <thead>
               <tr>
               <th>Image</th>
               <th>Name</th>
               <th>Email</th>
               <th>Phone</th>
               <th>Status</th>
               <th>Action</th>
               </tr>
           </thead>
           <tbody>
           @foreach($users as $item)
                <tr role="row">
                   <td><img src="{{(!empty($item->profile_photo_path))?url('upload/user_images/'.$item->profile_photo_path):url('upload/no_image.jpg')}}" style="width:70px;height:70px;"></td>
                   <td>{{$item->name}}</td>
                   <td>{{$item->email}}</td>
                   <td>{{$item->phone}}</td>
                   <td> 
                      @if($item->UserOnline())
                        <span class="badge badge-pill badge-success">Active Now</span>
                      @else
                        <span class="badge badge-pill badge-danger">{{ Carbon\Carbon::parse($item->last_seen)->diffForHumans() }}</span>
                      @endif 
                  </td>
                   <td>
                   <a href="#"class="btn btn-info" title="Edit Data"><i class="fa fa-pencil"></i></a>
                   <a href="#"class="btn btn-danger" title="Delete Data" id="delete"><i class="fa fa-trash"></i></a>
                   </td>
               </tr>
               @endforeach
               </tbody>
      
         </table></div></div><div class="row"><div class="col-sm-12 col-md-5"></div><div class="col-sm-12 col-md-7">
         <div class="dataTables_paginate paging_simple_numbers" id="example1_paginate">
         </div></div></div></div>
       </div>
   </div>
   <!-- /.box-body -->
 </div>
 <!-- /.box -->          
</div>


</div>




		
		</section>
		<!-- /.content -->
	  
	  </div>



@endsection