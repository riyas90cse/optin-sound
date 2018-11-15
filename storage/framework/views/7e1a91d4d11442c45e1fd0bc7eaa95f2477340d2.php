<?php $__env->startSection('content'); ?>
    <!-- Page Content -->
    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row bg-title">
                <div class="col-lg-12">
                    <h4 class="page-title">Users</h4>
                    <ol class="breadcrumb">
                        <li><a href="/">Home</a></li>
                        <li class="active">Users</li>
                    </ol>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- row -->

            <div class="row">
                <div class="col-sm-12">
                    <div class="white-box">
                        <a href="/users/create" id="addNew" class="btn btn-default" style="float:right">Add New</a>
                        <h3>Users</h3>
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Parent</th>
                                    <th>Active</th>
                                    <th>Role</th>
                                    <th class="text-nowrap">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                                <tr>
                                    <td><?php echo e($user->name); ?></td>
                                    <td><?php echo e($user->email); ?></td>
                                    <td>
                                        <?php $__currentLoopData = DB::table('users')->where('id', '=', $user->id)->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $id): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                                        <?php echo e($id->name); ?>

                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
                                    </td>
                                    <td>
                                        <form method="POST" id="status<?php echo e($user->id); ?>" action="/users/edit/<?php echo e($user->id); ?>">
                                            <?php echo e(csrf_field()); ?>

                                            <input id="<?php echo e($user->id); ?>" name="active" type="checkbox" <?php echo e($user->status ? 'checked' : ''); ?> class="js-switch status" data-color="#99d683" data-secondary-color="#f96262"/>
                                        </form>
                                    </td>
                                    <td>
                                        <?php echo e(Auth::user()->hasRole($user->id)); ?>

                                    </td>
                                    <td class="text-nowrap">
                                        <a href="/users/edit/<?php echo e($user->id); ?>" data-toggle="tooltip" data-original-title="Edit">
                                            <i class="fa fa-pencil text-inverse m-r-10"></i>
                                        </a>

                                        <a href="/users/reset/<?php echo e($user->id); ?>" data-toggle="tooltip" data-original-title="Reset Password">
                                            <i class="fa fa-key text-inverse m-r-10"></i>
                                        </a>

                                        <?php if($user->deleted_at): ?>
                                        <a class="restore" id="<?php echo e($user->id); ?>" data-toggle="tooltip" data-original-title="Restore">
                                            <i class="fa fa-close text-success"></i>
                                        </a>
                                        <?php else: ?>
                                        <a class="delete" id="<?php echo e($user->id); ?>" data-toggle="tooltip" data-original-title="Delete">
                                            <i class="fa fa-close text-danger"></i>
                                        </a>
                                        <?php endif; ?>

                                        <?php if(Auth::user()->isRoot()): ?>
                                        <a class="pdelete" id="<?php echo e($user->id); ?>" data-toggle="tooltip" data-original-title="Permanent Delete">
                                            <i class="fa fa-trash text-danger"></i>
                                        </a>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </div>
<script src="/bower_components/switchery/dist/switchery.min.js"></script>
<script>
    $(document).ready(function() {
        $('.status').change(function() {
            var this_ref = this;
            $.confirm({
                title: 'Warning!',
                content: 'Are you sure you want to change status?',
                buttons: {
                    confirm: function () {
                        document.getElementById('status'+$(this).attr('id')).submit();
                        // window.location = '<?php echo e(URL::to("/users/status/")); ?>/'+$(this_ref).attr('id');
                    },
                    cancel: function () {
                        //$.alert('Canceled!');
                    }
                }
            });
        });
        $('.delete').click(function() {
            var this_ref = this;
            $.confirm({
                title: 'Warning!',
                content: 'Are you sure you want to delete?',
                buttons: {
                    confirm: function () {
                        window.location = '<?php echo e(URL::to("/users/delete/")); ?>/'+$(this_ref).attr('id');
                    },
                    cancel: function () {
                        //$.alert('Canceled!');
                    }
                }
            });
        });
        $('.restore').click(function() {
            var this_ref = this;
            $.confirm({
                title: 'Warning!',
                content: 'Are you sure you want to restore?',
                buttons: {
                    confirm: function () {
                        window.location = '<?php echo e(URL::to("/users/restore/")); ?>/'+$(this_ref).attr('id');
                    },
                    cancel: function () {
                        //$.alert('Canceled!');
                    }
                }
            });
        });

        $('.delete').click(function() {
            var this_ref = this;
            $.confirm({
                title: 'Warning!',
                content: 'Are you sure you want to permanently delete user? <br /> This will delete all user content as well',
                buttons: {
                    confirm: function () {
                        window.location = '<?php echo e(URL::to("/users/destroy/")); ?>/'+$(this_ref).attr('id');
                    },
                    cancel: function () {
                        //$.alert('Canceled!');
                    }
                }
            });
        });
    });
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.website', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>