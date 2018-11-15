<?php $__env->startSection('content'); ?>

<div class="pageheader">
		<div class="media">
        <div class="pageicon pull-left">
            <i class="fa fa-share"></i>
        </div>
        <div class="media-body">
    	<h4>Integration Board</h4>
        <ul class="breadcrumb">
            <li><a href="<?php echo e(url('')); ?>"><i class="glyphicon glyphicon-home"></i></a></li>
            <li>Integrations</li>
        </ul>
    	</div>
    </div><!-- media -->
</div><!-- pageheader -->
<div class="contentpanel">
    <div id="page-wrapper"> 
        <div class="row">
                <!-- col -->
                <div class="col-md-8 col-md-offset-2">
                    <div class="row">
                        <!-- <div class="col-md-4 col-xs-12 col-sm-4" onclick="window.location='/domain/add'" style="cursor:pointer"> -->
                        <div class="col-md-6 col-xs-12 col-sm-6" style="cursor:pointer">
                            <div class="white-box">
                                <div class="bar-widget">
                                    <div class="info_button pull-right"><span class="tooltip1" title="This is my image's tooltip message!"><i class="fa fa-info-circle"></i></span></div>
                                    <div class="table-box">
                                        <div class="table-detail text-center">
                                            <div class="big-icons"><img src="<?php echo e(url('images/aweber_logo.jpeg')); ?>"></div>
                                            <button class="btn btn-primary inactive">Configure</button>
                                            <button class="btn btn-primary inactive">Revoke</button>            
                                            <a class="btn btn-primary active" id="awbcbtn" href="/aweberauth">Connect</a>
                                            <button class="btn btn-primary inactive" id="awbc" data-toggle="modal" data-target="#aweberconnect">Connect</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- https://hooks.zapier.com/hooks/catch/3402502/anfj45/?name=vipin&email=vipin-gmail.com&phone=9898778774 --> 
                        <div class="col-md-6 col-xs-12 col-sm-6" style="cursor:pointer">
                            <div class="white-box">
                                <div class="bar-widget">
                                    <div class="info_button pull-right"><span class="tooltip1" title="This is my image's tooltip message!"><i class="fa fa-info-circle"></i></span></div>
                                    <div class="table-box">
                                        <div class="table-detail text-center">
                                            <div class="big-icons"><img src="<?php echo e(url('images/Zapier_logo.png')); ?>"></div>
                                            <button class="btn btn-primary inactive">Configure</button>
                                            <button class="btn btn-primary inactive">Revoke</button>            
                                            <button class="btn btn-primary active">Connect</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-xs-12 col-sm-6" style="cursor:pointer">
                            <div class="white-box">
                                <div class="bar-widget">
                                    <div class="info_button pull-right"><span class="tooltip1" title="This is my image's tooltip message!"><i class="fa fa-info-circle"></i></span></div>
                                    <div class="table-box">
                                        <div class="table-detail text-center">
                                            <div class="big-icons"><img src="<?php echo e(url('images/gotowebinar_logo.png')); ?>"></div>
                                            <button class="btn btn-primary inactive">Configure</button>
                                            <button class="btn btn-primary inactive">Revoke</button>            
                                            <button class="btn btn-primary active">Connect</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-xs-12 col-sm-6" style="cursor:pointer">
                            <div class="white-box">
                                <div class="bar-widget">
                                    <div class="info_button pull-right"><span class="tooltip1" title="This is my image's tooltip message!"><i class="fa fa-info-circle"></i></span></div>
                                    <div class="table-box">
                                        <div class="table-detail text-center">
                                            <div class="big-icons"><img src="<?php echo e(url('images/drip_logo.png')); ?>"></div>
                                            <button class="btn btn-primary inactive">Configure</button>
                                            <button class="btn btn-primary inactive">Revoke</button>            
                                            <button class="btn btn-primary active">Connect</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        </div>
    </div>

<div class="modal fade cancelModal" id="aweberconnect" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button aria-hidden="true" data-dismiss="modal" class="close" type="button">&times;</button>
            </div>
            <?php echo e(csrf_field()); ?>

            <form method="post" id="aweberconnectform" action="">
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12 col-xs-12 col-sm-12">
                        <div class="row">
                            <div class="form-group opt" data-show="opt2">
                                <div class="col-md-2">
                                    <label>Consumer Key</label>
                                </div>
                                <div class="col-md-10">
                                    <input class="form-control" name="key" id="key" required="required">
                                </div>
                            </div>
                            <div class="form-group opt" data-show="opt2">
                                <div class="col-md-2">
                                    <label>Consumer Key</label>
                                </div>
                                <div class="col-md-10">
                                    <input class="form-control" name="key" id="key" required="required">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="alertmsg alert alert-danger" id="t2s_err"></div>
                    <button type="submit" class="btn btn-primary">Save</button>                            
                </div>
            </div>
            </form>
        </div>
    </div>
</div>
<script type="text/javascript">
    <?php 
if(isset($_GET['pop']) && $_GET['pop']=='aweber'){

?>
$('#aweberconnect').modal('toggle');

alert('');
    
<?php
    }
    ?>

</script>

</div>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.website', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>