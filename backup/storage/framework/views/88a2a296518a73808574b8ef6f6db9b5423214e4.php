<?php $__env->startSection('content'); ?>
<script type="text/javascript">
	
	var AmazonLanguage={
		'Danish':'da-DK',
		'Dutch':'nl-NL',
		'English (Australian)':'en-AU',
		'English (British)':'en-GB',
		'English (Indian)':'en-IN',
		'English (US)':'en-US',
		'English (Welsh)':'en-GB-WLS',
		'French':'fr-FR',
		'French (Canadian)':'fr-CA',
		'German':'de-DE',
		'Icelandic':'is-IS',
		'Italian':'it-IT',
		'Japanese':'ja-JP',
		'Korean':'ko-KR',
		'Norwegian':'nb-NO',
		'Polish':'pl-PL',
		'Portuguese (Brazilian)':'pt-BR',
		'Portuguese (European)':'pt-PT',
		'Romanian':'ro-RO',
		'Russian':'ru-RU',
		'Spanish':'es-ES',
		'Spanish (Latin American)':'es-US',
		'Swedish':'sv-SE',
		'Turkish':'tr-TR',
		'Welsh':'cy-GB'
	}

	var VoiceVariation={
		'da-DK':{
			'Mads':'Mads, Male',
			'Naja':'Naja, Female'
		},
		'nl-NL':{
			'Lotte':'Lotte, Female',
			'Ruben':'Ruben, Male'	
		},
		'en-AU':{
			'Nicole':'Nicole, Female',
			'Russell':'Russell, Male'
		},
		'en-GB':{
			'Amy':'Amy, Female',
			'Brian':'Brian, Male',
			'Emma':'Emma, Female'
		},
		'en-IN':{
			'Aditi':'Aditi, Female',
			'Raveena':'Raveena, Female'
		},
		'en-US':{
			'Ivy':'Ivy, Female',
			'Joanna':'Joanna, Female',
			'Joey':'Joey, Male',
			'Justin':'Justin, Male',
			'Kendra':'Kendra, Female',
			'Kimberly':'Kimberly, Female',
			'Matthew':'Matthew, Male',
			'Salli':'Salli, Female'
		},
		'en-GB-WLS':{
			'Geraint':'Geraint, Male'
		},
		'fr-FR':{
			'Celine':'Céline, Female',
			'Mathieu':'Mathieu, Male'
		},
		'fr-CA':{
			'Chantal':'Chantal, Female'
		},
		'de-DE':{
			'Hans':'Hans, Male',
			'Marlene':'Marlene, Female',
			'Vicki':'Vicki, Female'
		},
		'is-IS':{
			'Dora':'Dóra, Female',
			'Karl':'Karl, Male'
		},
		'it-IT':{
			'Carla':'Carla, Female',
			'Giorgio':'Giorgio, Male'
		},
		'ja-JP':{
			'Mizuki':'Mizuki, Female',
			'Takumi':'Takumi, Male'
		},
		'ko-KR':{
			'Seoyeon': 'Seoyeon, Female'
		},
		'nb-NO':{
			'Liv':'Liv, Female'
		},
		'pl-PL':{
			'Jacek': 'Jacek, Male',
			'Jan':'Jan, Male',
			'Ewa': 'Ewa, Female',
			'Maja': 'Maja, Female'
		},
		'pt-BR':{
			'Ricardo': 'Ricardo, Male',
			'Vitoria': 'Vitória, Female'	
		},
		'pt-PT':{
			'Cristiano':'Cristiano, Male',
			'Ines':'Inês, Female'
		},
		'ro-RO':{
			'Carmen' :'Carmen, Female'
		},
		'ru-RU':{
			'Maxim': 'Maxim, Male',
			'Tatyana':'Tatyana, Female'
		},
		'es-ES':{
			'Conchita': 'Conchita, Female',
			'Enrique': 'Enrique, Male'
		},
		'es-US':{
			'Miguel': 'Miguel, Male',
			'Penelope': 'Penélope, Female'
		},
		'sv-SE':{
			'Astrid': 'Astrid, Female'
		},
		'tr-TR':{
			'Filiz': 'Filiz, Female'
		},
		'cy-GB':{
			'Gwyneth': 'Gwyneth, Female'
		}
	}


for (var key in AmazonLanguage) {
	if(AmazonLanguage.hasOwnProperty(key))
	{
		// console.log(AmazonLanguage[key]);
		// $('#t2s_language').append('<option value="'+AmazonLanguage[key]+'">'+key+'</option>');

	}
}


for (k = 0; k < AmazonLanguage.length; k++)
{

//$('#t2s_language').append("<option value='" + AmazonLanguage[k]+ "'>" + AmazonLanguage[k] + "</option>");
}





</script>

<!-- <div class="pageheader">
		<div class="media">
        <div class="media-body">
    	<h4>Add Domain</h4>
        <ul class="breadcrumb">
            <li><a href="<?php echo e(url('/')); ?>"><i class="glyphicon glyphicon-home"></i></a></li>
            <li>Domain</li>
            <li>Add</li>
        </ul>
    	</div>
    </div>
</div> -->
<div class="contentpanel campaign-page">
	<div id="page-wrapper">
		<div class="campsection step1" id="step1">
			<div class="content">
				<div class="row">
					<div class="col-md-12">
						<div class="step-heading">STEP 1: Enter Domain Name for Campaign</div>
					</div>
				</div>
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
						<form method="post" id="action1" action="<?php echo e(url('domain/save')); ?>">
							<?php echo e(csrf_field()); ?>

							<?php //print_r($campaign);?>
							<div class="row">
								<div class="col-md-10 col-md-offset-1 pt10">
									<div class="col-md-8">
										<input type="text" class="big-inputs" placeholder="Enter Your Domain" name="domain_name" id="domain_name" value="<?php echo e($campaign[0]->domain_name); ?>" required="">
										<input type="hidden" name="domain_id" id="domain_id">
										<div class="info_button pull-right"><span class="tooltip1" title="This is my image's tooltip message!"><i class="fa fa-info-circle"></i></span></div>
									</div>
									<div class="col-md-3">

										<button type="submit" class="btn btn-primary large-btn">Submit</button>
									</div>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
		<div class="campsection step2" id="step2">
			<div class="content">
				<div class="row">
					<div class="col-md-12">
						<div class="step-heading">STEP 2: Choose Your Sound Campaign</div>
					</div>
				</div>
				<div class="row  pt10">
					<div class="col-md-8 col-md-offset-2">
						<input type="text" class="big-inputs" placeholder="Write Your Campaign Name" value="<?php echo e($campaign[0]->campaign_name); ?>" name="campaign_name" id="campaign_name" required="">
						<input type="hidden" value="<?php echo e($campaign[0]->id); ?>" name="campaign_id" id="campaign_id">

						<div class="info_button pull-right"><span class="tooltip1" title="This is my image's tooltip message!"><i class="fa fa-info-circle"></i></span></div>
					</div>
				</div>

				<div class="row" id="action_section">
					<!-- col -->
					<div class="col-md-8 col-xs-8 col-sm-8 col-md-offset-2 pt10">
						<p class="opt-title mb5">Choose Action Type <span class="tooltip1" title="Select the action on options (Autoplay or User intraction). You can choose one of them and set your campaign action!"><i class="fa fa-info-circle"></i></span></p>
						<div class="col-md-4 col-xs-12 col-sm-4 col-md-offset-1" style="cursor:pointer">
							<div class="campaign-action-box" id="autoplay"  data-type="autoplay">
								<div class="info_button"><span class="tooltip1" title="Autoplay on browser with multiple loading options."><i class="fa fa-info-circle"></i></span></div>
								<div class="bar-widget">
									<div class="table-box">
										<div class="table-detail text-center">
											<h2 class="m-t-0 m-b-5 font-light counter">Auto Play</h2>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-md-4 col-xs-12 col-sm-4 col-md-offset-2" style="cursor:pointer">
							<div class="campaign-action-box" id="manualplay" data-type="manualplay">
								<div class="info_button"><span class="tooltip1" title="Manual play on browser with custom popup for User Interaction."><i class="fa fa-info-circle"></i></span></div>
								<div class="bar-widget">
									<div class="table-box">
										<div class="table-detail text-center">
											<h2 class="m-t-0 m-b-5 font-light counter">User Play</h2>

										</div>
									</div>
								</div>
							</div>
						</div>
						<input type="hidden" name="action_type" id="action_type">
					</div>

					<div class="row actiontype" id="autoplay_option" style="display:none;">
						<div class="col-md-8 col-xs-8 col-sm-8 col-md-offset-2 pt5" >
						<p class="opt-title">Auto Play Condition <span class="tooltip1" title="Select one of the option from the dropdown options."><i class="fa fa-info-circle"></i></span></p>
							<div class="form-group">
								<p class="setting-title">Sound Play Condition <span class="tooltip1" title="This is my image's tooltip message!"><i class="fa fa-info-circle"></i></span></p>
								<div class="col-md-7">
									<select class="form-control selectpicker" name="play_condition" id="play_condition">
										<option value="onload">On Page Load</option>
										<option value="trigger_time">After X time on page (Seconds)</option>
										<option value="scroll_height">After X pixels scroll on page (Scroll Pixel)</option>
									</select>
								</div>
								<div class="col-md-5">
									<input type="number" min-value="0" name="value" id="play_condition_value" class="form-control" disabled="true">
								</div>
							</div>
							<div class="form-group center pt5 mb10">
								<button type="button" id="add_autoplay" class="btn btn-primary">Add</button>
							</div>
						</div>
					</div>

					<div class="row actiontype" id="manualplay_option" style="display:none;">
					<form method="get" id="widget_action" action="<?php echo e(url('campaign/savewidget')); ?>">

						<div class="col-md-8 col-xs-8 col-sm-8 col-md-offset-2 pt5" >
						<p class="opt-title">Widget Settings <span class="tooltip1" title="Here are some basic settings for the widget, Please fill below fields for Widget."><i class="fa fa-info-circle"></i></span></p>
							<div class="form-group">
								<div class="col-md-7  col-xs-12 col-sm-12">
								<p class="setting-title">Headline Text <span class="tooltip1" title="headline for the widget."><i class="fa fa-info-circle"></i></span></p>
									<input class="form-control" name="headline_text" id="headline_text" required="required" placeholder="Write Headline Text"/>					
								</div>
								<div class="col-md-3 col-xs-6 col-sm-6">
								<p class="setting-title">Text Color<span class="tooltip1" title="Text Color for the Headline text"><i class="fa fa-info-circle"></i></span></p>
									<input class="form-control" name="headline_color" id="headline_color" placeholder="Text Color"/>					
								</div>
								<div class="col-md-2  col-xs-6 col-sm-6">
								<p class="setting-title">Bg Color<span class="tooltip1" title="Background Color for the Headline text"><i class="fa fa-info-circle"></i></span></p>
									<input class="form-control" name="headline_bg" id="headline_bg" placeholder="Bg color"/>					
								</div>
							</div>

							<div class="form-group">
								<div class="col-md-7  col-xs-12 col-sm-12">
								<p class="setting-title">Description Text <span class="tooltip1" title="Description for the widget."><i class="fa fa-info-circle"></i></span></p>
									<input class="form-control" name="description_text" id="description_text"  required="required"  placeholder="Write Description Text"/>					
								</div>
								<div class="col-md-3 col-xs-6 col-sm-6">
								<p class="setting-title">Text Color<span class="tooltip1" title="Text Color for the Description text"><i class="fa fa-info-circle"></i></span></p>
									<input class="form-control" name="description_color" id="description_color" placeholder="Text Color"/>					
								</div>
								<div class="col-md-2  col-xs-6 col-sm-6">
								<p class="setting-title">Bg Color<span class="tooltip1" title="Background Color for the Description text"><i class="fa fa-info-circle"></i></span></p>
									<input class="form-control" name="description_bg" id="description_bg" placeholder="Bg color"/>					
								</div>	
							</div>
							<div class="form-group">
								<div class="col-md-7">
									<p class="setting-title">Widget Position <span class="tooltip1" title="Choose widget position from multiple options."><i class="fa fa-info-circle"></i></span></p>							
									<select class="form-control selectpicker" name="widget_position" id="widget_position">
										<option value="middle-right">Middle Right</option>
										<option value="middle-left">Middle Left</option>
										<option value="bottom-right">Bottom Right</option>
										<option value="bottom-left">Bottom Left</option>								
									</select>
								</div>
								<div class="col-md-5">
									<p class="setting-title">Pulsating Play Icon <span class="tooltip1" title="Choose widget position from multiple options."><i class="fa fa-info-circle"></i></span></p>

									<img class="play_icon" src="<?php echo e(url('/')); ?>/images/convertsound-fav-def.gif">
									<input value="<?php echo e(url('/')); ?>/images/convertsound-fav-def.gif" type="hidden" name="play_icon" id="play_icon">
								</div>
							</div>
							<div class="form-group center pt5 mb10">
								<button type="submit" id="save_widget" class="btn btn-primary">Save Widget</button>
							</div>
						</div>
					</form>
					</div>
					<input type="hidden" name="widget_id" id="widget_id">
				</div>

				<div class="row" id="campaign_type_section" style="display:none;">
					<!-- col -->
					<div class="col-md-8 col-xs-8 col-sm-8 col-md-offset-2 pt10">
						<!-- <h2 class="m-t-0 m-b-5 font-light counter">Choose From:</h2> -->
						<div class="col-md-4 col-xs-12 col-sm-4" style="cursor:pointer">
							<div class="campaign-option-box <?php if($campaign[0]->campaign_type=='Done For You') echo 'selected';?>" id="dfy"  data-type="Done For You">
								<div class="info_button"><span class="tooltip1" title="This is my image's tooltip message!"><i class="fa fa-info-circle"></i></span></div>
								<div class="bar-widget">
									<div class="table-box">
										<div class="table-detail text-center">
											<h2 class="m-t-0 m-b-5 font-light counter">Done For You</h2>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-md-4 col-xs-12 col-sm-4" style="cursor:pointer">
							<div class="campaign-option-box <?php if($campaign[0]->campaign_type=='Text to Speech') echo 'selected';?>" id="t2s" data-toggle="modal" data-target="#texttospeech" data-type="Text to Speech">
								<div class="info_button"><span class="tooltip1" title="This is my image's tooltip message!"><i class="fa fa-info-circle"></i></span></div>
								<div class="bar-widget">
									<div class="table-box">
										<div class="table-detail text-center">
											<h2 class="m-t-0 m-b-5 font-light counter">Text To Speech</h2>

										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-md-4 col-xs-12 col-sm-4" style="cursor:pointer">
							<div class="campaign-option-box  <?php if($campaign[0]->campaign_type=='Custom Upload') echo 'selected';?>" id="cu" data-type="Custom Upload">
								<div class="info_button"><span class="tooltip1" title="This is my image's tooltip message!"><i class="fa fa-info-circle"></i></span></div>
								<div class="bar-widget">
									<div class="table-box">
										<div class="table-detail text-center">
											<h2 class="m-t-0 m-b-5 font-light counter">Custom Upload</h2>
										</div>
									</div>
								</div>
							</div>
						</div>
						<input type="hidden" name="campaign_type" value="<?php echo e($campaign[0]->campaign_type); ?>" id="campaign_type">
					</div>
				</div>

				<div class="row" id="variation_section" <?php if($campaign[0]->campaign_type=='Done For You'){ echo 'style="display:block;"';} else { echo 'style="display:none;"';}?> >
					<div class="col-md-8 col-xs-8 col-sm-8 col-md-offset-2 pt10">
						<p class="opt-title">Choose Voice Variation <span class="tooltip1" title="This is my image's tooltip message!"><i class="fa fa-info-circle"></i></span></p>
						<div class="col-md-8 col-xs-8 col-sm-8 col-md-offset-2">
							<div class="col-md-6 col-xs-6 col-sm-6 vv" style="cursor:pointer">
								<div class="vv-box <?php if($campaign[0]->voice_variation=='male') echo 'selected';?>" data-toggle="modal" data-target="#selectsoundniche" data-value="male" id="voicemale">
									<img class="vv-img" src="<?php echo e(url('/images/male.jpg')); ?>">
									<div class="vv-title">Male</div> 
								</div>
							</div>
							<div class="col-md-6 col-xs-6 col-sm-6 vv" style="cursor:pointer">
								<div class="vv-box <?php if($campaign[0]->voice_variation=='female') echo 'selected';?>" data-toggle="modal" data-target="#selectsoundniche" data-value="female" id="voicefemale">
									<img class="vv-img" src="<?php echo e(url('/images/female.jpg')); ?>""/>
									<div class="vv-title">Female</div> 
								</div>
							</div>
							<input type="hidden" name="voice_variation"  value="<?php echo e($campaign[0]->voice_variation); ?>" id="voice_variation">
						</div>
					</div>
				</div>

<?php if($campaign[0]->campaign_type=='Done For You'){
	?>
				<div class="row" id="sound_details">
					<div class="col-md-8 col-xs-8 col-sm-8 col-md-offset-2">
						<p class="opt-title">Selected Sound Details<span class="tooltip1" title="This is my image's tooltip message!"><i class="fa fa-info-circle"></i></span></p>
						<table class="sound_details">
							<thead>
								<th>Campaign Type</th>
								<th>Variation</th>
								<th>Niche Category</th>
								<th>Traffic Source</th>
								<th>Sound Preview</th>
							</thead>
							<tbody>
								<tr>
									<td><?php echo e($campaign[0]->campaign_type); ?></td>
									<td><?php echo e($campaign[0]->voice_variation); ?></td>									
									<td><?php echo e($campaign[0]->sound_niche); ?></td>
									<td><?php echo e($campaign[0]->traffic_source); ?></td>
									<td><div class="sound_preview" data-soundsrc="<?php echo e($campaign[0]->sound_src); ?>"><span>Play </span><img height="20px" src="<?php echo e(url('/')); ?>/images/convertsound-fav.png"/></div>
									<audio class="form-control" name="dfy_soundpreview" id="dfy_soundpreview" controls>
										<source src="<?php echo e($campaign[0]->sound_src); ?>" type="audio/mpeg">
										Your browser does not support the audio tag.
									</audio>
									</td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
				<?php } else if($campaign[0]->campaign_type=='Text to Speech') {
					?>

				<div class="row" id="sound_details">
					<div class="col-md-8 col-xs-8 col-sm-8 col-md-offset-2">
						<p class="opt-title">Selected Sound Details<span class="tooltip1" title="This is my image's tooltip message!"><i class="fa fa-info-circle"></i></span></p>
						<table class="sound_details">
							<thead>
								<th>Campaign Type</th>
								<th>Language</th>
								<th>Voice Id</th>
								<th>Text</th>
								<th>Sound Preview</th>
							</thead>
							<tbody>
								<tr>
									<td><?php echo e($campaign[0]->campaign_type); ?></td>
									<td><?php echo e($amazonsound[0]->language); ?></td>									
									<td><?php echo e($amazonsound[0]->voice_id); ?></td>
									<td><?php echo e($amazonsound[0]->text); ?></td>
									<td><div class="sound_preview" data-soundsrc="<?php echo e($campaign[0]->sound_src); ?>"><span>Play </span><img height="20px" src="<?php echo e(url('/')); ?>/images/convertsound-fav.png"/></div>
									<audio class="form-control" name="dfy_soundpreview" id="dfy_soundpreview" controls>
										<source src="<?php echo e($campaign[0]->sound_src); ?>" type="audio/mpeg">
										Your browser does not support the audio tag.
									</audio>
									</td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
				<?php
					}
					?>
<?php // print_r($campaign);?>
				<div class="row" id="dfy_other_option">
					<div class="col-md-8 col-xs-8 col-sm-8 col-md-offset-2 pt10" >
<!-- 				<div class="form-group">
					<div class="col-md-12">
						<input type="text" name="campaign_name" placeholder="*Campaign Name" id="campaign_name" class="form-control" required="required">
					</div>
				</div> -->			
						<p class="opt-title">Campaign Setting <span class="tooltip1" title="This is my image's tooltip message!"><i class="fa fa-info-circle"></i></span></p>
						<div class="form-group">
							<p class="setting-title">Sound Play Condition <span class="tooltip1" title="This is my image's tooltip message!"><i class="fa fa-info-circle"></i></span></p>
							<div class="col-md-7">
								<select class="form-control selectpicker" name="play_condition" id="play_condition">
									<option value="onload">On Page Load</option>
									<option value="trigger_time" <?php if($campaign[0]->trigger_time!='') {echo 'selected';}?>>After X time on page (Seconds)</option>
									<option value="scroll_height" <?php if($campaign[0]->scroll_height!='') {echo 'selected';}?>>After X pixels scroll on page (Scroll Pixel)</option>
									<!-- <option value="scroll_height">After X %age on page (Scroll Percentage)</option> -->
									
								</select>

							</div>
							<div class="col-md-5">
								<input type="number" min-value="0" name="value" id="play_condition_value" class="form-control" <?php if($campaign[0]->trigger_time!='') {echo 'value="'.$campaign[0]->trigger_time.'"'; }  if($campaign[0]->scroll_height!='') {echo 'value="'.$campaign[0]->scroll_height.'"'; }?>  <?php if($campaign[0]->trigger_time=='' &&  $campaign[0]->scroll_height=='') {echo 'disabled="true"';}?>>
							</div>
						</div>

						<p class="setting-title">Repeat Trigger Time <span class="tooltip1" title="This is my image's tooltip message!"><i class="fa fa-info-circle"></i></span></p>
						<div class="form-group">
							<div class="col-md-7">
								(Trigger Sound After First Sound Play. Enter some amount of seconds, this should be greater than the playing sound duration. For eg: if playing sound is of 40sec than trigger sound should be greater than 40 sec.)

							</div>
							<div class="col-md-5">
								<input type="number" min-value="0" value="<?php echo e($campaign[0]->repeat_trigger_time); ?>" name="repeat_trigger_time" id="repeat_trigger_time" class="form-control">
							</div>
						</div>
				<!-- <input type="checkbox" checked="checked" name="repeat_trigger_time"> -->
<!-- 						<label class="switch pull-right">
						  <input type="checkbox" name="repeat_trigger_time" id="repeat_trigger_time">
						  <span class="slider round"></span>
						</label> -->
						<div class="form-group center pt10">
							<button type="button" id="save_campaign" class="btn btn-primary">Save Campaign</button>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="campsection step3" id="step3">
			<div class="content">
				<div class="row">
					<div class="col-md-12">
						<div class="step-heading">STEP 3: Copy Script Code</div>
					</div>
				</div>

				<div class="row">
					<div class="col-md-8 col-md-offset-2 pt10">
						<p class="setting-title">Sound Script for Campaign <span class="tooltip1" title="This is my image's tooltip message!"><i class="fa fa-info-circle"></i></span></p>
						<textarea id="copycode" name="copycode" readonly="readonly"></textarea>
						<p class="">Just copy the script and paste into header section of your desired place.</p>
						<div class="form-group center pt10">
							<a href="<?php echo e(url('/campaign')); ?>"><button type="button" id="close_camp" class="btn btn-primary">Finish</button></a>
						</div>
					</div>
				</div>
			</div>
		</div>


	</div>
</div>

<div class="modal fade cancelModal" id="selectsoundniche" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button aria-hidden="true" data-dismiss="modal" class="close" type="button">&times;</button>
				<div class="row">
					<div class="col-md-12 col-xs-12 col-sm-12">
						<div class="row">
							<div class="col-md-4 col-xs-12 col-sm-4">
								<label class="popup_label">Voice Variation:</label>
								<select class="variation form-control selectpicker" id="variation" name="variation">
									<option value="male">Male</option>
									<option value="female">Female</option>
								</select>
							</div>
							<div class="col-md-4 col-xs-12 col-sm-4">
								<label class="popup_label">Select Niche:</label>
								<select class="niche_category form-control selectpicker" name="niche_category">
									<option value="-1">Any Niche</option>
									<?php $__currentLoopData = $niche; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
									<option  value="<?php echo e($value->id); ?>"><?php echo e($value->niche_category); ?></option>
									<?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
								</select>
							</div>
							<div class="col-md-4 col-xs-12 col-sm-4">
								<label class="popup_label">Traffic Source:</label>
								<select class="trafficsource form-control selectpicker" name="trafficsource">
									<option value="-1">Any Source</option>
									<?php $__currentLoopData = $trafficsource; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
									<option  value="<?php echo e($value->id); ?>"><?php echo e($value->sourcename); ?></option>
									<?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
								</select>
							</div>
						</div>
					</div>

				</div>
			</div>
			<?php echo e(csrf_field()); ?>

			<div class="modal-body">
				<div class="row">
					<div class="col-md-8 col-xs-12 col-sm-8">
						<h4 class="modal-title">Templates:</h4>
						<hr/>
						<div class="soundniches">
							<div class="radio-group">
								<?php $__currentLoopData = $soundniche; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$sn): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
								<?php $__currentLoopData = $niche; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
								<?php if($key==$value->id): ?>
								<div class="single_niche" data-nicheid="<?php echo e($value->id); ?>">
									<div class="niche-title"><?php echo e($value->niche_category); ?></div>
									<?php $__currentLoopData = $sn; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k=>$sound): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
									<?php $__currentLoopData = $trafficsource; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $val): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
									<?php if($k==$val->id): ?>
									<div class="single_sound">
										<div class='radio' data-sid="<?php echo e($val->id); ?>" data-variation="<?php echo e($sound->variation); ?>" data-source="<?php echo e($sound->id); ?>" data-value="<?php echo e(url($sound->sound_url)); ?>"><img src="<?php echo e(url('/images/convertsound-fav.png')); ?>" alt="Sound preview" title="Select to play">

											<div class="source-title"><?php echo e($val->sourcename); ?></div>	  			
										</div>
									</div>
									<?php endif; ?>
									<?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
									<?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
								</div>
								<?php endif; ?>
								<?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
								<?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
								<input type="hidden" id="radio-value" name="sound_url"/>
								<input type="hidden" id="sound_id" name="sound_id"/>
							</div>
						</div>
					</div>
					<div class="col-md-4 col-xs-12 col-sm-4">
						<h4 class="modal-title">Sound Preview:</h4>
						<!-- <img src="<?php echo e(url('/images/convertsound-fav.png')); ?>" id="playpause" alt="play/pause" title="To Play Click Here"> -->

						<div id="playpause" alt="play/pause" title="To Play Click Here" class="pp" style=""><i class="fa fa-volume-up"></i>
							<p>Select sound template from the templates section and click above icon to play/pause.</p>
						</div>
						<audio class="form-control" name="dfy_soundpreview" id="dfy_soundpreview" controls>
							<source src="<?php echo e(url('/uploads/sound/')); ?>" type="audio/mpeg">
								Your browser does not support the audio tag.
							</audio> 
						</div>
					</div>
					<div class="modal-footer">
						<div class="alertmsg alert alert-danger" id="sns"></div>
						<button type="button" id="dfy_option" class="btn btn-primary">Done</button>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="modal fade cancelModal" id="texttospeech" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button aria-hidden="true" data-dismiss="modal" class="close" type="button">&times;</button>
				</div>
				<?php echo e(csrf_field()); ?>

				<div class="modal-body">
					<div class="row">
						<div class="col-md-12 col-xs-12 col-sm-12">
							<div class="row">
							<form method="post" id="texttospeechform" action="">

								<div class="form-group opt" data-show="opt2">
									<div class="col-md-5">
										<label>Select Language</label>
									</div>
									<div class="col-md-7">
										<select class="form-control selectpicker" name="t2s_language" id="t2s_language" required="required">
											<option selected value="">Choose Language</option>


											<?php $__currentLoopData = $language; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
											<!-- <option  value="<?php echo e($value->language_code); ?>"><?php echo e($value->language_name); ?></option> -->
											<?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
										</select>
									</div>
								</div>
								<div class="form-group opt" data-show="opt2">
									<div class="col-md-5">
										<label>Select Voice Variation</label>
									</div>
									<div class="col-md-7">

										<select class="form-control selectpicker" name="t2s_voiceid" id="t2s_voiceid" required="required">
											<option selected value="">Choose Variation</option>
<!-- 											<option  value="Matthew">Matthew, Male</option>
											<option  value="Salli">Salli, Female</option>
											<option  value="Joanna">Joanna, Female</option>
											<option  value="Ivy">Ivy, Female</option>
											<option  value="Justin">Justin, Male</option>
											<option  value="Joey">Joey, Female</option> -->
										</select>
									</div>
								</div>
								<div class="form-group opt" data-show="opt2">
									<div class="col-md-5">
										<label>Content for <b class="bold">Text To Speech</b></label>
									</div>
									<div class="col-md-7">
										<textarea class="form-control" name="text_to_speech" id="text_to_speech"  required="required"></textarea>
									</div>
								</div>
								<div class="form-group opt" data-show="opt2">
									<div class="col-md-9">
									</div>
									<div class="col-md-3">
										<button class="btn btn-primary pull-right" id="createText">Convert To Speech</button>
									</div>
								</div>
								<div class="form-group opt" id="t2s_output" style="display: none;">
									<div class="col-md-5">
										<label>Sound Preview</label>
									</div>
									<div class="col-md-7">
										<img src="<?php echo e(url('/images/convertsound-fav.png')); ?>" id="t2s_playservice" alt="play/pause" title="To Play Click Here">
										<audio class="form-control" name="t2s_soundpreview" id="t2s_soundpreview" controls>
											<source src="<?php echo e(url('/uploads/sound/')); ?>" type="audio/mpeg">
												Your browser does not support the audio tag.
										</audio>
										<input type="hidden" name="sound_src" value="<?php echo e($campaign[0]->sound_src); ?>" id="sound_src">

									</div>
								</div>								
							</form>
							</div>
						</div>
					</div>

						<div class="modal-footer">
							<div class="alertmsg alert alert-danger" id="t2s_err"></div>
							<button type="button" id="t2s_option" class="btn btn-primary">Done</button>
						</div>
					</div>
				</div>
			</div>
		</div>

		<script type="text/javascript">
			var vv_type='';


			function autoscrollby(){
				var s=0;
	var x = 200; //y-axis pixel displacement
	var y = 10; //delay in milliseconds
	var refreshId=setInterval(function() {
		window.scrollBy(0, s);
		s = s + 5;
		if(s==x)
		{
			clearInterval(refreshId);
		}	
	}, y);

}


$('#action1').submit(function(e){
	e.preventDefault();
		// alert($('#domain_name').val());
		$('#step1').slideUp();	
		$('#step2').show();	

		// var text=jQuery('#domain_name').val();
		// var voice_id=jQuery('#t2s_voiceid').val();
		// var language=jQuery('#t2s_language').val();
		// $.ajax({
		// 	type: "GET",
		// 	url: "<?php echo e(url('/t2speech/ajax')); ?>",
		// 	data:'voice_id='+voice_id+'&text='+text+'&language='+language,
		// 	success: function(data){
		// 		jQuery('#domain_id').val(data);
		// 		$('#step1').slideUp();	
		// 		$('#step2').show();	
		// 		console.log(data);
		// 	}
		// });







	});

$('.campaign-option-box').click(function(){
	var ct=$(this).data('type');
	$('#campaign_type').val(ct);
});
$('#dfy').click(function(){
	autoscrollby();
	$('#variation_section').slideDown();
});


$('.trafficsource').change(function(){
	var sv = $(this).val();	
	var vv=$('#variation').val();
	if(sv=='-1'){
		$('.radio').each(function(){
			var av=$(this).data('variation');
				// alert(av+vv);
				if(av==vv){
					$(this).show();
				}
			});

//			$('.radio').show();

}
else{
	$('.radio').hide();
	$('.radio').each(function(){
		var av=$(this).data('variation');
		var sid=$(this).data('sid');
		if(sv==sid && av==vv){
			$(this).show();
		}
	});
}
});

$('.niche_category').change(function(){
	var nc = $(this).val();	
	if(nc=='-1'){
		$('.single_niche').show();			
	}
	else{
		$('.single_niche').hide();
		$('.single_niche').each(function(){

			var nid=$(this).data('nicheid');
			if(nc==nid){
				$(this).show();
			}
		});
	}
});

$('.vv-box').click(function(){
	var vv=$(this).data('value');
	$('.vv-box').removeClass('selected');
	$(this).addClass('selected');

	$('#variation').prop('disabled',false);
	$('#variation').selectpicker('val', vv);
	$('#voice_variation').val(vv);

		// alert($('#variation').val());
		$('#variation').prop('disabled',true);

		$('.radio').hide();
		$('.radio').each(function(){
			var sv=$(this).data('variation');
			if(sv==vv){
				$(this).show();
			}
		});
		if(vv_type!=vv){
			$('#radio-value').val('');
			$('#sound_id').val('');			
		}
		vv_type=vv;

	});
$('.radio-group .radio').click(function(){
	$('.single_niche').find('.radio').removeClass('selected');
	$(this).addClass('selected');
	var val = $(this).attr('data-value');
	var id = $(this).attr('data-source');
	    //alert(val);
	    $('#radio-value').val(val);
	    $('#sound_id').val(id);
	    $('#dfy_soundpreview').attr('src',val);
	    $('#sns').fadeOut(200);

	});
jQuery('#playpause').click(function() {
	var audio = document.getElementById("dfy_soundpreview");
	if(audio.paused == false) {
		audio.pause();
	        // alert('music paused');
	    } else {
	    	audio.play();
	        // alert('music playing');
	    }
	});

jQuery('#dfy_option').click(function() {
	$(function () {
		var rv=$('#radio-value').val();
		var si=$('#sound_id').val();
		if(rv && si){
			$('#selectsoundniche').modal('toggle');
			$('#dfy_other_option').show();
			autoscrollby();

		}
		else{
			$('#sns').html('You haven\'t selected any sound niche. Please select one then proceed to done step.');
			$('#sns').show();
			setTimeout(function(){
				$('#sns').fadeOut(500);
			},10000);

		}
		var audio = document.getElementById("dfy_soundpreview");
		audio.pause();
		audio.currentTime = 0;
		console.log(audio.duration);

		   // $('#dfy_option_fields').modal('toggle');
		});
});

jQuery('#t2s_option').click(function() {
	$(function () {
		var rv=$('#t2s_language').val();
		var si=$('#t2s_voiceid').val();
		if(rv && si){
			$('#texttospeech').modal('toggle');
			$('#dfy_other_option').show();
			autoscrollby();

		}
		else{
			$('#t2s_err').html('You haven\'t converted any text to speech. Please convert one then proceed to done step.');
			$('#t2s_err').show();
			setTimeout(function(){
				$('#t2s_err').fadeOut(500);
			},10000);

		}
		var audio = document.getElementById("dfy_soundpreview");
		audio.pause();
		audio.currentTime = 0;
		console.log(audio.duration);

		   // $('#dfy_option_fields').modal('toggle');
		});
});

$('#play_condition').change(function(){
if($(this).val()=='onload')
{
	$('#play_condition_value').attr('disabled',true);
}
else if($(this).val()=='trigger_time')
{
	$('#play_condition_value').attr('disabled',false);
}
else if($(this).val()=='scroll_height')
{
	$('#play_condition_value').attr('disabled',false);
}
});


var ajaxchk=true;
$('#save_campaign').click(function(){
	var domain_name=$('#domain_name').val();	
	var domain_id=$('#domain_id').val();	
	var campaign_id=$('#campaign_id').val();
	var campaign_name=$('#campaign_name').val();
	var campaign_type=$('#campaign_type').val();
	var voice_variation=$('#voice_variation').val();
	var sound_niche=$('.niche_category').val();
	var traffic_source=$('.trafficsource').val();
	var sound_src=$('#radio-value').val();
	if(campaign_type=='Text to Speech'){
		sound_src=$('#sound_src').val();
	}
	var trigger_time='';
	var scroll_height='';
	var play_condition=$('#play_condition').val();
	if(play_condition=='onload')
	{
		var play_condition=$('#play_condition').val();
	}
	else if(play_condition=='trigger_time')
	{
		trigger_time = $('#play_condition_value').val();
	}
	else if(play_condition=='scroll_height')
	{
		scroll_height = $('#play_condition_value').val();
	}
	var repeat_trigger_time=$('#repeat_trigger_time').val();
	var script_name='<?php echo e($campaign[0]->script_name); ?>';

	if(ajaxchk==true){
		ajaxchk=false;

		$.ajax({
			type: "GET",
			url: "<?php echo e(url('/campaign/ajaxupdate')); ?>",
			data:'domain_name='+domain_name+'&domain_id='+domain_id+'&campaign_id='+campaign_id+'&campaign_name='+campaign_name+'&campaign_type='+campaign_type+'&voice_variation='+voice_variation+'&sound_niche='+sound_niche+'&traffic_source='+traffic_source+'&sound_src='+sound_src+'&trigger_time='+trigger_time+'&scroll_height='+scroll_height+'&repeat_trigger_time='+repeat_trigger_time+'&script_name='+script_name,
			success: function(data){
				jQuery('#copycode').text("<script type='text/javascript' src='"+data+"'><\/script>");
				$('#step2').slideUp();
				$('#step3').show();	
				console.log(data);
				ajaxchk=true;
			}
		});

	}
});


var ajaxchk1=true;


jQuery('#texttospeechform').submit(function(e){
	

	e.preventDefault();

	var text=jQuery('#text_to_speech').val();
	var voice_id=jQuery('#t2s_voiceid').val();
	var language=jQuery('#t2s_language').val();
	if(ajaxchk1==true){
		ajaxchk1=false;
		jQuery('#t2s_output').hide();
		$.ajax({
			type: "GET",
			url: "<?php echo e(url('/t2speech/ajax')); ?>",
			data:'voice_id='+voice_id+'&text='+text+'&language='+language,
			success: function(data){
				jQuery('#t2s_soundpreview').attr('src',data);
				jQuery('#sound_src').val(data);
				jQuery('#t2s_output').show();
				console.log(data);
				ajaxchk1=true;

			}
		});
	}
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


jQuery.each(AmazonLanguage, function (index, value) {
	jQuery('#t2s_language').append($('<option/>', { 
        'value': value,
        'text' : index 
    }));
	// $('#t2s_language')[0].options.add( new Option(index,value) );
});
jQuery(window).load(function(){

jQuery('#t2s_language').selectpicker('refresh');
})

jQuery('#t2s_language').change(function(){
	var langcode=$(this).val();
	// alert(langcode);
	jQuery('#t2s_voiceid').html('');
	jQuery('#t2s_voiceid').append($('<option/>', { 
	    'value': '',
	    'text' : 'Select Variation' 
    }));
	jQuery.each(VoiceVariation, function (index, value) {
		if(langcode==index){
		console.log(index);
			$.each(value, function(i, v) {
				console.log(v);
				// jQuery('#t2s_voiceid')[0].options.add( new Option(i,v) );
		   		jQuery('#t2s_voiceid').append($('<option/>', { 
		        'value': i,
		        'text' : v 
			    }));

			});
			jQuery('#t2s_voiceid').selectpicker('refresh');
		}
		// $('#t2s_language')[0].options.add( new Option(index,value) );
	});
});

jQuery('.sound_preview').click(function(){
	var val = $(this).attr('data-soundsrc');
	var audio = document.getElementById("dfy_soundpreview");
	if(audio.src!=val)
    $('#dfy_soundpreview').attr('src',val);
	if(audio.paused == false){
		audio.pause();
        // alert('music paused');
    }
    else{
    	audio.play();
        // alert('music playing');
    }
});



$('#headline_color').colorpicker();
$('#headline_bg').colorpicker();
$('#description_color').colorpicker();
$('#description_bg').colorpicker();

var ajaxchk2=true;
$('#widget_action').submit(function(e){
	var formdata=$(this).serialize();
	// var headline_text=$('#headline_text').val();	
	// var headline_color=$('#headline_color').val();	
	// var headline_bg=$('#headline_bg').val();
	// var description_text=$('#description_text').val();
	// var description_color=$('#description_color').val();
	// var description_bg=$('#description_bg').val();
	// var widget_position=jQuery('#widget_position').val();
	// var icon=jQuery('#play_icon').val();;
	console.log(formdata);
	e.preventDefault();
	if(ajaxchk2==true){
		ajaxchk2=false;

		$.ajax({
			url: "<?php echo e(url('/campaign/savewidget')); ?>",
			processData: false,
			//data:'headline_text='+headline_text+'&headline_color='+headline_color+'&headline_bg='+headline_bg+'&description_text='+description_text+'&description_color='+description_color+'&description_bg='+description_bg+'&widget_position='+widget_position+'&icon='+icon,
			data:formdata,
			type: "GET",
			success: function(data){
				jQuery('#widget_id').val(data);
				$('#action_section').slideUp();	
				$('#campaign_type_section').slideDown();	
				console.log(data);
				ajaxchk2=true;
			}
		});

	}
});


</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.website', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>