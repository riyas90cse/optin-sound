@extends('layouts.website')
@section('content')
<div class="pageheader">
		<div class="media">
        <div class="media-body">
    	<h4>Add Sound Niche</h4>
        <ul class="breadcrumb">
            <li><a href="{{ url('/') }}"><i class="glyphicon glyphicon-home"></i></a></li>
            <li>Masters</li>
            <li>Sound Niche</li>
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
      	<form method="post" action="{{ url('donesound/save') }}" enctype="multipart/form-data">
      	{{ csrf_field() }}
		  <div class="form-group">
		    <label>*Sound Name:</label>
		    <input type="text" class="form-control" placeholder="Enter Sound Name" name="soundname" id="soundname" required="">
		  </div>
		  <div class="form-group">
			<label>*Niche Category:</label>
			<select class="form-control" name="niche_category" id="niche_category">
				<option value="">Select</option>
				@foreach ($niche as $value)
				<option value="{{ $value->id }}">{{ $value->niche_category }}</option>
				@endforeach
			</select>
		  </div>

		  <div class="form-group">
			<label>*Traffic Source:</label>
			<select class="form-control" name="trafficsource" id="trafficsource">
				<option value="">Select</option>
				@foreach ($trafficsource as $value)
				<option value="{{ $value->id }}">{{ $value->sourcename }}</option>
				@endforeach
			</select>
		  </div>

		  <div class="form-group">
			<label>*Language:</label>
			<select class="form-control" name="language" id="language">
				<option value="">Select</option>
				@foreach ($language as $value)
				<option value="{{ $value->id }}">{{ $value->language_name }}</option>
				@endforeach
			</select>
		  </div>


		  <div class="form-group">
			<label>*Voice Variation :</label>
			<select class="form-control" name="variation" id="variation" required="">
				<option value="">Select</option>
				<option value="male">Male</option>
				<option value="female">Female</option>
			</select>
		  </div>

		  <div class="form-group">
			<label>*Sound Text :</label>
			<textarea class="form-control" name="sound_text" id="sound_text" required="" placeholder="Enter sound text here...">
			</textarea>
		  </div>

		  <div class="input-group control-group" >
			<label>*Upload File:</label>
			<input type="file" name="filename" class="form-control" id="filename">
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