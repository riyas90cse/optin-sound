
<?php $__env->startSection('content'); ?>
<div class="pageheader">
		<div class="media">
        <div class="media-body">
    	<h4>Edit Sound Niche</h4>
        <ul class="breadcrumb">
            <li><a href="<?php echo e(url('/')); ?>"><i class="glyphicon glyphicon-home"></i></a></li>
            <li>Masters</li>
            <li>Sound Niche</li>
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
      	<form method="post" action="<?php echo e(url('donesound/update/'.$soundniche[0]->id)); ?>" enctype="multipart/form-data">
  		<?php echo e(csrf_field()); ?>


		  <div class="form-group">
		    <label>*Sound Name:</label>
		    <input type="text" class="form-control" placeholder="Enter Sound Name" name="soundname" id="soundname" required="" value="<?php echo $soundniche[0]->soundname; ?>">
		  </div>

		  <div class="form-group">
			<label>*Niche Category:</label>
			<select class="form-control" name="niche_category" id="niche_category">
				<option value="">Select</option>
				<?php $__currentLoopData = $niche; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
				<option value="<?php echo e($value->id); ?>" <?php if($value->id==$soundniche[0]->niche_category) {echo  'selected=""';}?>><?php echo e($value->niche_category); ?></option>
				<?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
			</select>
		  </div>

		  <div class="form-group">
			<label>*Traffic Source:</label>
			<select class="form-control" name="trafficsource" id="trafficsource">
				<option value="">Select</option>
				<?php $__currentLoopData = $trafficsource; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
				<option value="<?php echo e($value->id); ?>" <?php if($value->id==$soundniche[0]->trafficsource) {echo  'selected=""';}?>><?php echo e($value->sourcename); ?></option>
				<?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
			</select>
		  </div>

		  <div class="form-group">
			<label>*Language:</label>
			<select class="form-control" name="language" id="language">
				<option value="">Select</option>
				<?php $__currentLoopData = $language; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
				<option value="<?php echo e($value->id); ?>" <?php if($value->id==$soundniche[0]->language) {echo  'selected=""';}?>><?php echo e($value->language_name); ?></option>
				<?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
			</select>
		  </div>


		  <div class="form-group">
			<label>*Voice Variation :</label>
			<select class="form-control" name="variation" id="variation" required="">
				<option value="">Select</option>
				<option value="male" <?php if($soundniche[0]->variation=='male') {echo  'selected=""';}?>>Male</option>
				<option value="female" <?php if($soundniche[0]->variation=='female') {echo  'selected=""';}?>>Female</option>
			</select>
		  </div>

		  <div class="form-group">
			<label>*Sound Text :</label>
			<textarea class="form-control" name="sound_text" id="sound_text" required="" placeholder="Enter sound text here..."><?php echo e($soundniche[0]->sound_text); ?></textarea>
		  </div>

		  <div class="form-group" id="t2s_output">
			<div class="col-md-3">
				<label>Sound Preview: </label>
			</div>
			<div class="col-md-7">
				<img src="<?php echo e(url('/images/convertsound-fav.png')); ?>" id="t2s_playservice" alt="play/pause" title="To Play Click Here">
				<audio class="form-control" name="t2s_soundpreview" id="t2s_soundpreview" controls>
				  <source src="<?php echo e(url('/')); ?>/<?php echo e($soundniche[0]->sound_url); ?>" type="audio/mpeg">
				  Your browser does not support the audio tag.
				</audio> 
			</div>
		  </div>								

		  <div class="input-group control-group" >
			<label>*Upload File:</label>
			<input type="hidden" name="hidden_filename" class="form-control" id="hidden_filename" value="<?php echo e($soundniche[0]->sound_url); ?>">
			<input type="file" name="filename" class="form-control" id="filename">
		  </div>
				

		  <div class="form-group">
		      <label>*Active:</label>
		      <select class="form-control" name="active" id="active">
				<option value="yes" <?php if($niche[0]->active=='yes'){ echo  'selected=""'; }?> >Yes</option>
				<option value="no" <?php if($niche[0]->active=='no'){ echo  'selected=""'; }?> >No</option>
		      </select>
		  </div>

		  <button type="submit" class="btn btn-primary">Update</button>
		</form>
		</div>
	</div>
</div>
</div>
<script type="text/javascript">
    jQuery('#t2s_playservice').click(function() {
	    var audio = document.getElementById("t2s_soundpreview");

	    //var audio=$('#soundpreview');
	    if(audio.paused == false) {
	        audio.pause();
	        // alert('music paused');
	    } else {
	        audio.play();
	        // alert('music playing');
	    }
    });

</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.website', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>