<?php $__env->startSection('content'); ?>
    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row bg-title">
                <div class="col-lg-12">
                    <h4 class="page-title">User</h4>
                    <ol class="breadcrumb">
                        <li><a href="<?php echo e(url('/users')); ?>">Home</a></li>
                        <li><a href="/users/list">User</a></li>
                        <li class="active">Add</li>
                    </ol>
                </div>
                <!-- /.col-lg-12 -->
            </div>

            <!-- row -->
            <div class="row">
                <div class=" col-md-offset-2 col-md-8 col-xs-12">
                    <div class="white-box">
                        <div class="tab-content">
                            <div class="tab-pane active" id="profile">
                                <form class="form-horizontal" method="POST" action="/users/save" enctype="multipart/form-data">
                                    <?php echo e(csrf_field()); ?>

                                    <div class="form-group <?php echo e($errors->has('name') ? 'has-error' : ''); ?>">
                                        <label class="col-md-12">Full Name</label>
                                        <div class="col-md-12">
                                            <input type="text" class="form-control form-control-line" value="" name="name">
                                            <?php if($errors->has('name')): ?>
                                            <span class="help-block">
                                                    <strong><?php echo e($errors->first('name')); ?></strong>
                                                </span>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <div class="form-group <?php echo e($errors->has('email') ? 'has-error' : ''); ?>">
                                        <label class="col-md-12">Email</label>
                                        <div class="col-md-12">
                                            <input type="email" name="email" class="form-control form-control-line" value="">
                                            <?php if($errors->has('email')): ?>
                                            <span class="help-block">
                                                    <strong><?php echo e($errors->first('email')); ?></strong>
                                                </span>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-12">User Level</label>
                                        <div class="col-md-12">
                                            <select class="form-control form-control-line" name="userlevel">
                                                <?php if(Auth::user()->isRoot()): ?>
                                                    <option value="1">Basic</option>
                                                    <option value="2">Advanced</option>
                                                    <option value="3">Extreme</option>
                                                    <option value="4">Unlimited 100</option>
                                                    <option value="5">Unlimited 250</option>
                                                <?php endif; ?>

                                                <?php if(Auth::user()->isLevel4()): ?>
                                                    <option value="1">Basic</option>
                                                    <option value="2">Advanced</option>
                                                    <option value="3">Extreme</option>
                                                <?php endif; ?>
                                                <?php if(Auth::user()->isLevel5()): ?>
                                                    <option value="1">Basic</option>
                                                    <option value="2">Advanced</option>
                                                    <option value="3">Extreme</option>
                                                <?php endif; ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group <?php echo e($errors->has('password') ? 'has-error' : ''); ?>">
                                        <label class="col-md-12">Password</label>
                                        <div class="col-md-12">
                                            <input type="password" class="form-control form-control-line" value="" name="password">
                                            <?php if($errors->has('password')): ?>
                                            <span class="help-block">
                                                    <strong><?php echo e($errors->first('password')); ?></strong>
                                                </span>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-12">Confirm Password</label>
                                        <div class="col-md-12">
                                            <input type="password" class="form-control form-control-line" value="" name="password_confirmation">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-12">
                                            <button class="btn btn-primary">Add User</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- /#page-wrapper -->
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.website', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>