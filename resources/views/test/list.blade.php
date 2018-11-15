@extends('layouts.website')
@section('content')
<script>
	function printPage(){
		window.print();
	}
</script>
<div class="pageheader">
	<div class="media">
		<div class="pull-right">
			<button onclick="printPage();" class="btn btn-primary"><i class="fa fa-print"></i> Print</button>
		</div>
		<div class="media-body">
		<h4>Test</h4>
		<ul class="breadcrumb">
		    <li><a href="{{ url('/') }}"><i class="glyphicon glyphicon-home"></i></a></li>
		    <li>Test</li>
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
		  <h4 class="center onlyprint">ARUN VIHAR COMMUNITY CENTER </h4>
		  <h5 class="center onlyprint">SECTOR 37, NOIDA</h5>
		  <h4 class="center-underline onlyprint">Test</h4>
		  <table class="table table-bordered" id="dataTable">
		    <thead>
		      <tr>
		      	<th>S.No</th>
		        <th>Name</th>
		        <th>Booking Date</th>
		      </tr>
		    </thead>
		    <tbody>
		      <?php $i=1; foreach ($test as $value){ ?>
	          <tr>
	          	<td>{{$i}}</td>
	            <td>{{ $value->name }}</td>
	            <td>{{ date_dfy($value->booking_date) }}</td>
	          </tr>
	          <?php $i++; } ?>
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
    	"ordering": false,
    	"paging": false
    });
    $('.dataTables_filter').hide();
    var table =  $('#dataTable').DataTable();
    $('#filter1').keyup(function () {
        table.columns(1).search( this.value ).draw();
    } );
});
</script>
@endsection