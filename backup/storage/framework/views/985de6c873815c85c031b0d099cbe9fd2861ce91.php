<?php $__env->startSection('content'); ?>
<!-- <div class="pageheader">
		<div class="media">
        <div class="media-body">
    	<h4>Add Domain</h4>
        <ul class="breadcrumb">
            <li><a href="<?php echo e(url('/')); ?>"><i class="glyphicon glyphicon-home"></i></a></li>
            <li>Domain</li>
            <li>Add</li>
        </ul>
    	</div>
    </div>
</div> -->
<div class="contentpanel">
<div id="page-wrapper">
    <div class="row">
	    <div class="col-md-12">
			<div class="step-heading">STEP 1: Enter Domain Name to create Campaign</div>
		</div>
	</div>

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
      	<form method="post" action="<?php echo e(url('domain/save')); ?>">
      	<?php echo e(csrf_field()); ?>


	    <div class="row">
			<div class="col-md-10 col-md-offset-1 pt10">
	    		<div class="col-md-8">
			    	<input type="text" class="big-inputs" placeholder="Enter Your Domain" name="domain_name" id="domain_name" required="">
				</div>
	    		<div class="col-md-3">

				  <button type="submit" class="btn btn-primary large-btn">Submit</button>
				</div>
			</div>
		</div>
		</form>
      </div>
	</div>
</div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.website', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>