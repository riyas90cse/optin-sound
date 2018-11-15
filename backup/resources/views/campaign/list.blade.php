@extends('layouts.website')
@section('content')
<div class="pageheader">
	<div class="media">
		<?php if(Auth::user()->status == '1'){ ?>
		<div class="pull-right">
			<a href="{{ url('/campaign/create') }}"><button class="btn btn-primary"><i class="fa fa-plus"></i> Add Campaign</button></a>
		</div>
		<?php }?>
		<div class="media-body">
		<h4>Campaign</h4>
		<ul class="breadcrumb">
		    <li><a href="{{ url('/') }}"><i class="glyphicon glyphicon-home"></i></a></li>
		    <li>Campaign</li>
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
		        <th>Campaign Name</th>
		        <th>Campaign Type</th>
		        <th>Domain</th>
		        <th>Sound Preview</th>
		        <?php if(Auth::user()->user_group == '1'){ ?>
		        <th style="width: 150px">Action</th>
		        <?php }?>
		      </tr>
		    </thead>
		    <tbody>
		      @foreach($campaigns as $value)
	          <tr>
	            <td>{{ $i++ }}</td>
	            <td>{{ $value->campaign_name}}</td>
	            <td>{{ $value->campaign_type}}</td>
	            <td>{{ $value->domain_name }}</td>
	            <td><div class="sound_preview" data-soundsrc="{{$value->sound_src}}"><span>Play Sound</span><img height="20px" src="{{url('/')}}/images/convertsound-fav.png"/></div></td>
	            <td>
				<div id="modal{{$value->id}}" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	                <div class="modal-dialog">
	                    <div class="modal-content">
	                        <div class="modal-header">
	                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
	                            <h4 class="modal-title" id="myModalLabel">{{ ucfirst($value->campaign_name)}} Code</h4>
	                        </div>
	                        <div class="modal-body">
	                            <textarea style="width:100%"><script type="text/javascript" src="{{url('/')}}/uploads/campaign/{{$value->script_name}}.js"></script></textarea>
	                        </div>
	                        <div class="modal-footer">
	                            <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Close</button>
	                        </div>
	                    </div>
	                </div>
	            </div>
            	<a href="" title="Code" class="btn btn-primary" data-original-title="Code" data-toggle="modal" data-original-title="View Code" data-target="#modal{{$value->id}}"><i class="fa fa-code"></i></a>
	            <a href="{{ url('/campaign/edit/'.$value->id) }}" data-toggle="tooltip" title="Edit" class="btn btn-success" data-original-title="Edit"><i class="fa fa-pencil"></i></a>
	            <a onclick="return confirm('Are you sure you want to Delete?');" href="{{ url('/campaign/delete/'.$value->id) }}" data-toggle="tooltip" title="Delete" class="btn btn-danger" data-original-title="Delete"><i class="fa fa-trash-o"></i></a>
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
		<p>No Campaingn found!</p>
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
