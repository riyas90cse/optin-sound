<?php $__env->startSection('content'); ?>
<div class="pageheader">
	<div class="media">
		<?php if(Auth::user()->status == '1'){ ?>
		<div class="pull-right">
			<a href="<?php echo e(url('/campaign/create')); ?>"><button class="btn btn-primary"><i class="fa fa-plus"></i> Add Campaign</button></a>
		</div>
		<?php }?>
		<div class="media-body">
		<h4>Campaign</h4>
		<ul class="breadcrumb">
		    <li><a href="<?php echo e(url('/')); ?>"><i class="glyphicon glyphicon-home"></i></a></li>
		    <li>Campaign</li>
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
		        <th>Campaign Name</th>
		        <th>Campaign Type</th>
		        <th>Domain</th>
		        <th>Sound Preview</th>
		        <?php if(Auth::user()->user_group == '1'){ ?>
		        <th style="width: 150px">Action</th>
		        <?php }?>
		      </tr>
		    </thead>
		    <tbody>
		      <?php $__currentLoopData = $campaigns; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
	          <tr>
	            <td><?php echo e($i++); ?></td>
	            <td><?php echo e($value->campaign_name); ?></td>
	            <td><?php echo e($value->campaign_type); ?></td>
	            <td><?php echo e($value->domain_name); ?></td>
	            <td><div class="sound_preview" data-soundsrc="<?php echo e($value->sound_src); ?>"><span>Play Sound</span><img height="20px" src="<?php echo e(url('/')); ?>/images/convertsound-fav.png"/></div></td>
	            <td>
				<div id="modal<?php echo e($value->id); ?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	                <div class="modal-dialog">
	                    <div class="modal-content">
	                        <div class="modal-header">
	                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
	                            <h4 class="modal-title" id="myModalLabel"><?php echo e(ucfirst($value->campaign_name)); ?> Code</h4>
	                        </div>
	                        <div class="modal-body">
	                            <textarea style="width:100%"><script type="text/javascript" src="<?php echo e(url('/')); ?>/uploads/campaign/<?php echo e($value->script_name); ?>.js"></script></textarea>
	                        </div>
	                        <div class="modal-footer">
	                            <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Close</button>
	                        </div>
	                    </div>
	                </div>
	            </div>
            	<a href="" title="Code" class="btn btn-primary" data-original-title="Code" data-toggle="modal" data-original-title="View Code" data-target="#modal<?php echo e($value->id); ?>"><i class="fa fa-code"></i></a>
	            <a href="<?php echo e(url('/campaign/edit/'.$value->id)); ?>" data-toggle="tooltip" title="Edit" class="btn btn-success" data-original-title="Edit"><i class="fa fa-pencil"></i></a>
	            <a onclick="return confirm('Are you sure you want to Delete?');" href="<?php echo e(url('/campaign/delete/'.$value->id)); ?>" data-toggle="tooltip" title="Delete" class="btn btn-danger" data-original-title="Delete"><i class="fa fa-trash-o"></i></a>
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
		<p>No Campaingn found!</p>
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