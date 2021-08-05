
@extends('admin.admin_master')
@section('admin')

<div class="container mt-3">
<div class="row">
<div class="col-12">

<div class="box">
   <div class="box-header with-border">
     <h3 class="box-title">Edit District </h3>
   </div>
   <!-- /.box-header -->
   <div class="box-body">
      <div class="table-responsive">
      <form method="post" action="{{route('district.update',$district->id)}}" >
        @csrf

                            <input type="hidden" name="id" value="{{$district->id}}">
                                 

        <div class="form-group">
            <h5>Select Division <span class="text-danger">*</span></h5>
            <div class="controls">
                <select name="division_id"  class="form-control">
                    <option value="" selected=""disabled="">Select Your Division</option>
                    @foreach($division as $item)
                    <option value="{{ $item->id }}" {{ $item->id == $district->division_id ? 'selected': '' }} >{{ $item->division_name }}</option>                    @endforeach
                </select>
                @error('division_id')
                <span class=" text-danger">{{$message}}</span>
                @enderror
            <div class="help-block"></div></div>
	    </div>                            
	 <div class="form-group">
		<h5>District Name  <span class="text-danger">*</span></h5>
		<div class="controls">
	 <input type="text"  name="district_name" value="{{$district->district_name}}" class="form-control" > 
	 @error('district_name') 
	 <span class="text-danger">{{ $message }}</span>
	 @enderror 
	</div>
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