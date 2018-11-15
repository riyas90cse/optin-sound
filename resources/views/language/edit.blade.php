@extends('layouts.website')
@section('content')
<div class="pageheader">
		<div class="media">
        <div class="media-body">
    	<h4>Update Country</h4>
        <ul class="breadcrumb">
            <li><a href="{{url('')}}"><i class="glyphicon glyphicon-home"></i></a></li>
            <li>Masters</li>
            <li>Country</li>
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
      	<form method="post" action="{{ url('/country/update/'.$country[0]->id) }}">
      	{{ csrf_field() }}
		  <div class="form-group">
		    <label>*Country Name:</label>
		    <input type="text" class="form-control" placeholder="Enter Country Name" name="country_name" id="country_name" value="<?php echo $country[0]->country_name; ?>" required="">
		  </div>
		  <div class="form-group">
		    <label>*Country Code:</label>
		    <input type="text" class="form-control" placeholder="Enter Country Code" name="country_code" id="country_code" value="<?php echo $country[0]->country_code; ?>" required="">
		  </div>

		  <div class="form-group">
		      <label>*Active:</label>
		      <select class="form-control" name="active" id="active">
				<option value="yes" <?php if($country[0]->active=='yes'){ echo  'selected=""'; }?> >Yes</option>
				<option value="no" <?php if($country[0]->active=='no'){ echo  'selected=""'; }?> >No</option>
		      </select>
		  </div>

		  <button type="submit" class="btn btn-primary">Update</button>
		</form>
		</div>
	</div>
</div>
</div>
@endsection