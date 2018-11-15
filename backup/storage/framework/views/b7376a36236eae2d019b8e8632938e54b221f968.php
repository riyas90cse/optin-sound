<?php $__env->startSection('content'); ?>
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
		<h4>Optin Records</h4>
		<ul class="breadcrumb">
		    <li><a href="<?php echo e(url('/')); ?>"><i class="glyphicon glyphicon-home"></i></a></li>
		    <li>Reports</li>
		    <li>Option Records</li>
		</ul>
		</div>
	</div>
</div>
<div class="contentpanel">
<div id="page-wrapper">  
	<div class="row">
		<div class="col-md-12">
			<form class="form-inline" method="post" action="">
			<?php echo e(csrf_field()); ?>

				<div class="form-group" style="margin-right: 0">
					<div class="input-group date">
						<input type="text" name="from_date" class="form-control" value="<?php echo e($from_date); ?>" placeholder="Record From" required=""><span class="input-group-addon"><i class="fa fa-calendar"></i></span>
					</div>
					<div class="input-group date">
						<input type="text" name="to_date" class="form-control" value="<?php echo e($to_date); ?>" placeholder="Record To" required=""><span class="input-group-addon"><i class="fa fa-calendar"></i></span>
					</div>
				</div>
				<button type="submit" name="submit" class="btn btn-info">Find</button>
			</form>
		</div>
	</div>     
    <div class="row" style="margin-top: 10px">
	    <div class="col-md-12">
	    <?php if(Session::has('success')): ?>
	    <div class="alert alert-success alert-dismissable">
		  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
		  <?php echo e(Session::get('success')); ?>

		</div>
		<?php endif; ?>
		<?php if(Session::has('failed')): ?>
		<div class="alert alert-danger alert-dismissable">
		<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
		<?php echo e(Session::get('failed')); ?>

		</div>
		<?php endif; ?>
		<?php if($count>0){ ?>

		  	<?php if($_POST && $_POST>0): ?>
		  	<h5 class="center-print"><strong>Optin Records From: <?php echo e($from_date); ?> - To: <?php echo e($to_date); ?></strong></h5>
		  	<?php endif; ?>
		    <div class="table-responsive">
			  <table class="table table-bordered" style="border: 1px solid #ddd; margin-top: 15px">
			    <thead>
			      <tr>
			      	<th>S.No.</th>
			      	<th>Name</th>
			      	<th>Email</th>
			      	<th>Phone</th>
			        <th>Campaign ID</th>
			        <th>Date</th>
			      </tr>
			    </thead>
			    <tbody>
			      <?php $i=1; foreach ($report as $value){ ?>
		          <tr>
		          	<td><?php echo e($i); ?></td>
		          	<td><?php echo e($value->name); ?></td>
		            <td><?php echo e($value->email); ?></td>
		            <td><?php echo e($value->phone); ?></td>
		            <td><?php echo e($value->campaign_id); ?></td>
		            <td><?php echo e($value->created_at); ?></td>
		          </tr>
		          <?php $i++; } ?>
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
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.website', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>