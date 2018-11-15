<?php $__env->startSection('content'); ?>
<script src="<?php echo e(url('/js/modernizr.custom.js')); ?>"></script>
<style>
.my-toggle-class {
color: #888;
cursor: pointer;
font-size: 0.75em;
font-weight: bold;
padding: 0.5em 1em;
text-transform: uppercase;
}
</style>
<div class="pageheader">
		<div class="media">
        <div class="pageicon pull-left">
            <i class="fa fa-gear"></i>
        </div>
        <div class="media-body">
    	<h4>Change Password</h4>
        <ul class="breadcrumb">
            <li><a href="<?php echo e(url('')); ?>"><i class="glyphicon glyphicon-home"></i></a></li>
            <li>Change Password</li>
        </ul>
    	</div>
    </div><!-- media -->
</div><!-- pageheader -->
<div class="contentpanel">
<div id="page-wrapper">       
    <div class="row">
        <div class="col-md-5">
          <?php if(Session::has('success')): ?>
			<div class="alert alert-success">
				<?php echo e(Session::get('success')); ?>

			 </div>
		  <?php endif; ?>
          <?php if(Session::has('failed')): ?>
			<div class="alert alert-danger">
				<ul>
			       <li><?php echo e(Session::get('failed')); ?></li>
			    </ul>
			 </div>
		  <?php endif; ?>
          <?php if(count($errors) > 0): ?>
			 <div class="alert alert-danger">
			    <ul>
			       <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
			          <li><?php echo e($error); ?></li>
			       <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
			    </ul>
			 </div>
		  <?php endif; ?>
          <form method="post" action="<?php echo e(url('/changepassword')); ?>">
          	<?php echo e(csrf_field()); ?>

		    <div class="form-group">
		      <label>*Old Password:</label>
		      <input type="password" class="form-control" name="old_password" id="old_password" placeholder="Enter old password" required="">
		    </div>
		    <div class="form-group">
		      <label>*New Password:</label>
		      <input type="password" class="form-control" name="password" id="password" placeholder="Enter new password" required="">
		    </div>
		    <div class="form-group">
		      <label>*Confirm New Password:</label>
		      <input type="password" class="form-control" name="confirm_password" id="confirm_password" placeholder="Confirm new password" required="">
		    </div>
		    <button type="submit" name="submit" class="btn btn-primary">Update</button>
		  </form>
        </div>
    </div>
</div>
</div>
<!-- Include the plugin. Yay! --> 
<script src="<?php echo e(url('/js/hideShowPassword.min.js')); ?>"></script> 
<script>
// Example 2
$('#old_password,#password,#confirm_password').hideShowPassword({
  // Make the password visible right away.
  show: false,
  // Create the toggle goodness.
  innerToggle: true,
  // Give the toggle a custom class so we can style it
  // separately from the previous example.
  toggleClass: 'my-toggle-class',
  // Don't show the toggle until the input triggers
  // the 'focus' event.
  hideToggleUntil: 'focus',
  // Enable touch support for toggle.
  touchSupport: Modernizr.touch
});
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.website', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>