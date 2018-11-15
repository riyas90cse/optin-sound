<?php $__env->startSection('content'); ?>
<div class="pageheader">
		<div class="media">
        <div class="media-body">
    	<h4>Add Facility</h4>
        <ul class="breadcrumb">
            <li><a href="<?php echo e(url('/')); ?>"><i class="glyphicon glyphicon-home"></i></a></li>
            <li>Masters</li>
            <li>Facility</li>
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
		<form method="post" action="<?php echo e(url('facility/save')); ?>" id="valWizard" class="panel-wizard">
		<?php echo e(csrf_field()); ?>

            <ul class="nav nav-justified nav-wizard nav-disabled-click">
                <li><a href="#tab1-4" data-toggle="tab"><strong>Step 1:</strong> Facility</a></li>
                <li><a href="#tab2-4" data-toggle="tab"><strong>Step 2:</strong> Rebate For AVCC</a></li>
                <li><a href="#tab3-4" data-toggle="tab"><strong>Step 3:</strong> Booking Rate</a></li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane" id="tab1-4">
                    <div class="form-group">
					      <label>*Facility Type:</label>
					      <select class="form-control" name="facility_type" id="facility_type" required="">
					      		<option value="">Select</option>
					      		<?php $__currentLoopData = $facilitytype; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
					      		<option value="<?php echo e($value->id); ?>"><?php echo e($value->name); ?></option>
					      		<?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
					      </select>
					</div>
					<div class="form-group">
					    <label>*Name:</label>
					    <input type="text" class="form-control" placeholder="Enter name" name="name" id="name" required="">
					</div>
					<div class="form-group">
					<label>Tax:</label>
					  <div class="form-group">
						  <div>
						  	<?php if(count($tax)>0){ ?>
						  	<?php $__currentLoopData = $tax; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
							  <label class="checkbox-inline"><input type="checkbox" name="taxes[]" value="<?php echo $value->id; ?>"><?php echo $value->name; ?></label>
							<?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
							<?php } else{ ?>
							  <label class="checkbox-inline"><input type="checkbox" name="taxes[]" checked="" disabled="">Tax Free</label>
							<?php } ?>
						  </div>
					  </div>
				  </div>
                </div><!-- tab-pane -->
                <div class="tab-pane" id="tab2-4">
                    <div class="form-group">
					    <label>Safai(Amt):</label>
					    <input type="number" class="form-control" placeholder="Enter safai amount" name="rebate_safai" id="rebate_safai">
					</div>
					<div class="form-group">
					    <label>Tentage(Amt):</label>
					    <input type="number" class="form-control" placeholder="Enter tentage amount" name="rebate_tentage" id="rebate_tentage">
					</div>
					<div class="form-group">
					    <label>Electricity(Amt):</label>
					    <input type="number" class="form-control" placeholder="Enter electricity amount" name="rebate_electricity" id="rebate_electricity">
					</div>
					<div class="form-group">
					    <label>Catering(%):</label>
					    <input type="number" class="form-control" placeholder="Enter catering" name="rebate_catering" id="rebate_catering" step="0.01">
					</div>
					<div class="form-group" style="display: none">
					    <label>Service Tax(%):</label>
					    <input type="number" class="form-control" placeholder="Enter service tax" name="rebate_servicetax" id="rebate_servicetax" step="0.01">
					</div>
					<div class="form-group" style="display: none">
					    <label>VAT(%):</label>
					    <input type="number" class="form-control" placeholder="Enter VAT" name="rebate_vat" id="rebate_vat" step="0.01">
					</div>
                </div>
                <div class="tab-pane" id="tab3-4">
                    <table class="table table-bordered">
				      <tbody>
				      	<tr>
				      	  <td width="150px">
				      	  	<select class="form-control" name="member_type" id="member_type">
					      		<option value="">Member Type</option>
					      		<?php $__currentLoopData = $membertype; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
					      		<option value="<?php echo e($value->id.'#'.$value->name); ?>"><?php echo e($value->name); ?></option>
					      		<?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
					        </select>
				      	  </td>
						  <td class="noerror"><input type="number" class="form-control" name="booking_rate" id="booking_rate" placeholder="Booking Rate" min="0"></td>

						  <td class="noerror"><input type="number" class="form-control" name="generator_charges" id="generator_charges" placeholder="Electricity/Generator" min="0"></td>
						  <td class="noerror"><input type="number" class="form-control" name="ac_charges" id="ac_charges" placeholder="AC Charges" min="0"></td>
						  <td class="noerror"><input type="number" class="form-control" name="safai_general" id="safai_general" placeholder="Safai &amp; General" min="0"></td>
						  <td class="noerror"><input type="number" class="form-control" name="security_charges" id="security_charges" placeholder="Security" min="0"></td>
						  <td class="noerror"><a onclick="add_bookingrate();" class="add_button" href="javascript:void(0);" title="Add field"><img src="<?php echo e(url('images/add-icon.png')); ?>"></a></td>
						</tr>
				      </tbody>
					</table>
					<table class="table table-bordered">
						<tr>
							<th>Member Type</th>
							<th>Booking Rate</th>
							<th>Electricity/Generator Charges</th>
							<th>AC Charges</th>
							<th>Safai &amp; General</th>
							<th>Security Charges</th>
							<th>Action</th>
						</tr>
						<tbody class="field_wrapper">
							<tr class="no-data">
								<td colspan="7">No data found!</td>
							</tr>
						</tbody>
					</table>
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
function add_bookingrate(){
	var member_type = document.getElementById("member_type").value;
	var membertype_explode = member_type.split("#");
	var booking_rate = document.getElementById("booking_rate").value;
	var generator_charges = document.getElementById("generator_charges").value;
	var ac_charges = document.getElementById("ac_charges").value;
	var safai_general = document.getElementById("safai_general").value;
	var security_charges = document.getElementById("security_charges").value;
	if(member_type!='' && booking_rate!='' && generator_charges!='' && safai_general!='' && security_charges!=''){
		var fieldHTML = '<tr><td class="center"><span>'+membertype_explode[1]+'</span><input type="hidden" name="member_type[]" value="'+membertype_explode[0]+'"></td><td class="center"><span>'+booking_rate+'</span><input type="hidden" name="booking_rate[]" value="'+booking_rate+'"></td><td class="center"><span>'+generator_charges+'</span><input type="hidden" name="generator_charges[]" value="'+generator_charges+'"></td><td class="center"><span>'+ac_charges+'</span><input type="hidden" name="ac_charges[]" value="'+ac_charges+'"></td><td class="center"><span>'+safai_general+'</span><input type="hidden" name="safai_general[]" value="'+safai_general+'"></td><td class="center"><span>'+security_charges+'</span><input type="hidden" name="security_charges[]" value="'+security_charges+'"></td><td><a href="javascript:void(0);" class="remove_button" title="Remove field"><img src="<?php echo e(url("images/remove-icon.png")); ?>"></a></td></tr>';
		if(x < maxField){
			x++;
			$(wrapper).append(fieldHTML);
		}
		$('.no-data').hide();
	    document.getElementById("member_type").value = "";
	    document.getElementById("booking_rate").value = "";
	    document.getElementById("generator_charges").value = "";
	    document.getElementById("ac_charges").value = "";
	    document.getElementById("safai_general").value = "";
	    document.getElementById("security_charges").value = "";
	}
	else{
		alert("Kindly fill all the details");
		if(document.getElementById("member_type").value == ''){
			document.getElementById("member_type").focus();
			return false;
		}
		if(document.getElementById("booking_rate").value == ''){
			document.getElementById("booking_rate").focus();
			return false;
		}
		if(document.getElementById("generator_charges").value == ''){
			document.getElementById("generator_charges").focus();
			return false;
		}
		if(document.getElementById("ac_charges").value == ''){
			document.getElementById("ac_charges").focus();
			return false;
		}
		if(document.getElementById("safai_general").value == ''){
			document.getElementById("safai_general").focus();
			return false;
		}
		if(document.getElementById("security_charges").value == ''){
			document.getElementById("security_charges").focus();
			return false;
		}
	}
}
jQuery(document).ready(function() {
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