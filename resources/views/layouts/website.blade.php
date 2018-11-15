<!DOCTYPE html>
<html lang="en">
  <head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
	<meta name="description" content="">
	<meta name="author" content="">
    <title>OptinSound</title>
	<link rel="icon" type="image/png" sizes="16x16" href="{{ url('/images/optinsound-fav.png') }}">

    <link href="{{ url('/css/style.default.css') }}" rel="stylesheet">
    <link href="{{ url('/css/style.print.css') }}" rel="stylesheet">
    <link href="{{ url('/css/jquery.tagsinput.css') }}" rel="stylesheet">
    <!-- <link href="{{ url('/css/select2.css') }}" rel="stylesheet"> -->
	<link href="{{ url('/css/dataTables.bootstrap.css') }}" rel="stylesheet" type="text/css">
    <script src="{{ url('/js/jquery-1.11.1.min.js') }}"></script>
    <!-- <script src="{{ url('/js/jquery.min.js') }}"></script> -->
    <link href="{{ url('/datepicker/bootstrap-datepicker3.min.css') }}" rel="stylesheet"/>
    <script src="{{ url('/datepicker/bootstrap-datepicker.min.js') }}"></script>
    <link href="{{ url('/timepicker/bootstrap-clockpicker.css') }}" rel="stylesheet">
    <script src="{{ url('/timepicker/bootstrap-clockpicker.js') }}"></script>
    <link href="{{ url('/css/fancybox/jquery.fancybox.css') }}" rel="stylesheet">
	
    
    <link href="{{ url('/css/fullcalendar.css') }}" rel="stylesheet">
    <link href="{{ url('/css/bootstrap-select.min.css') }}" rel="stylesheet">
    <link href="{{ url('/css/tooltipster.bundle.min.css') }}" rel="stylesheet">
    <script src="{{ url('/js/bootstrap-colorpicker.js') }}"></script>
	<link href="{{ url('/css/bootstrap-colorpicker.css') }}" rel="stylesheet">
	
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
                <a style="color: #fff;font-size: 18px; margin-top: 2px" href="{{ url('/') }}" class="logo">
                    <img class="logo" src="{{ url('/') }}/images/optinsound-logo.png">
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
						<?php if(Auth::user()->image != ''){ ?>
						<img class="img-circle" src="{{ url('/uploads/'.Auth::user()->image) }}" alt="">
						<?php } else{?>
						<img class="img-circle" src="{{ url('/images/default_thumb.png') }}" alt="">
						<?php }?>
                        </button>
                        <ul class="dropdown-menu pull-right">
                          <li><a href="{{ url('/editprofile') }}"><i class="glyphicon glyphicon-user"></i> Edit Profile</a></li>
                          <li><a href="{{ url('/changepassword') }}"><i class="glyphicon glyphicon-cog"></i> Change Password</a></li>
                          <li class="divider"></li>
                          <li><a href="{{ url('/logout') }}"><i class="glyphicon glyphicon-log-out"></i>Log Out</a></li>
                        </ul>
                    </div>
                </div>
				<div class="pull-right">
					<div class="media-body">
						<h4 class="media-heading">{{Auth::user()->name}}</h4>
						<small class="text-muted">Administrator</small>
					</div>
                </div>
            </div>
        </div>
    </header>
    <section>
      <div class="mainwrapper">
        <div class="leftpanel">
			<ul class="nav nav-pills nav-stacked" id="navMenus">
                <li><a href="{{ url('') }}"><i class="fa fa-home"></i> <span>Dashboard</span></a></li>           
                <?php if(Auth::user()->userlevel==10){?>

                <li class="parent"><a href=""><i class="fa fa-info"></i> <span>Masters</span></a>
                    <ul class="children">
                        <li><a href="{{ url('/donesound') }}">Done Sounds</a></li>
                        <li><a href="{{ url('/country') }}">Countries</a></li>
                        <li><a href="{{ url('/language') }}">Languages</a></li>
                        <li><a href="{{ url('/niche') }}">Niche Category</a></li>
                        <li><a href="{{ url('/trafficsource') }}">Traffic Source</a></li>
                        <li><a href="{{ url('/uploadfile') }}">Done for you Sounds</a></li>
                        <li><a href="{{ url('/userlevel') }}">User Levels</a></li>
                        <li><a href="{{ url('/users') }}">Users Management</a></li>
                    </ul>
                </li>
                <?php } ?>
                <?php if(Auth::user()->userlevel==4 || Auth::user()->userlevel==5){?>
                <li><a href="{{ url('/domain') }}"><i class="fa fa-globe"></i><span>Users Management</span></a></li> 
                <?php } ?>
                <li><a href="{{ url('/domain') }}"><i class="fa fa-globe"></i><span>Domains</span></a></li>           
                <!-- <li class="parent parent-focus"><a href="{{ url('/campaign') }}"><i class="fa fa-calendar"></i> <span>Campaigns</span></a> 
                    <ul class="children">
                        <li><a href="{{ url('/campaign') }}"><i class="fa fa-bullhorn"></i> <span>All Campaigns</span></a></li>
                        <li><a href="{{ url('/campaign/add') }}"><i class="fa fa-plus"></i> <span>Add Campaign</span></a></li>
                    </ul>    
                </li> -->
                <li><a href="{{ url('/campaign') }}"><i class="fa fa-volume-up"></i> <span>Campaigns</span></a></li>
                <li><a href="{{ url('/integration') }}"><i class="fa fa-share"></i> <span>Integrations</span></a></li>
                <li><a href="{{ url('/records') }}"><i class="fa fa-database"></i> <span>Optin Records</span></a></li>
                <li><a href="{{ url('/oc') }}"><i class="fa fa-map-marker"></i> <span>Overlay</span></a></li>
                <?php if(Auth::user()->userlevel>=2 ){?>

                <!-- <li><a href="{{ url('/campaign') }}"><i class="fa fa-map-marker"></i> <span>Geolocation</span></a></li> -->
                <!-- <li><a href="{{ url('/campaign') }}"><i class="fa fa-mobile"></i> <span>Mobile Vibration</span></a></li> -->
                <!-- <li><a href="{{ url('/campaign') }}"><i class="fa fa-mail-reply"></i> <span>Back Button Redirection</span></a></li> -->
                <!-- <li><a href="{{ url('/campaign') }}"><i class="fa fa-rocket"></i> <span>Tab Favicon</span></a></li> -->
                <?php } ?>
                <?php if(Auth::user()->userlevel>=3 ){?>

                <!-- <li><a href="{{ url('/oc') }}"><i class="fa fa-map-marker"></i> <span>Overlay</span></a></li> -->
                <!-- <li><a href="{{ url('/campaign') }}"><i class="fa fa-mobile"></i> <span>Mobile Vibration</span></a></li> -->
                <!-- <li><a href="{{ url('/campaign') }}"><i class="fa fa-mail-reply"></i> <span>Back Button Redirection</span></a></li> -->
                <!-- <li><a href="{{ url('/campaign') }}"><i class="fa fa-rocket"></i> <span>Tab Favicon</span></a></li> -->
                <?php } ?>

                <li><a href="{{ url('/campaign') }}"><i class="fa fa-comment"></i> <span>Support</span></a></li>
            </ul>    
        </div>
        <div class="mainpanel">
        @yield('content')
        </div>
      </div>
    </section>
<style type="text/css">
body{position: relative;height: 100%;}
.loader {
    border: 3px solid #f3f3f3; /* Light grey */
    border-top: 3px solid #3498db; /* Blue */
    border-radius: 50%;
    width: 40px;
    height: 40px;
    animation: spin 1.2s linear infinite;
    top: 45%;
    display: inline-block;
    position: fixed;
}

@keyframes spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
}

.loader-bg {
    background: #333 none repeat scroll 0 0;
    height: 100%;
    left: 0;
    opacity: 0.7;
    position: fixed;
    right: 0;
    top: 0;
    width: 100%;
    z-index: 99999;
    text-align: center;
    display: none;
}
</style>    
    <div class="loader-bg">
    <div class="loader"></div>
    </div>
    <script src="{{ url('/js/bootstrap.min.js') }}"></script>
    <script src="{{ url('/js/custom.js') }}"></script>
    <script src="{{ url('/js/jquery.dataTables.min.js') }}"></script>
	<script src="{{ url('/js/dataTables.bootstrap.min.js') }}"></script>
	<script src="{{ url('/js/jquery.tagsinput.min.js') }}"></script>
	<script src="{{ url('/js/fancybox/jquery.fancybox.js') }}"></script>
	<script src="{{ url('/js/bootstrap-wizard.min.js') }}"></script>
	<script src="{{ url('/js/jquery.validate.min.js') }}"></script>
	<script src="{{ url('/js/moment.min.js') }}"></script>
    <script src="{{ url('/js/fullcalendar.js') }}"></script>
    <script src="{{ url('/js/bootstrap-select.min.js') }}"></script>
	<script src="{{ url('/js/tooltipster.bundle.min.js') }}"></script>
	<script type="text/javascript">
	</script>
<script type="text/javascript">
    $('#playservice').click(function() {
    var audio = document.getElementById("soundpreview");

    //var audio=$('#soundpreview');
    if(audio.paused == false) {
        audio.pause();
        alert('music paused');
    } else {
        audio.play();
        alert('music playing');
    }
    });
</script>
<script type="text/javascript">
    $(document).ready(function() {
            $('.tooltip1').tooltipster({
                side:'right'
            });
        });
</script>

    </body>
</html>