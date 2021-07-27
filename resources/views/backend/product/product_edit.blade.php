@extends('admin.admin_master')
@section('admin')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	  <div class="container-full">
		<!-- Content Header (Page header) -->
		<div class="content-header">
			<div class="d-flex align-items-center">
				<div class="mr-auto">
					<h3 >Edit Product</h3>
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
					<form method="post" action="{{route('product-update')}}" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="id" value="{{$products->id}}"> 
					  <div class="row">
						<div class="col-12">
                                <div class="row">
                                <div class="col-md-4">
                                        <div class="form-group">
                                        <h5>Brand Select <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <select name="brand_id"  class="form-control">
                                                <option value="" selected=""disabled="">Select Brand</option>
                                                @foreach($brands as $brand)
                                                   <option value="{{$brand->id}}"{{$brands->id=$products->brand_id ? 'selected':''}}>{{$brand->brand_name_en}}</option>
                                                @endforeach
                                            </select>
                                            @error('brand_id')
                                            <span class=" text-danger">{{$message}}</span>
                                            @enderror
                                        <div class="help-block"></div></div>
                                        </div>  

                                        </div>
                                        <div class="col-md-4">
                                        <div class="form-group">
                                        <h5>Category Select <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <select name="category_id"  class="form-control">
                                                <option value="" selected=""disabled="">Select Category</option>
                                                @foreach($categories as $category)
                                                  <option value="{{$category->id}}" {{$category->id==$products->category_id ? 'selected':''}}>{{$category->category_name_en}}</option>
                                                @endforeach
                                            </select>
                                            @error('category_id')
                                            <span class=" text-danger">{{$message}}</span>
                                            @enderror
                                        <div class="help-block"></div></div>
                                        </div>
                                        </div>
                                        <div class="col-md-4">
                                            
                                        <div class="form-group">
                                        <h5>SubCategory Select <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <select name="subcategory_id"  class="form-control">
                                                <option value="" selected="" disabled="">Select SubCategory</option>
                                                @foreach($subcategory as $sub)
                                                  <option value="{{$sub->id}}" {{$sub->id==$products->subcategory_id ? 'selected':''}}>{{$sub->subcategory_name_en}}</option>
                                                @endforeach
                                            </select>
                                            @error('subcategory_id')
                                            <span class=" text-danger">{{$message}}</span>
                                            @enderror
                                        <div class="help-block"></div></div>
                                        </div> 
                                        </div>

                                 </div>
                                 <!-- 2nd Row -->
                                 <div class="row">
                                <div class="col-md-4">

                                        <div class="form-group">
                                        <h5>SubSubCategory Select <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <select name="subsubcategory_id"  class="form-control">
                                                <option value="" selected=""disabled="">Select SubSub Category</option>
                                                @foreach($subsubcategory as $subsub)
                                                  <option value="{{$subsub->id}}" {{$subsub->id==$products->subsubcategory_id ? 'selected':''}}>{{$subsub->subsubcategory_name_en}}</option>
                                                @endforeach
                                            </select>
                                            @error('subsubcategory_id')
                                            <span class=" text-danger">{{$message}}</span>
                                            @enderror
                                        <div class="help-block"></div></div>
                                        </div>  

                                        </div>
                                        <div class="col-md-4">
                                         <div class="form-group">
								            <h5>Product Name En <span class="text-danger">*</span></h5>
								            <div class="controls">
									          <input type="text" name="product_name_en" value="{{$products->product_name_en}}" class="form-control"> </div>
                                              @error('product_name_en')
                                                <span class=" text-danger">{{$message}}</span>
                                              @enderror
							             </div>
                                        </div>
                                        <div class="col-md-4">
                                            
                                            <div class="form-group">
                                                <h5>Product Name Hi <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                <input type="text" name="product_name_hi" value="{{$products->product_name_hi}}" class="form-control"> </div>
                                                @error('product_name_hi')
                                                    <span class=" text-danger">{{$message}}</span>
                                                @enderror
                                            </div>
                                         </div>

                                 </div>

                             <!-- 3rd Row -->
                                   <div class="row">
                                        <div class="col-md-4">

                                                <div class="form-group">
                                                    <h5>Product Code<span class="text-danger">*</span></h5>
                                                    <div class="controls">
                                                    <input type="text" name="product_code" value="{{$products->product_code}}" class="form-control"> </div>
                                                    @error('product_code')
                                                        <span class=" text-danger">{{$message}}</span>
                                                    @enderror
                                                </div>
                                        </div>
                                        <div class="col-md-4">
                                         <div class="form-group">
								            <h5>Product Qty <span class="text-danger">*</span></h5>
								            <div class="controls">
									          <input type="text" name="product_qty" value="{{$products->product_qty}}" class="form-control"> </div>
                                              @error('product_qty')
                                                <span class=" text-danger">{{$message}}</span>
                                              @enderror
							             </div>
                                        </div>
                                        <div class="col-md-4">
                                            
                                            <div class="form-group">
								             <h5>Product Tags En <span class="text-danger">*</span></h5>
								             <div class="controls">
                                             <input type="text" name="product_tags_en" value="{{$products->product_tags_en}}" data-role="tagsinput" /></div>
                                              @error('product_tags_en')
                                                <span class=" text-danger">{{$message}}</span>
                                              @enderror
							                 </div>
                                        </div>
                                    </div>

                                <!-- 4th Row -->
                                <div class="row">
                                <div class="col-md-4">
                                            
                                            <div class="form-group">
								             <h5>Product Tags Hi <span class="text-danger">*</span></h5>
								             <div class="controls">
                                             <input type="text" name="product_tags_hi" value="{{$products->product_tags_hi}}" data-role="tagsinput" /></div>
                                              @error('product_tags_hi')
                                                <span class=" text-danger">{{$message}}</span>
                                              @enderror
							                 </div>
                                        </div>
                                        <div class="col-md-4">

                                                <div class="form-group">
                                                    <h5>Product Size En<span class="text-danger">*</span></h5>
                                                    <div class="controls">
                                                    <input type="text" name="product_size_en" value="{{$products->product_size_en}}" class="form-control"  data-role="tagsinput"> </div>
                                                    @error('product_size_en')
                                                        <span class=" text-danger">{{$message}}</span>
                                                    @enderror
                                                </div>
                                        </div>
                                        <div class="col-md-4">
                                              <div class="form-group">
                                                    <h5>Product Size Hi<span class="text-danger">*</span></h5>
                                                    <div class="controls">
                                                    <input type="text" name="product_size_hi" value="{{$products->product_size_hi}}" class="form-control"  data-role="tagsinput"> </div>
                                                    @error('product_size_hi')
                                                        <span class=" text-danger">{{$message}}</span>
                                                    @enderror
                                                </div>
                                        </div>

                                    </div>

                                     <!-- 5th Row -->
                                <div class="row">
                                <div class="col-md-6">
                                            
                                            <div class="form-group">
								             <h5>Product Color En <span class="text-danger">*</span></h5>
								             <div class="controls">
                                             <input type="text" name="product_color_en" value="{{$products->product_color_en}}" data-role="tagsinput" /></div>
                                              @error('product_color_en')
                                                <span class=" text-danger">{{$message}}</span>
                                              @enderror
							                 </div>
                                        </div>
                                        <div class="col-md-6">

                                                <div class="form-group">
                                                    <h5>Product Color Hi<span class="text-danger">*</span></h5>
                                                    <div class="controls">
                                                    <input type="text" name="product_color_hi" class="form-control" value="{{$products->product_color_hi}}" data-role="tagsinput"> </div>
                                                    @error('product_color_hi')
                                                        <span class=" text-danger">{{$message}}</span>
                                                    @enderror
                                                </div>
                                        </div>


                                    </div>
                                <!-- 6th Row -->
                          <div class="row">
                          <div class="col-md-6">
                                              <div class="form-group">
                                                    <h5>Product Selling Price <span class="text-danger">*</span></h5>
                                                    <div class="controls">
                                                    <input type="text" name="selling_price" value="{{$products->selling_price}}" class="form-control" > </div>
                                                    @error('selling_price')
                                                        <span class=" text-danger">{{$message}}</span>
                                                    @enderror
                                                </div>
                                        </div>
                                <div class="col-md-6">
                                            
                                            <div class="form-group">
                                              <h5>Product Discount Price <span class="text-danger">*</span></h5>
                                              <div class="controls">
                                                              <input type="text" name="discount_price" value="{{$products->discount_price}}" class="form-control" /></div>
                                                              @error('discount_price')
                                                                <span class=" text-danger">{{$message}}</span>
                                                              @enderror
                                                </div>
                                        </div>
                                   

                                    </div>
                                <!-- 7th Row -->
                                  <div class="row">
                                    <div class="col-md-6">
                                                  <div class="form-group">
                                                    <h5>Short Description English <span class="text-danger">*</span></h5>
                                                    <div class="controls">
                                                    <textarea name="short_descp_en" class="form-control" >
                                                    {{!! $products->short_descp_en !!}}
                                                    </textarea> </div>
                                                    @error('short_descp_en')
                                                        <span class=" text-danger">{{$message}}</span>
                                                    @enderror
                                                  </div>
                                    </div>
                                    <div class="col-md-6">
                                                  <div class="form-group">
                                                    <h5>Short Description Hindi <span class="text-danger">*</span></h5>
                                                    <div class="controls">
                                                    <textarea name="short_descp_hi" class="form-control" >
                                                    {{!! $products->short_descp_hi !!}}
                                                    </textarea> </div>
                                                    @error('short_descp_hi')
                                                        <span class=" text-danger">{{$message}}</span>
                                                    @enderror
                                                  </div>
                                    </div>
                                  </div>

                                <!-- 8th Row -->
                                  <div class="row">
                                    <div class="col-md-6">
                                                  <div class="form-group">
                                                    <h5>Long Description English <span class="text-danger">*</span></h5>
                                                    <div class="controls">
                                                    <textarea id="editor1" name="long_descp_en"  rows="10" cols="80">
                                                    {{!! $products->long_descp_en !!}}
                                                    </textarea> </div>
                                                    @error('long_descp_en')
                                                        <span class=" text-danger">{{$message}}</span>
                                                    @enderror
                                                  </div>
                                    </div>
                                    <div class="col-md-6">
                                                  <div class="form-group">
                                                    <h5>Long Description Hindi <span class="text-danger">*</span></h5>
                                                    <div class="controls">
                                                    <textarea id="editor2" name="long_descp_hi"  rows="10" cols="80">
                                                    {{!! $products->long_descp_hi !!}}
                                                    </textarea> </div>
                                                    @error('short_descp_hi')
                                                        <span class=" text-danger">{{$message}}</span>
                                                    @enderror
                                                  </div>
                                    </div>
                                  </div>

                                  <hr>


						</div>
					  </div>
						<div class="row">
            <div class="col-md-6">
								<div class="form-group">
									<h5>Checkbox Group <span class="text-danger">*</span></h5>
									<div class="controls">
										<fieldset>
											<input type="checkbox" id="checkbox_2" name="hot_deals"  value="1" {{ $products->hot_deals == 1 ? 'checked':'' }}>
											<label for="checkbox_2">Hot Deals</label>
										</fieldset>
										<fieldset>
											<input type="checkbox" id="checkbox_3" name="featured" value="1" {{ $products->featured == 1 ? 'checked':'' }}>
											<label for="checkbox_3">Featured</label>
										</fieldset>
									</div>
								</div>
							</div>

							<div class="col-md-6">
								<div class="form-group">
									<h5>Checkbox Group <span class="text-danger">*</span></h5>
									<div class="controls">
										<fieldset>
											<input type="checkbox" id="checkbox_4" name="special_offer" value="1" {{ $products->special_offer == 1 ? 'checked':'' }}>
											<label for="checkbox_4">Special Offer</label>
										</fieldset>
										<fieldset>
											<input type="checkbox" id="checkbox_5" name="special_deals" value="1" {{ $products->special_deals == 1 ? 'checked':'' }}>
											<label for="checkbox_5">Special Deals</label>
										</fieldset>
									</div>
								</div>
							</div>
						</div>

						<div class="text-xs-right">
							<input type="submit" class="btn btn-rounded btn-primary mb-5" value="Update Product">
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
    <!-- ///////////////////////// Start Multiple Image Update Area //////////////////////////// -->
    <section class="content">
    <div class="row">
    <div class="col-md-12">
				<div class="box bt-3 border-info">
				  <div class="box-header">
					<h4 class="box-title">Product Multiple Image <strong>Update</strong></h4>
				  </div>
            <form method="post" action="{{route('update-product-image')}}" enctype="multipart/form-data">
            @csrf
             <div class="row row-sm">
                @foreach($multiImgs as $img)
                <div class="col-md-3">
                <div class="card">
                      <img class="card-img-top" src="{{asset($img->photo_name)}}" style="height:130px; width:280px;">
                      <div class="card-body">
                        <h5 class="card-title">
                        <a href="{{route('product.multiimg.delete',$img->id)}}" class="btn  btn-danger" id="delete" title="Delete Data"><i class="fa fa-trash"></i></a>
                        </h5>
                        <p class="card-text">
                        <div class="form-group">
                        <label class="form-control-label">Change Image<span class="tx-danger">*</span></label>
                        <input class="form-control" type="file" name="multi_img[{{$img->id}}]"/>
                        </div>
                        </p>

                      </div>
                    </div>
                </div>
                @endforeach
             </div>
                <div class="text-xs-right">
                      <input type="submit" class="btn btn-rounded btn-primary mb-5" value="Update Image">                
                </div>
            </form>
				</div>
			  </div>
    </div>
    </section>


        <!-- ///////////////////////// Start Thumbnil Image Update Area //////////////////////////// -->
        <section class="content">
    <div class="row">
    <div class="col-md-12">
				<div class="box bt-3 border-info">
				  <div class="box-header">
					<h4 class="box-title">Product Thumbnil Image <strong>Update</strong></h4>
				  </div>
            <form method="post" action="{{route('update-product-thumbnil')}}" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="id" value="{{$products->id}}">
            <input type="hidden" name="old_img" value="{{$products->product_thumbnil}}">
             <div class="row row-sm">

                <div class="col-md-3">
                <div class="card">
                      <img class="card-img-top" src="{{asset($products->product_thumbnil)}}" style="height:130px; width:280px;">
                      <div class="card-body">
                        <p class="card-text">
                        <div class="form-group">
                        <label class="form-control-label">Change Image<span class="tx-danger">*</span></label>
                        <input type="file" name="product_thumbnil" value="{{$products->product_thumbnil}}" class="form-control" onChange="mainThumbUrl(this)" />
                        <img src="" id="mainThumb">                                 
                        </div>
                        </p>

                      </div>
                    </div>
                </div>

             </div>
                <div class="text-xs-right">
                      <input type="submit" class="btn btn-rounded btn-primary mb-5" value="Update Image">                
                </div>
            </form>
				</div>
			  </div>
    </div>
    </section>






	  </div>


    <script type="text/javascript">
      $(document).ready(function() {
        $('select[name="category_id"]').on('change', function(){
            var category_id = $(this).val();
            if(category_id) {
                $.ajax({
                    url: "{{ url('/category/subcategory/ajax') }}/"+category_id,
                    type:"GET",
                    dataType:"json",
                    success:function(data) {
                      $('select[name="subsubcategory_id"]').html('');
                       var d =$('select[name="subcategory_id"]').empty();
                          $.each(data, function(key, value){
                              $('select[name="subcategory_id"]').append('<option value="'+ value.id +'">' + value.subcategory_name_en + '</option>');
                          });
                    },
                });
            } else {
                alert('danger');
            }
        });


        $('select[name="subcategory_id"]').on('change', function(){
            var subcategory_id = $(this).val();
            if(subcategory_id) {
                $.ajax({
                    url: "{{  url('/category/sub-subcategory/ajax') }}/"+subcategory_id,
                    type:"GET",
                    dataType:"json",
                    success:function(data) {
                       var d =$('select[name="subsubcategory_id"]').empty();
                          $.each(data, function(key, value){
                              $('select[name="subsubcategory_id"]').append('<option value="'+ value.id +'">' + value.subsubcategory_name_en + '</option>');
                          });
                    },
                });
            } else {
                alert('danger');
            }
        });
    });
    </script>
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
    <script type="text/javascript">
          $(document).ready(function(){
   $('#multiImg').on('change', function(){ //on file input change
      if (window.File && window.FileReader && window.FileList && window.Blob) //check File API supported browser
      {
          var data = $(this)[0].files; //this file data
           
          $.each(data, function(index, file){ //loop though each file
              if(/(\.|\/)(gif|jpe?g|png)$/i.test(file.type)){ //check supported file type
                  var fRead = new FileReader(); //new filereader
                  fRead.onload = (function(file){ //trigger function on successful read
                  return function(e) {
                      var img = $('<img/>').addClass('thumb').attr('src', e.target.result) .width(80)
                  .height(80); //create image element 
                      $('#preview_img').append(img); //append image to output element
                  };
                  })(file);
                  fRead.readAsDataURL(file); //URL representing the file's data.
              }
          });
           
      }
      else
      {
          alert("Your browser doesn't support File API!"); //if File API is absent
      }
   });
  });
   

    </script>

@endsection