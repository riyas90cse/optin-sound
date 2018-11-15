@extends('layouts.website')
@section('content')
<div class="pageheader">
		<div class="media">
        <div class="pageicon pull-left">
            <i class="fa fa-share"></i>
        </div>
        <div class="media-body">
    	<h4>Integration Board</h4>
        <ul class="breadcrumb">
            <li><a href="{{ url('') }}"><i class="glyphicon glyphicon-home"></i></a></li>
            <li>Integrations</li>
        </ul>
    	</div>
    </div><!-- media -->
</div><!-- pageheader -->
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
                                            <div class="big-icons"><img src="{{url('images/aweber_logo.jpeg')}}"></div>
                                            <div class="action-buttons">
                                                <button class="btn btn-primary inactive">Configure</button>
                                                <button class="btn btn-primary inactive">Revoke</button>            
                                                <a class="btn btn-primary active" id="awbcbtn" href="/aweberauth">Connect</a>
                                                <button class="btn btn-primary" id="awbc" data-toggle="modal" data-target="#aweberconnect">Configure</button>
                                            </div>
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
                                            <div class="big-icons"><img src="{{url('images/Zapier_logo.png')}}"></div>
                                            <button class="btn btn-primary" id="awbc" data-toggle="modal" data-target="#zapierconnect">Configure</button>
                                            <button class="btn btn-primary inactive">Revoke</button>            
                                            <button class="btn btn-primary inactive">Connect</button>
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
                                            <div class="big-icons"><img src="{{url('images/gotowebinar_logo.png')}}"></div>
                                            <button class="btn btn-primary inactive">Configure</button>
                                            <button class="btn btn-primary inactive">Revoke</button>            
                                            <button class="btn btn-primary active">Connect</button>
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
                                            <div class="big-icons"><img src="{{url('images/drip_logo.png')}}"></div>
                                            <button class="btn btn-primary inactive">Configure</button>
                                            <button class="btn btn-primary inactive">Revoke</button>            
                                            <button class="btn btn-primary active">Connect</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
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
            {{ csrf_field() }}
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
            url: "{{url('/integration/getlist')}}",
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
    $.ajax({
        url: "{{url('/integration/savelist')}}",
        type: "GET",
        processData: false,
        data:'listname='+listval,
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
            {{ csrf_field() }}
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
                url: "{{url('/integration/savezapier')}}",
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
</div>
@endsection

