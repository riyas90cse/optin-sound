@extends('layouts.website')
@section('content')
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
<div class="contentpanel">
<div id="page-wrapper">
	<div class="campsection step1" id="step1">
	    <div class="row">
		    <div class="col-md-12">
				<div class="step-heading">STEP 1: Enter Domain Name to create Campaign</div>
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

		    <div class="row">
				<div class="col-md-10 col-md-offset-1 pt10">
		    		<div class="col-md-8">
				    	<input type="text" class="big-inputs" placeholder="Enter Your Domain" name="domain_name" id="domain_name" required="">
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
	<div class="campsection step2" id="step2">
	    <div class="row">
		    <div class="col-md-12">
				<div class="step-heading">STEP 2: Choose Your Sound Campaign</div>
			</div>
		</div>
		<div class="row">
	        <!-- col -->
            <div class="col-md-8 col-xs-8 col-sm-8 col-md-offset-2 pt10">
            <!-- <h2 class="m-t-0 m-b-5 font-light counter">Choose From:</h2> -->
            <div class="col-md-4 col-xs-12 col-sm-4" style="cursor:pointer">
                <div class="campaign-option-box" id="dfy">
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
                <div class="campaign-option-box" id="t2s">
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
                <div class="campaign-option-box" id="cu">
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
            </div>
        </div>
	
		<div class="row" id="variation_section" style="display:none;">
	        <div class="col-md-8 col-xs-8 col-sm-8 col-md-offset-2 pt10">
	            <div class="col-md-4 col-xs-12 col-sm-4">
	        	Voice Variation:
				</div>
	            <div class="col-md-4 col-xs-12 col-sm-4" style="cursor:pointer">
	        	Male <input type="radio" class="voice_variation" name="voice_variation" data-toggle="modal" data-target="#selectsoundniche" value="male" id="voicemale">
				</div>
	            <div class="col-md-4 col-xs-12 col-sm-4" style="cursor:pointer">
	        	Female <input type="radio" class="voice_variation" name="voice_variation" data-toggle="modal" data-target="#selectsoundniche" value="female" id="voicefemale"> 
				</div>
			</div>
			<div class="modal fade cancelModal" id="selectsoundniche" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false">
	            <div class="modal-dialog">
	              <div class="modal-content">
	                  <div class="modal-header">
	                      <!-- <button aria-hidden="true" data-dismiss="modal" class="close" type="button">&times;</button> -->
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
										<label class="popup_label">Traffic Source:</label>
										<select class="trafficsource form-control selectpicker" name="trafficsource">
											<option value="-1">Any Source</option>
											@foreach ($trafficsource as $value)
											<option  value="{{ $value->id }}">{{ $value->sourcename }}</option>
											@endforeach
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
	        					</div>
	        				</div>

	                      </div>
	                  </div>
	                  <form class="form-vertical" method="post" action="{{ url('/') }}">
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
											<?php if($k==$val->id){?>
	    							  		<div class="single_sound">
												<div class='radio' data-sid="{{$val->id}}" data-source="{{ $sound->id }}" data-value="{{url($sound->sound_url)}}"><img src="{{ url('/images/convertsound-fav.png')}}" alt="Sound preview" title="Select to play">

												<div class="source-title">{{$val->sourcename}}</div>	  			
												</div>
	    							  		</div>
	    							  		<? }?>
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
								<audio class="form-control" name="dfy_soundpreview" id="dfy_soundpreview" controls>
								  <source src="{{ url('/uploads/sound/')}}" type="audio/mpeg">
								  Your browser does not support the audio tag.
								</audio> 
	        				</div>
	                  </div>
	                  <div class="modal-footer">
				        <button type="button" id="dfy_option" class="btn btn-primary">Next</button>
				      </div>
				      </form>
	              </div>
	            </div>
	        </div>
		</div>
	</div>

	<div class="campsection step3" id="step3">

		
	</div>

</div>
</div>


<script type="text/javascript">
	$('#action1').submit(function(e){
		e.preventDefault();
		// alert($('#domain_name').val());
		$('#step1').slideUp();	
		$('#step2').show();	
	});
	$('#dfy').click(function(){
		$('#variation_section').slideDown();
	});


	$('.trafficsource').change(function(){
		var sv = $(this).val();	
		if(sv=='-1'){
			$('.radio').show();			
		}
		else{
			$('.radio').hide();
			$('.radio').each(function(){
				var sid=$(this).data('sid');
				if(sv==sid){
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

	$('.voice_variation').click(function(){
		var vv=$(this).val();
		// alert(vv);
		if(vv=='male')
		{
			$("#variation option").filter(function() {
			    return $(this).text() == vv; 
			}).attr('selected', true);
			$('#variation').prop('disabled',true);

		}
		if(vv=='female')
		{
			$("#variation option").filter(function() {
			    return $(this).text() == vv; 
			}).attr('selected', true);
			// $('#variation').val('female');
			$('#variation').prop('disabled',true);
		}
	});
	$('.radio-group .radio').click(function(){
	    $('.single_niche').find('.radio').removeClass('selected');
	    $(this).addClass('selected');
	    var val = $(this).attr('data-value');
	    var id = $(this).attr('data-source');
	    //alert(val);
	    $('#radio-value').val(val);
	    $('#sound_id').val(val);
		$('#dfy_soundpreview').attr('src',val);

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
		   $('#selectsoundniche').modal('toggle');
		});
	});

</script>
@endsection
