<?php $__env->startSection('content'); ?>
<div class="pageheader">
	<div class="media">
		<?php if(Auth::user()->user_group == '1'){ ?>
		<div class="pull-right">
			<a href="<?php echo e(url('/class-section-combination/add')); ?>"><button class="btn btn-primary"><i class="fa fa-plus"></i> Add Combination</button></a>
		</div>
		<?php }?>
		<div class="media-body">
		<h4>Class Section Combination</h4>
		<ul class="breadcrumb">
		    <li><a href="<?php echo e(url('/')); ?>"><i class="glyphicon glyphicon-home"></i></a></li>
		    <li>Masters</li>
		    <li>Class Sections</li>
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
		<?php if($count>0){ ?>
		  <table class="table table-bordered" id="dataTable">
		    <thead>
		      <tr>
		        <th>Class</th>
		        <th>Section</th>
		        <th>Class Teacher</th>
		        <?php if(Auth::user()->user_group == '1'){ ?>
		        <th>Action</th>
		        <?php }?>
		      </tr>
		    </thead>
		    <tbody>
		      <?php $__currentLoopData = $cscombination; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
	          <tr>
	            <td>
					<?php 
					foreach ($class as $key)							   
					if($key->id==$value->class_id)
					echo  $key->name;
					?>
			  	</td>
	            <td>
					<?php 
					foreach ($section as $key)							   
					if($key->id==$value->section_name)
					echo  $key->section_name;
					?>
				</td>
	            <td>
					<?php 
					foreach ($teacher as $key)							   
					if($key->id==$value->class_teacher)
					echo  $key->name;
					?>
				</td>

				<?php if(Auth::user()->user_group == '1'){ ?>
	            <td>
	            <a href="<?php echo e(url('/class-section-combination/edit/'.$value->id)); ?>" data-toggle="tooltip" title="Edit" class="btn btn-primary" data-original-title="Edit"><i class="fa fa-pencil"></i></a>
	            <a onclick="return confirm('Are you sure you want to Delete?');" href="<?php echo e(url('/class-section-combination/delete/'.$value->id)); ?>" data-toggle="tooltip" title="Delete" class="btn btn-danger" data-original-title="Delete"><i class="fa fa-trash-o"></i></a>
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
    });
});
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.website', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>