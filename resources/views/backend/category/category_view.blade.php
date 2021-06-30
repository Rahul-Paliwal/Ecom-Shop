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
     <h3 class="box-title">Categories Lists</h3>
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
               <th >Category En</th>
               <th>Category Hi</th>
               <th>Category Icon</th>
               <th>Action</th>
               </tr>
           </thead>
           <tbody>
           @foreach($category as $item)
                <tr role="row">
                   <td>{{$item->category_name_en}}</td>
                   <td>{{$item->category_name_hi}}</td>
                   <td><span><i class="{{$item->category_icon}}"></i></span></td>
                   <td>
                   <a href="{{route('category.edit',$item->id)}}"class="btn btn-info" title="Edit Data"><i class="fa fa-pencil"></i></a>
                   <a href="{{route('category.delete',$item->id)}}"class="btn btn-danger" title="Delete Data" id="delete"><i class="fa fa-trash"></i></a>
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

<!-- Add Category  -->

<div class="col-4">

<div class="box">
   <div class="box-header with-border">
     <h3 class="box-title">Add Category </h3>
   </div>
   <!-- /.box-header -->
   <div class="box-body">
      <div class="table-responsive">
      <form method="post" action="{{route('category.store')}}"  enctype="multipart/form-data">
                    @csrf
					  	
                         
                                 <div class="form-group">
								   <h5>Category Name English<span class="text-danger">*</span></h5>
								    <div class="controls">
									  <input type="text" name="category_name_en" class="form-control" > 
                                    @error('category_name_en')
                                    <span class=" text-danger">{{$message}}</span>
                                    @enderror
                                    </div>
							     </div>
                                 <div class="form-group">
								   <h5>Category Name Hindi<span class="text-danger">*</span></h5>
								    <div class="controls">
									  <input type="text" name="category_name_hi"  class="form-control" > 
                                      @error('category_name_hi')
                                    <span class=" text-danger">{{$message}}</span>
                                    @enderror
                                    </div>
							     </div>
                                 <div class="form-group">
								   <h5>Category Icon<span class="text-danger">*</span></h5>
								    <div class="controls">
									  <input type="text" name="category_icon"  class="form-control" > 
                                      @error('category_icon')
                                    <span class=" text-danger">{{$message}}</span>
                                    @enderror
                                    </div>
							     </div>
                          
                 
						
					
						<div class="text-xs-right">
							<input type="submit" value="Save" class="btn btn-rounded btn-primary mb-5">
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