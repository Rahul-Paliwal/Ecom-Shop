@extends('admin.admin_master')
@section('admin')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	  <div class="container-full">
		<!-- Content Header (Page header) -->
		<div class="content-header">
			<div class="d-flex align-items-center">
				<div class="mr-auto">
					<h3 >Add Blog Post</h3>
				</div>
			</div>
		</div>	  

		<!-- Main content -->
		<section class="content">

		 <!-- Basic Forms -->
		  <div class="box">
			<!-- /.box-header -->
			<div class="box-body">
			  <div class="row">
				<div class="col">
					<form method="post" action="{{route('blog-store')}}" enctype="multipart/form-data">
                      @csrf
					  <div class="row">
						<div class="col-12">

                                 <div class="row">
                                        <div class="col-md-6">
                                         <div class="form-group">
								            <h5>Post Title English <span class="text-danger">*</span></h5>
								            <div class="controls">
									          <input type="text" name="post_title_en" class="form-control" value="{{$blogpost->post_title_en}}"  required=""> </div>
                                              @error('post_title_en')
                                                <span class=" text-danger">{{$message}}</span>
                                              @enderror
							             </div>
                                        </div>
                                        <div class="col-md-6">
                                            
                                            <div class="form-group">
                                                <h5>Post Title Hindi <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                <input type="text" name="post_title_hi" class="form-control" value="{{$blogpost->post_title_hi}}"  required=""> </div>
                                                @error('post_title_hi')
                                                    <span class=" text-danger">{{$message}}</span>
                                                @enderror
                                            </div>
                                         </div>

                                 </div>

                                <!-- 2nd Row -->
                          <div class="row">
                                 
                                        <div class="col-md-6">
                                            
                                        <input type="hidden" name="id" value="{{$blogpost->id}}" >
                                        <input type="hidden" name="old_image" value="{{$blogpost->post_image}}">
                                        <div class="form-group">
                                                <h5>Blog Category Select <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <select name="category_id"  class="form-control" required="">
                                                        <option value="" selected="" disabled="" >Select Blog Category</option>
                                                        @foreach($blogpost as $category)
                                                          <option value="{{$category->id}}" {{$category->id == $blogpost->category_id ? 'selected': ' ' }} > {{$category->blog_category_name_en}}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('category_id')
                                                    <span class=" text-danger">{{$message}}</span>
                                                    @enderror
                                                <div class="help-block"></div></div>
                                            </div>  
                                        
                                        
         
                                        </div>
                                        <div class="col-md-6">

                                            <div class="form-group">
                                              <h5>Post Image <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                          <input type="file" name="post_image" class="form-control" onChange="mainThumbUrl(this)"  required=""/>
                                                          
                               
                                                            @error('post_image')
                                                              <span class=" text-danger">{{$message}}</span>
                                                            @enderror
                                                        <img src="" id="mainThumb"/>
                                                </div>
                                        </div>
                                  </div>
                                   

                                <!-- 3rd Row -->
                                  <div class="row">
                                    <div class="col-md-6">
                                                  <div class="form-group">
                                                    <h5>Post Details English <span class="text-danger">*</span></h5>
                                                    <div class="controls">
                                                    <textarea id="editor1" name="post_details_en" rows="10" cols="80"  required="">
                                                        Post Details English
                                                    </textarea> </div>
                                                    @error('post_details_en')
                                                        <span class=" text-danger">{{$message}}</span>
                                                    @enderror
                                                  </div>
                                    </div>
                                    <div class="col-md-6">
                                                  <div class="form-group">
                                                    <h5>Post Details Hindi <span class="text-danger">*</span></h5>
                                                    <div class="controls">
                                                    <textarea id="editor2" name="post_details_hi" rows="10" cols="80"  required="">
                                                        Post Details Hindi
                                                    </textarea> </div>
                                                    @error('post_details_hi')
                                                        <span class=" text-danger">{{$message}}</span>
                                                    @enderror
                                                  </div>
                                    </div>
                                  </div>

                                  <hr>


						</div>
					  </div>
	

						<div class="text-xs-right">
							<input type="submit" class="btn btn-rounded btn-primary mb-5" value="Add Product">
              			</div>
					</form>

				</div>
				<!-- /.col -->
			  </div>
			  <!-- /.row -->
			</div>
			<!-- /.box-body -->
		  </div>
		  <!-- /.box -->

		</section>
		<!-- /.content -->
	  </div>

    <script type="text/javascript">
      function mainThumbUrl(input){
        if(input.files && input.files[0]){
          var reader = new FileReader();
          reader.onload =function(e){
            $('#mainThumb').attr('src',e.target.result).width(80).height(80);
          };
          reader.readAsDataURL(input.files[0]);
        }
      }
    </script>
   

@endsection