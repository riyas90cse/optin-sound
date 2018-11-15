@extends('layouts.website')
@section('content')
<div class="pageheader">
		<div class="media">
        <div class="media-body">
    	<h4>Add Domain</h4>
        <ul class="breadcrumb">
            <li><a href="{{ url('/') }}"><i class="glyphicon glyphicon-home"></i></a></li>
            <li>Domain</li>
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
      	<form method="post" action="{{ url('domain/save') }}">
      	{{ csrf_field() }}
		  <div class="form-group">
		    <label>*Domain Name:</label>
		    <input type="text" class="form-control" placeholder="Enter Doamin" name="domain_name" id="domain_name" required="">
		  </div>
		  <div class="form-group">
			<label>Parent Domain</label>
			<select class="form-control" name="parent_domain" id="parent_domain">
				<option value="">Select</option>
				@foreach ($domain as $value)
				<option value="{{ $value->id }}">{{ $value->domain_name }}</option>
				@endforeach
			</select>
		  </div>

		  <button type="submit" class="btn btn-primary">Submit</button>
		</form>
      </div>
	</div>
</div>
</div>
@endsection