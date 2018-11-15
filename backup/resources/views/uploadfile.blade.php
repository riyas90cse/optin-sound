@extends('layouts.website')
@section('content')
<div class="pageheader">
		<div class="media">
        <div class="media-body">
    	<h4>Upload Sound</h4>
        <ul class="breadcrumb">
            <li><a href="{{ url('/') }}"><i class="glyphicon glyphicon-home"></i></a></li>
            <li>Masters</li>
            <li>Sounds</li>
            <li>Add</li>
        </ul>
    	</div>
    </div>
</div>
      @if (count($errors) > 0)
      <div class="alert alert-danger">
        <strong>Whoops!</strong> There were some problems with your input.<br><br>
        <ul>
          @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
      @endif

        @if(session('success'))
        <div class="alert alert-success">
          {{ session('success') }}
        </div> 
        @endif

<div class="contentpanel">
<div id="page-wrapper">       
    <div class="row">
	    <div class="col-md-6">
			<form method="post" action="{{url('uploadfile')}}" enctype="multipart/form-data">
			{{csrf_field()}}

			    <div class="input-group control-group increment" >
			      <input type="file" name="filename" class="form-control">
			      <div class="input-group-btn"> 
			        <button class="btn btn-success" type="button"><i class="glyphicon glyphicon-plus"></i>Add</button>
			      </div>
			    </div>

			    <button type="submit" class="btn btn-primary" style="margin-top:10px">Submit</button>

			</form> 
   		</div>
   </div>
</div>
</div>
@endsection