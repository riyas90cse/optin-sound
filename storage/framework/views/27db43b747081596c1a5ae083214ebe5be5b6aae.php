<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>hawai iceland</title>
  <link rel="shortcut icon" href="https://cdn.letspin.io/global/images/favicon.png">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
  <meta name="description" content="Here we have new adventure trips for you. We always welcome your request for customization.">
  <meta property="og:title" content="hawai iceland" />
  <meta property="og:description" content="Here we have new adventure trips for you. We always welcome your request for customization." />
    <meta property="og:image" content="http://cdn.letspin.io/images/scamps/d2499af921eea741064e299079484eeb.jpg" />
  <meta property="og:image:width" content="1218" />
  <meta property="og:image:height" content="630" />
  <!--twitter-->
  <meta name="twitter:card" content="summary_large_image">
  <meta name="twitter:title" content="hawai iceland">
  <meta name="twitter:description" content="Here we have new adventure trips for you. We always welcome your request for customization.">
    <meta name="twitter:image:src" content="http://cdn.letspin.io/images/scamps/d2499af921eea741064e299079484eeb.jpg">
      <meta name="twitter:url" content="http://jackjack.letspiniowin.com/5b2a86e95f28a">
  <meta name="twitter:domain" content="letspin.io">
<!-- <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=9" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0,maximum-scale=1,user-scalable=no">
	<title><?php echo e($campaign->meta_title); ?></title>
	<link rel="shortcut icon" href="<?php echo e(url('/')); ?>/images/favicon.png">
	<meta name="description" content="<?php echo e($campaign->meta_description); ?>"> -->
	<!--facebook meta-->
<!-- 	<meta property="og:title" content="<?php echo e($campaign->meta_title); ?>" />
	<meta property="og:description" content="<?php echo e($campaign->meta_description); ?>" />
	<meta property="og:image" content="<?php echo e($campaign->meta_image); ?>" /> -->
	
	<!--twitter meta-->
<!-- 	<meta name="twitter:card" content="summary_large_image">
	<meta name="twitter:title" content="<?php echo e($campaign->meta_title); ?>">
	<meta name="twitter:description" content="<?php echo e($campaign->meta_description); ?>">
	<meta name="twitter:image:src" content="<?php echo e($campaign->meta_image); ?>">
	<meta name="twitter:url" content="<?php echo e($campaign->custom_link); ?>">
	<meta name="twitter:domain" content="<?php echo e(url('/')); ?>">
	<script src="<?php echo e(url('/')); ?>/uploads/campaign/<?php echo e($campaign_data->script_name); ?>.js"></script> -->
	<link href="https://fonts.googleapis.com/css?family=Karla|Lato|Lora|Oswald|Roboto" rel="stylesheet"> 
	<style>
	body{
		

    font-family: 'Karla', sans-serif;
/*
    font-family: 'Lato', sans-serif;

    font-family: 'Lora', serif;

    font-family: 'Roboto', sans-serif;

    font-family: 'Oswald', sans-serif;*/

 
	}
	.overlay-container{
	    position: fixed;
	    left:0;
	    top:0;
	    height:100%;
	    width:100%;
	    -webkit-overflow-scrolling: touch;
	    overflow-y: scroll;
	}
	#overlayframe{
	    top:0;
	    left:0;
	    width: 100%;
	    height:100%;
	}
	</style>
<script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>
</head>
<body>
    <div class="overlay-container">
        <iframe id="overlayframe" src="<?php echo e($campaign->overlay_siteurl); ?>"></iframe>
    </div>

	<div class="modal-body">
		<p class="opt-title center">Overlay Link Created Successfully! <span class="tooltip1 tooltipstered"><i class="fa fa-info-circle"></i></span></p>

		<p class="center">
			<a href="http://app.optinsound.com/hubspot" class="overlaylink" target="_blank" style="font-weight: bold;">http://app.optinsound.com/hubspot</a>
			<a href="#" class="copybutton" data-copy=""><i class="fa fa-copy"></i></a>
		</p>
		<p class="center">
		<a href="#" class="shareCampaign btn btn-primary" data-sharelink="http://app.optinsound.com/overlay/hubspot" data-handle="hubspot" data-sharenetwork="facebook"><i class="fa fa-facebook-square"></i> Share on Facebook</a>
		</p>
		<p class="center">
		<a href="#" class="shareCampaign btn btn-primary" data-sharelink="http://app.optinsound.com/hubspot" data-handle="" data-sharenetwork="twitter"><i class="fa fa-twitter-square"></i> Share on Twitter</a> 
		</p>

		<p class="center">
		<a href="#" class="shareCampaign btn btn-primary" data-sharelink="http://app.optinsound.com/hubspot" data-handle="" data-sharenetwork="gplus"><i class="fa fa-google-plus-square"></i> Share on Google Plus</a> 
		</p>
		
		<p class="center">
		<a href="#" class="shareCampaign btn btn-primary" data-sharelink="http://app.optinsound.com/hubspot" data-handle="" data-sharenetwork="linkedin"><i class="fa fa-linkedin-square"></i> Share on LinkedIn</a> 
		</p>
		<p class="center">
		<a href="#" class="shareCampaign btn btn-primary" data-sharelink="http://app.optinsound.com/hubspot" data-handle="" data-sharenetwork="pinterest"><i class="fa fa-pinterest-square"></i> Share on Pinterest</a>
		</p>
</div>

    <?php echo e($campaign->remarketing_pixels); ?>

    <script type="text/javascript">
    	
jQuery("body").on('click', '.shareCampaign', function() {
    var url = $(this).attr("data-sharelink");
    var networks = {
		facebook: "https://www.facebook.com/sharer/sharer.php?u=",
		twitter: "https://twitter.com/intent/tweet?text=",
		gplus: "https://plus.google.com/share?url=",
		linkedin: "https://www.linkedin.com/cws/share?url=",
		pinterest: "https://pinterest.com/pin/create/button/?description=&media=&url="
    }
	var networkURL = networks[$(this).data("sharenetwork")];
	window.open(networkURL+encodeURIComponent(url), '','menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=300,width=600');
	return false;
});

    </script>
</body>
</html>

