@extends('layouts.website')
@section('content')
<style type="text/css">
	.setting-title{padding: 0 10px 0;}
</style>
<div class="contentpanel campaign-page">
	<div id="page-wrapper">
		<div style="display:block;">
			<div class="content">
				<form method="get" id="widget_action1" action="{{ url('campaign/savewidget') }}">

				<div class="row" id="action_section">					
					<div class="col-md-10 col-xs-10 col-sm-10 col-md-offset-1 pt5" style="display:block;">
						
							<div class="form-group">
								<p class="setting-title">Overlay Name <span class="tooltip1" title="Write overlay name in below input."><i class="fa fa-info-circle"></i></span></p>
								<div class="col-md-12">
									<input type="text" class="form-control" name="overlay_name" id="overlay_name" required="required" placeholder="Write Overlay Name"/>	
								</div>
							</div>
							<div class="form-group">
								<p class="setting-title">Overlay Site Url <span class="tooltip1" title="Enter the site url which will be overlayed in jacker."><i class="fa fa-info-circle"></i></span></p>
								<div class="col-md-12">
									<input type="text" class="form-control" name="overlay_siteurl" id="overlay_siteurl" required="required" placeholder="Write Overlay Site Url"/>	
								</div>
							</div>

							<div class="form-group">
								<p class="setting-title">Custom Link <span class="tooltip1" title="Create add a unique link for your campaign url."><i class="fa fa-info-circle"></i></span></p>
								<div class="col-md-12">
									<span class="custom_url_part1" id="">{{url('/')}}/overlay/</span><input type="text" class="custom_url_part2" name="handle" id="handle" required="required" placeholder="Write Unique Handle Name"/>
								</div>
							</div>

							<div class="form-group">
								<p class="setting-title">Meta Title <span class="tooltip1" title="Add Meta Title for buffer integration/share widget."><i class="fa fa-info-circle"></i></span></p>
								<div class="col-md-12">
									<input type="text" class="form-control" name="meta_title" id="meta_title" placeholder="Write Meta Title"/>	
								</div>
							</div>
							<div class="form-group">
								<p class="setting-title">Meta Description <span class="tooltip1" title="Add Meta Description for buffer integration/share widget."><i class="fa fa-info-circle"></i></span></p>
								<div class="col-md-12">
									<input type="text"  class="form-control" name="meta_description" id="meta_description"  placeholder="Write Meta Description"/>
								</div>
							</div>
							<div class="form-group">
								<p class="setting-title">Meta Image <span class="tooltip1" title="Upload Meta Image for buffer integration/share widget."><i class="fa fa-info-circle"></i></span></p>
								<div class="col-md-6">
									<p data-toggle="modal" data-target="#selectimageupload" class="upload_image" data-value="meta_image">
										<i id="meta_image_font" class="fa fa-upload"></i>
										<img id="meta_image_preview" class="play_icon" src="" style="display: none;" width="70px" height="70px">
										<input type="hidden"  name="meta_image" id="meta_image"/>
									</p>
								</div>
							</div>

							<div class="form-group">
								<p class="setting-title">Choose Campaign <span class="tooltip1" title="Select Campaign "><i class="fa fa-info-circle"></i></span></p>
								<div class="col-md-12">
									<select class="form-control selectpicker" id="campaign_id"  required="required" name="campaign_id">
										<option value="-1"></option>
										@foreach ($campaigns as $value)
										<option  value="{{ $value->id }}">{{ $value->campaign_name }}</option>
										@endforeach
									</select>
								</div>
							</div>
							<div class="form-group">
								<p class="setting-title">Remarketing Pixel <span class="tooltip1" title="Add marketing pixel for the page."><i class="fa fa-info-circle"></i></span></p>
								<div class="col-md-12">
									<textarea id="remarketing_pixel" name="remarketing_pixel" style="width: 100%;"></textarea>
								</div>
							</div>
							<div class="form-group center pt10">
								<button type="submit" id="save_campaign" class="btn btn-primary">Create Campaign</button>
							</div>
						
					</div>
				</div>
				</form>
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

<div class="modal fade cancelModal" id="buffershare" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="row" id="variation_section" style="display:block;">
				<div class="col-md-12">
				    <div class="modal-header">
				        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
				        	<span aria-hidden="true">×</span>
			        	</button>
				    </div>
				    <div class="modal-body">
						<p class="opt-title center">Overlay Link Created Successfully! <span class="tooltip1" title="Copy Below link and past in browser for overlay campaign preview!"><i class="fa fa-info-circle"></i></span></p>

						<p class="center">
							<a href="" class="overlaylink" target="_blank" style="font-weight: bold;"></a>
							<a href="#" class="copybutton" data-copy=""><i class="fa fa-copy"></i></a>
						</p>
						<p class="center">
						<a href="#" class="shareCampaign btn btn-primary" data-sharelink="" data-handle="" data-sharenetwork="facebook"><i class="fa fa-facebook-square"></i> Share on Facebook</a>
						</p>
						<p class="center">
						<a href="#" class="shareCampaign btn btn-primary" data-sharelink="" data-handle="" data-sharenetwork="twitter"><i class="fa fa-twitter-square"></i> Share on Twitter</a> 
						</p>

						<p class="center">
						<a href="#" class="shareCampaign btn btn-primary" data-sharelink="" data-handle="" data-sharenetwork="gplus"><i class="fa fa-google-plus-square"></i> Share on Google Plus</a> 
						</p>
						
						<p class="center">
						<a href="#" class="shareCampaign btn btn-primary" data-sharelink="" data-handle="" data-sharenetwork="linkedin"><i class="fa fa-linkedin-square"></i> Share on LinkedIn</a> 
						</p>
						<p class="center">
						<a href="#" class="shareCampaign btn btn-primary" data-sharelink="" data-handle="" data-sharenetwork="pinterest"><i class="fa fa-pinterest-square"></i> Share on Pinterest</a>
						</p>
					</div>

				    <div class="modal-footer">
				        <button type="button" class="btn btn-default pull-right" data-dismiss="modal">Close</button>
				    </div>
			    </div>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">

var ajaxchk3=true;

jQuery('#widget_action1').submit(function(e){
	var formdata=$(this).serialize();

	var domain_name='';
	var domain_id='';
	var campaign_name=$('#campaign_id option:selected').text();

	console.log(formdata);
	e.preventDefault();
	if(ajaxchk3==true){
		ajaxchk3=false;
		$.ajax({
			url: "{{url('/overlay/ajaxsave')}}",
			type: "GET",
			processData: false,
			data:formdata+'&domain_name='+domain_name+'&domain_id='+domain_id+'&campaign_name='+campaign_name,
			success: function(data){
				var ol='{{url("/")}}/overlay/'+$('input[name="handle"]').val();
				$('.overlaylink').html(ol);
				$('.overlaylink').attr('href',ol);
				$('.copybutton').data('copy',ol);
				$('.shareCampaign').data('sharelink',ol);
				$('.shareCampaign').data('handle',$('input[name="handle"]').val());
	        	$('#buffershare').modal('toggle');
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
});


jQuery('#form-edit-post').submit(function(event){
	event.preventDefault();
	var form = new FormData();
	    var image = $('#form-edit-post .imageedit')[0].files[0];
	    form.append('imageedit', image);
    var upfor=$('#uploadfor').val();
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
	        $('#'+upfor).val('{{url("/")}}'+'/'+response);
        	$('#'+upfor+'_font').hide();
	        $('#'+upfor+'_preview').attr('src', ('{{url("/")}}'+'/'+response));
        	$('#'+upfor+'_preview').show();
        	$('#selectimageupload').modal('toggle');
	    }
	});
  
});
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
@endsection
