<!DOCTYPE html>
<html lang="en">
<head>
<!-- Meta -->
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
<meta name="description" content="">
<meta name="csrf_token" content="{{csrf_token()}}">
<meta name="author" content="">
<meta name="keywords" content="MediaCenter, Template, eCommerce">
<meta name="robots" content="all">
<title>@yield('title')</title>

<!-- Bootstrap Core CSS -->
<link rel="stylesheet" href="{{asset('frontend/assets/css/bootstrap.min.css')}}">

<!-- Customizable CSS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css" integrity="sha512-3pIirOrwegjM6erE5gPSwkUzO+3cTjpnV9lexlNZqvupR64iZBnOOTiiLPb9M36zpMScbmUNIcHUqKD47M719g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="stylesheet" href="{{asset('frontend/assets/css/main.css')}}">
<link rel="stylesheet" href="{{asset('frontend/assets/css/blue.css')}}">
<link rel="stylesheet" href="{{asset('frontend/assets/css/owl.carousel.css')}}">
<link rel="stylesheet" href="{{asset('frontend/assets/css/owl.transitions.css')}}">
<link rel="stylesheet" href="{{asset('frontend/assets/css/animate.min.css')}}">
<link rel="stylesheet" href="{{asset('frontend/assets/css/rateit.css')}}">
<link rel="stylesheet" href="{{asset('frontend/assets/css/bootstrap-select.min.css')}}">

<!-- Icons/Glyphs -->
<link rel="stylesheet" href="{{asset('frontend/assets/css/font-awesome.css')}}">

<!-- Fonts -->
<link href='http://fonts.googleapis.com/css?family=Roboto:300,400,500,700' rel='stylesheet' type='text/css'>
<link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,400italic,600,600italic,700,700italic,800' rel='stylesheet' type='text/css'>
<link href='https://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
</head>
<body class="cnt-home">
@include('frontend.body.header')

@yield('content')

@include('frontend.body.footer')






<!-- JavaScripts placed at the end of the document so the pages load faster --> 

<script src="{{asset('frontend/assets/js/jquery-1.11.1.min.js')}}"></script> 
<script src="{{asset('frontend/assets/js/bootstrap.min.js')}}"></script> 
<script src="{{asset('frontend/assets/js/bootstrap-hover-dropdown.min.js')}}"></script> 
<script src="{{asset('frontend/assets/js/owl.carousel.min.js')}}"></script> 
<script src="{{asset('frontend/assets/js/echo.min.js')}}"></script> 
<script src="{{asset('frontend/assets/js/jquery.easing-1.3.min.js')}}"></script> 
<script src="{{asset('frontend/assets/js/bootstrap-slider.min.js')}}"></script> 
<script src="{{asset('frontend/assets/js/jquery.rateit.min.js')}}"></script> 
<script type="text/javascript" src="{{asset('frontend/assets/js/lightbox.min.js')}}"></script> 
<script src="{{asset('frontend/assets/js/bootstrap-select.min.js')}}"></script> 
<script src="{{asset('frontend/assets/js/wow.min.js')}}"></script> 
<script src="{{asset('frontend/assets/js/scripts.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>


<script>
 @if(Session::has('message'))
 var type = "{{ Session::get('alert-type','info') }}"
 switch(type){
    case 'info':
    toastr.info(" {{ Session::get('message') }} ");
    break;

    case 'success':
    toastr.success(" {{ Session::get('message') }} ");
    break;

    case 'warning':
    toastr.warning(" {{ Session::get('message') }} ");
    break;

    case 'error':
    toastr.error(" {{ Session::get('message') }} ");
    break; 
 }
 @endif 
</script>

<!-- Add to cart Model -->
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><strong><span id ="p_name"></span></strong></h5>
        <button type="button" class="close" id="closeModal" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
            <div class="row">
               <div class="col-md-4">
                 <div class="card" style="width: 18rem;">
                     <img src=" " id="p_img" class="card-img-top" alt="..." style="height:200px; width:200px;">
                     
                  </div>
               </div>
               <div class="col-md-4">
                <ul class="list-group">
                  <li class="list-group-item">Product Price: <strong class="text-danger">$<span id="price"></span></strong>
                     <del id="oldprice">$</del>
                  </li>
                  <li class="list-group-item">Product Code: <strong id="p_code"></strong></li>
                  <li class="list-group-item">Category: <strong id="p_category"></strong></li>
                  <li class="list-group-item">Brand: <strong id="p_brand"></strong></li>
                  <li class="list-group-item">Stock: 
                     <span id="available" class="badge badge-pill badge-success" style="background:green; color:white"></span>
                     <span id="stockout" class="badge badge-pill badge-danger" style="background:red; color:white"></span>
                  </li>
                </ul>
               </div>
               <div class="col-md-4">
                 <div class="form-group">
                     <label for="exampleFormControlSelect1">Choose Color</label>
                     <select class="form-control" id="color" name="color">
                        <option></option>
                        
                     </select>
                  </div> 

                  <div class="form-group" id="sizeArea">
                     <label for="exampleFormControlSelect1">Choose Size</label>
                     <select class="form-control" id="size" name="size">
                        <option></option>
                       
                     </select>
                  </div> 

                  <div class="form-group">
                     <label for="exampleFormControlInput1">Qty</label>
                     <input type="number" name="" class="form-control" id="qty" min="1" value="1">
                  </div>
                  
                  <input type="hidden" id="product_id">
                  <button type="submit" class="btn btn-primary mb-2" onclick="addToCart()">Add to Cart</button>
               </div>
            </div>   
            <!-- End row -->
      </div>
      <!-- END modal body -->

    </div>
  </div>
</div>
<!-- End Add to cart model -->

<script type="text/javascript">
$.ajaxSetup({
   headers:{
      'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
   }
})

// Start Product_view modal 
function productView(id){
   // alert(id);
   $.ajax({
      type:'GET',
      url:'/product/view/modal/'+id,
      dataType:'json',
      success:function(data){
            // console.log(data);
            $('#p_name').text(data.product.product_name_en);
            $('#p_price').text(data.product.selling_price);
            $('#p_code').text(data.product.product_code);
            $('#p_category').text(data.product.category.category_name_en);
            $('#p_brand').text(data.product.brand.brand_name_en);
            $('#p_img').attr('src','/'+data.product.product_thumbnil);
            $('#product_id').val(id);
            $('#qty').val(1);
            

            // product price conditin
            if(data.product.discount_price == null){
               $('#price').text('');
               $('#oldprice').text('');
                  $('#price').text(data.product.selling_price);
            }
            else{
               $('#price').text(data.product.discount_price);
               $('#oldprice').text(data.product.selling_price);
            }

            // in stock condition
            if(data.product.product_qty > 0){
               $('#available').text('');
               $('#stockout').text('');
               $('#available').text('available');
               }
            else
               {
                  $('#available').text('');
                  $('#stockout').text('');
                  $('#stockout').text('stockout');

                  }

            // color & size
            $('select[name="color"]').empty();
            $.each(data.color,function(key,val){
               $('select[name="color"]').append('<option value=" '+val+' "> '+ val +' </option>')
            })
            
            
            $('select[name="size"]').empty();
            $.each(data.size,function(key,val){
               $('select[name="size"]').append('<option value=" '+val+' ">'+val+' </option>')
               if (data.size == "") 
                  {
                     $('#sizeArea').hide();
                     }
               else
                  {
                     $('#sizeArea').show();
                     }
            })

      }

   })
}
// End


// Start add to cart
   function addToCart(){
      var product_name = $('#p_name').text();
      var id=$('#product_id').val();
      var color=$('#color option:selected').text();
      var size=$('#size option:selected').text();
      var qty=$('#qty').val();
      $.ajax({
         type:'POST',
         dataType:'json',
         data:{
            color:color, 
            size:size,
            qty:qty,
            product_name:product_name,
            _token: '{{csrf_token()}}'
         },
         url: "/cart/data/store/"+id,
         success:function(data){
            miniCart();
            $('#closeModal').click();
            // console.log(data);
            // start message
            const Toast = Swal.mixin({
                      toast: true,
                      position: 'top-end',
                      icon: 'success',
                      showConfirmButton: false,
                      timer: 3000
                    })
                if ($.isEmptyObject(data.error)) {
                    Toast.fire({
                        type: 'success',
                        title: data.success
                    })
                }else{
                    Toast.fire({
                        type: 'error',
                        title: data.error
                    })
                }      // End 
         }
      })

   }
// end

</script>
<script type="text/javascript">
      function miniCart(){
       $.ajax({
          type:'GET',
          url:'/product/mini/cart/',
          dataType:'json',
          success:function(response){
            //  console.log(response);
            $('span[id="cartSubTotal"]').text(response.cartTotal);
                $('#cartQty').text(response.cartQty);

            
            var miniCart = ""
                $.each(response.carts, function(key,val){
                    miniCart += `<div class="cart-item product-summary">
                  <div class="row">
                    <div class="col-xs-4">
                      <div class="image"> <a href="detail.html"><img src="/${val.options.image}" alt=""></a> </div>
                    </div>
                    <div class="col-xs-7">
                      <h3 class="name"><a href="index.php?page-detail">${val.name}</a></h3>
                      <div class="price">${val.price}*${val.qty}</div>
                    </div>
                    <div class="col-xs-1 action"> <button type="submit" id="${val.rowId}" onClick="miniCartDelete(this.id)"><i class="fa fa-trash"></i></button> </div>
                  </div>
                </div>
                <!-- /.cart-item -->
                <div class="clearfix"></div>
                <hr>`
                });
                
                $('#miniCart').html(miniCart);
         
         
          }

       })  
      }
      miniCart();
      // Start minicart delete
         function miniCartDelete(rowId){
            $.ajax({
               type:'GET',
               url:'/minicart/product-delete/'+rowId,
               dataType:'json',
               success:function(data){
                  miniCart();
                  // start message
            const Toast = Swal.mixin({
                      toast: true,
                      position: 'top-end',
                      icon: 'success',
                      showConfirmButton: false,
                      timer: 3000
                    })
                if ($.isEmptyObject(data.error)) {
                    Toast.fire({
                        type: 'success',
                        title: data.success
                    })
                }else{
                    Toast.fire({
                        type: 'error',
                        title: data.error
                    })
                }      // End 

               } 
               // end Function
            })
         }
      // End minicart delete
</script>
 

</body>
</html>