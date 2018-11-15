@extends('layouts.website')
@section('content')
<div class="pageheader">
	<div class="media">
		<?php if(Auth::user()->status == '1'){ ?>
		<div class="pull-right">
			<a href="{{ url('/oc/create') }}"><button class="btn btn-primary"><i class="fa fa-plus"></i> Add Overlay Campaign</button></a>
		</div>
		<?php }?>
		<div class="media-body">
		<h4>Overlay Campaigns</h4>
		<ul class="breadcrumb">
		    <li><a href="{{ url('/') }}"><i class="glyphicon glyphicon-home"></i></a></li>
		    <li>Overlay</li>
		</ul>
		</div>
	</div>
</div>
<div class="contentpanel">
<div id="page-wrapper">       
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
		<?php $i=1;?>
		<?php if($count>0){ ?>
		  <table class="table table-bordered" id="dataTable">
		    <thead>
		      <tr>
		        <th>S.No.</th>
		        <th>Overlay Name</th>
				<th>Campaign Name</th>
		        <th>Domain</th>
		        <th>Link</th>
		        <th>Sound Preview</th>
		        <?php if(Auth::user()->user_group == '1'){ ?>
		        <th style="width: 150px">Action</th>
		        <?php }?>
		      </tr>
		    </thead>
		    <tbody>
		      @foreach($overlays as $value)
	          <tr>
	            <td>{{ $i++ }}</td>
	            <td>{{ $value->overlay_name}}</td>
	            <td>{{ $value->campaign_name}}</td>
	            <td>{{ $value->domain_name }}</td>
	            <td>{{ $value->custom_link}}</td>
	            <td>
	            <a href="{{ url('/oc/edit/'.$value->id) }}" data-toggle="tooltip" title="Edit" class="btn btn-success" data-original-title="Edit"><i class="fa fa-pencil"></i></a>
	            <a onclick="return confirm('Are you sure you want to Delete?');" href="{{ url('/oc/delete/'.$value->id) }}" data-toggle="tooltip" title="Delete" class="btn btn-danger" data-original-title="Delete"><i class="fa fa-trash-o"></i></a>
	            </td>
	          </tr>
	          @endforeach
		    </tbody>
		  </table>
			<audio class="form-control" name="dfy_soundpreview" id="dfy_soundpreview" controls>
				<source src="{{ url('/uploads/sound/')}}" type="audio/mpeg">
				Your browser does not support the audio tag.
			</audio> 
						</div>

		<?php } else{?>
		<p>No Overlay Campaingn found!</p>
		<?php }?>
		</div>
	</div>
</div>
</div>
<script>
$(document).ready(function() {
    $('#dataTable').DataTable({});



	$('.sound_preview').click(function(){
		var val = $(this).attr('data-soundsrc');
		var audio = document.getElementById("dfy_soundpreview");
		if(audio.src!=val)
	    $('#dfy_soundpreview').attr('src',val);
		if(audio.paused == false) {
			audio.pause();
	        // alert('music paused');
	    }
	    else {
	    	audio.play();
	        // alert('music playing');
	    }
	});


});


</script>
@endsection
