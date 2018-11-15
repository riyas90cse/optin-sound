@extends('layouts.website')
@section('content')
<div class="pageheader">
	<div class="media">
		<?php if(Auth::user()->user_group == '1'){ ?>
		<div class="pull-right">
			<a href="{{ url('/niche/add') }}"><button class="btn btn-primary"><i class="fa fa-plus"></i> Add Niche</button></a>
		</div>
		<?php }?>
		<div class="media-body">
		<h4>Niches</h4>
		<ul class="breadcrumb">
		    <li><a href="{{ url('/') }}"><i class="glyphicon glyphicon-home"></i></a></li>
		    <li>Niche</li>
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
		        <th>Niche Category</th>
		        <th>User Level</th>
		        <th>Active</th>
		        <?php if(Auth::user()->user_group == '1'){ ?>
		        <th width="100px">Action</th>
		        <?php }?>
		      </tr>
		    </thead>
		    <tbody>
		      @foreach ($niche as $value)
	          <tr>
	          	<td>{{ $value->id }}</td>
	            <td>{{ $value->niche_category }}</td>

	            <td>
				@foreach ($userlevel as $uv)
					<?php if($uv->id==$value->user_level) {echo $uv->level; } ?>
				@endforeach

	            </td>
	            <td>{{ ucfirst($value->active) }}</td>
	            <?php if(Auth::user()->user_group == '1'){ ?>
	            <td>
	            <a href="{{ url('/niche/edit/'.$value->id) }}" data-toggle="tooltip" title="Edit" class="btn btn-primary" data-original-title="Edit"><i class="fa fa-pencil"></i></a>
	            <a onclick="return confirm('Are you sure you want to Delete?');" href="{{ url('/niche/delete/'.$value->id) }}" data-toggle="tooltip" title="Delete" class="btn btn-danger" data-original-title="Delete"><i class="fa fa-trash-o"></i></a>
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