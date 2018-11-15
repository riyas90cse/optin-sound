<?php $__env->startSection('content'); ?>
<div class="pageheader">
		<div class="media">
        <div class="media-body">
    	<h4>Upload Sound</h4>
        <ul class="breadcrumb">
            <li><a href="<?php echo e(url('/')); ?>"><i class="glyphicon glyphicon-home"></i></a></li>
            <li>Masters</li>
            <li>Sounds</li>
            <li>Add</li>
        </ul>
    	</div>
    </div>
</div>
      <?php if(count($errors) > 0): ?>
      <div class="alert alert-danger">
        <strong>Whoops!</strong> There were some problems with your input.<br><br>
        <ul>
          <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
              <li><?php echo e($error); ?></li>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
        </ul>
      </div>
      <?php endif; ?>

        <?php if(session('success')): ?>
        <div class="alert alert-success">
          <?php echo e(session('success')); ?>

        </div> 
        <?php endif; ?>

<div class="contentpanel">
<div id="page-wrapper">       
    <div class="row">
	    <div class="col-md-6">
			<form method="post" action="<?php echo e(url('uploadfile')); ?>" enctype="multipart/form-data">
			<?php echo e(csrf_field()); ?>


			    <div class="input-group control-group increment" >
			      <input type="file" name="filename" class="form-control">
			      <div class="input-group-btn"> 
			        <button class="btn btn-success" type="button"><i class="glyphicon glyphicon-plus"></i>Add</button>
			      </div>
			    </div>

			    <button type="submit" class="btn btn-primary" style="margin-top:10px">Submit</button>

			</form> 
   		</div>
   </div>
</div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.website', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>