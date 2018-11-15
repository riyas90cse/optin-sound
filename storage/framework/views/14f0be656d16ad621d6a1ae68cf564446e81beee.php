<?php $__env->startSection('content'); ?>
<div class="pageheader">
		<div class="media">
        <div class="pageicon pull-left">
            <i class="fa fa-share"></i>
        </div>
        <div class="media-body">
    	<h4>Integration Board</h4>
        <ul class="breadcrumb">
            <li><a href="<?php echo e(url('')); ?>"><i class="glyphicon glyphicon-home"></i></a></li>
            <li>Integrations</li>
        </ul>
    	</div>
    </div><!-- media -->
</div><!-- pageheader -->

<!-- https://hooks.zapier.com/hooks/catch/3402502/anfj45/?name=vipin&email=vipin-gmail.com&phone=9898778774 -->
<!-- https://hooks.zapier.com/hooks/catch/3402502/anfj45/  -->

<div class="contentpanel">
    <div id="page-wrapper"> 

        <div class="row">
                <!-- col -->
                <div class="col-md-8 col-md-offset-2">
                    <div class="row">
                        <!-- <div class="col-md-4 col-xs-12 col-sm-4" onclick="window.location='/domain/add'" style="cursor:pointer"> -->
                        <div class="col-md-6 col-xs-12 col-sm-6" style="cursor:pointer">
                            <div class="white-box">
                                <div class="bar-widget">
                                    <div class="info_button pull-right"><span class="tooltip1" title="This is my image's tooltip message!"><i class="fa fa-info-circle"></i></span></div>
                                    <div class="table-box">
                                        <div class="table-detail text-center">
                                            <div class="big-icons"><img src="<?php echo e(url('images/aweber_logo.jpeg')); ?>"></div>
                                            <!-- <div class="action-buttons"> -->
<?php if(array_key_exists('aweber',$integrations)){ ?>
                                                <a class="btn btn-primary inactive aweber"  id="awbcbtn" href="/aweberauth">Connect</a>
                                                <button class="btn btn-primary" id="aweber" data-toggle="modal" data-target="#aweberconnect">Configure</button>
                                                <button class="btn btn-primary disconnect" id="awbd" data-app="aweber">Disconnect</button>
<?php } else { ?>
                                                <a class="btn btn-primary active" id="awbcbtn" href="/aweberauth">Connect</a>
<?php } ?>
                                            <!-- </div> -->,
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-xs-12 col-sm-6" style="cursor:pointer">
                            <div class="white-box">
                                <div class="bar-widget">
                                    <div class="info_button pull-right"><span class="tooltip1" title="This is my image's tooltip message!"><i class="fa fa-info-circle"></i></span></div>
                                    <div class="table-box">
                                        <div class="table-detail text-center">
                                            <div class="big-icons"><img src="<?php echo e(url('images/Zapier_logo.png')); ?>"></div>
<?php if(array_key_exists('zapier',$integrations)){ ?>
                                            <button class="btn btn-primary inactive zapier" id="zapc" data-toggle="modal" data-target="#zapierconnect">Connect</button>
                                            <button class="btn btn-primary" id="zapier" data-toggle="modal" data-target="#zapierconnect">Configure</button>
                                            <button class="btn btn-primary disconnect" id="zapd" data-app="zapier">Disconnect</button>            
<?php } else { ?>
                                            <button class="btn btn-primary" id="zapc" data-toggle="modal" data-target="#zapierconnect">Connect</button>
<?php } ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 col-xs-12 col-sm-6" style="cursor:pointer">
                            <div class="white-box">
                                <div class="bar-widget">
                                    <div class="info_button pull-right"><span class="tooltip1" title="This is my image's tooltip message!"><i class="fa fa-info-circle"></i></span></div>
                                    <div class="table-box">
                                        <div class="table-detail text-center">
                                            <div class="big-icons"><img src="<?php echo e(url('images/activecampaign_logo.png')); ?>"></div>
                                            <!-- <div class="action-buttons"> -->
<?php if(array_key_exists('activecampaign',$integrations)){ ?>
                                                <button class="btn btn-primary inactive activecampaign" id="acampc" data-toggle="modal" data-target="#activecampconnect">Connect</button>
                                                <button class="btn btn-primary" id="activecampaign" data-toggle="modal" data-target="#activecampconnect">Configure</button>
                                                <button class="btn btn-primary disconnect" id="awbd" data-app="activecampaign">Disconnect</button>
<?php } else { ?>
                                                <button class="btn btn-primary activecampaign" id="acampc" data-toggle="modal" data-target="#activecampconnect">Connect</button>
<?php } ?>
                                            <!-- </div> -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 col-xs-12 col-sm-6" style="cursor:pointer">
                            <div class="white-box">
                                <div class="bar-widget">
                                    <div class="info_button pull-right"><span class="tooltip1" title="This is my image's tooltip message!"><i class="fa fa-info-circle"></i></span></div>
                                    <div class="table-box">
                                        <div class="table-detail text-center">
                                            <div class="big-icons"><img src="<?php echo e(url('images/gotowebinar_logo.png')); ?>"></div>
<?php if(array_key_exists('gotowebinar',$integrations)){ ?>
                                            <a class="btn btn-primary inactive gotowebinar" id="gtwbtn" href="/gotowebinarauth">Connect</a>
                                            <button class="btn btn-primary" id="gotowebinar" data-toggle="modal" data-target="#gotowebinarconnect">Configure</button>
                                            <button class="btn btn-primary disconnect" id="gtwd"  data-app="gotowebinar">Disconnect</button>
<?php } else { ?>
                                            <a class="btn btn-primary active" id="gtwbtn" href="/gotowebinarauth">Connect</a>
<?php } ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="col-md-6 col-xs-12 col-sm-6" style="cursor:pointer">
                            <div class="white-box">
                                <div class="bar-widget">
                                    <div class="info_button pull-right"><span class="tooltip1" title="This is my image's tooltip message!"><i class="fa fa-info-circle"></i></span></div>
                                    <div class="table-box">
                                        <div class="table-detail text-center">
                                            <div class="big-icons"><img src="<?php echo e(url('images/getresponse_logo.png')); ?>"></div>
                                            <!-- <div class="action-buttons"> -->
<?php if(array_key_exists('getresponse',$integrations)){ ?>
                                                <button class="btn btn-primary inactive getresponse" id="sgarc" data-toggle="modal" data-target="#getresponseconnect">Connect</button>
                                                <button class="btn btn-primary" id="getresponse" data-toggle="modal" data-target="#getresponseconnect">Configure</button>
                                                <button class="btn btn-primary disconnect" id="sgard" data-app="getresponse">Disconnect</button>
<?php } else { ?>
                                                <button class="btn btn-primary getresponse" id="sgarc" data-toggle="modal" data-target="#getresponseconnect">Connect</button>
<?php } ?>
                                            <!-- </div> -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="col-md-6 col-xs-12 col-sm-6" style="cursor:pointer">
                            <div class="white-box">
                                <div class="bar-widget">
                                    <div class="info_button pull-right"><span class="tooltip1" title="This is my image's tooltip message!"><i class="fa fa-info-circle"></i></span></div>
                                    <div class="table-box">
                                        <div class="table-detail text-center">
                                            <div class="big-icons"><img src="<?php echo e(url('images/sg-autorepondeur_logo.png')); ?>"></div>
                                            <!-- <div class="action-buttons"> -->
<?php if(array_key_exists('sgautoresponder',$integrations)){ ?>
                                                <button class="btn btn-primary inactive sgautoresponder" id="sgarc" data-toggle="modal" data-target="#sgautoresponderconnect">Connect</button>
                                                <button class="btn btn-primary" id="sgautoresponder" data-toggle="modal" data-target="#sgautoresponderconnect">Configure</button>
                                                <button class="btn btn-primary disconnect" id="sgard" data-app="sgautoresponder">Disconnect</button>
<?php } else { ?>
                                                <button class="btn btn-primary sgautoresponder" id="sgarc" data-toggle="modal" data-target="#sgautoresponderconnect">Connect</button>
<?php } ?>
                                            <!-- </div> -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="col-md-6 col-xs-12 col-sm-6" style="cursor:pointer">
                            <div class="white-box">
                                <div class="bar-widget">
                                    <div class="info_button pull-right"><span class="tooltip1" title="This is my image's tooltip message!"><i class="fa fa-info-circle"></i></span></div>
                                    <div class="table-box">
                                        <div class="table-detail text-center">
                                            <div class="big-icons"><img src="<?php echo e(url('images/mailchimp_logo.png')); ?>"></div>
                                            <!-- <div class="action-buttons"> -->
<?php if(array_key_exists('mailchimp',$integrations)){ ?>
                                                <button class="btn btn-primary inactive mailchimp" id="sgarc" data-toggle="modal" data-target="#mailchimpconnect">Connect</button>
                                                <button class="btn btn-primary" id="mailchimp" data-toggle="modal" data-target="#mailchimpconnect">Configure</button>
                                                <button class="btn btn-primary disconnect" id="sgard" data-app="mailchimp">Disconnect</button>
<?php } else { ?>
                                                <button class="btn btn-primary mailchimp" id="sgarc" data-toggle="modal" data-target="#mailchimpconnect">Connect</button>
<?php } ?>
                                            <!-- </div> -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 col-xs-12 col-sm-6" style="cursor:pointer">
                            <div class="white-box">
                                <div class="bar-widget">
                                    <div class="info_button pull-right"><span class="tooltip1" title="This is my image's tooltip message!"><i class="fa fa-info-circle"></i></span></div>
                                    <div class="table-box">
                                        <div class="table-detail text-center">
                                            <div class="big-icons"><img src="<?php echo e(url('images/webinarjam_logo.png')); ?>"></div>
                                            <!-- <div class="action-buttons"> -->
<?php if(array_key_exists('webinarjam',$integrations)){ ?>
                                                <button class="btn btn-primary inactive webinarjam" id="sgarc" data-toggle="modal" data-target="#webinarjamconnect">Connect</button>
                                                <button class="btn btn-primary" id="webinarjam" data-toggle="modal" data-target="#webinarjamconnect">Configure</button>
                                                <button class="btn btn-primary disconnect" id="sgard" data-app="webinarjam">Disconnect</button>
<?php } else { ?>
                                                <button class="btn btn-primary webinarjam" id="sgarc" data-toggle="modal" data-target="#webinarjamconnect">Connect</button>
<?php } ?>
                                            <!-- </div> -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 col-xs-12 col-sm-6" style="cursor:pointer">
                            <div class="white-box">
                                <div class="bar-widget">
                                    <div class="info_button pull-right"><span class="tooltip1" title="This is my image's tooltip message!"><i class="fa fa-info-circle"></i></span></div>
                                    <div class="table-box">
                                        <div class="table-detail text-center">
                                            <div class="big-icons"><img src  ="<?php echo e(url('images/everwebinar_logo.png')); ?>"></div>
                                            <!-- <div class="action-buttons"> -->
<?php if(array_key_exists('everwebinar',$integrations)){ ?>
                                                <button class="btn btn-primary inactive everwebinar" id="sgarc" data-toggle="modal" data-target="#everwebinarconnect">Connect</button>
                                                <button class="btn btn-primary" id="everwebinar" data-toggle="modal" data-target="#everwebinarconnect">Configure</button>
                                                <button class="btn btn-primary disconnect" id="sgard" data-app="everwebinar">Disconnect</button>
<?php } else { ?>
                                                <button class="btn btn-primary everwebinar" id="sgarc" data-toggle="modal" data-target="#everwebinarconnect">Connect</button>
<?php } ?>
                                            <!-- </div> -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

<!--
  <div class="col-md-6 col-xs-12 col-sm-6" style="cursor:pointer">
                            <div class="white-box">
                                <div class="bar-widget">
                                    <div class="info_button pull-right"><span class="tooltip1" title="This is my image's tooltip message!"><i class="fa fa-info-circle"></i></span></div>
                                    <div class="table-box">
                                        <div class="table-detail text-center">
                                            <div class="big-icons"><img src  ="<?php echo e(url('images/drip_logo.png')); ?>"></div>
                                            
<?php if(array_key_exists('drip',$integrations)){ ?>
                                                <button class="btn btn-primary inactive drip" id="sgarc" data-toggle="modal" data-target="#dripconnect">Connect</button>
                                                <button class="btn btn-primary" id="drip" data-toggle="modal" data-target="#dripconnect">Configure</button>
                                                <button class="btn btn-primary disconnect" id="sgard" data-app="drip">Disconnect</button>
<?php } else { ?>
                                                <button class="btn btn-primary drip" id="sgarc" data-toggle="modal" data-target="#dripconnect">Coming soon...</button>
<?php } ?>
                                            
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
-->

                   <!--      <div class="col-md-6 col-xs-12 col-sm-6" style="cursor:pointer">
                            <div class="white-box">
                                <div class="bar-widget">
                                    <div class="info_button pull-right"><span class="tooltip1" title="This is my image's tooltip message!"><i class="fa fa-info-circle"></i></span></div>
                                    <div class="table-box">
                                        <div class="table-detail text-center">
                                            <div class="big-icons"><img src="<?php echo e(url('images/drip_logo.png')); ?>"></div>
                                            <button class="btn btn-primary inactive">Configure</button>
                                            <button class="btn btn-primary inactive">Revoke</button>            
                                            <button class="btn btn-primary active">Connect</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> -->
                    </div>
                </div>
        </div>
    </div>
<?php if(array_key_exists('aweber',$integrations)){ ?>
<div class="modal fade cancelModal" id="aweberconnect" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button aria-hidden="true" data-dismiss="modal" class="close" type="button">&times;</button>
            </div>
            <?php echo e(csrf_field()); ?>

            <form method="post" id="aweberconnectform" action="#">
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12 col-xs-12 col-sm-12">
                        <div class="row">
                            <div class="form-group opt" id="awb_aid_container">
                                <div class="col-md-3">
                                    <label>Choose Account</label>
                                </div>
                                <div class="col-md-8">
                                    <select class="form-control selectpicker" name="aweber_account_id" id="aweber_account_id">
                                        <option value=""></option>
                                        <option value="<?php echo $integrations['aweber']->account_id;?>"><?php echo $integrations['aweber']->account_id;?></option>
                                    </select>

                                </div>
                            </div>
                            <div class="form-group opt" id="awb_list_container" style="display:none">
                                <div class="col-md-3">
                                    <label>Choose List</label>
                                </div>
                                <div class="col-md-8">
                                   <select class="form-control selectpicker" name="aweber_account_list" id="aweber_account_list">
                                        <option value=""></option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer" id="saveaweberlistbtn" style="display: none;">
                    <div class="alertmsg alert alert-danger" id="t2s_err"></div>
                    <button type="submit" class="btn btn-primary" id="saveaweberlist">Save</button>                            
                </div>
                <p class="savestats"></p>
            </div>
            </form>
        </div>
    </div>
</div>
<script type="text/javascript">
<?php 
if((isset($_GET['pop']) && $_GET['pop']=='aweber') || $integrations['aweber']->account_id){
    echo 'var showpop=false;';
    
if ((isset($_GET['pop']) && $_GET['pop']=='aweber')){
    echo 'showpop=true;';
}
?>
jQuery('document').ready(function(){
    if(showpop)
    jQuery('#aweberconnect').modal('show');

$('#aweber_account_id').change(function(){
    if($(this).val()!='')
    {
        var account_id=$(this).val();   
        $('#awb_list_container').show();
        $.ajax({
            url: "<?php echo e(url('/integration/getlist')); ?>",
            type: "GET",
            processData: false,
            data:'account_id='+account_id,
            success: function(data){
                console.log(data);
                $('#awb_list_container select').html(data);
                $('#awb_list_container select').selectpicker('refresh');

            }
        });

    }
    else{
        $('#awb_list_container').hide();
    }
});
$('#aweber_account_list').change(function(){
    if($(this).val()!='')
    {
        $('#saveaweberlistbtn').show();
    }
    else{
        $('#saveaweberlistbtn').hide();
    }

});
$('#aweberconnectform').submit(function(e){
    e.preventDefault();
    var listval=$('#aweber_account_list').val();
    if(listval){
    var listtxt = $("#aweber_account_list option:selected").text();
    var lval = $("#aweber_account_list option:selected").val();
    $.ajax({
        url: "<?php echo e(url('/integration/savelist')); ?>",
        type: "GET",
        processData: false,
        data:'listname='+lval+'&listtxt='+listtxt,
        success: function(data){
            console.log(data);
            $('#aweberconnectform .savestats').html('Saved Successfully');
        }
    });
}

});

});

<?php
    }
?>
</script>


<?php } ?>


<div class="modal fade cancelModal" id="zapierconnect" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button aria-hidden="true" data-dismiss="modal" class="close" type="button">&times;</button>
            </div>
            <?php echo e(csrf_field()); ?>

            <form method="post" id="zapierhooks" action="#">
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12 col-xs-12 col-sm-12">
                        <div class="row">
                            <table id="myTable" class=" table order-list">
                                <thead>
                                    <tr>
                                        <td>Hook URL</td>
                                        <td>Action</td>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php 
                                $hooksCount=0;
                                 if(array_key_exists('zapier',$integrations)){
                                    $zapss= json_decode($integrations['zapier']->hook);
                                    // print_r($zapss);
                                     $hooksCount=count((array)$zapss);
                                    } 
                            if($hooksCount>0){
                                $html='';
                                foreach ($zapss as $key => $value) {
                                    $html.='<tr>
                                            <td class="col-sm-10">
                                                <input class="form-control" type="text" name="hookurl[]" value="'.$value.'" class="hookurl"/>
                                            </td>';
                                    if($key==0){
                                        $html.='<td class="col-sm-2">
                                                    <a class="deleteRow"></a>
                                                </td>';
                                    }else{
                                        $html.='<td class="col-sm-2">
                                                    <input type="button" class="ibtnDel btn btn-md btn-danger "  value="Delete">
                                                </td>';
                                    }
                                    $html.= '</tr>';
                                }
                                echo $html; 
                            }else {
                             ?>

                                    <tr>
                                        <td class="col-sm-10">
                                            <input class="form-control" type="text" name="hookurl[]"  class="hookurl"/>
                                        </td>
                                        <td class="col-sm-2">
                                            <a class="deleteRow"></a>
                                        </td>
                                    </tr>
                            <?php } ?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="3" style="text-align: left;">
                                            <input type="button" class="btn btn-lg btn-block " id="addrow" value="Add New URL" />
                                        </td>
                                    </tr>
                                    <tr>
                                    </tr>
                                </tfoot>
                            </table>


                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="alertmsg alert alert-danger" id="t2s_err"></div>
                    <button type="submit" class="btn btn-primary" id="savezapierhook">Save</button>                            
                </div>
                <p class="savestats"></p>
            </div>
            </form>
        </div>
    </div>
</div>

<script type="text/javascript">
jQuery('document').ready(function(){
     var counter = 0;

    $("#addrow").on("click", function () {
        var newRow = $("<tr>");
        var cols = "";
        cols+= '<td class="col-sm-10">\
                <input class="form-control" type="text" name="hookurl[]"  class="hookurl"/>\
                </td>';
        cols += '<td class="col-sm-2"><input type="button" class="ibtnDel btn btn-md btn-danger "  value="Delete"></td>';
        newRow.append(cols);
        $("table.order-list").append(newRow);
        jQuery('select').selectpicker('refresh');
        counter++;
    });
     jQuery("table.order-list").on("click", ".ibtnDel", function (event) {
        jQuery(this).closest("tr").remove();       
        counter -= 1
    });



    var ajaxchk2=true;
    $('#zapierhooks').submit(function(e){
        var formdata=$(this).serialize();
        e.preventDefault();
        if(ajaxchk2==true){
            ajaxchk2=false;
            $.ajax({
                url: "<?php echo e(url('/integration/savezapier')); ?>",
                processData: false,
                data:formdata,
                type: "GET",
                success: function(data){
                    $('#zapierhooks .savestats').html('Saved Successfully');
                    console.log(data);
                    ajaxchk2=true;
                }
            });
        }

    });




});
</script>

<?php 
$acampkey='';
$acampurl='';
$acamplistid='';
$acamplistname='';
if(array_key_exists('activecampaign',$integrations)){
$acampurl=$integrations['activecampaign']->counsumerKey;
$acampkey=$integrations['activecampaign']->counsumerSecret;
$acamplistid=$integrations['activecampaign']->list_campaign_id;
$acamplistname=$integrations['activecampaign']->list_campaign_name;
}
?>
<div class="modal fade cancelModal" id="activecampconnect" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button aria-hidden="true" data-dismiss="modal" class="close" type="button">&times;</button>
            </div>
            <?php echo e(csrf_field()); ?>

            <form method="post" id="acamp_account_details" action="#" style="<?php if($acamplistid!='' ){ echo 'display:none;'; } ?>">
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12 col-xs-12 col-sm-12">
                        <div class="row">
                            <div class="form-group opt" id="acampapiurl">
                                <div class="col-md-3">
                                    <label>API Url</label>
                                </div>
                                <div class="col-md-8">
                                    <input class="form-control" type="text" name="acampapiurl" required="required" value="<?php echo e($acampurl); ?>">
                                </div>
                            </div>

                            <div class="form-group opt" id="acampapikey">
                                <div class="col-md-3">
                                    <label>API Key</label>
                                </div>
                                <div class="col-md-8">
                                    <input class="form-control" type="text" name="acampapikey" required="required" value="<?php echo e($acampkey); ?>">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="alertmsg alert alert-danger" id="t2s_err"></div>
                    <button type="submit" class="btn btn-primary" id="savezapierhook">Save</button>                            
                </div>
                <p class="savestats"></p>
            </div>
            </form>
            <form method="post" id="acamp_lists" action="#" style="<?php if($acamplistid=='' ){ echo 'display:none;'; } ?>" >
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12 col-xs-12 col-sm-12">
                        <div class="row">
                            <div class="form-group opt" id="acamp_list_container">
                                <div class="col-md-3">
                                    <label>Choose List</label>
                                </div>
                                <div class="col-md-8">
                                   <select class="form-control selectpicker" name="acamp_account_list" id="acamp_account_list" required="required">
                                        <option value="<?php echo e($acamplistid); ?>"><?php echo e($acamplistname); ?></option>
                                    </select>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="alertmsg alert alert-danger" id="t2s_err"></div>
                    <button type="submit" class="btn btn-primary" id="savezapierhook">Save</button>                            
                </div>
                <p class="savestats"></p>
            </div>
            </form>            
        </div>
    </div>
</div>
<script type="text/javascript">

jQuery('document').ready(function(){
   var acampchk=true;
    $('#acamp_account_details').submit(function(e){
        var formdata=$(this).serialize();
        e.preventDefault();
        if(acampchk==true){
            $('.loader-bg').show(100);
            acampchk=false;
            $.ajax({
                url: "<?php echo e(url('/integration/saveactivecamp')); ?>",
                processData: false,
                data:formdata,
                type: "GET",
                success: function(data){
                    $('#acamp_account_details .savestats').html('Saved Successfully');
                    console.log(data);
                    $('#acamp_lists select').html(data);
                    $('#acamp_lists select').selectpicker('refresh');
                    $('#acamp_account_details').slideUp();
                    $('#acamp_lists').slideDown();
                    acampchk=true;
                    $('.loader-bg').hide(100);
                }
            });
        }
    });

    $('#acamp_lists').submit(function(e){
        var formdata=$(this).serialize();
        var listname = $("#acamp_account_list option:selected").text();
        var listid = $("#acamp_account_list option:selected").val();

        e.preventDefault();
        if(acampchk==true){
            $('.loader-bg').show(100);
            acampchk=false;
            $.ajax({
                url: "<?php echo e(url('/integration/saveactivecamplist')); ?>",
                processData: false,
                data:'listid='+listid+'&listname='+listname,
                type: "GET",
                success: function(data){
                    $('#acamp_lists .savestats').html('Saved Successfully');
                    console.log(data);
                    acampchk=true;                    
                    $('.loader-bg').hide(100);
                    setTimeout(function(){
                    $('#activecampconnect').modal('hide');                        
                    },1000);
                }
            });
        }

    });




});
</script>



<?php if(array_key_exists('gotowebinar',$integrations)){ ?>
<div class="modal fade cancelModal" id="gotowebinarconnect" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button aria-hidden="true" data-dismiss="modal" class="close" type="button">&times;</button>
            </div>
            <?php echo e(csrf_field()); ?>

            <form method="post" id="gotowebinarconnectform" action="#">
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12 col-xs-12 col-sm-12">
                        <div class="row">
                            <div class="form-group opt" id="awb_aid_container">
                                <div class="col-md-3">
                                    <label>Choose Webinar</label>
                                </div>
                                <div class="col-md-8">
                                    <select class="form-control selectpicker" name="gtw_account_id" id="gtw_account_id">
                                        <option value=""></option>
                                    </select>
                                        <?php $webinars=json_decode($integrations['gotowebinar']->hook); print_r($webinars);?>

                                </div>
                            </div>
                            <div class="form-group opt" id="awb_list_container" style="display:none">
                                <div class="col-md-3">
                                    <label>Choose List</label>
                                </div>
                                <div class="col-md-8">
                                   <select class="form-control selectpicker" name="aweber_account_list" id="aweber_account_list">
                                        <option value=""></option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer" id="saveaweberlistbtn" style="display: none;">
                    <div class="alertmsg alert alert-danger" id="t2s_err"></div>
                    <button type="submit" class="btn btn-primary" id="saveaweberlist">Save</button>                            
                </div>
                <p class="savestats"></p>
            </div>
            </form>
        </div>
    </div>
</div>
<script type="text/javascript">
<?php 
if((isset($_GET['pop']) && $_GET['pop']=='gotowebinar') || $integrations['gotowebinar']->account_id){
    echo 'var showpop1=false;';
    
if ((isset($_GET['pop']) && $_GET['pop']=='gotowebinar')){
    echo 'showpop1=true;';
}
?>
jQuery('document').ready(function(){
    if(showpop1)
    jQuery('#gotowebinarconnect').modal('show');

$('#aweber_account_id').change(function(){
    if($(this).val()!='')
    {
        var account_id=$(this).val();   
        $('#awb_list_container').show();
        $.ajax({
            url: "<?php echo e(url('/integration/gtwgetlist')); ?>",
            type: "GET",
            processData: false,
            data:'account_id='+account_id,
            success: function(data){
                console.log(data);
                $('#awb_list_container select').html(data);
                $('#awb_list_container select').selectpicker('refresh');

            }
        });

    }
    else{
        $('#awb_list_container').hide();
    }
});
$('#aweber_account_list').change(function(){
    if($(this).val()!='')
    {
        $('#saveaweberlistbtn').show();
    }
    else{
        $('#saveaweberlistbtn').hide();
    }

});
$('#aweberconnectform').submit(function(e){
    e.preventDefault();
    var listval=$('#aweber_account_list').val();
    if(listval){
    var listtxt = $("#aweber_account_list option:selected").text();
    var lval = $("#aweber_account_list option:selected").val();
    $.ajax({
        url: "<?php echo e(url('/integration/savelist')); ?>",
        type: "GET",
        processData: false,
        data:'listname='+lval+'&listtxt='+listtxt,
        success: function(data){
            console.log(data);
            $('#aweberconnectform .savestats').html('Saved Successfully');
        }
    });
}

});

});

<?php
    }
?>
</script>


<?php } ?>




<?php 
$getresponsekey='';
$getresponseCampid='';
$getresponseCampname='';
if(array_key_exists('getresponse',$integrations)){
echo  $getresponsekey=$integrations['getresponse']->counsumerKey;
$getresponseCampid=$integrations['getresponse']->list_campaign_id;
$getresponseCampname=$integrations['getresponse']->list_campaign_name;
}
?>
<div class="modal fade cancelModal" id="getresponseconnect" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button aria-hidden="true" data-dismiss="modal" class="close" type="button">&times;</button>
            </div>
            <?php echo e(csrf_field()); ?>

            <form method="post" id="getresponse_account_details" action="#" style="<?php if( $getresponseCampid !='' ){ echo 'display:none;'; } ?>">
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12 col-xs-12 col-sm-12">
                        <div class="row">
                            <div class="form-group opt" id="getresponsekey">
                                <div class="col-md-3">
                                    <label>API Key</label>
                                </div>
                                <div class="col-md-8">
                                    <input class="form-control" type="text" name="getresponsekey" required="required" value="<?php echo e($getresponsekey); ?>">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="alertmsg alert alert-danger" id="t2s_err"></div>
                    <button type="submit" class="btn btn-primary" id="savegetresponse">Save</button>                            
                </div>
                <p class="savestats"></p>
            </div>
            </form>
            <form method="post" id="getresponse_campaign_lists" action="#" style="<?php if($getresponseCampid =='' ){ echo 'display:none;'; } ?>" >
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12 col-xs-12 col-sm-12">
                        <div class="row">
                            <div class="form-group opt" id="getresponse_list_container">
                                <div class="col-md-3">
                                    <label>Choose List</label>
                                </div>
                                <div class="col-md-8">
                                   <select class="form-control selectpicker" name="getresponse_campaign_list" id="getresponse_campaign_list" required="required">
                                        <option value="<?php echo e($getresponseCampid); ?>"><?php echo e($getresponseCampname); ?></option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="alertmsg alert alert-danger" id="t2s_err"></div>
                    <button type="submit" class="btn btn-primary" id="savegetresponse">Save</button>                            
                </div>
                <p class="savestats"></p>
            </div>
            </form>            
        </div>
    </div>
</div>
<script type="text/javascript">

jQuery('document').ready(function(){
   var grchk=true;
    $('#getresponse_account_details').submit(function(e){
        var formdata=$(this).serialize();
        e.preventDefault();
        if(grchk==true){
            $('.loader-bg').show(100);
            grchk=false;
            $.ajax({
                url: "<?php echo e(url('/integration/savegetresponse')); ?>",
                processData: false,
                data:formdata,
                type: "GET",
                success: function(data){
                    console.log(data);
                    grchk=true;
                    if(data=='error'){
                        $('#getresponse_account_details #t2s_err').html('Your API key is not valid. Please check account and insert valid API Key.');
                        $('#getresponse_account_details #t2s_err').show();
                        setTimeout(function(){
                            $('#getresponse_account_details #t2s_err').fadeOut(500);
                        },10000);
                    }
                    else{                        
                        $('#getresponse_account_details .savestats').html('Saved Successfully');
                        $('#getresponse_campaign_lists select').html(data);
                        $('#getresponse_campaign_lists select').selectpicker('refresh');
                        $('#getresponse_account_details').slideUp();
                        $('#getresponse_campaign_lists').slideDown();
                    }
                    $('.loader-bg').hide(100);
                }
            });
        }
    });

    $('#getresponse_campaign_lists').submit(function(e){
        var formdata=$(this).serialize();
        var listname = $("#getresponse_campaign_list option:selected").text();
        var listid = $("#getresponse_campaign_list option:selected").val();

        e.preventDefault();
        if(grchk==true){
            $('.loader-bg').show(100);
            grchk=false;
            $.ajax({
                url: "<?php echo e(url('/integration/savegetresponselist')); ?>",
                processData: false,
                data:'listid='+listid+'&listname='+listname,
                type: "GET",
                success: function(data){
                    $('#getresponse_campaign_lists .savestats').html('Saved Successfully');
                    console.log(data);
                    grchk=true;                    
                    $('.loader-bg').hide(100);
                    setTimeout(function(){
                    $('#getresponseconnect').modal('hide');                        
                    },1000);
                }
            });
        }

    });




});
</script>




<?php 
$sgautokey='';
$sgautomemberid='';
$sgautolistid='';
$sgautolistname='';
if(array_key_exists('sgautoresponder',$integrations)){
$sgautomemberid=$integrations['sgautoresponder']->counsumerKey;
$sgautokey=$integrations['sgautoresponder']->counsumerSecret;
$sgautolistid=$integrations['sgautoresponder']->list_campaign_id;
$sgautolistname=$integrations['sgautoresponder']->list_campaign_name;
}
?>
<div class="modal fade cancelModal" id="sgautoresponderconnect" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button aria-hidden="true" data-dismiss="modal" class="close" type="button">&times;</button>
            </div>
            <?php echo e(csrf_field()); ?>

            <form method="post" id="sgauto_account_details" action="#" style="<?php if($sgautolistid!='' ){ echo 'display:none;'; } ?>">
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12 col-xs-12 col-sm-12">
                        <div class="row">
                            <div class="form-group opt" id="sgautomemberid">
                                <div class="col-md-3">
                                    <label>Member ID</label>
                                </div>
                                <div class="col-md-8">
                                    <input class="form-control" type="text" required="required" name="sgautomemberid" value="<?php echo e($sgautomemberid); ?>">
                                </div>
                            </div>

                            <div class="form-group opt" id="sgautoapikey">
                                <div class="col-md-3">
                                    <label>Permission Key</label>
                                </div>
                                <div class="col-md-8">
                                    <input class="form-control" type="text" required="required" name="sgautoapikey" value="<?php echo e($sgautokey); ?>">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="alertmsg alert alert-danger" id="t2s_err"></div>
                    <button type="submit" class="btn btn-primary" id="savezapierhook">Save</button>                            
                </div>
                <p class="savestats"></p>
            </div>
            </form>
            <form method="post" id="sgauto_lists" action="#" style="<?php if($sgautolistid=='' ){ echo 'display:none;'; } ?>" >
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12 col-xs-12 col-sm-12">
                        <div class="row">
                            <div class="form-group opt" id="sgauto_list_container">
                                <div class="col-md-3">
                                    <label>Choose List</label>
                                </div>
                                <div class="col-md-8">
                                   <select class="form-control selectpicker" name="sgauto_account_list" id="sgauto_account_list" required="required">
                                        <option value="<?php echo e($sgautolistid); ?>"><?php echo e($sgautolistname); ?></option>
                                    </select>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="alertmsg alert alert-danger" id="t2s_err"></div>
                    <button type="submit" class="btn btn-primary" id="savezapierhook">Save</button>                            
                </div>
                <p class="savestats"></p>
            </div>
            </form>            
        </div>
    </div>
</div>
<script type="text/javascript">

jQuery('document').ready(function(){
   var sgautochk=true;
    $('#sgauto_account_details').submit(function(e){
        var formdata=$(this).serialize();
        e.preventDefault();
        if(sgautochk==true){
            $('.loader-bg').show(100);
            sgautochk=false;
            $.ajax({
                url: "<?php echo e(url('/integration/savesgauto')); ?>",
                processData: false,
                data:formdata,
                type: "GET",
                success: function(data){
                    $('#sgauto_account_details .savestats').html('Saved Successfully');
                    console.log(data);
                    $('#sgauto_lists select').html(data);
                    $('#sgauto_lists select').selectpicker('refresh');
                    $('#sgauto_account_details').slideUp();
                    $('#sgauto_lists').slideDown();
                    sgautochk=true;
                    $('.loader-bg').hide(100);
                }
            });
        }
    });

    $('#sgauto_lists').submit(function(e){
        var formdata=$(this).serialize();
        var listname = $("#sgauto_account_list option:selected").text();
        var listid = $("#sgauto_account_list option:selected").val();

        e.preventDefault();
        if(sgautochk==true){
            $('.loader-bg').show(100);
            sgautochk=false;
            $.ajax({
                url: "<?php echo e(url('/integration/savesgautolist')); ?>",
                processData: false,
                data:'listid='+listid+'&listname='+listname,
                type: "GET",
                success: function(data){
                    $('#sgauto_lists .savestats').html('Saved Successfully');
                    console.log(data);
                    sgautochk=true;                    
                    $('.loader-bg').hide(100);
                    setTimeout(function(){
                    $('#sgautoresponderconnect').modal('hide');                        
                    },1000);
                }
            });
        }

    });




});
</script>








<script type="text/javascript">
$('.disconnect').click(function(){
    var obj=$(this);
    var app=$(this).data('app');
    $('.loader-bg').show(100);
    $.ajax({
        url: "<?php echo e(url('/integration/disconnectApp')); ?>",
        type: "GET",
        processData: false,
        data:'app='+app,
        success: function(data){
            console.log(data);
            if(data=='success')
            {
                $('.'+app).removeClass('inactive');
                $('.'+app).fadeIn(200);
                $('#'+app).fadeOut(100);
                obj.addClass('inactive');
                $('.loader-bg').hide(300);
            }
        }
    });
});
</script>
</div>
<?php $__env->stopSection(); ?>




<?php echo $__env->make('layouts.website', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>