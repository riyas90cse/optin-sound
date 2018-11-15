@extends('layouts.website')
@section('content')
<div class="contentpanel">
<div id="page-wrapper">
    <div class="row">
	    <div class="col-md-12">
			<div class="step-heading">Enter Domain Name for Campaign</div>
		</div>
	</div>

    <div class="row">
	    <div class="col-md-12">
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
      	<form method="post" action="{{ url('domain/update/'.$domain[0]->id) }}">
      	{{ csrf_field() }}

	    <div class="row">
			<div class="col-md-10 col-md-offset-1 pt10">
	    		<div class="col-md-8">
			    	<input type="text" class="big-inputs" value="{{$domain[0]->domain_name}}" placeholder="Enter Your Domain" name="domain_name" id="domain_name" required="">
				</div>
	    		<div class="col-md-3">

				  <button type="submit" class="btn btn-primary large-btn">Submit</button>
				</div>
			</div>
		</div>
		</form>
      </div>
	</div>
</div>
</div>
@endsection