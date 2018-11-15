@extends('layouts.website')
@section('content')
<?php
$from_date = '';
$to_date = '';
if($_POST && $_POST>0){
	$from_date = $_POST['from_date'];
	$to_date = $_POST['to_date'];
}
?>
<script>
$(function(){
var nowDate = new Date();
var today = new Date(nowDate.getFullYear(), nowDate.getMonth(), nowDate.getDate(), 0, 0, 0, 0);
$('.input-group.date').datepicker({
    calendarWeeks: true,
    todayHighlight: true,
    autoclose: true,
    format: "dd-MM-yyyy",
    //startDate: today
});  
});
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
		<h4>Service Tax Register</h4>
		<ul class="breadcrumb">
		    <li><a href="{{ url('/') }}"><i class="glyphicon glyphicon-home"></i></a></li>
		    <li>Service Tax Register</li>
		</ul>
		</div>
	</div>
</div>
<div class="contentpanel">
<div id="page-wrapper">
	<div class="row">
		<div class="col-md-12">
			<form class="form-inline" method="post" action="">
			{{ csrf_field() }}
				<div class="form-group" style="margin-right: 0">
					<div class="input-group date">
						<input type="text" name="from_date" class="form-control" value="{{$from_date}}" placeholder="Function From" required=""><span class="input-group-addon"><i class="fa fa-calendar"></i></span>
					</div>
					<div class="input-group date">
						<input type="text" name="to_date" class="form-control" value="{{$to_date}}" placeholder="Function To" required=""><span class="input-group-addon"><i class="fa fa-calendar"></i></span>
					</div>
				</div>
				<button type="submit" name="submit" class="btn btn-info">Find</button>
			</form>
		</div>
	</div>        
    <div class="row" style="margin-top: 10px">
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
		<?php if($count>0){ ?>
		  <h4 class="center onlyprint">ARUN VIHAR COMMUNITY CENTER </h4>
		  <h5 class="center onlyprint">SECTOR 37, NOIDA</h5>
		  <h4 class="center-underline onlyprint">Service Tax Register</h4>
		  @if($_POST && $_POST>0)
		  	<h5 class="center-print"><strong>Function From: {{$from_date}}, Function To: {{$to_date}}</strong></h5>
		  @endif
		  <div class="table-responsive">
		  <table class="table table-bordered" style="border: 1px solid #ddd; margin-top: 15px">
		    <thead>
		      <tr>
		        <th>S.No</th>
		        <th>Membership No</th>
		        <th>Party Name</th>
		        <th>Bill No</th>
		      	<th>Bill Date </th>
		      	<th>Booking Form No</th>
		        <th>Booking Date</th>
		      	<th>Function Date</th>
		        <th>Taxable Amount</th>
		        <th>Service Tax Amount</th>
		        <th>Total Amount</th>
		      </tr>
		    </thead>
		    <tbody>
		      <?php
		      $i = 1;
		      foreach ($booking as $value){ ?>
	          <tr>
	            <td>{{ $i}}</td>
	            <td>{{ $value->membership_no }}</td>
	            <td>{{ $value->party_name }}</td>
	            <td>{{ $value->bill_no }}</td>
	            <td>{{ date_dfy($value->bill_date) }}</td>
	            <td>{{ $value->booking_no }}</td>
	            <td>{{ date_dfy($value->created_at) }}</td>
	          	<td>{{ date_dfy($value->function_date) }}</td>
	            <td>{{ $value->total_amount }}</td>
	            <td>{{ $value->service_tax }}</td>
	            <td>{{number_format((float)$value->total_amount + $value->service_tax, 2, '.', '')}}</td>
	          </tr>
	          <?php $i++; }?>
		    </tbody>
		  </table>
		  </div>
		<?php } else{?>
		<p>No results found!</p>
		<?php }?>
		</div>
	</div>
</div>
</div>
@endsection