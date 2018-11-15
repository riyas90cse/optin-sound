<?php $__env->startSection('content'); ?>
<script type='text/javascript'>
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
</script>
<div class="pageheader">
	<div class="media">
		<div class="pageicon pull-left">
            <i style="padding: 10px 0 0 0;" class="fa fa-book"></i>
        </div>
		<?php if(Auth::user()->user_group == '1'){ ?>
		<div class="pull-right">
			<a href="<?php echo e(url('/booking/add')); ?>"><button class="btn btn-primary"><i class="fa fa-plus"></i> Add Booking</button></a>
		</div>
		<?php }?>
		<div class="media-body">
		<h4>Booking</h4>
		<ul class="breadcrumb">
		    <li><a href="<?php echo e(url('/')); ?>"><i class="glyphicon glyphicon-home"></i></a></li>
		    <li>Booking</li>
		</ul>
		</div>
	</div>
</div>
<div class="contentpanel">
<div id="page-wrapper">       
    <div class="row">
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
		<?php if(count($errors) > 0): ?>
		 <div class = "alert alert-danger">
		    <ul>
		       <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
		          <li><?php echo e($error); ?></li>
		       <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
		    </ul>
		 </div>
		<?php endif; ?>
		<?php if($count>0){ ?>
		  <table class="table table-bordered" id="dataTable">
		    <thead>
		      <tr>
		        <th>Booking Form No</th>
		      	<th>Booking Date</th>
		      	<th>Party Name</th>
		      	<th>Function Date</th>
		      	<th>Function Time</th>
		        <th>Function Type</th>
		        <th>Status</th>
		        <?php if(Auth::user()->user_group == '1'){ ?>
		        <th style="width: 150px">Action</th>
		        <?php }?>
		      </tr>
		    </thead>
		    <tbody>
		      <?php $__currentLoopData = $booking; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
	          <tr>
	            <td><?php echo e($value->booking_no); ?></td>
	          	<td><?php echo e(date_dfy($value->booking_date)); ?></td>
	          	<td><?php echo e($value->party_name); ?></td>
	          	<td><?php echo e(date_dfy($value->function_date)); ?></td>
	            <td><?php echo e(am_pm($value->from_time).' - '. am_pm($value->to_time)); ?></td>
	            <td><?php echo e($value->function_type); ?></td>
	            <?php if($value->cancel_booking == '1'){ ?>
	            <td><span class="label label-warning">Cancelled</span></td>
	            <?php } else{ ?>
	            <td><span class="label label-success">Booked</span></td>
	            <?php }?>
	            <?php if(Auth::user()->user_group == '1'){ ?>
	            <td>
	            <a href="<?php echo e(url('/booking/view/'.$value->id)); ?>" data-toggle="tooltip" title="View" class="btn btn-info" data-original-title="View"><i class="fa fa-eye"></i></a>
	            <?php if($value->receipt_created == '0' && $value->cancel_booking == '0'){ ?>
	            <a href="<?php echo e(url('/booking/edit/'.$value->id)); ?>" data-toggle="tooltip" title="Edit" class="btn btn-primary" data-original-title="Edit"><i class="fa fa-pencil"></i></a>
	            <?php }?>
	            <?php if($value->cancel_booking == '0'){ ?>
	            <a href="javascript:" data-toggle="modal" data-target="#cancelModal<?php echo e($value->id); ?>" title="Cancel" class="btn btn-warning" data-original-title="Edit"><i class="fa fa-times "></i></a>
	            <?php }?>
	            <div class="modal fade cancelModal" id="cancelModal<?php echo e($value->id); ?>" tabindex="-1" role="dialog">
		            <div class="modal-dialog">
		              <div class="modal-content">
		                  <div class="modal-header">
		                      <button aria-hidden="true" data-dismiss="modal" class="close" type="button">&times;</button>
		                      <h4 class="modal-title">Cancel Booking</h4>
		                  </div>
		                  <form class="form-vertical" method="post" action="<?php echo e(url('booking/cancel/'.$value->id)); ?>">
		                  <?php echo e(csrf_field()); ?>

		                  <div class="modal-body">
		                  	  <div class="form-group">
							      <label class="popup_label">*Cancel Date:</label>
								  <div class="input-group date">
									<input type="text" name="cancel_date" id="cancel_date" class="form-control " placeholder="Enter cancel date" required=""><span class="input-group-addon"><i class="fa fa-calendar"></i></span>
								  </div>
							  </div>
							  <div class="form-group">
							    <label class="popup_label">Cancel (%):</label>
							    <input type="number" class="form-control popup_input" placeholder="Enter cancel percentage" name="cancel_percentage" id="cancel_percentage" step="0.01">
							  </div>
							  <div class="form-group">
							    <label class="popup_label">Cancel (Amt):</label>
							    <input type="number" class="form-control popup_input" placeholder="Enter cancel amount" name="cancel_amount" id="cancel_amount">
							  </div>
							  <?php if($value->receipt_created == '1'){ ?>
							  <div><b>Note:</b> The associated Receipt ID: <?php echo e($value->receipt_id); ?> will be auto cancelled with Booking ID: <?php echo e($value->id); ?></div>
							  <?php }?>
		                  </div>
		                  <div class="modal-footer">
					        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
					        <button type="submit" class="btn btn-primary">Cancel Booking</button>
					      </div>
					      </form>
		              </div>
		            </div>
		        </div>
	            <!--<a onclick="return confirm('Are you sure you want to Delete?');" href="<?php echo e(url('/booking/delete/'.$value->id)); ?>" data-toggle="tooltip" title="Delete" class="btn btn-danger" data-original-title="Delete"><i class="fa fa-trash-o"></i></a>-->
	            </td>
	            <?php }?>
	          </tr>
	          <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
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
    	"ordering": false
    });
});
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.website', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>