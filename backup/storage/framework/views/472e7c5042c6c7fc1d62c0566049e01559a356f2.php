<?php $__env->startSection('content'); ?>

<div class="pageheader">
		<div class="media">
        <div class="pageicon pull-left">
            <i class="fa fa-home"></i>
        </div>
        <div class="media-body">
    	<h4>Dashboard</h4>
        <ul class="breadcrumb">
            <li><a href="<?php echo e(url('')); ?>"><i class="glyphicon glyphicon-home"></i></a></li>
            <li>Dashboard</li>
        </ul>
    	</div>
    </div><!-- media -->
</div><!-- pageheader -->
<div class="contentpanel">
<div id="page-wrapper">       
</div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.website', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>