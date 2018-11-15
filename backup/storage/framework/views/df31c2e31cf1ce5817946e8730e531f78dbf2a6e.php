<?php $__env->startSection('content'); ?>

<div class="pageheader">
		<div class="media">
        <div class="pageicon pull-left">
            <i class="fa fa-user"></i>
        </div>
        <div class="media-body">
    	<h4>Edit Profile</h4>
        <ul class="breadcrumb">
            <li><a href="<?php echo e(url('')); ?>"><i class="glyphicon glyphicon-home"></i></a></li>
            <li>Edit Profile</li>
        </ul>
    	</div>
    </div><!-- media -->
</div><!-- pageheader -->
<div class="contentpanel">
<div id="page-wrapper">       
    <div class="row">
        <div class="col-md-5">
          <?php if(Session::has('status')): ?>
			<div class="alert alert-success">
				<?php echo e(Session::get('status')); ?>

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
          <form method="post" action="<?php echo e(url('/editprofile')); ?>" enctype="multipart/form-data">
          	<?php echo e(csrf_field()); ?>

		    <div class="form-group">
		      <label>*Name:</label>
		      <input type="text" class="form-control" name="name" id="name" value="<?php echo $profile[0]->name; ?>" placeholder="Enter your name" required="">
		    </div>
		    <div class="form-group">
		      <label>*Email:</label>
		      <input type="email" class="form-control" name="email" id="email" value="<?php echo $profile[0]->email; ?>" placeholder="Enter your email" required="">
		    </div>
		    <div class="form-group">
		      <label>*Mobile:</label>
		      <input type="text" class="form-control" name="mobile" id="mobile" value="<?php echo $profile[0]->mobile; ?>" placeholder="Enter your mobile (10 digits only)" required="" maxlength="10">
		    </div>
		    <div class="form-group">
		      <label>Image:</label>
		      <input class="form-control" type="file" name="image" accept="image/*" />
		      <?php if($profile[0]->image != ''){ ?>
	          <img style="margin-top: 10px" width="100px" src="<?php echo e(url('/uploads/'.$profile[0]->image)); ?>"/>
	          <?php } ?>
		    </div>
		    <button type="submit" name="submit" class="btn btn-primary">Update</button>
		  </form>
        </div>
    </div>
</div>
</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.website', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>