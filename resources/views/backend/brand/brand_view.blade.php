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
     <h3 class="box-title">Brand Lists <span class="badge badge-pill badge-success ">{{count($brands)}}</span></h3>
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
               <th>Brand En</th>
               <th>Brand Hi</th>
               <th>Image</th>
               <th>Action</th>
               </tr>
           </thead>
           <tbody>
           @foreach($brands as $item)
                <tr role="row">
                   <td class="sorting_1">{{$item->brand_name_en}} </td>
                   <td>{{$item->brand_name_hi}}</td>
                   <td><img src="{{asset($item->brand_image)}}" style="width:70px;height:70px;"></td>
                   <td>
                   <a href="{{route('brand.edit',$item->id)}}"class="btn btn-info" title="Edit Data"><i class="fa fa-pencil"></i></a>
                   <a href="{{route('brand.delete',$item->id)}}"class="btn btn-danger" title="Delete Data" id="delete"><i class="fa fa-trash"></i></a>
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
     <h3 class="box-title">Add Brand </h3>
   </div>
   <!-- /.box-header -->
   <div class="box-body">
      <div class="table-responsive">
      <form method="post" action="{{route('brand.store')}}"  enctype="multipart/form-data">
                    @csrf
					  	
                         
                                 <div class="form-group">
								   <h5>Brand Name English<span class="text-danger">*</span></h5>
								    <div class="controls">
									  <input type="text" name="brand_name_en" class="form-control" > 
                                    @error('brand_name_en')
                                    <span class=" text-danger">{{$message}}</span>
                                    @enderror
                                    </div>
							     </div>
                                 <div class="form-group">
								   <h5>Brand Name Hindi<span class="text-danger">*</span></h5>
								    <div class="controls">
									  <input type="text" name="brand_name_hi"  class="form-control" > 
                                      @error('brand_name_hi')
                                    <span class=" text-danger">{{$message}}</span>
                                    @enderror
                                    </div>
							     </div>
                                 <div class="form-group">
								   <h5>Brand Image<span class="text-danger">*</span></h5>
								    <div class="controls">
									  <input type="file" name="brand_image"  class="form-control" > 
                                      @error('brand_image')
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