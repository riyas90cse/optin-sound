@extends('layouts.website')
@section('content')
<div class="pageheader">
		<div class="media">
        <div class="media-body">
    	<h4>Update Weekly Period Limit</h4>
        <ul class="breadcrumb">
            <li><a href="{{url('')}}"><i class="glyphicon glyphicon-home"></i></a></li>
            <li>Masters</li>
            <li>Weekly Period Limit</li>
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
      	<form method="post" action="{{ url('/weeklycount/update/'.$weeklycount[0]->id) }}">
      	{{ csrf_field() }}
			<div class="form-group">
				  <label>*Class:</label>
				  <select class="form-control" name="class_id" id="class_id" required="">
						<option value="">Select</option>
						@foreach ($class as $value)
						<option value="{{ $value->id }}" <?php if($weeklycount[0]->class_id==$value->id) echo 'selected';?>>{{ $value->name }}</option>
						@endforeach
				  </select>
			</div>
			<div class="form-group">
				  <label>*Subject:</label>
				  <select class="form-control" name="subject" id="subject" required="">
						<option value="">Select</option>
						@foreach ($subject as $value)
						<option value="{{ $value->id }}" <?php if($weeklycount[0]->subject==$value->id) echo 'selected';?>>{{ $value->name }}</option>
						@endforeach
				  </select>
			</div>
			<div class="form-group">
				<label>Count:</label>
				<input type="text" class="form-control" placeholder="Enter Count" name="count" id="count" value="{{$weeklycount[0]->count}}">
			</div>

			<button type="submit" class="btn btn-primary">Update</button>
		</form>
		</div>
	</div>
</div>
</div>
@endsection