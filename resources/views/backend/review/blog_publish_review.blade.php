@extends('admin.admin_master')
@section('admin')
  <!-- Content Wrapper. Contains page content -->
  
	  <div class="container-full">
		<!-- Content Header (Page header) -->
		 
		<!-- Main content -->
		<section class="content">
		  <div class="row">
			   
		 
			<div class="col-12">
			 <div class="box">
				<div class="box-header with-border">
				  <h3 class="box-title">Blog Publish Reviews</h3>
				</div>
				<!-- /.box-header -->
				<div class="box-body">
					<div class="table-responsive">
					  <table id="example1" class="table table-bordered table-striped">
						<thead>
							<tr>
                                <th>Name </th>
                                <th>Email </th>
                                <th>Blog</th>
								<th>Summary </th>
								<th>Comment</th>
                                <th>Status </th>
                                <th>Action</th>
								 
							</tr>
						</thead>
						<tbody>
	 @foreach($review as $item)
	 <tr>
        <td> {{ $item->name }} </td>
        <td> {{ $item->email}} </td>
        <td> {{ $item->blogpost->post_title_en }} </td>
		<td> {{ $item->summary }}  </td>
		<td> {{ $item->comments }} </td>
        <td> 
            @if($item->status==0)
             <span class="badge badge-pill badge-primary">Pending </span>
             @elseif($item->status==1)
             <span class="badge badge-pill badge-success">Success </span>
            @endif    
        </td>
        <td width="20%">
            <a href="{{route('delete.blog_review',$item->id)}}" class="btn btn-danger" id="delete">Delete</a>
		</td>
							 
	 </tr>
	  @endforeach
						</tbody>
						 
					  </table>
					</div>
				</div>
				<!-- /.box-body -->
			  </div>
			  <!-- /.box -->
			          
			</div>
			<!-- /.col -->

        
 
		  </div>
		  <!-- /.row -->
		</section>
		<!-- /.content -->
	  
	  </div>
  
@endsection