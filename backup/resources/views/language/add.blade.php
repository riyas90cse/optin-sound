@extends('layouts.website')
@section('content')
<div class="pageheader">
		<div class="media">
        <div class="media-body">
    	<h4>Add Language</h4>
        <ul class="breadcrumb">
            <li><a href="{{ url('/') }}"><i class="glyphicon glyphicon-home"></i></a></li>
            <li>Masters</li>
            <li>Language</li>
            <li>Add</li>
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
      	<form method="post" action="{{ url('language/save') }}">
      	{{ csrf_field() }}
		  <div class="form-group">
		    <label>*Language Name:</label>
		    <input type="text" class="form-control" placeholder="Enter Language Name" name="language_name" id="language_name" required="">
		  </div>
		  <div class="form-group">
		    <label>*Language Code:</label>
		    <input type="text" class="form-control" placeholder="Enter Language Code" name="language_code" id="language_code" required="">
		  </div>
		  <div class="form-group">
			<label>*Active:</label>
			<select class="form-control" name="active" id="active" required="">
				<option value="">Select</option>
				<option value="yes">Yes</option>
				<option value="no">No</option>
			</select>
		  </div>

		  <button type="submit" class="btn btn-primary">Submit</button>
		</form>
      </div>
	</div>
</div>
</div>
@endsection