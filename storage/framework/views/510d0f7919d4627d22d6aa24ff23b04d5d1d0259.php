<?php $__env->startSection('content'); ?>
<div class="pageheader">
		<div class="media">
        <div class="media-body">
    	<h4>Add Period</h4>
        <ul class="breadcrumb">
            <li><a href="<?php echo e(url('/')); ?>"><i class="glyphicon glyphicon-home"></i></a></li>
            <li>Masters</li>
            <li>Period</li>
            <li>Add</li>
        </ul>
    	</div>
    </div>
</div>
<div class="contentpanel">
<div id="page-wrapper">       
    <div class="row">
	    <div class="col-md-6">
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
      	<form method="post" action="<?php echo e(url('period/save')); ?>">
      	<?php echo e(csrf_field()); ?>

		  <div class="form-group">
		    <label>*Period Name:</label>
		    <input type="text" class="form-control" placeholder="Enter period name" name="name" id="name" required="">
		  </div>
		  <div class="form-group" style="display: inline-block; width: 49.6%">
			<label>Start Time:</label>
			<div class="input-group clockpicker">
			  <input type="text" class="form-control" placeholder="Enter Start time" name="start_time" id="start_time">
			  <span class="input-group-addon">
				<span class="glyphicon glyphicon-time"></span>
			  </span>
			</div>
		  </div>
		  <div class="form-group" style="display: inline-block; width: 49.6%">
		    <label>*End Time:</label>
			<div class="input-group clockpicker">
		    <input type="text" class="form-control" placeholder="Enter End Time" name="end_time" id="end_time" required="">
			  <span class="input-group-addon">
				<span class="glyphicon glyphicon-time"></span>
			  </span>
			</div>
		  </div>
		  <div class="form-group">
		    <label>*Period Order:</label>
		    <input type="text" class="form-control" placeholder="Period Order" name="period_order" id="period_order" required="">
		  </div>

		  <button type="submit" class="btn btn-primary">Submit</button>
		</form>
      </div>
	</div>
</div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.website', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>