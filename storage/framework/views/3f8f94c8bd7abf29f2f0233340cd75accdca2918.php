<?php $__env->startSection('content'); ?>
<div class="pageheader">
	<div class="media">
		<?php if(Auth::user()->status == '1'){ ?>
		<div class="pull-right">
			<a href="<?php echo e(url('/oc/create')); ?>"><button class="btn btn-primary"><i class="fa fa-plus"></i> Add Overlay Campaign</button></a>
		</div>
		<?php }?>
		<div class="media-body">
		<h4>Overlay Campaigns</h4>
		<ul class="breadcrumb">
		    <li><a href="<?php echo e(url('/')); ?>"><i class="glyphicon glyphicon-home"></i></a></li>
		    <li>Overlay</li>
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
		<?php $i=1;?>
		<?php if($count>0){ ?>
		  <table class="table table-bordered" id="dataTable">
		    <thead>
		      <tr>
		        <th>S.No.</th>
		        <th>Overlay Name</th>
				<th>Campaign Name</th>
		        <th>Domain</th>
		        <th>Link</th>
		        <th>Sound Preview</th>
		        <?php if(Auth::user()->user_group == '1'){ ?>
		        <th style="width: 150px">Action</th>
		        <?php }?>
		      </tr>
		    </thead>
		    <tbody>
		      <?php $__currentLoopData = $overlays; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
	          <tr>
	            <td><?php echo e($i++); ?></td>
	            <td><?php echo e($value->overlay_name); ?></td>
	            <td><?php echo e($value->campaign_name); ?></td>
	            <td><?php echo e($value->domain_name); ?></td>
	            <td><?php echo e($value->custom_link); ?></td>
	            <td>
	            <a href="<?php echo e(url('/oc/edit/'.$value->id)); ?>" data-toggle="tooltip" title="Edit" class="btn btn-success" data-original-title="Edit"><i class="fa fa-pencil"></i></a>
	            <a onclick="return confirm('Are you sure you want to Delete?');" href="<?php echo e(url('/oc/delete/'.$value->id)); ?>" data-toggle="tooltip" title="Delete" class="btn btn-danger" data-original-title="Delete"><i class="fa fa-trash-o"></i></a>
	            </td>
	          </tr>
	          <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
		    </tbody>
		  </table>
			<audio class="form-control" name="dfy_soundpreview" id="dfy_soundpreview" controls>
				<source src="<?php echo e(url('/uploads/sound/')); ?>" type="audio/mpeg">
				Your browser does not support the audio tag.
			</audio> 
						</div>

		<?php } else{?>
		<p>No Overlay Campaingn found!</p>
		<?php }?>
		</div>
	</div>
</div>
</div>
<script>
$(document).ready(function() {
    $('#dataTable').DataTable({});



	$('.sound_preview').click(function(){
		var val = $(this).attr('data-soundsrc');
		var audio = document.getElementById("dfy_soundpreview");
		if(audio.src!=val)
	    $('#dfy_soundpreview').attr('src',val);
		if(audio.paused == false) {
			audio.pause();
	        // alert('music paused');
	    }
	    else {
	    	audio.play();
	        // alert('music playing');
	    }
	});


});


</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.website', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>