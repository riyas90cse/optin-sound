<?php $__env->startSection('content'); ?>

<div class="contentpanel campaign-page">
	<div id="page-wrapper">

		<div class="row" id="campaign_type_section" style="display:block;">
			<!-- col -->
			<div class="col-md-8 col-xs-8 col-sm-8 col-md-offset-2 pt5">
			<p class="opt-title">Sound Settings <span class="tooltip1" title="Sound Setting."><i class="fa fa-info-circle"></i></span></p>
			
				<!-- <h2 class="m-t-0 m-b-5 font-light counter">Choose From:</h2> -->
				<div class="col-md-4 col-xs-12 col-sm-4" style="cursor:pointer">
					<div class="campaign-option-box" id="dfy" data-toggle="modal" data-target="#selectsoundniche" data-type="Done For You">
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
			</div>
		</div>

	</div>
</div>

<div class="modal fade cancelModal" id="selectsoundniche" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="row" id="variation_section" style="display:block;">
				<div class="col-md-12">
					<form enctype="multipart/form-data" method="PUT" id="form-edit-post">  
						<?php echo e(csrf_field()); ?>

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

$('#form-edit-post').submit(function(event){
	event.preventDefault();
	var form = new FormData();
	    var image = $('#form-edit-post .imageedit')[0].files[0];
	    form.append('imageedit', image);

	$.ajax({
	    url: '/apiintegraion/upload',
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
	        alert(response);
	    }
	});
  
});





</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.website', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>