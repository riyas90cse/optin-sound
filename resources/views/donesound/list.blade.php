@extends('layouts.website')
@section('content')
<div class="pageheader">
	<div class="media">
		<?php if(Auth::user()->user_group == '1'){ ?>
		<div class="pull-right">
			<a href="{{ url('/donesound/add') }}"><button class="btn btn-primary"><i class="fa fa-plus"></i> Add Sound Niche</button></a>
		</div>
		<?php }?>
		<div class="media-body">
		<h4>Sound Niches</h4>
		<ul class="breadcrumb">
		    <li><a href="{{ url('/') }}"><i class="glyphicon glyphicon-home"></i></a></li>
		    <li>Sound Niche</li>
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
		<?php if($count>0){ ?>
		  <table class="table table-bordered" id="dataTable">
		    <thead>
		      <tr>
		      	<th>S. No</th>
		        <th>Sound Name</th>
		        <th>Niche Category</th>
		        <th>Traffic Source</th>
		        <th>Language</th>
		        <th>Voice Variation</th>
		        <th>Sound Text</th>
		        <th>Sound Preview</th>
		        <th>Active</th>
		        <?php if(Auth::user()->user_group == '1'){ ?>
		        <th width="100px">Action</th>
		        <?php }?>
		      </tr>
		    </thead>
		    <tbody>
		      @foreach ($soundniche as $value)
	          <tr>
	          	<td>{{ $value->id }}</td>
	            <td>{{ $value->soundname }}</td>
	            <td>
				@foreach ($niche as $uv)
					<?php if($uv->id==$value->niche_category) {echo $uv->niche_category; } ?>
				@endforeach

	            </td>
	            <td>
				@foreach ($trafficsource as $uv)
					<?php if($uv->id==$value->trafficsource) {echo $uv->sourcename; } ?>
				@endforeach

	            </td>

	            <td>
				@foreach ($language as $uv)
					<?php if($uv->id==$value->language) {echo $uv->language_name; } ?>
				@endforeach

	            </td>
	            <td>{{ $value->variation }}</td>
	            <td>{{ $value->sound_text }}</td>
	            <td>{{ $value->sound_url }}</td>


	            <td>{{ ucfirst($value->active) }}</td>
	            <?php if(Auth::user()->user_group == '1'){ ?>
	            <td>
	            <a href="{{ url('/donesound/edit/'.$value->id) }}" data-toggle="tooltip" title="Edit" class="btn btn-primary" data-original-title="Edit"><i class="fa fa-pencil"></i></a>
	            <a onclick="return confirm('Are you sure you want to Delete?');" href="{{ url('/donesound/delete/'.$value->id) }}" data-toggle="tooltip" title="Delete" class="btn btn-danger" data-original-title="Delete"><i class="fa fa-trash-o"></i></a>
	            </td>
	            <?php }?>
	          </tr>
	          @endforeach
		    </tbody>
		  </table>
		<?php } else{?>
		<p>No results found!</p>
		<?php }?>
		</div>
	</div>
</div>
</div>
<script>
$(document).ready(function() {
    $('#dataTable').DataTable({
    });
});
</script>
@endsection