@extends('layouts.website')
@section('content')
<div class="pageheader">
	<div class="media">
		<?php if(Auth::user()->user_group == '1'){ ?>
		<div class="pull-right">
			<a href="{{ url('/domain/add') }}"><button class="btn btn-primary"><i class="fa fa-plus"></i> Add Domain</button></a>
		</div>
		<?php }?>
		<div class="media-body">
		<h4>Domains</h4>
		<ul class="breadcrumb">
		    <li><a href="{{ url('/') }}"><i class="glyphicon glyphicon-home"></i></a></li>
		    <li>Domain</li>
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
		        <th>Domain Name</th>
		        <th>Parent Domain</th>
		        <?php if(Auth::user()->status == '1'){ ?>
		        <th width="100px">Action</th>
		        <?php }?>
		      </tr>
		    </thead>
		    <tbody>
		      @foreach ($domain as $value)
	          <tr>
	          	<td>{{ $value->id }}</td>
	            <td>{{ $value->domain_name }}</td>

	            <td>
				@foreach ($domain as $uv)
					<?php if($uv->id==$value->parent_domain) {echo $uv->domain_name; } ?>
				@endforeach

	            </td>
	            <?php if(Auth::user()->user_group == '3'){ ?>
	            <td>
	            <a href="{{ url('/domain/edit/'.$value->id) }}" data-toggle="tooltip" title="Edit" class="btn btn-primary" data-original-title="Edit"><i class="fa fa-pencil"></i></a>
	            <a onclick="return confirm('Are you sure you want to Delete?');" href="{{ url('/domain/delete/'.$value->id) }}" data-toggle="tooltip" title="Delete" class="btn btn-danger" data-original-title="Delete"><i class="fa fa-trash-o"></i></a>
	            </td>
	            <?php }?>
	          </tr>
	          @endforeach
		    </tbody>
		  </table>
		<?php } else{?>
		<p>No Domain found!</p>
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