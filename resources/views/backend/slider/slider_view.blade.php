@extends('admin.admin_master')
@section('admin')

	  <div class="container-full">
		<!-- Content Header (Page header) -->
		

		<!-- Main content -->
		<section class="content">
		  <div class="row">
          <div class="col-8">

<div class="box">
   <div class="box-header with-border">
     <h3 class="box-title">Slider Lists</h3>
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
               <th>Slider Image </th>
               <th>Title</th>
               <th>Description</th>
               <th>Status</th>
               <th>Action</th>
               </tr>
           </thead>
           <tbody>
           @foreach($sliders as $item)
                <tr role="row">
                   <td><img src="{{asset($item->slider_img)}}" style="width:70px;height:70px;"></td>
                   <td>
                   @if($item->title==NULL)
                      <span class="badge badge-pill badge-danger">No Title</span>
                      @else
                      {{$item->title}}
                      @endif
                   </td>
                   <td>{{$item->description}}</td>
                   <td>
                      @if($item->status==1)
                      <span class="badge badge-pill badge-success">Active</span>
                      @else
                      <span class="badge badge-pill badge-danger">InActive</span>
                      @endif
                    </td>
                    <td width="30%">
                
                <a href="{{route('slider.edit',$item->id)}}"class="btn btn-info btn-sm" title="Edit Data"><i class="fa fa-pencil"></i></a>
                <a href="{{route('slider.delete',$item->id)}}"class="btn btn-danger btn-sm" title="Delete Data" id="delete"><i class="fa fa-trash"></i></a>
                @if($item->status==1)
                <a href="{{route('slider.inactive',$item->id)}}"class="btn btn-danger btn-sm" title="Inactive Now"><i class="fa fa-arrow-down"></i></a>
                @else
                <a href="{{route('slider.active',$item->id)}}"class="btn btn-success btn-sm" title="Active Now"><i class="fa fa-arrow-up"></i></a>
                @endif
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



<div class="col-4">

<div class="box">
   <div class="box-header with-border">
     <h3 class="box-title">Add Slider </h3>
   </div>
   <!-- /.box-header -->
   <div class="box-body">
      <div class="table-responsive">
      <form method="post" action="{{route('slider.store')}}"  enctype="multipart/form-data">
                    @csrf
					  	
                         
                                 <div class="form-group">
								   <h5>Slider Title<span class="text-danger">*</span></h5>
								    <div class="controls">
									  <input type="text" name="title" class="form-control" > 
                                    @error('title')
                                    <span class=" text-danger">{{$message}}</span>
                                    @enderror
                                    </div>
							     </div>
                                 <div class="form-group">
								   <h5>Slider Description <span class="text-danger">*</span></h5>
								    <div class="controls">
									  <input type="text" name="description"  class="form-control" > 
                                      @error('description')
                                    <span class=" text-danger">{{$message}}</span>
                                    @enderror
                                    </div>
							     </div>
                                 <div class="form-group">
								   <h5>Slider Image<span class="text-danger">*</span></h5>
								    <div class="controls">
									  <input type="file" name="slider_img"  class="form-control" > 
                                      @error('slider_img')
                                    <span class=" text-danger">{{$message}}</span>
                                    @enderror
                                    </div>
							     </div>
                          
                 
						
					
						<div class="text-xs-right">
							<input type="submit" value="save" class="btn btn-rounded btn-primary mb-5">
						</div>
					</form>
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