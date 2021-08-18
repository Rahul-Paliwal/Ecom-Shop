
@extends('admin.admin_master')
@section('admin')

<div class="container mt-3">
<div class="row">
<div class="col-12">

<div class="box">
   <div class="box-header with-border">
     <h3 class="box-title">Edit Blog Category </h3>
   </div>
   <!-- /.box-header -->
   <div class="box-body">
      <div class="table-responsive">
      <form method="post" action="{{route('blog_category.update',$blogcategory->id)}}" >
        @csrf

                            <input type="hidden" name="id" value="{{$blogcategory->id}}">
                                 <div class="form-group">
								   <h5>Blog Category Name English<span class="text-danger">*</span></h5>
								    <div class="controls">
									  <input type="text" name="blog_category_name_en" value="{{$blogcategory->blog_category_name_en}}" class="form-control" > 
                                    @error('blog_category_name_en')
                                    <span class=" text-danger">{{$message}}</span>
                                    @enderror
                                    </div>
							     </div>
                                 <div class="form-group">
								   <h5>Blog Category Name Hindi<span class="text-danger">*</span></h5>
								    <div class="controls">
									  <input type="text" name="blog_category_name_hi" value="{{$blogcategory->blog_category_name_hi}}"  class="form-control" > 
                                      @error('blog_category_name_hi')
                                    <span class=" text-danger">{{$message}}</span>
                                    @enderror
                                    </div>
							     </div>
                       
                          
                 
						
					
		<div class="text-xs-right">
			<input type="submit"  value="Update" class="btn btn-rounded btn-primary mb-5">
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