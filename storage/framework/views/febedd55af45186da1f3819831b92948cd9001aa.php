<?php $__env->startSection('content'); ?>
<div class="pageheader">
	<div class="media">
		<?php if(Auth::user()->user_group == '1'){ ?>
		<div class="pull-right">
			<a href="<?php echo e(url('/donesound/add')); ?>"><button class="btn btn-primary"><i class="fa fa-plus"></i> Add Sound Niche</button></a>
		</div>
		<?php }?>
		<div class="media-body">
		<h4>Sound Niches</h4>
		<ul class="breadcrumb">
		    <li><a href="<?php echo e(url('/')); ?>"><i class="glyphicon glyphicon-home"></i></a></li>
		    <li>Sound Niche</li>
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
		      	<th>S. No</th>
		        <th>Sound Name</th>
		        <th>Niche Category</th>
		        <th>Traffic Source</th>
		        <th>Language</th>
		        <th>Voice Variation</th>
		        <th>Sound Text</th>
		        <th>Sound Preview</th>
		        <th>Active</th>
		        <?php if(Auth::user()->user_group == '1'){ ?>
		        <th width="100px">Action</th>
		        <?php }?>
		      </tr>
		    </thead>
		    <tbody>
		      <?php $__currentLoopData = $soundniche; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
	          <tr>
	          	<td><?php echo e($value->id); ?></td>
	            <td><?php echo e($value->soundname); ?></td>
	            <td>
				<?php $__currentLoopData = $niche; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $uv): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
					<?php if($uv->id==$value->niche_category) {echo $uv->niche_category; } ?>
				<?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>

	            </td>
	            <td>
				<?php $__currentLoopData = $trafficsource; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $uv): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
					<?php if($uv->id==$value->trafficsource) {echo $uv->sourcename; } ?>
				<?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>

	            </td>

	            <td>
				<?php $__currentLoopData = $language; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $uv): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
					<?php if($uv->id==$value->language) {echo $uv->language_name; } ?>
				<?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>

	            </td>
	            <td><?php echo e($value->variation); ?></td>
	            <td><?php echo e($value->sound_text); ?></td>
	            <td><?php echo e($value->sound_url); ?></td>


	            <td><?php echo e(ucfirst($value->active)); ?></td>
	            <?php if(Auth::user()->user_group == '1'){ ?>
	            <td>
	            <a href="<?php echo e(url('/donesound/edit/'.$value->id)); ?>" data-toggle="tooltip" title="Edit" class="btn btn-primary" data-original-title="Edit"><i class="fa fa-pencil"></i></a>
	            <a onclick="return confirm('Are you sure you want to Delete?');" href="<?php echo e(url('/donesound/delete/'.$value->id)); ?>" data-toggle="tooltip" title="Delete" class="btn btn-danger" data-original-title="Delete"><i class="fa fa-trash-o"></i></a>
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