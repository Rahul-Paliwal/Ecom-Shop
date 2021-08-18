@extends('admin.admin_master')
@section('admin')

	  <div class="container-full">
		<!-- Content Header (Page header) -->
		

		<!-- Main content -->
		<section class="content">
		  <div class="row">
          <div class="col-12">

<div class="box">
   <div class="box-header with-border">
     <h3 class="box-title">Blog Post Lists <span class="badge badge-pill badge-success ">{{count($blogpost)}}</span></h3>
     <a href="{{route('add.blog_post')}}" class="btn btn-success" style="float:right;">Add Post</a>
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
               <th>Post Category </th>
               <th>Post Image</th>
               <th>Post Title En</th>
               <th>Post Title Hi</th>
               <th>Action</th>
               </tr>
           </thead>
           <tbody>
           @foreach($blogpost as $item)
                <tr role="row">
                   <td>{{$item->category->blog_category_name_en}}</td>
                   <td><img src="{{asset($item->post_image)}}" style="width:60px; height:60px;"></td>
                   <td>{{$item->post_title_en}}</td>
                   <td>{{$item->post_title_hi}}</td>
                   <td>
                   <a href="{{route('blog_post.edit',$item->id)}}"class="btn btn-info" title="Edit Data"><i class="fa fa-pencil"></i></a>
                   <a href="{{route('blog_post.delete',$item->id)}}"class="btn btn-danger" title="Delete Data" id="delete"><i class="fa fa-trash"></i></a>
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