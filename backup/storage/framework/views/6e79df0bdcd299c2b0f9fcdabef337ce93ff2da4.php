<?php $__env->startSection('content'); ?>
<div class="pageheader">
	<div class="media">
		<div class="media-body">
			<h4>Add Campaign</h4>
			<ul class="breadcrumb">
				<li><a href="<?php echo e(url('/')); ?>"><i class="glyphicon glyphicon-home"></i></a></li>
				<li>Campaign</li>
				<li>Add</li>
			</ul>
		</div>
	</div>
</div>
<div class="contentpanel">
	<div id="page-wrapper">       
		<div class="row">
			<div class="col-md-12">
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

				<form method="post" action="<?php echo e(url('campaign/save')); ?>" id="valWizard" class="panel-wizard">
					<?php echo e(csrf_field()); ?>

					<div class="form-group">
						<div class="col-md-5">
							<label>Select Domain:</label>
						</div>
						<div class="col-md-7">
							<select class="form-control selectpicker" name="domain_name" id="domain" required="">
								<?php $__currentLoopData = $domain; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
								<option  value="<?php echo e($value->id); ?>"><?php echo e($value->domain_name); ?></option>
								<?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
							</select>
						</div>
					</div>


					<ul class="nav nav-justified nav-wizard nav-disabled-click">
						<li><a href="#tab1-4" data-toggle="tab"><strong>Step 1:</strong> Select Sound</a></li>
						<li><a href="#tab2-4" data-toggle="tab"><strong>Step 2:</strong> Configure Options</a></li>
						<li><a href="#tab3-4" data-toggle="tab"><strong>Step 3:</strong> Add the code to landing page</a></li>
					</ul>
					<div class="tab-content grey-bg">
						<div class="tab-pane" id="tab1-4">
							<div class="col-md-12">
								<div class="form-group">
									<label>*Choose Campaign Type:</label>
								</div>
								<div class="form-group radio_options">

									<div class="col-md-4">
										<label>Done for you templates</label>
										<input type="radio" class="campaign_type" id="opt1" name="campaign_type" value="doneforyou">					    	
									</div>
									<div class="col-md-4">
										<label>Text to speech</label>
										<input type="radio" class="campaign_type" id="opt2" name="campaign_type" value="texttospeech">					    						    	
									</div>
									<div class="col-md-4">
										<label>Custom Sound Upload</label>
										<input type="radio" class="campaign_type" id="opt3" name="campaign_type" value="customsound">					    						    	
									</div>
								</div>
							</div>
<?php 
// print_r($country);
// print_r($campaigns);
// print_r($language);
// print_r($niche);
// print_r($trafficsource);
// print_r($soundniche);
?>		

<!-- 
				<?php $__currentLoopData = $niche; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
				<textarea value="<?php echo e($value->id); ?>"><?php echo e($value->niche_category); ?></textarea>

				<?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?> -->
							<div class="col-md-12">
								<div class="col-md-8">
									<div class="form-group opt" data-show="opt1">
										<div class="col-md-5">
											<label>Select Language</label>
										</div>
										<div class="col-md-7">

											<select class="form-control selectpicker" name="language" id="language">
												<option selected value="">Choose Language</option>
												<?php $__currentLoopData = $language; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
												<option  value="<?php echo e($value->id); ?>"><?php echo e($value->language_name); ?></option>
												<?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
											</select>
										</div>
									</div>
									<div class="form-group opt" data-show="opt1">
										<div class="col-md-5">
											<label>Select Voice Variation</label>
										</div>
										<div class="col-md-7">

											<select class="form-control selectpicker" name="voice_varation" id="voice_varation">
												<option value="male">Male</option>
												<option value="female">Female</option>
											</select>
										</div>
									</div>

									<div class="form-group opt" data-show="opt1">
										<div class="col-md-5">
											<label>Select Niche</label>
										</div>
										<div class="col-md-7">
											<select class="form-control selectpicker" name="sound_niche" id="sound_niche">
												<option selected value="">Choose Niche</option>
												<?php $__currentLoopData = $niche; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
												<option  value="<?php echo e($value->id); ?>"><?php echo e($value->niche_category); ?></option>
												<?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>

											</select>
										</div>
									</div>
									<div class="form-group opt" data-show="opt1">
										<div class="col-md-5">
											<label>Traffic Source / Target Audience</label>
										</div>
										<div class="col-md-7">
											<select class="form-control selectpicker" name="traffic_source" id="traffic_source">
												<option selected value="">Choose Source</option>
												<?php $__currentLoopData = $trafficsource; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
												<option  value="<?php echo e($value->id); ?>"><?php echo e($value->sourcename); ?></option>
												<?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
											</select>
										</div>
									</div>

									<div class="form-group opt" data-show="opt2">
										<div class="col-md-5">
											<label>Select Language</label>
										</div>
										<div class="col-md-7">

											<select class="form-control selectpicker" name="t2s_language" id="t2s_language">
												<option selected value="">Choose Language</option>
												<?php $__currentLoopData = $language; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
												<option  value="<?php echo e($value->language_code); ?>"><?php echo e($value->language_name); ?></option>
												<?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
											</select>
										</div>
									</div>

									<div class="form-group opt" data-show="opt2">
										<div class="col-md-5">
											<label>Select Voice Variation</label>
										</div>
										<div class="col-md-7">

											<select class="form-control selectpicker" name="t2s_voiceid" id="t2s_voiceid">
												<option selected value="">Choose Variation</option>
												<option  value="Matthew">Matthew, Male</option>
												<option  value="Salli">Salli, Female</option>
												<option  value="Joanna">Joanna, Female</option>
												<option  value="Ivy">Ivy, Female</option>
												<option  value="Justin">Justin, Male</option>
												<option  value="Joey">Joey, Female</option>
											</select>
										</div>
									</div>

									<div class="form-group opt" data-show="opt2">
										<div class="col-md-5">
											<label>Content for <b class="bold">Text To Speech</b></label>
										</div>
										<div class="col-md-7">
											<textarea class="form-control" name="text_to_speech" id="text_to_speech"></textarea>
										</div>
									</div>

									<div class="form-group opt" data-show="opt2">
										<div class="col-md-9">
										</div>
										<div class="col-md-3">
											<button class="btn btn-primary pull-right" id="createText">Convert Voice</button>
										</div>
									</div>
									<div class="form-group opt" id="t2s_output">
										<div class="col-md-5">
											<label>Sound Preview</label>
										</div>
										<div class="col-md-7">
											<img src="<?php echo e(url('/images/convertsound-fav.png')); ?>" id="t2s_playservice" alt="play/pause" title="To Play Click Here">
											<audio class="form-control" name="t2s_soundpreview" id="t2s_soundpreview" controls>
											  <source src="<?php echo e(url('/uploads/sound/')); ?>" type="audio/mpeg">
											  Your browser does not support the audio tag.
											</audio> 
										</div>
									</div>								
									<div class="form-group opt" data-show="opt3">
										<div class="col-md-5">
											<label>Upload Custom Sound</label>
										</div>
										<div class="col-md-7">
											<input type="file" class="form-control" name="custom_upload" id="custom_upload">
										</div>
									</div>
									<div class="form-group opt" data-show="opt1">
										<div class="col-md-5">
											<label>Sound Preview</label>
										</div>
										<div class="col-md-7">
											<img src="<?php echo e(url('/images/convertsound-fav.png')); ?>" id="playservice" alt="play/pause" title="To Play Click Here">
											<audio class="form-control" name="soundpreview" id="soundpreview" controls>
											  <source src="<?php echo e(url('/uploads/sound/demo-jogi-sound.mp3')); ?>" type="audio/mpeg">
											  Your browser does not support the audio tag.
											</audio> 
										</div>
									</div>
								</div>
							</div>
							<div class="form-group"></div>

						</div><!-- tab-pane -->
						<div class="tab-pane" id="tab2-4">									
							<div class="row">
								<div class="col-md-8">
									<div class="form-group">
										<div class="col-md-5">
											<label>Campaign Name</label>
										</div>
										<div class="col-md-7">
											<input type="text" name="trigger_time" id="trigger_time" class="form-control">
										</div>
									</div>
									<div class="form-group">
										<div class="col-md-5">
											<label>Trigger Time (First time on loading)</label>
										</div>
										<div class="col-md-7">
											<input type="text" name="trigger_time" id="trigger_time" class="form-control">
										</div>
									</div>
									<div class="form-group">
										<div class="col-md-5">
											<label>Trigger after Scroll height</label>
										</div>
										<div class="col-md-7">
											<input type="text" name="scroll_height" id="scroll_height" class="form-control">
										</div>
									</div>
<!-- 									<div class="form-group">
										<div class="col-md-5">
											<label>Exit Sound</label>
										</div>
										<div class="col-md-7">
											<select class="form-control selectpicker" name="exit_sound" id="exit_sound">
												<option selected value="">Choose Sound</option>
												<option value="1">Holdon.mp3</option>
												<option value="1">Wait.mp3</option>
												<option value="2">hello.mp3</option>
												<option value="4">Thankyou.mp3</option>
											</select>
										</div>
									</div> -->
									<div class="form-group">
										<div class="col-md-5">
											<label>Favicon Icon</label>
										</div>
										<div class="col-md-7">
											<input type="file" class="form-control" name="favicon_icon" id="favicon_icon">
										</div>
									</div>
									<div class="form-group">
										<div class="col-md-5">
											<label>Repeat Trigger Time (After First loading)</label>
										</div>
										<div class="col-md-7">
											<input type="text" name="repeat_trigger_time" id="repeat_trigger_time" class="form-control">
										</div>
									</div>
									<div class="form-group">
										<div class="col-md-5">
											<label>Back Button Redirection(On Browser)</label>
										</div>
										<div class="col-md-7">
											<input type="text" name="back_button_redirect" id="back_button_redirect" class="form-control">
										</div>
									</div>
									<div class="form-group">
										<div class="col-md-5">
											<label>Vibration For Mobile</label>
										</div>
										<div class="col-md-7">
											<input type="checkbox" name="vibration_mobile" class="checkbox" id="vibration_mobile" value="1">
										</div>
									</div>
									<hr>
									<div class="form-group">
										<label>Geo Redirection</label>
									</div>
									<div class="form-group country_re" >
										<div class="col-md-5">
											<select class="form-control selectpicker" name="country" id="country">
												<option selected value="">Select Country</option>
												<?php $__currentLoopData = $country; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
												<option  value="<?php echo e($value->country_code); ?>"><?php echo e($value->country_name); ?></option>
												<?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>

											</select>
										</div>
										<div class="col-md-7">
											<input type="text" name="redirectionlink" class="form-control" id="redirectionlink"/>
											<a href="javascript:void(0);" class="remove_button" title="Remove field"><img src="<?php echo e(url("images/remove-icon.png")); ?>"></a>
										</div>
									</div>
									<div class="form-group country_re">
										<div class="col-md-5">
											<select class="form-control selectpicker" name="country" id="country">
												<option selected value="">Select Country</option>
												<option value="AF">Afghanistan</option>
												<option value="BA">Bangladesh</option>
												<option value="BG">Bulgaria</option>
												<option value="GA">Germany</option>
											</select>
										</div>
										<div class="col-md-7">
											<input type="text" name="redirectionlink" class="form-control" id="redirectionlink"/><a onclick="add_bookingrate();" class="add_button" href="javascript:void(0);" title="Add field"><img src="<?php echo e(url('images/add-icon.png')); ?>"></a>
										</div>
									</div>

								</div>
							</div>
						</div>
						<div class="tab-pane" id="tab3-4">
							<div class="row">
								<div class="col-md-10">
									<div class="form-group">
										<div class="col-md-4">
											<label>Embed Code (Copy the code and paste in footer section)</label>
										</div>
										<div class="col-md-8">
											<textarea class="form-control" name="copycode" id="copycode"><script type="text/javascript" src="http://convertsound.com/livecamp/cvs098.js"></script></textarea>
											<input type="hidden" name="script_name" id="script_name">
											<input type="hidden" name="sound_src" id="sound_src">
										</div>
									</div>
								</div>
							</div>
						</div><!-- tab-pane -->
					</div><!-- tab-content -->
					<ul class="list-unstyled wizard">
						<li class="pull-left previous"><button type="button" class="btn btn-default">Previous</button></li>
						<li class="pull-right next"><button type="button" class="btn btn-primary">Next</button></li>
						<li class="pull-right finish hide"><button onclick="submitForm()" type="button" class="btn btn-primary">Finish</button></li>
					</ul>
				</form>
			</div>
		</div>
	</div>
</div>
<script>
	function submitForm(){
		document.getElementById("valWizard").submit();
	}
var maxField = 10; //Input fields increment limitation
var addButton = $('.add_button'); //Add button selector
var wrapper = $('.field_wrapper'); //Input field wrapper
var x = 1; //Initial field counter is 1
$(wrapper).on('click', '.remove_button', function(e){
	e.preventDefault();
	$(this).closest("tr").remove();
	x--;
});
function add_geolocation(){

}


jQuery(document).ready(function() {

	jQuery('.opt').hide();

	jQuery('.campaign_type').click(function(){
		var camp_id=$(this).attr('id');
		jQuery('.opt').hide();

		jQuery('.opt').each(function(){
			if(jQuery(this).data('show')==camp_id){
			jQuery(this).show();		
			}
		});	
	});
	var script_name=Date.now();

	jQuery('#copycode').text("<script type='text/javascript' src='http://convertsound.com/uploads/campaign/"+script_name+".js'><\/script>");
	jQuery('#script_name').val(script_name);



	jQuery('#createText').click(function(e){
		e.preventDefault();
		var text=jQuery('#text_to_speech').val();
		var voice_id=jQuery('#t2s_voiceid').val();
		var language=jQuery('#t2s_language').val();
		$.ajax({
			type: "GET",
			url: "<?php echo e(url('/t2speech/ajax')); ?>",
			data:'voice_id='+voice_id+'&text='+text+'&language='+language,
			success: function(data){
				jQuery('#t2s_soundpreview').attr('src',data);
				jQuery('#sound_src').val(data);
				jQuery('#t2s_output').show();
				console.log(data);
			}
		});

	});
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

	

	// 9716012062

	jQuery('#valWizard').bootstrapWizard({
		onTabShow: function(tab, navigation, index) {
			tab.prevAll().addClass('done');
			tab.nextAll().removeClass('done');
			tab.removeClass('done');

			var $total = navigation.find('li').length;
			var $current = index + 1;

			if($current >= $total) {
				$('#valWizard').find('.wizard .next').addClass('hide');
				$('#valWizard').find('.wizard .finish').removeClass('hide');
			} else {
				$('#valWizard').find('.wizard .next').removeClass('hide');
				$('#valWizard').find('.wizard .finish').addClass('hide');
			}
		},
		onTabClick: function(tab, navigation, index) {
			return false;
		},
		onNext: function(tab, navigation, index) {
			var $valid = jQuery('#valWizard').valid();
			if (!$valid) {
				$validator.focusInvalid();
				return false;
			}
		}
	});
    // Wizard With Form Validation
    var $validator = jQuery("#valWizard").validate({
    	highlight: function(element) {
    		jQuery(element).closest('.form-group').removeClass('has-success').addClass('has-error');
    	},
    	success: function(element) {
    		jQuery(element).closest('.form-group').removeClass('has-error');
    	}
    });
});
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.website', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>