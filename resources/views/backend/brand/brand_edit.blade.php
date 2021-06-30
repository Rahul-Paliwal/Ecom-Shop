
@extends('admin.admin_master')
@section('admin')

<div class="container mt-3">
<div class="row">
<div class="col-12">

<div class="box">
   <div class="box-header with-border">
     <h3 class="box-title">Edit Brand </h3>
   </div>
   <!-- /.box-header -->
   <div class="box-body">
      <div class="table-responsive">
      <form method="post" action="{{route('brand.update',$brand->id)}}"  enctype="multipart/form-data">
        @csrf

                         <input type="hidden" name="id" value="{{$brand->id}}">
                         <input type="hidden" name="old_image" value="{{$brand->brand_image}}">
                         
                                 <div class="form-group">
								   <h5>Brand Name English<span class="text-danger">*</span></h5>
								    <div class="controls">
									  <input type="text" name="brand_name_en" value="{{$brand->brand_name_en}}" class="form-control" > 
                                    @error('brand_name_en')
                                    <span class=" text-danger">{{$message}}</span>
                                    @enderror
                                    </div>
							     </div>
                                 <div class="form-group">
								   <h5>Brand Name Hindi<span class="text-danger">*</span></h5>
								    <div class="controls">
									  <input type="text" name="brand_name_hi" value="{{$brand->brand_name_hi}}"  class="form-control" > 
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
			<button type="submit" class="btn btn-rounded btn-primary mb-5">Update</button>
		</div>
	  </form>
      </div> 
   </div>
   <!-- /.box-body -->
 </div>
 <!-- /.box -->          
</div>
</div>
</div>

@endsection