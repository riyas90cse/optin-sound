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


<div class="row">
                <!-- col -->
                <div class="col-sm-12 col-xs-12 col-md-12 col-lg-12">
                    <div class="row">
                        <!-- <div class="col-md-4 col-xs-12 col-sm-4" onclick="window.location='/domain/add'" style="cursor:pointer"> -->
                        <div class="col-md-4 col-xs-12 col-sm-4" style="cursor:pointer">
                            <div class="white-box">
                                <div class="bar-widget">
                                    <div class="info_button pull-right"><span class="tooltip1" title="This is my image's tooltip message!"><i class="fa fa-info-circle"></i></span></div>
                                    <div class="table-box">
                                        <!--<div class="cell text-left">
                                            <div id="sparkline1"></div>
                                        </div>-->
                                        <div class="table-detail text-center">
                                            <div class="big-icons"><i class="fa fa-globe"></i></div>
                                            <h2 class="m-t-0 m-b-5 font-light counter">STEP 1</h2>
                                            <p>Add a domain</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- <div class="col-md-4 col-xs-12 col-sm-4" onclick="window.location='/campaign/add'" style="cursor:pointer"> -->
                        <div class="col-md-4 col-xs-12 col-sm-4" style="cursor:pointer">
                            <div class="white-box">
                                <div class="bar-widget">
                                    <div class="info_button pull-right"><span class="tooltip1" title="This is my image's tooltip message!"><i class="fa fa-info-circle"></i></span></div>
                                    <div class="table-box">
                                        <!--<div class="cell text-left">
                                            <div id="sparkline1"></div>
                                        </div>-->
                                        <div class="table-detail text-center">
                                            <div class="big-icons"><i class="fa fa-bullhorn"></i></div>
                                            <h2 class="m-t-0 m-b-5 font-light counter">STEP 2</h2>
                                            <p>Choose a Campaign Type</p>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-xs-12 col-sm-4" style="cursor:pointer">
                            <div class="white-box">
                                <div class="bar-widget">
                                    <div class="info_button pull-right"><span class="tooltip1" title="This is my image's tooltip message!"><i class="fa fa-info-circle"></i></span></div>
                                    <div class="table-box">
                                        <!--<div class="cell text-left">
                                            <div id="sparkline1"></div>
                                        </div>-->
                                        <div class="table-detail text-center">
                                            <div class="big-icons"><i class="fa fa-code"></i></div>
                                            <h2 class="m-t-0 m-b-5 font-light counter">STEP 3</h2>
                                            <p>Just Copy paste the Embed code</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-sm-12 col-xs-12 col-md-12 col-lg-12 getstart" >
                    <div class="row">
                        <div class="col-md-6 col-xs-12 col-sm-6" onclick="window.location='/campaign/create'" style="cursor:pointer">
                            <div class="white-box">
                                <div class="bar-widget">
                                    <div class="info_button pull-right"><span class="tooltip1" title="This is my image's tooltip message!"><i class="fa fa-info-circle"></i></span></div>
                                    <div class="table-detail text-center">
                                        <h2 class="m-t-0 m-b-5 font-light counter">Get Started Now</h2>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

</div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.website', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>