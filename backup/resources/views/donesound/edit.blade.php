@extends('layouts.website')
@section('content')
<div class="pageheader">
		<div class="media">
        <div class="media-body">
    	<h4>Edit Sound Niche</h4>
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
      	<form method="post" action="{{ url('donesound/update/'.$soundniche[0]->id) }}" enctype="multipart/form-data">
  		{{ csrf_field() }}

		  <div class="form-group">
		    <label>*Sound Name:</label>
		    <input type="text" class="form-control" placeholder="Enter Sound Name" name="soundname" id="soundname" required="" value="<?php echo $soundniche[0]->soundname; ?>">
		  </div>

		  <div class="form-group">
			<label>*Niche Category:</label>
			<select class="form-control" name="niche_category" id="niche_category">
				<option value="">Select</option>
				@foreach ($niche as $value)
				<option value="{{ $value->id }}" <?php if($value->id==$soundniche[0]->niche_category) {echo  'selected=""';}?>>{{ $value->niche_category }}</option>
				@endforeach
			</select>
		  </div>

		  <div class="form-group">
			<label>*Traffic Source:</label>
			<select class="form-control" name="trafficsource" id="trafficsource">
				<option value="">Select</option>
				@foreach ($trafficsource as $value)
				<option value="{{ $value->id }}" <?php if($value->id==$soundniche[0]->trafficsource) {echo  'selected=""';}?>>{{ $value->sourcename }}</option>
				@endforeach
			</select>
		  </div>

		  <div class="form-group">
			<label>*Language:</label>
			<select class="form-control" name="language" id="language">
				<option value="">Select</option>
				@foreach ($language as $value)
				<option value="{{ $value->id }}" <?php if($value->id==$soundniche[0]->language) {echo  'selected=""';}?>>{{ $value->language_name }}</option>
				@endforeach
			</select>
		  </div>


		  <div class="form-group">
			<label>*Voice Variation :</label>
			<select class="form-control" name="variation" id="variation" required="">
				<option value="">Select</option>
				<option value="male" <?php if($soundniche[0]->variation=='male') {echo  'selected=""';}?>>Male</option>
				<option value="female" <?php if($soundniche[0]->variation=='female') {echo  'selected=""';}?>>Female</option>
			</select>
		  </div>

		  <div class="form-group">
			<label>*Sound Text :</label>
			<textarea class="form-control" name="sound_text" id="sound_text" required="" placeholder="Enter sound text here...">{{$soundniche[0]->sound_text}}</textarea>
		  </div>

		  <div class="form-group" id="t2s_output">
			<div class="col-md-3">
				<label>Sound Preview: </label>
			</div>
			<div class="col-md-7">
				<img src="{{ url('/images/convertsound-fav.png')}}" id="t2s_playservice" alt="play/pause" title="To Play Click Here">
				<audio class="form-control" name="t2s_soundpreview" id="t2s_soundpreview" controls>
				  <source src="{{ url('/')}}/{{$soundniche[0]->sound_url}}" type="audio/mpeg">
				  Your browser does not support the audio tag.
				</audio> 
			</div>
		  </div>								

		  <div class="input-group control-group" >
			<label>*Upload File:</label>
			<input type="hidden" name="hidden_filename" class="form-control" id="hidden_filename" value="{{$soundniche[0]->sound_url}}">
			<input type="file" name="filename" class="form-control" id="filename">
		  </div>
				

		  <div class="form-group">
		      <label>*Active:</label>
		      <select class="form-control" name="active" id="active">
				<option value="yes" <?php if($niche[0]->active=='yes'){ echo  'selected=""'; }?> >Yes</option>
				<option value="no" <?php if($niche[0]->active=='no'){ echo  'selected=""'; }?> >No</option>
		      </select>
		  </div>

		  <button type="submit" class="btn btn-primary">Update</button>
		</form>
		</div>
	</div>
</div>
</div>
<script type="text/javascript">
    jQuery('#t2s_playservice').click(function() {
	    var audio = document.getElementById("t2s_soundpreview");

	    //var audio=$('#soundpreview');
	    if(audio.paused == false) {
	        audio.pause();
	        // alert('music paused');
	    } else {
	        audio.play();
	        // alert('music playing');
	    }
    });

</script>
@endsection