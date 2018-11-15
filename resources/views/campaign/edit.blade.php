@extends('layouts.website')
@section('content')
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


</script>

<!-- <div class="pageheader">
		<div class="media">
        <div class="media-body">
    	<h4>Add Domain</h4>
        <ul class="breadcrumb">
            <li><a href="{{ url('/') }}"><i class="glyphicon glyphicon-home"></i></a></li>
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
						@if(Session::has('success'))
						<div class="alert alert-success alert-dismissable">
							<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
							{{ Session::get('success') }}
						</div>
						@endif
						@if(Session::has('failed'))
						<div class="alert alert-danger alert-dismissable">
							<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
							{{ Session::get('failed') }}
						</div>
						@endif
						@if (count($errors) > 0)
						<div class = "alert alert-danger">
							<ul>
								@foreach ($errors->all() as $error)
								<li>{{ $error }}</li>
								@endforeach
							</ul>
						</div>
						@endif
						<form method="post" id="action1" action="{{ url('domain/save') }}">
							{{ csrf_field() }}
							<?php //print_r($campaign);?>
							<div class="row">
								<div class="col-md-10 col-md-offset-1 pt10">
									<div class="col-md-8">
										<input type="text" class="big-inputs" placeholder="Enter Your Domain" name="domain_name" id="domain_name" value="{{$campaign[0]->domain_name}}" required="">
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
				<form method="get" id="widget_action1" action="{{ url('campaign/savewidget') }}">
				<div class="row">
					<div class="col-md-12">
						<div class="step-heading">STEP 2: Choose Your Sound Campaign</div>
					</div>
				</div>
				<div class="row  pt10">
					<div class="col-md-8 col-md-offset-2">
						<input type="text" class="big-inputs" placeholder="Write Your Campaign Name" value="{{$campaign[0]->campaign_name}}" name="campaign_name" id="campaign_name" required="">
						<input type="hidden" value="{{$campaign[0]->id}}" name="campaign_id" id="campaign_id">

						<div class="info_button pull-right"><span class="tooltip1" title="This is my image's tooltip message!"><i class="fa fa-info-circle"></i></span></div>
					</div>
				</div>
<?php print_r($campaign[0]);?>
				<div class="row" id="action_section">
				

					<div class="row actiontype" id="manualplay_option" style="display:block;">

						<div class="col-md-8 col-xs-8 col-sm-8 col-md-offset-2 pt5" >
						<p class="opt-title">Widget Settings <span class="tooltip1" title="Here are some basic settings for the widget, Please fill below fields for Widget."><i class="fa fa-info-circle"></i></span></p>

						<div class="form-group">
							<div class="col-md-7  col-xs-12 col-sm-12">
							<p class="setting-title">Your Name / Brand Name <span class="tooltip1" title="headline for the widget."><i class="fa fa-info-circle"></i></span></p>
								<input class="form-control" name="topbar_text" id="topbar_text" value="{{$campaign[0]->topbar_text}}" required="required" placeholder="Write Brand Name"/>					
							</div>
							<div class="col-md-3 col-xs-6 col-sm-6">
							<p class="setting-title">Text Color<span class="tooltip1" title="Text Color for the Headline text"><i class="fa fa-info-circle"></i></span></p>
								<input class="form-control" name="topbar_color" id="topbar_color" value="{{$campaign[0]->topbar_color}}" placeholder="Text Color"/>					
							</div>
							<div class="col-md-2  col-xs-6 col-sm-6">
							<p class="setting-title">Bg Color<span class="tooltip1" title="Background Color for the Headline text"><i class="fa fa-info-circle"></i></span></p>
								<input class="form-control" name="topbar_bg" id="topbar_bg" value="{{$campaign[0]->topbar_bg}}" placeholder="Bg color"/>					
							</div>
						</div>

						<div class="form-group">
							<div class="col-md-7">
								<p class="setting-title">Your Avatar/Brand Logo <span class="tooltip1" title="Choose widget position from multiple options."><i class="fa fa-info-circle"></i></span></p>
								<div class="col-md-6">
									<p data-toggle="modal" data-target="#selectimageupload"  class="upload_image" data-value="brandlogo">
										<i id="brandlogo_font" class="fa fa-upload"></i>
										<img id="brandlogo_preview" class="play_icon" src="" width="70px" height="70px" style="display: none;">
										<span></span>
									</p>
								</div>
								
							</div>
							<div class="col-md-5">
								<p class="setting-title">Default Icon <span class="tooltip1" title="Choose widget position from multiple options."><i class="fa fa-info-circle"></i></span></p>

								<img width="80px" class="play_icon" src="{{$campaign[0]->brandlogo}}">
								<input value="{{$campaign[0]->brandlogo}}" type="hidden" name="brandlogo" id="brandlogo">
							</div>
						</div>

						<div class="form-group">
							<div class="col-md-7  col-xs-12 col-sm-12">
							<p class="setting-title">Headline Text<span class="tooltip1" title="headline for the widget."><i class="fa fa-info-circle"></i></span></p>
								<input class="form-control" name="headline_text" id="headline_text" value="{{$campaign[0]->headline_text}}" required="required" placeholder="Write Headline Text"/>					
							</div>
							<div class="col-md-3 col-xs-6 col-sm-6">
							<p class="setting-title">Text Color<span class="tooltip1" title="Text Color for the Headline text"><i class="fa fa-info-circle"></i></span></p>
								<input class="form-control" name="headline_color" id="headline_color" value="{{$campaign[0]->headline_color}}" placeholder="Text Color"/>					
							</div>
							<div class="col-md-2  col-xs-6 col-sm-6">
							<p class="setting-title">Bg Color<span class="tooltip1" title="Background Color for the Headline text"><i class="fa fa-info-circle"></i></span></p>
								<input class="form-control" name="headline_bg" id="headline_bg" value="{{$campaign[0]->headline_bg}}" placeholder="Bg color"/>					
							</div>
						</div>

						<div class="form-group">
							<div class="col-md-7  col-xs-12 col-sm-12">
							<p class="setting-title">Description Text<span class="tooltip1" title="Description for the widget."><i class="fa fa-info-circle"></i></span></p>
								<input class="form-control" name="description_text" id="description_text" value="{{$campaign[0]->description_text}}" required="required"  placeholder="Write Description Text"/>					
							</div>
							<div class="col-md-3 col-xs-6 col-sm-6">
							<p class="setting-title">Text Color<span class="tooltip1" title="Text Color for the Description text"><i class="fa fa-info-circle"></i></span></p>
								<input class="form-control" name="description_color" id="description_color" value="{{$campaign[0]->description_color}}" placeholder="Text Color"/>					
							</div>
							<div class="col-md-2  col-xs-6 col-sm-6">
							<p class="setting-title">Bg Color<span class="tooltip1" title="Background Color for the Description text"><i class="fa fa-info-circle"></i></span></p>
								<input class="form-control" name="description_bg" id="description_bg" value="{{$campaign[0]->description_bg}}" placeholder="Bg color"/>					
							</div>	
						</div>
						<div class="form-group">
							<div class="col-md-7">
							<p class="setting-title">Widget Play Icon <span class="tooltip1" title="Choose play icon for widget."><i class="fa fa-info-circle"></i></span></p>
							<div class="col-md-6">
								<p data-toggle="modal" data-target="#selectimageupload"  class="upload_image" data-value="play_icon">
									<i id="play_icon_font" class="fa fa-upload"></i>
									<img id="play_icon_preview" class="play_icon" src="" width="70px" height="70px" style="display: none;">
									<span></span>
								</p>
							</div>


							</div>
							<div class="col-md-5">
								<p class="setting-title">Default Icon <span class="tooltip1" title="Default widget play icon from multiple options."><i class="fa fa-info-circle"></i></span></p>

								<img class="play_icon" src="{{$campaign[0]->playicon}}">
								<input value="{{$campaign[0]->playicon}}" type="hidden" name="play_icon" id="play_icon">
							</div>
						</div>	
					</div>
				</div>


				<div class="row" id="campaign_type_section" style="display:block;">
					<!-- col -->
					<div class="col-md-8 col-xs-8 col-sm-8 col-md-offset-2 pt5">
					<p class="opt-title">Optin Message Sound Settings <span class="tooltip1" title="Sound Setting."><i class="fa fa-info-circle"></i></span></p>
						<div class="col-md-4 col-xs-12 col-sm-4" style="cursor:pointer">
							<div class="campaign-option-box <?php if($campaign[0]->campaign_type=='Done For You') echo 'selected';?>" id="dfy" data-toggle="modal" data-target="#selectsoundniche" data-type="Done For You">
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
						<input type="hidden" name="campaign_type" value="{{$campaign[0]->campaign_type}}" id="campaign_type">
					</div>
				</div>

				<!-- <div class="row" id="variation_section" <?php if($campaign[0]->campaign_type=='Done For You'){ echo 'style="display:block;"';} else { echo 'style="display:none;"';}?> >
					<div class="col-md-8 col-xs-8 col-sm-8 col-md-offset-2 pt10">
						<p class="opt-title">Choose Voice Variation <span class="tooltip1" title="This is my image's tooltip message!"><i class="fa fa-info-circle"></i></span></p>
						<div class="col-md-8 col-xs-8 col-sm-8 col-md-offset-2">
							<div class="col-md-6 col-xs-6 col-sm-6 vv" style="cursor:pointer">
								<div class="vv-box <?php if($campaign[0]->voice_variation=='male') echo 'selected';?>" data-toggle="modal" data-target="#selectsoundniche" data-value="male" id="voicemale">
									<img class="vv-img" src="{{url('/images/male.jpg')}}">
									<div class="vv-title">Male</div> 
								</div>
							</div>
							<div class="col-md-6 col-xs-6 col-sm-6 vv" style="cursor:pointer">
								<div class="vv-box <?php if($campaign[0]->voice_variation=='female') echo 'selected';?>" data-toggle="modal" data-target="#selectsoundniche" data-value="female" id="voicefemale">
									<img class="vv-img" src="{{url('/images/female.jpg')}}""/>
									<div class="vv-title">Female</div> 
								</div>
							</div>
							<input type="hidden" name="voice_variation"  value="{{$campaign[0]->voice_variation}}" id="voice_variation">
						</div>
					</div>
				</div> -->

<?php if($campaign[0]->campaign_type=='Done For You'){
	?>
				<div class="row pt5" id="sound_details">
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
									<td>{{$campaign[0]->campaign_type}}</td>
									<td>{{$campaign[0]->voice_variation}}</td>									
									<td>{{$campaign[0]->sound_niche}}</td>
									<td>{{$campaign[0]->traffic_source}}</td>
									<td><div class="sound_preview" data-soundsrc="{{$campaign[0]->sound_src}}"><span>Play </span><img height="20px" src="{{url('/')}}/images/convertsound-fav.png"/></div>
									<audio class="form-control" name="dfy_soundpreview" id="dfy_soundpreview" controls>
										<source src="{{$campaign[0]->sound_src}}" type="audio/mpeg">
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

				<div class="row pt5" id="sound_details">
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
									<td>{{$campaign[0]->campaign_type}}</td>
									<td>{{$amazonsound[0]->language}}</td>									
									<td>{{$amazonsound[0]->voice_id}}</td>
									<td>{{$amazonsound[0]->text}}</td>
									<td><div class="sound_preview" data-soundsrc="{{$campaign[0]->sound_src}}"><span>Play </span><img height="20px" src="{{url('/')}}/images/convertsound-fav.png"/></div>
									<audio class="form-control" name="dfy_soundpreview" id="dfy_soundpreview" controls>
										<source src="{{$campaign[0]->sound_src}}" type="audio/mpeg">
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
				<div class="row actiontype" id="option_settings" style="display:block;">

					<div class="col-md-8 col-xs-8 col-sm-8 col-md-offset-2 pt5" >
					<p class="opt-title">Optin Settings <span class="tooltip1" title="Here are some basic settings for the widget, Please fill below fields for Widget."><i class="fa fa-info-circle"></i></span></p>

						<div class="form-group">
							<div class="col-md-12  col-xs-12 col-sm-12">
							<p class="setting-title">Optin Message  <span class="tooltip1" title="headline for the widget."><i class="fa fa-info-circle"></i></span></p>
								<input class="form-control" name="optin_message" id="optin_message" value="{{$campaign[0]->optin_message}}" required="required" placeholder="Write Optin Message"/>					
							</div>
						</div>
						<div class="form-group">
							<div class="col-md-12  col-xs-12 col-sm-12">
							<p class="setting-title">Optin Message in Skip Condition<span class="tooltip1" title="headline for the optin."><i class="fa fa-info-circle"></i></span></p>
								<input class="form-control" name="sp_optin_message" id="sp_optin_message" value="{{$campaign[0]->sp_optin_message}}" required="required" placeholder="Write Optin Message for Skip Condition Here"/>					
							</div>
						</div>

						<div class="form-group">
							<div class="col-md-12  col-xs-12 col-sm-12">
							<p class="setting-title">Thank You Message <span class="tooltip1" title="Description for the widget."><i class="fa fa-info-circle"></i></span></p>
								<input class="form-control" name="thankyou_message" id="thankyou_message" value="{{$campaign[0]->thankyou_message}}" required="required"  placeholder="Write Thank You Message on successful submission."/>					
							</div>
						</div>
<!-- 							<div class="form-group center pt5 mb10">
							<button type="submit" id="save_widget" class="btn btn-primary">Save Widget</button>
						</div> -->
					</div>
				</div>
			</div>



			<div class="row" id="page_url_settings" style="">				
				<div class="col-md-8 col-xs-8 col-sm-8 col-md-offset-2 pt5" >
					<p class="opt-title">Exclude Page Url Settings <span class="tooltip1" title="Here are some basic settings for the widget, Please fill below fields for Widget."><i class="fa fa-info-circle"></i></span></p>
				    <table id="myTable" class=" table order-list">
					    <thead>
					        <tr>
					            <td>Condition</td>
					            <td>URL</td>
					            <td>Action</td>
					        </tr>
					    </thead>
					    <tbody>
					    <?php 

				    	$excludepages=json_decode($campaign[0]->exclude_pages,true);
				    	if(count($excludepages)>0){
						    // print_r($excludepages);
						    $str='';
						    foreach ($excludepages as $key => $page) {
						    	$selected1='';
						    	$selected2='';
						    	if($page[0]=='contains'){
								$selected1='selected="selected"';
						    	}
						    	if($page[0]=='specific_url'){
								$selected2='selected="selected"';
						    	}


					        $str.='<tr>';
					        $str.='<td class="col-sm-4">';
						    $str.='<select class="form-control selectpicker" name="match_condition[]" class="match_condition">';
							$str.='<option value="contains" '.$selected1.'>Contains</option>';
							$str.='<option value="specific_url" '.$selected2.'>Specific URL</option>';
							$str.='</select>';
					        $str.='</td>';
					        $str.='<td class="col-sm-6">';
					        $str.='<input type="text" name="pageurl[]" value="'.$page[1].'" class="pageurl"/>';
					        $str.='</td>';
					        $str.='<td class="col-sm-2"><a class="deleteRow"></a>';
					        $str.='</td>';
					        $str.='</tr>';


						    	// echo $page[0] . '-' . $page[1];
						    }
			    		
				    		echo $str;
				    	}
				    	else{
						echo '<tr>
					            <td class="col-sm-4">
						            <select class="form-control selectpicker" name="match_condition[]" class="match_condition">
										<option value="contains">Contains</option>
										<option value="specific_url">Specific URL</option>
									</select>
					            </td>
					            <td class="col-sm-6">
					                <input type="text" name="pageurl[]"  class="pageurl"/>
					            </td>
					            <td class="col-sm-2"><a class="deleteRow"></a>
					            </td>
					        </tr>';				    		
				    	}
	
					    ?>

					    </tbody>
					    <tfoot>
					        <tr>
					            <td colspan="3" style="text-align: left;">
					                <input type="button" class="btn btn-lg btn-block btn-primary" id="addrow" value="+" />
					            </td>
					        </tr>
					        <tr>
					        </tr>
					    </tfoot>
					</table>
				</div>
			</div>


			<div class="row" id="page_url_settings" style="">				
				<div class="col-md-8 col-xs-8 col-sm-8 col-md-offset-2 pt5" >
					<p class="opt-title">Conditions: <span class="tooltip1" title="Here are some basic settings for the widget, Please fill below fields for Widget."><i class="fa fa-info-circle"></i></span></p>
					<div class="form-group">
						<div class="col-md-7">
							<p class="setting-title">Phone No in Optin Form <span class="tooltip1" title="Toggle it green for phone number in optin form."><i class="fa fa-info-circle"></i></span></p>							
						</div>
						<div class="col-md-5">
							<label class="switch pull-right">
							  <input type="checkbox" name="phone_no_optin" <?php if($campaign[0]->geo_redirect!='') { echo 'checked="checked"';} ?> id="phone_no_optin">
							  <span class="slider round"></span>
							</label>
						</div>
					</div>

					<div class="form-group">
						<div class="col-md-7">
							<p class="setting-title">Exit Intent Popup <span class="tooltip1" title="Choose play icon for widget."><i class="fa fa-info-circle"></i></span></p>							
						</div>
						<div class="col-md-5">
							<label class="switch pull-right">
							  <input type="checkbox" name="exit_intent_popup" <?php if($campaign[0]->exit_intent_pop!='') { echo 'checked="checked"';} ?> id="exit_intent_popup">
							  <span class="slider round"></span>
							</label>
						</div>
					</div>
					<div class="form-group">
						<div class="col-md-7">
							<p class="setting-title">Insite Trigger<span class="tooltip1" title="Choose play icon for widget."><i class="fa fa-info-circle"></i></span></p>							
						</div>
						<div class="col-md-5">
							<label class="switch pull-right">
							  <input type="checkbox" name="insite_trigger" <?php if($campaign[0]->insite_trigger !='') { echo 'checked="checked"'; $insitetrigger='active';} ?> id="insite_trigger">
							  <span class="slider round"></span>
							</label>
						</div>
						<div class="col-md-12  col-xs-12 col-sm-12 insite_trigger" <?php if(isset($insitetrigger) && $insitetrigger=='active') { echo 'style="display: block;"';} else { echo 'style="display: none;"';} ?> >
							<p class="setting-title">Add Trigger Elements <span class="tooltip1" title="Add the comma seperate element attributes like class, id or element. E.g. #idname, .classname , elementname"><i class="fa fa-info-circle"></i></span></p>
							<input class="form-control" name="trigger_elements" value="{{$campaign[0]->trigger_elements}}" id="trigger_elements" placeholder="Add Elements"/>					
						</div>
					</div>

					<div class="form-group" id="smart_targeting_option" style="display:block;">
						<p class="opt-title">Smart Targeting <span class="tooltip1" title="Select one of the option from the dropdown options."><i class="fa fa-info-circle"></i></span></p>
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
					<div class="form-group center pt10">
						<button type="submit" id="create_campaign" class="btn btn-primary">Save Campaign</button>
					</div>
				</div>
			</div>

			<div class="row" id="dfy_other_option" style="display:none;">
				<div class="col-md-8 col-xs-8 col-sm-8 col-md-offset-2" >
				<input type="hidden" min-value="0" name="repeat_trigger_time" id="repeat_trigger_time" class="form-control">
				</div>
			</div>
		</form>
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
							<a href="{{url('/campaign')}}"><button type="button" id="close_camp" class="btn btn-primary">Finish</button></a>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="form-group center pt10">
						<button type="button" id="editlink" class="btn btn-primary">Back</button>
						<button type="button" id="preview" class="btn btn-primary">Preview</button>
						<button type="button" id="addnewcampaign" class="btn btn-primary">Add New Campaign</button>
					</div>
				</div>
			</div>
		</div>


	</div>
</div>


<div class="modal fade cancelModal" id="selectsoundniche" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="row" id="variation_section" style="display:block;">
				<div class="col-md-8 col-xs-8 col-sm-8 col-md-offset-2 pt10">
					<p class="opt-title">Choose Voice Variation <span class="tooltip1" title="This is my image's tooltip message!"><i class="fa fa-info-circle"></i></span></p>
					<div class="col-md-8 col-xs-8 col-sm-8 col-md-offset-2">
						<div class="col-md-6 col-xs-6 col-sm-6 vv" style="cursor:pointer">
							<div class="vv-box" data-value="male" id="voicemale">
								<img class="vv-img" src="{{url('/images/male.jpg')}}">
								<div class="vv-title">Male</div> 
							</div>
						</div>
						<div class="col-md-6 col-xs-6 col-sm-6 vv" style="cursor:pointer">
							<div class="vv-box" data-value="female" id="voicefemale">
								<img class="vv-img" src="{{url('/images/female.jpg')}}""/>
								<div class="vv-title">Female</div> 
							</div>
						</div>
						<input type="hidden" name="voice_variation" value="" id="voice_variation">
					</div>
				</div>
			</div>	
			<div id="dfy_variation_section" style="display:none;">
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
										@foreach ($niche as $value)
										<option  value="{{ $value->id }}">{{ $value->niche_category }}</option>
										@endforeach
									</select>
								</div>
								<div class="col-md-4 col-xs-12 col-sm-4">
									<label class="popup_label">Traffic Source:</label>
									<select class="trafficsource form-control selectpicker" name="trafficsource">
										<option value="-1">Any Source</option>
										@foreach ($trafficsource as $value)
										<option  value="{{ $value->id }}">{{ $value->sourcename }}</option>
										@endforeach
									</select>
								</div>
							</div>
						</div>

					</div>
				</div>
				{{ csrf_field() }}
				<div class="modal-body">
					<div class="row">
						<div class="col-md-8 col-xs-12 col-sm-8">
							<h4 class="modal-title">Templates:</h4>
							<hr/>
							<div class="soundniches">
								<div class="radio-group">
									@foreach ($soundniche as $key=>$sn)
									@foreach ($niche as $value)
									@if($key==$value->id)
									<div class="single_niche" data-nicheid="{{ $value->id }}">
										<div class="niche-title">{{$value->niche_category}}</div>
										@foreach($sn as $k=>$sound)
										@foreach ($trafficsource as $val)
										@if($k==$val->id)
										<div class="single_sound">
											<div class='radio' data-sid="{{$val->id}}" data-variation="{{ $sound->variation }}" data-source="{{ $sound->id }}" data-value="{{url($sound->sound_url)}}"><img src="{{ url('/images/convertsound-fav.png')}}" alt="Sound preview" title="Select to play">

												<div class="source-title">{{$val->sourcename}}</div>	  			
											</div>
										</div>
										@endif
										@endforeach
										@endforeach
									</div>
									@endif
									@endforeach
									@endforeach
									<input type="hidden" id="radio-value" name="sound_url"/>
									<input type="hidden" id="sound_id" name="sound_id"/>
								</div>
							</div>
						</div>
						<div class="col-md-4 col-xs-12 col-sm-4">
							<h4 class="modal-title">Sound Preview:</h4>
							<img src="{{ url('/images/convertsound-fav.png')}}" id="playpause" alt="play/pause" title="To Play Click Here">

							<div id="playpause" alt="play/pause" title="To Play Click Here" class="pp" style=""><i class="fa fa-volume-up"></i>
								<p>Select sound template from the templates section and click above icon to play/pause.</p>
							</div>
							<audio class="form-control" name="dfy_soundpreview" id="dfy_soundpreview" controls>
								<source src="{{ url('/uploads/sound/')}}" type="audio/mpeg">
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
	</div>
	<div class="modal fade cancelModal" id="texttospeech" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button aria-hidden="true" data-dismiss="modal" class="close" type="button">&times;</button>
				</div>
				{{ csrf_field() }}
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


											@foreach ($language as $value)
											<!-- <option  value="{{ $value->language_code }}">{{ $value->language_name }}</option> -->
											@endforeach
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
										<img src="{{ url('/images/convertsound-fav.png')}}" id="t2s_playservice" alt="play/pause" title="To Play Click Here">
										<audio class="form-control" name="t2s_soundpreview" id="t2s_soundpreview" controls>
											<source src="{{ url('/uploads/sound/')}}" type="audio/mpeg">
												Your browser does not support the audio tag.
										</audio>
										<input type="hidden" name="sound_src" id="sound_src">

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


<div class="modal fade cancelModal" id="selectimageupload" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="row" id="variation_section" style="display:block;">
				<div class="col-md-12">
					<form enctype="multipart/form-data" method="PUT" id="form-edit-post">  
						{{ csrf_field() }}
					    <div class="modal-header">
					        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
					        	<span aria-hidden="true">×</span>
				        	</button>
							<p class="opt-title">Choose file to upload<span class="tooltip1" title="This is my image's tooltip message!"><i class="fa fa-info-circle"></i></span></p>
					    </div>
					    <div class="modal-body">
							<div class="form-group">
								<div class="col-md-4  col-xs-12 col-sm-12">
								<p class="setting-title">Select an image to upload: <span class="tooltip1" title="Select an image file to upload."><i class="fa fa-info-circle"></i></span></p>				
								</div>
								<div class="col-md-8 col-xs-12 col-sm-12">
									<input type="file" name="imageedit" class="imageedit">
									<input type="hidden" name="id" id="id" value="20">
									<input type="hidden" name="uploadfor" id="uploadfor" value="">
								</div>
							</div>
					    </div>
					    <div class="modal-footer">
					        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cancel</button>
					        <button type="submit" class="btn btn-primary">Upload</button>
					    </div>
					</form>
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
		// window.scrollBy(0, s);
		s = s + 5;
		if(s==x)
		{
			clearInterval(refreshId);
		}	
	}, y);

}

jQuery('.campaign-action-box').click(function(){
	$('.campaign-action-box').removeClass('selected');
	$(this).addClass('selected');
	var cab=$(this).data('type');
	$('#action_type').val(cab);
	$('.actiontype').fadeOut();
	$('#'+cab+'_option').fadeIn	(200);
});



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
		// 	url: "{{url('/t2speech/ajax')}}",
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
	// autoscrollby();
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
	$('#dfy_variation_section').fadeIn(300);
	$('#variation_section').fadeOut(200);

	var vv=$(this).data('value');
	$('#variation').prop('disabled',false);
	$('#variation').selectpicker('val', vv);
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
		$('#voice_variation').val(vv);
		

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
			$('#dfy').addClass('selected');

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
			$('#t2s').addClass('selected');

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
	var campaign_name=$('#campaign_name').val();
	var campaign_type=$('#campaign_type').val();
	var voice_variation=$('#voice_variation').val();
	var sound_niche=$('.niche_category').val();
	var traffic_source=$('.trafficsource').val();
	var sound_src=$('#radio-value').val();
	var widget_id=$('#widget_id').val();
	var action_type=$('#action_type').val();
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
	var script_name=Date.now();

	if(ajaxchk==true){
		ajaxchk=false;

		$.ajax({
			type: "GET",
			url: "{{url('/campaign/ajaxsave')}}",
			data:'domain_name='+domain_name+'&domain_id='+domain_id+'&campaign_name='+campaign_name+'&campaign_type='+campaign_type+'&voice_variation='+voice_variation+'&sound_niche='+sound_niche+'&traffic_source='+traffic_source+'&sound_src='+sound_src+'&widget_id='+widget_id+'&action_type='+action_type+'&trigger_time='+trigger_time+'&scroll_height='+scroll_height+'&repeat_trigger_time='+repeat_trigger_time+'&script_name='+script_name,
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
			url: "{{url('/t2speech/ajax')}}",
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



$('#topbar_color').colorpicker();
$('#topbar_bg').colorpicker();
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
			url: "{{url('/campaign/savewidget')}}",
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




    var counter = 0;

    $("#addrow").on("click", function () {
        var newRow = $("<tr>");
        var cols = "";
		cols+= '<td class="col-sm-4">\
		        	<select class="form-control selectpicker" name="match_condition[]" class="match_condition">\
		        	<option value="onload">Contains</option>\
					<option value="trigger_time">Specific URL</option>\
					</select>\
		        </td>';
		cols+= '<td class="col-sm-6"> <input type="text" name="pageurl[]"  class="pageurl"/></td>';
        cols += '<td><input type="button" class="ibtnDel btn btn-md btn-danger "  value="Delete"></td>';
        newRow.append(cols);
        $("table.order-list").append(newRow);
		jQuery('select').selectpicker('refresh');
        counter++;
    });
     jQuery("table.order-list").on("click", ".ibtnDel", function (event) {
        jQuery(this).closest("tr").remove();       
        counter -= 1
    });

$('#insite_trigger').click(function(){
	if($(this).is(':checked')){
		$('.insite_trigger').slideDown(200);
	}
	else{
		$('.insite_trigger').slideUp(200);
	}
});


var ajaxchk3=true;
$('#widget_action1').submit(function(e){
	var formdata=$(this).serialize();

	var domain_name=$('#domain_name').val();	
	var domain_id=$('#domain_id').val();	
	var campaign_name=$('#campaign_name').val();
	var campaign_type=$('#campaign_type').val();
	var voice_variation=$('#voice_variation').val();
	var sound_niche=$('.niche_category').val();
	var traffic_source=$('.trafficsource').val();
	var sound_src=$('#radio-value').val();
	var widget_id=$('#widget_id').val();

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
	var script_name='{{$campaign[0]->script_name}}';

	console.log(formdata);
	e.preventDefault();
	if(ajaxchk3==true){
		ajaxchk3=false;

		$.ajax({
			url: "{{url('/campaign/ajaxupdate')}}",
			type: "GET",
			processData: false,
			data:formdata+'&domain_name='+domain_name+'&domain_id='+domain_id+'&voice_variation='+voice_variation+'&sound_niche='+sound_niche+'&traffic_source='+traffic_source+'&sound_src='+sound_src+'&trigger_time='+trigger_time+'&scroll_height='+scroll_height+'&repeat_trigger_time='+repeat_trigger_time+'&script_name='+script_name,
			success: function(data){
				jQuery('#copycode').text("<script type='text/javascript' src='"+data+"'><\/script>");
				$('#step2').slideUp();
				$('#step3').show();	
				console.log(data);
				ajaxchk3=true;
			}
		});

	}
});


function isImage(filename) {
    var ext = getExtension(filename);
    switch (ext.toLowerCase()) {
    case 'jpg':
    case 'gif':
    case 'bmp':
    case 'png':
        //etc
        return true;
    }
    return false;
}

$('.upload_image').click(function(){
	var upfor=$(this).data('value');
	$('#uploadfor').val(upfor);
	jQuery('#form-edit-post')[0].reset();

});

jQuery('#form-edit-post').submit(function(event){
	event.preventDefault();
	var form = new FormData();
	    var image = $('#form-edit-post .imageedit')[0].files[0];
	    form.append('imageedit', image);
    var upfor=$('#uploadfor').val();
    $('.loader-bg').show(100);
	$.ajax({
	    url: '/campaign/uploadimage',
	    data: form,
		cache: false,
		contentType: false,
		processData: false,
		type: "post",
		beforeSend: function (xhr) {
		var token = $('meta[name="csrf_token"]').attr('content');
			if (token) {
			      return xhr.setRequestHeader('X-CSRF-TOKEN', token);
			}                
		},
	    success:function(response) {
	        $('#'+upfor).val("{{url('/')}}"+'/'+response);
        	$('#'+upfor+'_font').hide();
	        $('#'+upfor+'_preview').attr('src', ("{{url('/')}}"+'/'+response));
        	$('#'+upfor+'_preview').show();
        	$('#selectimageupload').modal('toggle');
        	jQuery('#form-edit-post')[0].reset();
        	$('.loader-bg').hide(100);

	    }
	});
  
});

</script>
@endsection
