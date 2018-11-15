
<?php $__env->startSection('content'); ?>
<div class="pageheader">
		<div class="media">
        <div class="media-body">
    	<h4>Update Teacher</h4>
        <ul class="breadcrumb">
            <li><a href="<?php echo e(url('')); ?>"><i class="glyphicon glyphicon-home"></i></a></li>
            <li>Masters</li>
            <li>Teacher</li>
            <li>Edit</li>
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
      	<form method="post" action="<?php echo e(url('/teacher/update/'.$teacher[0]->id)); ?>">
      	<?php echo e(csrf_field()); ?>

		  <div class="form-group">
		    <label>*Teacher Name:</label>
		    <input type="text" class="form-control" placeholder="Enter teacher name" name="name" id="name" value="<?php echo $teacher[0]->name; ?>" required="">
		  </div>

		  <div class="form-group">
		    <label>*Email:</label>
		    <input type="email" class="form-control" placeholder="Enter email" name="email" id="email" value="<?php echo $teacher[0]->email; ?>" required="">
		  </div>

		  <div class="form-group">
		    <label>*Teacher Code:</label>
		    <input type="text" class="form-control" placeholder="Enter Teacher Code" name="teachercode" id="teachercode" value="<?php echo $teacher[0]->teachercode; ?>" required="">
		  </div>

		  <div class="form-group">
		    <label>Phone:</label>
		    <input type="text" class="form-control" placeholder="Enter phone" name="phone" value="<?php echo $teacher[0]->phone; ?>" id="phone">
		  </div>
		  <div class="form-group">
			  <label>*Role:</label>
			  <select class="form-control" name="role" id="role" required="">
					<option value="">Select</option>
					<?php $__currentLoopData = $role; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
					<option <?php if($teacher[0]->role==$value->id) echo 'selected';?> value="<?php echo e($value->id); ?>"><?php echo e($value->name); ?></option>
					<?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
			  </select>
		  </div>
		  <div class="input_fields_wrap">			  
			<div class="form-group" style="display: inline-block; width: 49.6%">
				<label>*Subject:</label>
				<select class="form-control" name="subject_id" id="subject_id" required="">
					<option value="">Select</option>
					<?php $__currentLoopData = $subject; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
					<option value="<?php echo e($value->id); ?>"><?php echo e($value->name); ?></option>
					<?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
				</select>
			</div>
			<div class="form-group" style="display: inline-block; width: 49.6%">
				<label>*Class Level:</label>
				<select class="form-control" name="class_id" id="class_id" required="">
					<option value="">Select</option>
					<?php $__currentLoopData = $class; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
					<option value="<?php echo e($value->id); ?>"><?php echo e($value->name); ?></option>
					<?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
				</select>
			</div>
			<button type="button" class="add_field_button">Add Subject</button>
			<?php if($teacher[0]->subject_cabalility_with_level)
			{
				$capability=json_decode($teacher[0]->subject_cabalility_with_level);
			}
				?>
      		<?php for($i=0;$i<count($capability[0]);$i++): ?>
				<div><input type="text" placeholder="Subject Name" name="subjects[]" readonly value="<?php echo e($capability[0][$i]); ?>"><input type="text" readonly placeholder="Class Level" name="class_level[]" value="<?php echo e($capability[1][$i]); ?>" ><a class="remove_entry"><span>Remove</span></a></div>
      		<?php endfor; ?>
		  </div>
			
		  <div class="form-group">
		      <label>*Status:</label>
		      <select class="form-control" name="status" id="status" required="">
		      		<option value="">Select</option>
		      		<option value="1" <?php if($teacher[0]->status) echo 'selected';?> >Enable</option>
		      		<option value="0" <?php if(!$teacher[0]->status) echo 'selected';?> >Disable</option>
		      </select>
		  </div>

		  <button type="submit" class="btn btn-primary">Update</button>
		</form>
		</div>
	</div>
</div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.website', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>