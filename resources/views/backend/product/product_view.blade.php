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
     <h3 class="box-title">Product Lists</h3>
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
               <th>Image</th>
               <th >Product En</th>
               <th>Product Price</th>
               <th>Quantity</th>
               <th>Discount</th>
               <th>Status</th>
               <th>Action</th>
               </tr>
           </thead>
           <tbody>
           @foreach($products as $item)
                <tr role="row">
                   <td><img src="{{asset($item->product_thumbnil)}}" style="width:60px; height:50px;"></td>
                   <td>{{$item->product_name_en}}</td>
                   <td>{{$item->selling_price}}</td>
                   <td>{{$item->product_qty}} Pcs</td> 
                   <td>
                   @if($item->discount_price==NULL)
                   <span class="badge badge-pill badge-danger">No Discount</span>  

                   @else
                   @php
                      $amount=$item->selling_price - $item->discount_price;
                      $discount=($amount/$item->selling_price)*100;
                   @endphp
                   <span class="badge badge-pill badge-danger">{{round($discount)}}</span>  

                   @endif
                   
                   </td>
                    <td>
                      @if($item->status==1)
                      <span class="badge badge-pill badge-success">Active</span>
                      @else
                      <span class="badge badge-pill badge-danger">InActive</span>
                      @endif
                    </td>
                   <td width="30%">
                
                   <a href="{{route('product.edit',$item->id)}}"class="btn btn-info" title="Details Data"><i class="fa fa-eye"></i></a>
                   <a href="{{route('product.edit',$item->id)}}"class="btn btn-info" title="Edit Data"><i class="fa fa-pencil"></i></a>
                   <a href="{{route('product.delete',$item->id)}}"class="btn btn-danger" title="Delete Data" id="delete"><i class="fa fa-trash"></i></a>
                   @if($item->status==1)
                   <a href="{{route('product.inactive',$item->id)}}"class="btn btn-danger" title="Inactive Now"><i class="fa fa-arrow-down"></i></a>
                   @else
                   <a href="{{route('product.active',$item->id)}}"class="btn btn-success" title="Active Now"><i class="fa fa-arrow-up"></i></a>
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


</div>




		
		</section>
		<!-- /.content -->
	  
	  </div>



@endsection