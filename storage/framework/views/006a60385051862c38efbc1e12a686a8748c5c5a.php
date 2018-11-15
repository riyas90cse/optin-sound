<!DOCTYPE html>
<html lang="en">
  <head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
	<meta name="description" content="">
	<meta name="author" content="">
    <title>School Time Table</title>
    <link href="<?php echo e(url('/css/style.default.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(url('/css/style.print.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(url('/css/jquery.tagsinput.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(url('/css/select2.css')); ?>" rel="stylesheet">
	<link href="<?php echo e(url('/css/dataTables.bootstrap.css')); ?>" rel="stylesheet" type="text/css">
	<script src="<?php echo e(url('/js/jquery-1.11.1.min.js')); ?>"></script>
	<link href="<?php echo e(url('/datepicker/bootstrap-datepicker3.min.css')); ?>" rel="stylesheet"/>
	<script src="<?php echo e(url('/datepicker/bootstrap-datepicker.min.js')); ?>"></script>
	<link href="<?php echo e(url('/timepicker/bootstrap-clockpicker.css')); ?>" rel="stylesheet">
	<script src="<?php echo e(url('/timepicker/bootstrap-clockpicker.js')); ?>"></script>
	<link href="<?php echo e(url('/css/fancybox/jquery.fancybox.css')); ?>" rel="stylesheet">
	
	<link href="<?php echo e(url('/css/fullcalendar.css')); ?>" rel="stylesheet">
	
    <style>
    	footer{
			position: relative;
			width: 100%;
			bottom: 0;
			background: #fff;
			padding: 15px;
			text-align: center;
			border-top: 1px solid #eee;
		}
		.footer{
			margin: 0px;
			line-height: 32px;
		}
		td,th{
			vertical-align: middle !important;
		text-align: center;
		}
		.badge{
			margin-bottom: 3px;
		}
    </style>
    </head>
    <body> 
    <header>
        <div class="headerwrapper">
            <div class="header-left">
                <a style="color: #fff;font-size: 18px; margin-top: 2px" href="<?php echo e(url('/')); ?>" class="logo">
                    Admin Panel
                </a>
                <div class="pull-right">
                    <a href="" class="menu-collapse">
                        <i style="font-size: 17px;" class="fa fa-bars"></i>
                    </a>
                </div>
            </div>
            <div class="header-right">
                <div class="pull-right">
                    <div class="btn-group btn-group-option">
                        <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                          <i class="fa fa-user"></i>
                        </button>
                        <ul class="dropdown-menu pull-right">
                          <li><a href="<?php echo e(url('/editprofile')); ?>"><i class="glyphicon glyphicon-user"></i> Edit Profile</a></li>
                          <li><a href="<?php echo e(url('/changepassword')); ?>"><i class="glyphicon glyphicon-cog"></i> Change Password</a></li>
                          <li class="divider"></li>
                          <li><a href="<?php echo e(url('/logout')); ?>"><i class="glyphicon glyphicon-log-out"></i>Log Out</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </header>

    11600/-

    <section>
      <div class="mainwrapper">
        <div class="leftpanel">
            <div class="media profile-left">
                <a onclick="return false;" class="pull-left profile-thumb" href="" style="cursor: default;">
                    <?php if(Auth::user()->image != ''){ ?>
                    <img class="img-circle" src="<?php echo e(url('/uploads/'.Auth::user()->image)); ?>" alt="">
                    <?php } else{?>
                    <img class="img-circle" src="<?php echo e(url('/images/default_thumb.png')); ?>" alt="">
                    <?php }?>
                </a>
                <div class="media-body">
                    <h4 class="media-heading"><?php echo e(Auth::user()->name); ?></h4>
                    <small class="text-muted">Administrator</small>
                </div>
            </div>    
            <ul class="nav nav-pills nav-stacked" id="navMenus">
                <li><a href="<?php echo e(url('')); ?>"><i class="fa fa-home"></i> <span>Dashboard</span></a></li>
                <!--<li class="parent"><a href=""><i class="fa fa-share"></i> <span>Sale</span></a>
                    <ul class="children">
                        <li><a href="<?php echo e(url('/sale-register')); ?>">Sale Register</a></li>
                        <li><a href="<?php echo e(url('/sale-return')); ?>">Sale Return</a></li>
                    </ul>
                </li>
                <li class="parent"><a href=""><i class="fa fa-reply"></i> <span>Purchase</span></a>
                    <ul class="children">
                        <li><a href="<?php echo e(url('/purchase-register')); ?>">Purchase Register</a></li>
                        <li><a href="<?php echo e(url('/purchase-return')); ?>">Purchase Return</a></li>
                    </ul>
                </li>
                <li class="parent"><a href=""><i class="fa fa-money"></i> <span>Accounts</span></a>
                    <ul class="children">
                        <li><a href="<?php echo e(url('/clientaccount')); ?>">Client's A/C</a></li>
                        <li><a href="<?php echo e(url('/vendoraccount')); ?>">Vendor's A/C</a></li>
                    </ul>
                </li>-->
                <li class="parent"><a href=""><i class="fa fa-info"></i> <span>Masters</span></a>
                    <ul class="children">
<!--                         <li><a href="<?php echo e(url('/accounthead')); ?>">Account Head</a></li>
                        <li><a href="<?php echo e(url('/bank')); ?>">Bank</a></li>
                        <li><a href="<?php echo e(url('/contractor')); ?>">Contractor</a></li>
                        <li><a href="<?php echo e(url('/facility')); ?>">Facility</a></li>
                        <li><a href="<?php echo e(url('/facilitytype')); ?>">Facility Type</a></li>
                        <li><a href="<?php echo e(url('/member')); ?>">Member</a></li>
                        <li><a href="<?php echo e(url('/membertype')); ?>">Member Type</a></li> -->
                        <li><a href="<?php echo e(url('/class')); ?>">Classes</a></li>
                        <li><a href="<?php echo e(url('/section')); ?>">Sections</a></li>
                        <li><a href="<?php echo e(url('/class-section-combination')); ?>">Class Section Combinations</a></li>
                        <li><a href="<?php echo e(url('/class-section-stream')); ?>">Class Stream Combinations</a></li>
                        <li><a href="<?php echo e(url('/weeklycount')); ?>">Weekly Period Count Settings</a></li>
                        <li><a href="<?php echo e(url('/period')); ?>">Period Timing</a></li>
                        <li><a href="<?php echo e(url('/stream')); ?>">Streams</a></li>
                        <li><a href="<?php echo e(url('/subject')); ?>">Subjects</a></li>
                        <li><a href="<?php echo e(url('/role')); ?>">Roles</a></li>
                        <li><a href="<?php echo e(url('/teacher')); ?>">Teachers</a></li>
                    </ul>
                </li>
                <!-- <li><a href="<?php echo e(url('/booking')); ?>"><i class="fa fa-book"></i> <span>Time Table</span></a></li> -->
<!--                 <li class="parent"><a href="<?php echo e(url('/receipt')); ?>"><i class="fa fa-file-text-o"></i> <span>Receipt</span></a>
                    <ul class="children">
                    	<li><a href="<?php echo e(url('/receipt')); ?>">All Receipts</a></li>
                    	<li><a href="<?php echo e(url('/receipt-tentage')); ?>">Tentage &amp; Catering Receipts</a></li>
                    	<li><a href="<?php echo e(url('/receipt-others')); ?>">Other Receipts</a></li>
                        <li><a href="<?php echo e(url('/receipt-stl')); ?>">Service Tax Liability</a></li>
                    </ul>
                </li> -->
                 <li class="parent"><a href="<?php echo e(url('/timetable')); ?>"><i class="fa fa-file-text-o"></i> <span>Timetable</span></a>
                    <ul class="children">
                        <li><a href="<?php echo e(url('/timetable')); ?>">List Time Tables</a></li>
                        <li><a href="<?php echo e(url('/timetable-list')); ?>">Create Time Tables</a></li>
                    </ul>
                </li>
                <li><a href="<?php echo e(url('/calendar')); ?>"><i class="fa fa-calendar"></i> <span>Time Table Calender</span></a></li>
<!--                 <li class="parent"><a href=""><i class="fa fa-file-excel-o"></i> <span>Voucher</span></a>
                    <ul class="children">
                        <li><a href="<?php echo e(url('/refund-voucher')); ?>">Refund Voucher</a></li>
                        <li><a href="<?php echo e(url('/debit-voucher')); ?>">Debit Voucher</a></li>
                    </ul>
                </li> -->
<!--                 <li class="parent"><a href=""><i class="fa fa-file-word-o"></i> <span>Reports</span></a>
                    <ul class="children" style="margin-bottom: 20px">
                    	<li><a href="<?php echo e(url('/securityamount-register')); ?>">Security Amount Register</a></li>
                        <li><a href="<?php echo e(url('/servicetax-register')); ?>">Service Tax Register</a></li>
                        <li><a href="<?php echo e(url('/tentage-register')); ?>">Tentage Register</a></li>
                        <li><a href="<?php echo e(url('/catering-register')); ?>">Catering Register</a></li>
                        <li><a href="<?php echo e(url('/booking-details')); ?>">Booking Details Report</a></li>
                        <li><a href="<?php echo e(url('/memberlist-report')); ?>">Member List Report</a></li>
                        <li><a href="<?php echo e(url('/booking-register')); ?>">Booking Register</a></li>
                        <li><a href="<?php echo e(url('/booking-cancellation')); ?>">Booking Cancellation</a></li>
                        <li><a href="<?php echo e(url('/rebate-register')); ?>">Rebate Register</a></li>
                        <li><a href="<?php echo e(url('/vat-register')); ?>">Vat Register</a></li>
                    </ul>
                </li> -->
            </ul>    
        </div>
        <div class="mainpanel">
        <?php echo $__env->yieldContent('content'); ?>
        </div>
      </div>
    </section>
    <script src="<?php echo e(url('/js/bootstrap.min.js')); ?>"></script>
    <script src="<?php echo e(url('/js/custom.js')); ?>"></script>
    <script src="<?php echo e(url('/js/jquery.dataTables.min.js')); ?>"></script>
	<script src="<?php echo e(url('/js/dataTables.bootstrap.min.js')); ?>"></script>
	<script src="<?php echo e(url('/js/jquery.tagsinput.min.js')); ?>"></script>
	<script src="<?php echo e(url('/js/select2.min.js')); ?>"></script>
	<script src="<?php echo e(url('/js/fancybox/jquery.fancybox.js')); ?>"></script>
	<script src="<?php echo e(url('/js/bootstrap-wizard.min.js')); ?>"></script>
	<script src="<?php echo e(url('/js/jquery.validate.min.js')); ?>"></script>
	<script src="<?php echo e(url('/js/moment.min.js')); ?>"></script>
	<script src="<?php echo e(url('/js/fullcalendar.js')); ?>"></script>
	<script type="text/javascript">
	$(document).ready(function() {
	  $(".multiple-select").select2();
	});
	</script>
    </body>
</html>