<?php $__env->startSection('content'); ?>
<div class="pageheader">
		<div class="media">
        <div class="media-body">
    	<h4>Add Teacher</h4>
        <ul class="breadcrumb">
            <li><a href="<?php echo e(url('/')); ?>"><i class="glyphicon glyphicon-home"></i></a></li>
            <li>Masters</li>
            <li>Weekly Period Limit</li>
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
      	<form method="post" action="<?php echo e(url('weeklycount/save')); ?>">
      	<?php echo e(csrf_field()); ?>

			<div class="form-group">
				  <label>*Class:</label>
				  <select class="form-control" name="class_id" id="class_id" required="">
						<option value="">Select</option>
						<?php $__currentLoopData = $class; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
						<option value="<?php echo e($value->id); ?>"><?php echo e($value->name); ?></option>
						<?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
				  </select>
			</div>
			<div class="form-group">
				  <label>*Subject:</label>
				  <select class="form-control" name="subject" id="subject" required="">
						<option value="">Select</option>
						<?php $__currentLoopData = $subject; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
						<option value="<?php echo e($value->id); ?>"><?php echo e($value->name); ?></option>
						<?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
				  </select>
			</div>
			<div class="form-group">
				<label>Count:</label>
				<input type="text" class="form-control" placeholder="Enter Count" name="count" id="count">
			</div>

			<button type="submit" class="btn btn-primary">Submit</button>

		</form>
      </div>
	</div>
</div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.website', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>