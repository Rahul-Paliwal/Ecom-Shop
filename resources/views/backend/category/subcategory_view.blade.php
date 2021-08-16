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
     <h3 class="box-title">SubCategories Lists <span class="badge badge-pill badge-success ">{{count($subcategory)}}</span></h3>
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
               <th>Category</th>
               <th >SubCategory En</th>
               <th>SubCategory Hi</th>
               <th>Action</th>
               </tr>
           </thead>
           <tbody>
           @foreach($subcategory as $item)
                <tr role="row">
                   <td>{{$item['category']['category_name_en']}}</td>
                   <td>{{$item->subcategory_name_en}}</td>
                   <td>{{$item->subcategory_name_hi}}</td>
                   <td>
                   <a href="{{route('subcategory.edit',$item->id)}}"class="btn btn-info" title="Edit Data"><i class="fa fa-pencil"></i></a>
                   <a href="{{route('subcategory.delete',$item->id)}}"class="btn btn-danger" title="Delete Data" id="delete"><i class="fa fa-trash"></i></a>
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
     <h3 class="box-title">Add SubCategory </h3>
   </div>
   <!-- /.box-header -->
   <div class="box-body">
      <div class="table-responsive">
      <form method="post" action="{{route('subcategory.store')}}" >
                    @csrf
					  	
              <div class="form-group">
								<h5>Category <span class="text-danger">*</span></h5>
								<div class="controls">
									<select name="category_id"  class="form-control">
										<option value="" selected=""disabled="">Select Your Category</option>
										@foreach($categories as $category)
                                        <option value="{{$category->id}}">{{$category->category_name_en}}</option>
                                        @endforeach
									</select>
                                    @error('category_id')
                                    <span class=" text-danger">{{$message}}</span>
                                    @enderror
								<div class="help-block"></div></div>
							</div>  
                                 <div class="form-group">
								   <h5>SubCategory Name English<span class="text-danger">*</span></h5>
								    <div class="controls">
									  <input type="text" name="subcategory_name_en" class="form-control" > 
                                    @error('subcategory_name_en')
                                    <span class=" text-danger">{{$message}}</span>
                                    @enderror
                                    </div>
							     </div>
                                 <div class="form-group">
								   <h5>SubCategory Name Hindi<span class="text-danger">*</span></h5>
								    <div class="controls">
									  <input type="text" name="subcategory_name_hi"  class="form-control" > 
                                      @error('subcategory_name_hi')
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