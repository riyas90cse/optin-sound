@extends('layouts.website')
@section('content')
<div class="pageheader">
		<div class="media">
        <div class="media-body">
    	<h4>Update Role</h4>
        <ul class="breadcrumb">
            <li><a href="{{url('')}}"><i class="glyphicon glyphicon-home"></i></a></li>
            <li>Masters</li>
            <li>Role</li>
            <li>Edit</li>
        </ul>
    	</div>
    </div>
</div>
<div class="contentpanel">
<div id="page-wrapper">       
    <div class="row">
	    <div class="col-md-6">
		@if(Session::has('success'))
	    <div class="alert alert-success alert-dismissable">
		  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
		  {{ Session::get('success') }}
		</div>
		@endif
		@if(Session::has('failed'))
		<div class="alert alert-danger alert-dismissable">
		<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
		{{ Session::get('failed') }}
		</div>
		@endif
		@if (count($errors) > 0)
		 <div class = "alert alert-danger">
		    <ul>
		       @foreach ($errors->all() as $error)
		          <li>{{ $error }}</li>
		       @endforeach
		    </ul>
		 </div>
		@endif
      	<form method="post" action="{{ url('/role/update/'.$role[0]->id) }}">
      	{{ csrf_field() }}
		  <div class="form-group">
		    <label>*Role Name:</label>
		    <input type="text" class="form-control" placeholder="Enter role name" name="name" id="name" required="" value="<?php echo $role[0]->name; ?>">
		  </div>
		  <div class="form-group">
		    <label>*Max Lectures:</label>
		    <input type="text" class="form-control" placeholder="Enter Max Limit" name="max" id="max" required="" value="<?php echo $role[0]->max; ?>">
		  </div>
		  <div class="form-group">
		    <label>*Min Lectures:</label>
		    <input type="text" class="form-control" placeholder="Enter Min limit" name="min" id="min" required="" value="<?php echo $role[0]->min; ?>">
		  </div>

		  <button type="submit" class="btn btn-primary">Update</button>
		</form>
		</div>
	</div>
</div>
</div>
@endsection