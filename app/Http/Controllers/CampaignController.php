<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
use File;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Campaign;
use App\Domain;
use App\Country;
use App\Language;
use App\DoneSound;
use App\Niche;
use App\Trafficsource;
use App\Amazonpolly;
use App\Widget;


class CampaignController extends Controller
{
    public function __construct()
    {
        $this->campaign = new Campaign();
        $this->country = new Country();
        $this->domain = new Domain();
        $this->language = new Language();
        $this->soundniche = new DoneSound();
        $this->niche = new Niche();
        $this->trafficsource= new Trafficsource();
        $this->amazonpolly= new Amazonpolly();
        $this->widget= new Widget();
    }
    public function index()
    {
        $campaign = $this->campaign->campaign_list();
        $domain =  $this->domain->domain_list();
        $country =  $this->country->country_list();
        $language =  $this->language->language_list();
        $niche =  $this->niche->niche_list();
        $trafficsource =  $this->trafficsource->trafficsource_list();
        $soundniche =  $this->soundniche->soundniche_list();
		    $count = $campaign->count();
		return view('campaign/list',['campaigns'=>$campaign,'domain'=>$domain,'country'=>$country,'language'=>$language,'niche'=>$niche,'trafficsource'=>$trafficsource,'soundniche'=>$soundniche,'count'=>$count]);
    }

    public function amazon_text2speech(Request $request)
    {

        include(app_path() . '/libraries/aws/aws-autoloader.php');
        $voice_id = $request->input('voice_id');
        $text = $request->input('text');
        $language = $request->input('language');

        $awsAccessKeyId = 'AKIAIRNSNN2WBX37VHKQ';
        $awsSecretKey   = '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';

        $credentials    = new \Aws\Credentials\Credentials($awsAccessKeyId, $awsSecretKey);
        $client         = new \Aws\Polly\PollyClient([
            'version'     => '2016-06-10',
            'credentials' => $credentials,
            'region'      => 'us-east-1',
        ]);
        $result         = $client->synthesizeSpeech([
            'OutputFormat' => 'mp3',
            'Text'         => $text,
            'TextType'     => 'text',
            'VoiceId'      => $voice_id,
        ]);
        $resultData     = $result->get('AudioStream')->getContents();
        $resultData_polly=$resultData;


        $s3bucket = 'convertsound';
        $s3region = 'us-west-2';
        $filename = time().'-cvs.mp3';
        $client_s3 = new \Aws\S3\S3Client([
          'version'     => 'latest',
          'credentials' => $credentials,
          'region'      => $s3region
        ]);
        $result_s3 = $client_s3->putObject([
          'Key'         => $filename,
          'ACL'         => 'public-read',
          'Body'        => $resultData_polly,
          'Bucket'      => $s3bucket,
          'ContentType' => 'audio/mpeg',
          'SampleRate'  => '8000'
        ]);

        echo $result_s3['ObjectURL'];

        $this->amazonpolly->t2s_add( $voice_id, $text, $language, $result_s3['ObjectURL'] );

    }
    public function create()
    {
        $campaign = $this->campaign->campaign_list();
        $domain =  $this->domain->domain_list();
        $country =  $this->country->country_list();
        $language =  $this->language->language_list();
        $niche =  $this->niche->niche_list();
        $trafficsource =  $this->trafficsource->trafficsource_list();
        $soundniche =  $this->soundniche->soundniche_list();
        $sounds=array();
        foreach($soundniche as $key=>$sound)
        {
        $sounds[$sound->niche_category][$sound->trafficsource]=$sound;
        }

        // return view('campaign/add',['niches'=>$niche]);
        return view('campaign/create',['campaigns'=>$campaign,'domain'=>$domain,'country'=>$country,'language'=>$language,'niche'=>$niche,'trafficsource'=>$trafficsource,'soundniche'=>$sounds]);
    }


    public function add()
    {
        $campaign = $this->campaign->campaign_list();
        $domain =  $this->domain->domain_list();
        $country =  $this->country->country_list();
        $language =  $this->language->language_list();
        $niche =  $this->niche->niche_list();
        $trafficsource =  $this->trafficsource->trafficsource_list();
        $soundniche =  $this->soundniche->soundniche_list();

        // return view('campaign/add',['niches'=>$niche]);
		return view('campaign/add',['campaigns'=>$campaign,'domain'=>$domain,'country'=>$country,'language'=>$language,'niche'=>$niche,'trafficsource'=>$trafficsource,'soundniche'=>$soundniche]);
    }
    public function save(Request $request)
    {

        $domain_name = $request->input('domain_name');
        $campaign_type = $request->input('campaign_type');
        $language = $request->input('language');
        $voice_variation = $request->input('voice_variation');
        $sound_niche = $request->input('sound_niche');
        $traffic_source = $request->input('traffic_source');
        $text_to_speech = $request->input('text_to_speech');
        $sound_src = $request->input('sound_src');
        $file_custom_upload = $request->file('custom_upload');

        $trigger_time = $request->input('trigger_time');
        $scroll_height = $request->input('scroll_height');

        $file_favicon = $request->file('favicon_icon');

        $repeat_trigger_time = $request->input('repeat_trigger_time');
        $back_button_redirect = $request->input('back_button_redirect');
        $vibration_mobile = $request->input('vibration_mobile');
        $script_name= $request->input('script_name');

        // $this->validate($request,[
        //     'favicon_icon' => 'required',
        //     'favicon_icon.*' => 'required|mimes:gif,png'
        // ]);


        $filename=rand(1000000000,9999999999);
        $ext=$file->getClientOriginalExtension();
        $destinationPath = 'uploads/favicon';
        $full_filename=$filename.'.'.$ext;
        $favicon_url=url('/').$destinationPath.'/'.$full_filename;
        $file->move($destinationPath,$full_filename);

// ND-07092018


        $result = $this->campaign->campaign_add($domain_name, $campaign_type, $language, $voice_variation, $sound_niche, $traffic_source, $text_to_speech, $sound_src, $trigger_time, $scroll_height,$favicon_url, $repeat_trigger_time, $back_button_redirect, $vibration_mobile, $script_name );


        if($result){

$script="var convertsound={
'delay_time':".$trigger_time.",
'st':".$scroll_height.",
'audiosrc':'".$sound_src."',
'favicon':'',
'bbl':'http://convertsound.com',
'noactrigger':1,
'mb':1,
'pr':1,
'ap':1,
'geolocation':{'IN':'http://app.geekotech.com','FR':'http://geekotech.com','AG':'http://developer.facebook.com'}
}

if(convertsound.mb)
{
    if(navigator.vibrate!==undefined)
      navigator.vibrate(1000);
}

if(convertsound.bbl!=''){
history.pushState('first load', null, window.location.href);
history.pushState(null, null, window.location.href);
window.addEventListener('popstate', function(event) {
event.state == 'first load' && window.location.assign(convertsound.bbl);
});  
}

var url  = 'https://json.geoiplookup.io';
var xhr  = new XMLHttpRequest()
xhr.open('GET', url, true)
xhr.responseType = 'jsonp';
xhr.onload = function () {
  var users = JSON.parse(xhr.responseText);
  if (xhr.readyState == 4 && xhr.status == '200') {
    console.log(users.country_code);
    var key=users.country_code;
    if(convertsound.geolocation[key]!='undefined')
    {
      console.log(convertsound.geolocation[key]);
      var redir=convertsound.geolocation[key];
      // window.location.replace(redir);
    }

  } else {
    console.error(users);
  }
}
xhr.send(null);


var audio = document.createElement('audio');
audio.src = convertsound.audiosrc;

setTimeout(function(){
audio.play();
},convertsound.delay_time*1000);

if(convertsound.ap){
document.addEventListener('visibilitychange', function() {
    if (document.hidden){
      audio.pause();

        console.log('Browser tab is hidden')
    } else {
      audio.play();
        console.log('Browser tab is visible')
    }
});

}

var playonscroll=true;
function scrolltopevent(){
  var doc = document.documentElement;
  var left = (window.pageXOffset || doc.scrollLeft) - (doc.clientLeft || 0);
  var top = (window.pageYOffset || doc.scrollTop)  - (doc.clientTop || 0);
  if(top>=convertsound.st && playonscroll)
  {
     audio.play();
     playonscroll=false;
     console.log('play');
  } 
}

if(convertsound.noactrigger)
{
function setup() {
    this.addEventListener('mousemove', resetTimer, false);
    this.addEventListener('mousedown', resetTimer, false);
    this.addEventListener('keypress', resetTimer, false);
    this.addEventListener('DOMMouseScroll', resetTimer, false);
    this.addEventListener('mousewheel', resetTimer, false);
    this.addEventListener('touchmove', resetTimer, false);
    this.addEventListener('MSPointerMove', resetTimer, false);
    this.addEventListener('scroll', scrolltopevent, false);
 
    startTimer();
}
setup();

}

function startTimer() {
    // wait 60 seconds before calling goInactive
    timeoutID = window.setTimeout(goInactive, 60000);
}

function resetTimer(e) {
    window.clearTimeout(timeoutID);
    goActive();
}

function goInactive() {
  setTimeout(function(){
    audio.play();
    goActive();
  },convertsound.delay_time*1000);
  console.log('reactive');
}

function goActive() {
    startTimer();
}


if(convertsound.favicon!='')
{
 (function() {
    var link = document.querySelector('link[rel*=\"icon\"]') || document.createElement('link');
    link.type = 'image/x-icon';
    link.rel = 'shortcut icon';
    link.href = convertsound.favicon;
    document.getElementsByTagName('head')[0].appendChild(link);
})();
 
}";





// Create file

        // $data = json_encode(['Example 1','Example 2','Example 3',]);
        $fileName = time() . '_datafile.json';
        $fileName = $script_name.'.js';
        File::put(public_path('uploads/campaign/'.$fileName),$script);

            if($result){
                $request->session()->flash('Success', 'Record added successfully!');
            }
            else{
                $request->session()->flash('Failed', 'Something went wrong!');
            }
            return redirect()->back();
            }
        else{
            $request->session()->flash('Failed', 'Something went wrong!');
        }
        return redirect()->back();






    }

    public function ajaxsave(Request $request)
    {

        $campaign_name = $request->input('campaign_name');
        $campaign_type = $request->input('campaign_type');
        $domain_name = $request->input('domain_name');
        $voice_variation = $request->input('voice_variation');
        $sound_niche = $request->input('sound_niche');
        $traffic_source = $request->input('traffic_source');
        $sound_src = $request->input('sound_src');
        $trigger_time = $request->input('trigger_time');
        $scroll_height = $request->input('scroll_height');
        $repeat_trigger_time = $request->input('repeat_trigger_time');
        $script_name= $request->input('script_name');

        $brandlogo= $request->input('brandlogo');
        $description_bg= $request->input('description_bg');
        $description_color= $request->input('description_color');
        $description_text = $request->input('description_text');
        $exit_intent_popup= $request->input('exit_intent_popup');
        $phone_no_optin= $request->input('phone_no_optin');
        $headline_bg= $request->input('headline_bg');
        $headline_color= $request->input('headline_color');
        $headline_text= $request->input('headline_text');
        $insite_trigger= $request->input('insite_trigger');
        $optin_message= $request->input('optin_message');
        $play_condition= $request->input('play_condition');
        $play_icon= $request->input('play_icon');
        $sp_optin_message= $request->input('sp_optin_message');
        $thankyou_message= $request->input('thankyou_message');
        $topbar_bg= $request->input('topbar_bg');
        $topbar_color= $request->input('topbar_color');
        $topbar_text= $request->input('topbar_text');
        $trigger_elements= $request->input('trigger_elements');

        
        $match_condition= $request->input('match_condition');
        $pageurl= $request->input('pageurl');
        $exclude_pages=array();

        foreach ($match_condition as $key => $value) {
          $exclude_pages_arr[]=[$match_condition[$key],$pageurl[$key]];
        }
        $exclude_pages=json_encode($exclude_pages_arr,JSON_FORCE_OBJECT);
        

        // $widget_id = $request->input('widget_id');
        // $language = $request->input('language');
//        $text_to_speech = $request->input('text_to_speech');
        // $action_type = $request->input('action_type');
        // $file_custom_upload = $request->file('custom_upload');
        // $file_favicon = $request->file('favicon_icon');
        // $back_button_redirect = $request->input('back_button_redirect');
        // $vibration_mobile = $request->input('vibration_mobile');
        // $this->validate($request,[
        //     'favicon_icon' => 'required',
        //     'favicon_icon.*' => 'required|mimes:gif,png'
        // ]);
        // $filename=rand(1000000000,9999999999);
        // $ext=$file->getClientOriginalExtension();
        // $destinationPath = 'uploads/favicon';
        // $full_filename=$filename.'.'.$ext;
        // $favicon_url=url('/').$destinationPath.'/'.$full_filename;
        // $file->move($destinationPath,$full_filename);

// ND-07092018


        $result = $this->campaign->campaign_ajax_add( $campaign_name, $domain_name, $campaign_type, $voice_variation, $sound_niche, $traffic_source,  $sound_src, $trigger_time, $scroll_height, $repeat_trigger_time,  $script_name, $brandlogo,$description_bg,$description_color,$description_text,$exit_intent_popup,$headline_bg,$headline_color,$headline_text,$insite_trigger,$exclude_pages,$optin_message,$play_condition,$play_icon,$sp_optin_message,$thankyou_message,$topbar_bg,$topbar_color,$topbar_text,$trigger_elements);


        if($result){

if($scroll_height)
{}
else{
  $scroll_height=1;
}

$favicon=url('/')."/images/convertsound-fav-def.gif";
$bbl="";
$noactrigger="";
$mb="";
$pr="";
$ap="";
$geolocation="{}";


$script="var convertsound={
'delay_time':'".$trigger_time."',
'st':'".$scroll_height."',
'audiosrc':'".$sound_src."',
'favicon':'".$favicon."',
'bbl':'".$bbl."',
'noactrigger':'".$noactrigger."',
'mb':'".$mb."',
'pr':'".$pr."',
'ap':'".$ap."',
'geolocation':".$geolocation.",
'insite_trigger':'".$insite_trigger."',
'trigger_elements':'".$trigger_elements."',
'play_condition':'".$play_condition."',
'exclude_pages':".$exclude_pages.",
'exit_intent_pop':'".$exit_intent_popup."',
'phone_no_optin':'".$phone_no_optin."',
'widget':{'tbt':'".$topbar_text."', 'tbc':'".$topbar_color."', 'tbb':'".$topbar_bg."','brandicon':'".$brandlogo."','ht':'".$headline_text."', 'hc':'".$headline_color."', 'hb':'".$headline_bg."', 'dt':'".$description_text."', 'dc':'".$description_color."', 'db':'".$description_bg."', 'position':'bottom-right', 'icon':'".$play_icon."','closebtn':'".url('/')."/images/switch.png','playbtn':'".url('/')."/images/optin-play-action.png'},
'opw':{'optinM':'".$optin_message."','sp_optinM':'".$sp_optin_message."','thankyou':'".$thankyou_message."'},
'url':'".url('/')."/optin',
'uid':'".$user_id = Auth::id()."',
'cid':'".$result."',
'domain':'".$domain_name."'

}
//Congratulations!!! You are enrolled in luckydraw now. Thankyou for your submitting your entry. We will communicate to the winners!


var cs=convertsound;
if(convertsound.mb)
{
    if(navigator.vibrate!==undefined)
      navigator.vibrate(1000);
}

if(convertsound.bbl!=''){
history.pushState('first load', null, window.location.href);
history.pushState(null, null, window.location.href);
window.addEventListener('popstate', function(event) {
event.state == 'first load' && window.location.assign(convertsound.bbl);
});  
}

window.onload = function() {

var popup=document.createElement('div');
popup.id='cs_popup';
popup.style.position='fixed';
popup.style.border='none';
popup.style.width='300px';
popup.style.zIndex='99999';
if(cs.widget.position=='middle-right'){
popup.style.right='0';
popup.style.top='40%';
}
else if(cs.widget.position=='middle-left'){
popup.style.left='0';
popup.style.top='40%';
}
else if(cs.widget.position=='bottom-left'){
popup.style.left='0';
popup.style.bottom='0';
}
else if(cs.widget.position=='bottom-right'){
popup.style.right='5px';
popup.style.bottom='0';
}
popup.style.display='block';
popup.style.textAlign='center';

document.body.appendChild(popup);
document.body.style.position='relative';
document.body.style.zIndex='1';

var opswidget=document.createElement('div');
opswidget.id='opswidget';
document.body.appendChild(opswidget);
var opswidgetHtml=\"<header class='ops-header'>\
    <div class='ops-brandname'>\"+cs.widget.tbt+\"</div>\
    <div class='ops-brandlogo'><img title='Brand name' alt='Brand Logo' src='\"+cs.widget.brandicon+\"'/></div>\
    <div class='ops-closebtn' id='ops-closebtn'><img title='Close button' alt='Close Button' src='\"+cs.widget.closebtn+\"'/></div>\
  </header>\
  <div class='ops-content'>\
    <div class='ops-heading'>\"+cs.widget.ht+\"</div>\
    <div class='ops-contenttxt'>\"+cs.widget.dt+\"</div>\
    <div class='ops-formsection' id='ops-formsection'>\
      <div class='ops-message'>\"+cs.opw.optinM+\"</div>\
      <form action='#' id='optinform' method='post'>\
        <input required='required' name='name' placeholder='Your Name*' autofocus='' type='text'>\
        <input required='required' name='email' placeholder='Your Email*' type='text'>\
        <input name='phone' class='ops-phone' placeholder='Your Phone Number' type='text'>\
        <input name='account' value='accountid' type='hidden'>\
        <button type='submit' class='ops-chat-submit' id='ops-chat-submit'>Submit</button>\
      </form> \
      <div id='optin-thank'>\
        <p>\"+cs.opw.thankyou+\"</p>\
      </div>\
    </div> \
    <div class='ops-formsection skipfm' id='ops-skipformsection'>\
      <div class='ops-message'>Special optin message here...</div>\
      <form action='#' id='skipoptinform' method='post'>\
        <input required='required' name='email' placeholder='Your Email*' type='text'>\
        <input name='phone' class='ops-phone1' placeholder='Phone Number (Optional)' type='text'>\
        <button type='submit' class='ops-chat-submit' id='ops-skip-submit'>Submit</button>\
      </form>\
      <div id='skipoptin-thank'>\"+cs.opw.thankyou+\"</div>\
    </div>\
    <div class='ops-action'>\
      <div class='ops-full'>\
        <button class='ops-playbutton' id='ops-playbutton'>Listen!</button>\
      </div><div class='ops-full'>\
        <!-- <a class='ops-skip'>Skip</a> -->\
      </div>\
    </div>\
  </div>\";
opswidgetHtml+=\"<div class='ops-footer'><div class='copyrite'>Powered By <a href='http://optinsound.com/' target='_blank'><span style='color:#43bcb6'>Optin</span> <span style='color: #767c7c'>Sound</span></a></div></div>\";
document.getElementById('opswidget').innerHTML=opswidgetHtml;
var opswidgetIcon=document.createElement('div');
opswidgetIcon.id='opswidget-icon';
document.body.appendChild(opswidgetIcon);
document.getElementById('opswidget-icon').innerHTML=\"<div class='ops-brandlogo pulse'><img title='Brand name' alt='Brand Logo' src='\"+cs.widget.brandicon+\"'/></div>\";

addCss(\"#ops-chatpop,#opswidget{font-family:sans-serif;position:fixed;width:286px; border-right:1px solid #eee; border-left:1px solid #eee; z-index:99999;bottom:0;text-align:center;background:#eee;border-radius:16px 16px 0 0}.ops-brandname,.ops-heading{font-weight:600;text-transform:uppercase}.ops-brandname,.ops-heading,.ops-playbutton{text-transform:uppercase}.ops-footer .copyrite a,.ops-skip{text-decoration:none}.ops-chat-submit,.ops-playbutton{box-sizing:border-box;transition:all .15s linear 0s}#opswidget{right:5px;display:block;}#ops-chatpop{right:270px;border:1px solid #eee;display:none} .ops-header{background:#636363;height:90px; border-radius:16px 16px 0 0; position:relative;z-index:1} .ops-brandname{color:#fff;font-size:14px;padding:30px 0}.ops-brandlogo img,.ops-closebtn img{font-size:10px;vertical-align:middle;text-align:center}.ops-brandlogo{position:absolute;z-index:2;height:70px;bottom:-35px;text-align:center;width:100%;display:block}.ops-brandlogo img{height:70px;width:70px;display:inline-block;border-radius:50%;background:#d7d7d7;color:#fff}.ops-closebtn{position:absolute;z-index:3;background:#fff;height:27px;width:26px;top:6px;right:6px;display:block;border-radius:50%;padding:2px;cursor:pointer}.ops-closebtn img{height:22px;width:22px;display:inline-block;color:#333}.ops-content{background:#fff;min-height:100px;border-radius:0 0 16px 16px;position:relative;margin-bottom:5px;padding:40px 0 80px}.ops-contenttxt,.ops-heading{padding:5px 10px 10px;width:100%}.ops-heading{color:#000;font-size:18px;line-height:1.4}.ops-message,.ops-skip{line-height:1.2;color:#636363}.ops-contenttxt{color:#636363;font-weight:400;font-size:13px;line-height:1.2}.ops-action{text-align:center;width:100%;display:block;position:absolute;bottom:0;height:80px}.ops-playbutton{background:url('".url('/')."/images/optin-play-action.png"."') left no-repeat #3b569b;border-radius:12px;color:#fff;font-size:12.5px;font-weight:600;padding:7px 18px 7px 35px;border:0;cursor:pointer}.ops-full{width:100%;text-align:center}.ops-skip{font-weight:400;font-size:8px;padding:10px 0;width:auto;cursor:pointer;display:inline-block}.ops-content:after{content:'';position:absolute;bottom:0;left:50%;width:0;height:0;border:5px solid transparent;border-top-color:#fff;border-bottom:0;margin-left:-5px;margin-bottom:-5px}.ops-footer{height:24px;position:relative;width:100%}.ops-footer .copyrite{height:16px;color:#636363;font-weight:400;font-size:10px;padding:4px 0}.ops-footer .copyrite span{font-weight:600}.ops-message{font-weight:400;font-size:14px;padding:5px 10px 10px;max-width:100%}.ops-formsection{opacity:0;height:0;visibility:hidden;position:relative;bottom:-10px}.ops-fade-in{opacity:1;visibility:visible;height:auto;animation-name:fadeInOpacity;animation-iteration-count:1;animation-timing-function:ease-in;animation-duration:.2s;z-index:5}@keyframes fadeInOpacity{0%{opacity:0}100%{opacity:1}}.ops-chat-submit{background:#3b569b;border-radius:20px;color:#fff;font-size:14px;font-weight:600;padding:7px 18px;border:0}#ops-chatpop form{padding:10px}.ops-formsection input[type=text]{font-size:12px;border:1px solid #ccc;border-radius:3px;margin-bottom:10px;outline:0;padding:8px;width:240px}div#opswidget-icon{cursor:pointer;background:0 0;border-radius:43px;bottom:10px;display:block;height:85px;right:10px;position:fixed;width:85px;z-index:100}.visit-us{background:#fff;border-radius:30px;font-family:sans-serif;font-size:12px;padding:10px;position:absolute;top:20px;width:190px;z-index:1;border:1px solid #eee}#opswidget-icon .ops-brandlogo img{height:75px;width:75px;border:5px solid #fafafa}#opswidget-icon .ops-brandlogo{bottom:15px;display:block;position:absolute;right:0;text-align:right;z-index:2}@keyframes pulse_animation{0%,100%,30%,50%,60%,80%{transform:scale(1)}40%{transform:scale(1.08)}70%{transform:scale(1.05)}}.pulse{animation-name:pulse_animation;animation-duration:5s;transform-origin:70% 70%;animation-iteration-count:infinite;animation-timing-function:linear}#optin-thank{display:none;font-size: 15px; font-weight: 400; max-width: 100%; padding: 5px 10px 10px;}#skipoptin-thank{display:none; font-size: 15px; font-weight: 400; max-width: 100%; padding: 5px 10px 10px;}#optin-thank p{padding:45px 4px} .ops-content.formopen {   padding-bottom: 40px; }\");



/*
addCss(\"#ops-chatpop,#opswidget{font-family:sans-serif;position:fixed;width:260px;z-index:99999;bottom:0;text-align:center;background:#eee;border-radius:16px 16px 0 0}.ops-brandname,.ops-heading{font-weight:600;text-transform:uppercase}.ops-brandname,.ops-heading,.ops-playbutton{text-transform:uppercase}.ops-footer .copyrite a,.ops-skip{text-decoration:none}#ops-chat-submit,.ops-playbutton{box-sizing:border-box;transition:all .15s linear 0s}#opswidget{right:5px;display:block;}#ops-chatpop{right:270px;border:1px solid #eee;display:none}.ops-header{background:#636363;height:90px;border-radius:16px 16px 0 0;position:relative;z-index:1}.ops-brandname{color:#fff;font-size:14px;padding:30px 0}.ops-brandlogo img,.ops-closebtn img{font-size:10px;vertical-align:middle;text-align:center}.ops-brandlogo{position:absolute;z-index:2;height:70px;bottom:-35px;text-align:center;width:100%;display:block}.ops-brandlogo img{height:70px;width:70px;display:inline-block;border-radius:50%;background:#d7d7d7;color:#fff}.ops-closebtn{position:absolute;z-index:3;background:#fff;height:27px;width:26px;top:6px;right:6px;display:block;border-radius:50%;padding:2px;cursor:pointer}.ops-closebtn img{height:22px;width:22px;display:inline-block;color:#333}.ops-content{    border-left: 1px solid #eee;border-right: 1px solid #eee;background:#fff;min-height:100px;border-radius:0 0 16px 16px;position:relative;margin-bottom:5px;padding:40px 0 80px}.ops-contenttxt,.ops-heading{padding:5px 10px 10px;width:100%}.ops-heading{color:#000;font-size:18px;line-height:1.4}.ops-message,.ops-skip{line-height:1.2;color:#636363}.ops-contenttxt{color:#636363;font-weight:400;font-size:12px;line-height:1.2}.ops-action{text-align:center;width:100%;display:block;position:absolute;bottom:0;height:80px}.ops-playbutton{background:url('".url('/')."/images/optin-play-action.png"."') left no-repeat #3b569b;border-radius:12px;color:#fff;font-size:12.5px;font-weight:600;padding:7px 18px 7px 35px;border:0;cursor:pointer}.ops-full{width:100%;text-align:center}.ops-skip{font-weight:400;font-size:8px;padding:10px 0;width:auto;cursor:pointer;display:inline-block}.ops-content:after{content:'';position:absolute;bottom:0;left:50%;width:0;height:0;border:5px solid transparent;border-top-color:#fff;border-bottom:0;margin-left:-5px;margin-bottom:-5px}.ops-footer{height:26px;position:relative;width:100%}.ops-footer .copyrite{height:16px;color:#636363;font-weight:400;font-size:10px;padding:4px 0}.ops-footer .copyrite span{font-weight:600}.ops-message{font-weight:400;font-size:12px;padding:5px 10px 10px;max-width:100%}.ops-formsection{opacity:0;height:0;visibility:hidden;position:relative;bottom:-50px}.ops-fade-in{opacity:1;visibility:visible;height:auto;animation-name:fadeInOpacity;animation-iteration-count:1;animation-timing-function:ease-in;animation-duration:.2s;z-index: 5;}@keyframes fadeInOpacity{0%{opacity:0}100%{opacity:1}}#ops-chat-submit{background:#3b569b;border-radius:20px;color:#fff;font-size:14px;font-weight:600;padding:7px 18px;border:0}#ops-chatpop form{padding:10px}.ops-formsection input[type=text]{border:1px solid #ccc;border-radius:3px;margin-bottom:10px;outline:0;padding:8px;width:220px}div#opswidget-icon{cursor:pointer;background:0 0;border-radius:37px;bottom:5px;display:block;height:76px;right:5px;position:fixed;width:220px;z-index:100;border:2px solid #999}.visit-us{background:#fff;border-radius:30px;font-family:sans-serif;font-size:12px;padding:10px;position:absolute;top:17px;width:190px;z-index:1;border:1px solid #eee}#opswidget-icon .ops-brandlogo{bottom:1px;display:block;height:70px;position:absolute;right:3px;text-align:right;width:100%;z-index:2}#optin-thank{display:none}#optin-thank p{padding:45px 4px}\");
*/

if(cs.phone_no_optin=='on')
{}
else
{
  document.querySelector('.ops-phone').style.display='none';
  document.querySelector('.ops-phone1').style.display='none';
}

document.getElementById('ops-playbutton').addEventListener('click',function(){
  var element = document.getElementById('ops-formsection');
  element.classList.add('ops-fade-in');
  document.querySelector('.ops-action').style.display='none';
  document.querySelector('.ops-content').classList.add('formopen');
});        
document.getElementById('ops-closebtn').addEventListener('click',function(){
  var element = document.getElementById('opswidget');
  element.style.display='none';
});        
document.getElementById('opswidget-icon').addEventListener('click',function(){
  var element = document.getElementById('opswidget');
  document.getElementById('ops-formsection').classList.remove('ops-fade-in');
  document.getElementById('ops-skipformsection').classList.remove('ops-fade-in');

  document.querySelector('.ops-action').style.display='block';
  document.querySelector('#optinform').style.display='block';
  document.querySelector('#optin-thank').style.display='none';

  document.querySelector('.ops-content').classList.remove('formopen');
  element.style.display='block';

});

document.getElementById('ops-skip').addEventListener('click',function(){
  var element = document.getElementById('ops-skipformsection');
  element.classList.add('ops-fade-in');
  document.querySelector('.ops-content').classList.add('formopen');
  document.querySelector('.ops-action').style.display='none';
});


var tt=true;
document.getElementById('ops-playbutton').addEventListener('click', function() {
if(tt){
tt=false;
document.getElementById('convertsound_audio').muted = false;
console.log('played');
}
document.getElementById('convertsound_audio').play();
},false);


var division=document.createElement('div');
division.id='soundcontainer';
division.style.width='50%';
division.style.height='50%';
division.style.position='absolute';
division.style.border='none';
division.style.zIndex='0';
division.style.top='0';
// division.style.width='340px';
division.style.left='-5000px';
division.style.background='#fff';
document.body.appendChild(division);
document.body.style.position='relative';
document.body.style.zIndex='1';

document.getElementById('soundcontainer').innerHTML=\"<audio class='form-control' name='dfy_soundpreview' id='convertsound_audio'  controls><source src='\"+cs.audiosrc+\"' type='audio/mpeg'>Your browser does not support the audio tag.</audio><button id='unmuteButton' style='margin-top:20px;''>Play</button>\";


var playonscroll=true;
function scrolltopevent(){
  var doc = document.documentElement;
  var left = (window.pageXOffset || doc.scrollLeft) - (doc.clientLeft || 0);
  var top = (window.pageYOffset || doc.scrollTop)  - (doc.clientTop || 0);
  if(top>=convertsound.st && playonscroll)
  {
    document.getElementById('convertsound_audio').pause();
    document.getElementById('convertsound_audio').currentTime=0;
  document.getElementById('convertsound_audio').muted = false;
    document.getElementById('convertsound_audio').play();
    alert('in');
    console.log('scroll-play');
  } 
}

if(convertsound.delay_time=='' && convertsound.st!=''){
//    this.addEventListener('scroll',scrolltopevent,false);
   // this.addEventListener('touchmove',playondelaymobile,false);
}


document.getElementById('ops-playbutton').addEventListener('click', showPopup);
document.getElementById('ops-closebtn').addEventListener('click', removePopup);


var submit = document.getElementById('ops-chat-submit');
if (submit.addEventListener) {
  submit.addEventListener('click', optinformsubmit);
} else {
  submit.attachEvent('onclick', optinformsubmit);
}

function optinformsubmit (e) {
  e = e || window.event;

    var formdata='';

    formdata+= '&name='+encodeURIComponent(document.querySelector('#optinform input[name=\"name\"]').value);
    formdata+= '&email='+encodeURIComponent(document.querySelector('#optinform input[name=\"email\"]').value);
    formdata+= '&phone='+encodeURIComponent(document.querySelector('#optinform input[name=\"phone\"]').value);
    formdata+= '&cid='+convertsound.cid;
    formdata+= '&id='+convertsound.uid;


  console.log(formdata);

  convertsound.sendData(convertsound.url+'?'+formdata,'callback');
  // if invalid
  if (e.preventDefault) {
    e.preventDefault();
  } else {
    e.returnValue = false;
  }
}

var skipsubmit = document.getElementById('ops-skip-submit');
if (skipsubmit.addEventListener) {
  skipsubmit.addEventListener('click', optinformsubmit1);
} else {
  skipsubmit.attachEvent('onclick', optinformsubmit1);
}

function optinformsubmit1(e) {
  e = e || window.event;

    var formdata='';

    formdata+= '&name='
    formdata+= '&email='+encodeURIComponent(document.querySelector('#skipoptinform input[name=\"email\"]').value);
    formdata+= '&phone='+encodeURIComponent(document.querySelector('#skipoptinform input[name=\"phone\"]').value);
    formdata+= '&cid='+convertsound.cid;
    formdata+= '&id='+convertsound.uid;

  console.log(formdata);

  convertsound.sendData(convertsound.url+'?'+formdata,'callback');

  if (e.preventDefault) {
    e.preventDefault();
  } else {
    e.returnValue = false;
  }
}




}

function showPopup(){
  var element = document.getElementById('opswidget');
  element.classList.add('showpop');
}

function removePopup(){
    var element = document.getElementById('opswidget');
    element.classList.remove('showpop');
}

function playondelay(){
    setTimeout(function(){
    audio.play();
    },convertsound.delay_time*1000);    
}


function playondelaymobile(){
alert('mobile');
}

if(convertsound.ap){
document.addEventListener('visibilitychange', function() {
    if (document.hidden){
      audio.pause();
      console.log('Browser tab is hidden')
    } else {
      audio.play();
      console.log('Browser tab is visible')
    }
});

}

if(convertsound.noactrigger)
{
function setup() {
    this.addEventListener('mousemove', resetTimer, false);
    this.addEventListener('mousedown', resetTimer, false);
    this.addEventListener('keypress', resetTimer, false);
    this.addEventListener('DOMMouseScroll', resetTimer, false);
    this.addEventListener('mousewheel', resetTimer, false);
    this.addEventListener('touchmove', resetTimer, false);
    this.addEventListener('MSPointerMove', resetTimer, false);
    this.addEventListener('scroll', scrolltopevent, false);
    startTimer();
}
setup();

}

function startTimer() {
    timeoutID = window.setTimeout(goInactive, 60000);
}

function resetTimer(e) {
    window.clearTimeout(timeoutID);
    goActive();
}


function goInactive() {
  setTimeout(function(){
    audio.play();
    goActive();
  },convertsound.delay_time*1000);
  console.log('reactive');
}

function goActive() {
    startTimer();
}



if(convertsound.favicon!='')
{
 (function() {
    var link = document.querySelector('link[rel*=\"icon\"]') || document.createElement('link');
    link.type = 'image/x-icon';
    link.rel = 'shortcut icon';
    link.href = convertsound.favicon;
    document.getElementsByTagName('head')[0].appendChild(link);
})();
 
}


  
convertsound.sendData= function  (url,callback){
    if (window.XMLHttpRequest)
    {
      xmlhttp=new XMLHttpRequest();
    }
    else
    {
      xmlhttp=new ActiveXObject('Microsoft.XMLHTTP');
    }
    xmlhttp.onreadystatechange=function()
    {
      if(xmlhttp.readyState==4 && xmlhttp.status==200)
      {
          alert(xmlhttp.responseText);

        if(xmlhttp.responseText=='Success'){
        document.querySelector('#optinform').style.display='none';
        document.querySelector('#skipoptinform').style.display='none';
        document.querySelector('#optin-thank').style.display='block';
        document.querySelector('#skipoptin-thank').style.display='block';
        setTimeout(function(){
        document.querySelector('#opswidget').style.display='none';
        document.querySelector('#optin-thank').style.display='none';
        document.querySelector('#skipoptin-thank').style.display='none';
        document.getElementById('optinform').reset(); 
        document.getElementById('skipoptinform').reset(); 
          },5000);         
        }
 
      }
    };
    xmlhttp.open('GET',url);
    xmlhttp.send();
};


function addCss(css) {
  // ss is style variable
  var ss = document.createElement('style');
  ss.type = 'text/css';
  ss.rel = 'stylesheet';
  ss.media = 'all';
  try {
    ss.styleSheet.cssText = css;
  } catch (t) {}
  try {
    ss.innerHTML = css;
  } catch (t) {}
  document.getElementsByTagName('head')[0].appendChild(ss);
}";

// Create file

        // $data = json_encode(['Example 1','Example 2','Example 3',]);
        // $fileName = time() . '_datafile.json';
        $fileName = $script_name.'.js';
        File::put(public_path('uploads/campaign/'.$fileName),$script);

        echo url('/').'/uploads/campaign/'.$fileName;

    }
}



public function ajaxupdate(Request $request)
    {


        $campaign_name = $request->input('campaign_name');
        $campaign_id = $request->input('campaign_id');
        $campaign_type = $request->input('campaign_type');
        $domain_name = $request->input('domain_name');
        $voice_variation = $request->input('voice_variation');
        $sound_niche = $request->input('sound_niche');
        $traffic_source = $request->input('traffic_source');
        $sound_src = $request->input('sound_src');
        $trigger_time = $request->input('trigger_time');
        $scroll_height = $request->input('scroll_height');
        $repeat_trigger_time = $request->input('repeat_trigger_time');
        $script_name= $request->input('script_name');

        $brandlogo= $request->input('brandlogo');
        $description_bg= $request->input('description_bg');
        $description_color= $request->input('description_color');
        $description_text = $request->input('description_text');
        $exit_intent_popup= $request->input('exit_intent_popup');
        $phone_no_optin= $request->input('phone_no_optin');
        $headline_bg= $request->input('headline_bg');
        $headline_color= $request->input('headline_color');
        $headline_text= $request->input('headline_text');
        $insite_trigger= $request->input('insite_trigger');
        $optin_message= $request->input('optin_message');
        $play_condition= $request->input('play_condition');
        $play_icon= $request->input('play_icon');
        $sp_optin_message= $request->input('sp_optin_message');
        $thankyou_message= $request->input('thankyou_message');
        $topbar_bg= $request->input('topbar_bg');
        $topbar_color= $request->input('topbar_color');
        $topbar_text= $request->input('topbar_text');
        $trigger_elements= $request->input('trigger_elements');

        
        $match_condition= $request->input('match_condition');
        $pageurl= $request->input('pageurl');
        $exclude_pages=array();

        foreach ($match_condition as $key => $value) {
          $exclude_pages_arr[]=[$match_condition[$key],$pageurl[$key]];
        }
        $exclude_pages=json_encode($exclude_pages_arr,JSON_FORCE_OBJECT);



        $result = $this->campaign->campaign_ajax_update( $campaign_id, $campaign_name, $domain_name, $campaign_type, $voice_variation, $sound_niche, $traffic_source,  $sound_src, $trigger_time, $scroll_height, $repeat_trigger_time,  $script_name, $brandlogo,$description_bg,$description_color,$description_text,$exit_intent_popup,$headline_bg,$headline_color,$headline_text,$insite_trigger,$exclude_pages,$optin_message,$play_condition,$play_icon,$sp_optin_message,$thankyou_message,$topbar_bg,$topbar_color,$topbar_text,$trigger_elements);



        
        if($result){

if($scroll_height)
{}
else{
  $scroll_height=1;
}

$favicon=url('/')."/images/convertsound-fav-def.gif";
$bbl="";
$noactrigger="";
$mb="";
$pr="";
$ap="";
$geolocation="{}";


$script="var convertsound={
'delay_time':'".$trigger_time."',
'st':'".$scroll_height."',
'audiosrc':'".$sound_src."',
'favicon':'".$favicon."',
'bbl':'".$bbl."',
'noactrigger':'".$noactrigger."',
'mb':'".$mb."',
'pr':'".$pr."',
'ap':'".$ap."',
'geolocation':".$geolocation.",
'insite_trigger':'".$insite_trigger."',
'trigger_elements':'".$trigger_elements."',
'play_condition':'".$play_condition."',
'exclude_pages':".$exclude_pages.",
'exit_intent_pop':'".$exit_intent_popup."',
'phone_no_optin':'".$phone_no_optin."',
'widget':{'tbt':'".$topbar_text."', 'tbc':'".$topbar_color."', 'tbb':'".$topbar_bg."','brandicon':'".$brandlogo."','ht':'".$headline_text."', 'hc':'".$headline_color."', 'hb':'".$headline_bg."', 'dt':'".$description_text."', 'dc':'".$description_color."', 'db':'".$description_bg."', 'position':'bottom-right', 'icon':'".$play_icon."','closebtn':'".url('/')."/images/switch.png','playbtn':'".url('/')."/images/optin-play-action.png'},
'opw':{'optinM':'".$optin_message."','sp_optinM':'".$sp_optin_message."','thankyou':'".$thankyou_message."'},
'url':'".url('/')."/optin',
'uid':'".$user_id = Auth::id()."',
'cid':'".$result."',
'domain':'".$domain_name."'

}
//Congratulations!!! You are enrolled in luckydraw now. Thankyou for your submitting your entry. We will communicate to the winners!


var cs=convertsound;
if(convertsound.mb)
{
    if(navigator.vibrate!==undefined)
      navigator.vibrate(1000);
}

if(convertsound.bbl!=''){
history.pushState('first load', null, window.location.href);
history.pushState(null, null, window.location.href);
window.addEventListener('popstate', function(event) {
event.state == 'first load' && window.location.assign(convertsound.bbl);
});  
}

window.onload = function() {

var popup=document.createElement('div');
popup.id='cs_popup';
popup.style.position='fixed';
popup.style.border='none';
popup.style.width='300px';
popup.style.zIndex='99999';
if(cs.widget.position=='middle-right'){
popup.style.right='0';
popup.style.top='40%';
}
else if(cs.widget.position=='middle-left'){
popup.style.left='0';
popup.style.top='40%';
}
else if(cs.widget.position=='bottom-left'){
popup.style.left='0';
popup.style.bottom='0';
}
else if(cs.widget.position=='bottom-right'){
popup.style.right='5px';
popup.style.bottom='0';
}
popup.style.display='block';
popup.style.textAlign='center';

document.body.appendChild(popup);
document.body.style.position='relative';
document.body.style.zIndex='1';

var opswidget=document.createElement('div');
opswidget.id='opswidget';
document.body.appendChild(opswidget);
var opswidgetHtml=\"<header class='ops-header'>\
    <div class='ops-brandname'>\"+cs.widget.tbt+\"</div>\
    <div class='ops-brandlogo'><img title='Brand name' alt='Brand Logo' src='\"+cs.widget.brandicon+\"'/></div>\
    <div class='ops-closebtn' id='ops-closebtn'><img title='Close button' alt='Close Button' src='\"+cs.widget.closebtn+\"'/></div>\
  </header>\
  <div class='ops-content'>\
    <div class='ops-heading'>\"+cs.widget.ht+\"</div>\
    <div class='ops-contenttxt'>\"+cs.widget.dt+\"</div>\
    <div class='ops-formsection' id='ops-formsection'>\
      <div class='ops-message'>\"+cs.opw.optinM+\"</div>\
      <form action='#' id='optinform' method='post'>\
        <input required='required' name='name' placeholder='Your Name*' autofocus='' type='text'>\
        <input required='required' name='email' placeholder='Your Email*' type='text'>\
        <input name='phone' class='ops-phone' placeholder='Your Phone Number' type='text'>\
        <input name='account' value='accountid' type='hidden'>\
        <button type='submit' class='ops-chat-submit' id='ops-chat-submit'>Submit</button>\
      </form> \
      <div id='optin-thank'>\
        <p>\"+cs.opw.thankyou+\"</p>\
      </div>\
    </div> \
    <div class='ops-formsection skipfm' id='ops-skipformsection'>\
      <div class='ops-message'>Special optin message here...</div>\
      <form action='#' id='skipoptinform' method='post'>\
        <input required='required' name='email' placeholder='Your Email*' type='text'>\
        <input name='phone' class='ops-phone1' placeholder='Phone Number (Optional)' type='text'>\
        <button type='submit' class='ops-chat-submit' id='ops-skip-submit'>Submit</button>\
      </form>\
      <div id='skipoptin-thank'>\"+cs.opw.thankyou+\"</div>\
    </div>\
    <div class='ops-action'>\
      <div class='ops-full'>\
        <button class='ops-playbutton' id='ops-playbutton'>Listen!</button>\
      </div><div class='ops-full'>\
        <!-- <a class='ops-skip'>Skip</a> -->\
      </div>\
    </div>\
  </div>\";
opswidgetHtml+=\"<div class='ops-footer'><div class='copyrite'>Powered By <a href='http://optinsound.com/' target='_blank'><span style='color:#43bcb6'>Optin</span> <span style='color: #767c7c'>Sound</span></a></div></div>\";
document.getElementById('opswidget').innerHTML=opswidgetHtml;
var opswidgetIcon=document.createElement('div');
opswidgetIcon.id='opswidget-icon';
document.body.appendChild(opswidgetIcon);
document.getElementById('opswidget-icon').innerHTML=\"<div class='ops-brandlogo pulse'><img title='Brand name' alt='Brand Logo' src='\"+cs.widget.brandicon+\"'/></div>\";

addCss(\"#ops-chatpop,#opswidget{font-family:sans-serif;position:fixed;width:286px; border-right:1px solid #eee; border-left:1px solid #eee; z-index:99999;bottom:0;text-align:center;background:#eee;border-radius:16px 16px 0 0}.ops-brandname,.ops-heading{font-weight:600;text-transform:uppercase}.ops-brandname,.ops-heading,.ops-playbutton{text-transform:uppercase}.ops-footer .copyrite a,.ops-skip{text-decoration:none}.ops-chat-submit,.ops-playbutton{box-sizing:border-box;transition:all .15s linear 0s}#opswidget{right:5px;display:block;}#ops-chatpop{right:270px;border:1px solid #eee;display:none} .ops-header{background:#636363;height:90px; border-radius:16px 16px 0 0; position:relative;z-index:1} .ops-brandname{color:#fff;font-size:14px;padding:30px 0}.ops-brandlogo img,.ops-closebtn img{font-size:10px;vertical-align:middle;text-align:center}.ops-brandlogo{position:absolute;z-index:2;height:70px;bottom:-35px;text-align:center;width:100%;display:block}.ops-brandlogo img{height:70px;width:70px;display:inline-block;border-radius:50%;background:#d7d7d7;color:#fff}.ops-closebtn{position:absolute;z-index:3;background:#fff;height:27px;width:26px;top:6px;right:6px;display:block;border-radius:50%;padding:2px;cursor:pointer}.ops-closebtn img{height:22px;width:22px;display:inline-block;color:#333}.ops-content{background:#fff;min-height:100px;border-radius:0 0 16px 16px;position:relative;margin-bottom:5px;padding:40px 0 80px}.ops-contenttxt,.ops-heading{padding:5px 10px 10px;width:100%}.ops-heading{color:#000;font-size:18px;line-height:1.4}.ops-message,.ops-skip{line-height:1.2;color:#636363}.ops-contenttxt{color:#636363;font-weight:400;font-size:13px;line-height:1.2}.ops-action{text-align:center;width:100%;display:block;position:absolute;bottom:0;height:80px}.ops-playbutton{background:url('".url('/')."/images/optin-play-action.png"."') left no-repeat #3b569b;border-radius:12px;color:#fff;font-size:12.5px;font-weight:600;padding:7px 18px 7px 35px;border:0;cursor:pointer}.ops-full{width:100%;text-align:center}.ops-skip{font-weight:400;font-size:8px;padding:10px 0;width:auto;cursor:pointer;display:inline-block}.ops-content:after{content:'';position:absolute;bottom:0;left:50%;width:0;height:0;border:5px solid transparent;border-top-color:#fff;border-bottom:0;margin-left:-5px;margin-bottom:-5px}.ops-footer{height:24px;position:relative;width:100%}.ops-footer .copyrite{height:16px;color:#636363;font-weight:400;font-size:10px;padding:4px 0}.ops-footer .copyrite span{font-weight:600}.ops-message{font-weight:400;font-size:14px;padding:5px 10px 10px;max-width:100%}.ops-formsection{opacity:0;height:0;visibility:hidden;position:relative;bottom:-10px}.ops-fade-in{opacity:1;visibility:visible;height:auto;animation-name:fadeInOpacity;animation-iteration-count:1;animation-timing-function:ease-in;animation-duration:.2s;z-index:5}@keyframes fadeInOpacity{0%{opacity:0}100%{opacity:1}}.ops-chat-submit{background:#3b569b;border-radius:20px;color:#fff;font-size:14px;font-weight:600;padding:7px 18px;border:0}#ops-chatpop form{padding:10px}.ops-formsection input[type=text]{font-size:12px;border:1px solid #ccc;border-radius:3px;margin-bottom:10px;outline:0;padding:8px;width:240px}div#opswidget-icon{cursor:pointer;background:0 0;border-radius:43px;bottom:10px;display:block;height:85px;right:10px;position:fixed;width:85px;z-index:100}.visit-us{background:#fff;border-radius:30px;font-family:sans-serif;font-size:12px;padding:10px;position:absolute;top:20px;width:190px;z-index:1;border:1px solid #eee}#opswidget-icon .ops-brandlogo img{height:75px;width:75px;border:5px solid #fafafa}#opswidget-icon .ops-brandlogo{bottom:15px;display:block;position:absolute;right:0;text-align:right;z-index:2}@keyframes pulse_animation{0%,100%,30%,50%,60%,80%{transform:scale(1)}40%{transform:scale(1.08)}70%{transform:scale(1.05)}}.pulse{animation-name:pulse_animation;animation-duration:5s;transform-origin:70% 70%;animation-iteration-count:infinite;animation-timing-function:linear}#optin-thank{display:none;font-size: 15px; font-weight: 400; max-width: 100%; padding: 5px 10px 10px;}#skipoptin-thank{display:none; font-size: 15px; font-weight: 400; max-width: 100%; padding: 5px 10px 10px;}#optin-thank p{padding:45px 4px} .ops-content.formopen {   padding-bottom: 40px; }\");



/*
addCss(\"#ops-chatpop,#opswidget{font-family:sans-serif;position:fixed;width:260px;z-index:99999;bottom:0;text-align:center;background:#eee;border-radius:16px 16px 0 0}.ops-brandname,.ops-heading{font-weight:600;text-transform:uppercase}.ops-brandname,.ops-heading,.ops-playbutton{text-transform:uppercase}.ops-footer .copyrite a,.ops-skip{text-decoration:none}#ops-chat-submit,.ops-playbutton{box-sizing:border-box;transition:all .15s linear 0s}#opswidget{right:5px;display:block;}#ops-chatpop{right:270px;border:1px solid #eee;display:none}.ops-header{background:#636363;height:90px;border-radius:16px 16px 0 0;position:relative;z-index:1}.ops-brandname{color:#fff;font-size:14px;padding:30px 0}.ops-brandlogo img,.ops-closebtn img{font-size:10px;vertical-align:middle;text-align:center}.ops-brandlogo{position:absolute;z-index:2;height:70px;bottom:-35px;text-align:center;width:100%;display:block}.ops-brandlogo img{height:70px;width:70px;display:inline-block;border-radius:50%;background:#d7d7d7;color:#fff}.ops-closebtn{position:absolute;z-index:3;background:#fff;height:27px;width:26px;top:6px;right:6px;display:block;border-radius:50%;padding:2px;cursor:pointer}.ops-closebtn img{height:22px;width:22px;display:inline-block;color:#333}.ops-content{    border-left: 1px solid #eee;border-right: 1px solid #eee;background:#fff;min-height:100px;border-radius:0 0 16px 16px;position:relative;margin-bottom:5px;padding:40px 0 80px}.ops-contenttxt,.ops-heading{padding:5px 10px 10px;width:100%}.ops-heading{color:#000;font-size:18px;line-height:1.4}.ops-message,.ops-skip{line-height:1.2;color:#636363}.ops-contenttxt{color:#636363;font-weight:400;font-size:12px;line-height:1.2}.ops-action{text-align:center;width:100%;display:block;position:absolute;bottom:0;height:80px}.ops-playbutton{background:url('".url('/')."/images/optin-play-action.png"."') left no-repeat #3b569b;border-radius:12px;color:#fff;font-size:12.5px;font-weight:600;padding:7px 18px 7px 35px;border:0;cursor:pointer}.ops-full{width:100%;text-align:center}.ops-skip{font-weight:400;font-size:8px;padding:10px 0;width:auto;cursor:pointer;display:inline-block}.ops-content:after{content:'';position:absolute;bottom:0;left:50%;width:0;height:0;border:5px solid transparent;border-top-color:#fff;border-bottom:0;margin-left:-5px;margin-bottom:-5px}.ops-footer{height:26px;position:relative;width:100%}.ops-footer .copyrite{height:16px;color:#636363;font-weight:400;font-size:10px;padding:4px 0}.ops-footer .copyrite span{font-weight:600}.ops-message{font-weight:400;font-size:12px;padding:5px 10px 10px;max-width:100%}.ops-formsection{opacity:0;height:0;visibility:hidden;position:relative;bottom:-50px}.ops-fade-in{opacity:1;visibility:visible;height:auto;animation-name:fadeInOpacity;animation-iteration-count:1;animation-timing-function:ease-in;animation-duration:.2s;z-index: 5;}@keyframes fadeInOpacity{0%{opacity:0}100%{opacity:1}}#ops-chat-submit{background:#3b569b;border-radius:20px;color:#fff;font-size:14px;font-weight:600;padding:7px 18px;border:0}#ops-chatpop form{padding:10px}.ops-formsection input[type=text]{border:1px solid #ccc;border-radius:3px;margin-bottom:10px;outline:0;padding:8px;width:220px}div#opswidget-icon{cursor:pointer;background:0 0;border-radius:37px;bottom:5px;display:block;height:76px;right:5px;position:fixed;width:220px;z-index:100;border:2px solid #999}.visit-us{background:#fff;border-radius:30px;font-family:sans-serif;font-size:12px;padding:10px;position:absolute;top:17px;width:190px;z-index:1;border:1px solid #eee}#opswidget-icon .ops-brandlogo{bottom:1px;display:block;height:70px;position:absolute;right:3px;text-align:right;width:100%;z-index:2}#optin-thank{display:none}#optin-thank p{padding:45px 4px}\");
*/

if(cs.phone_no_optin=='on')
{}
else
{
  document.querySelector('.ops-phone').style.display='none';
  document.querySelector('.ops-phone1').style.display='none';
}

document.getElementById('ops-playbutton').addEventListener('click',function(){
  var element = document.getElementById('ops-formsection');
  element.classList.add('ops-fade-in');
  document.querySelector('.ops-action').style.display='none';
  document.querySelector('.ops-content').classList.add('formopen');
});        
document.getElementById('ops-closebtn').addEventListener('click',function(){
  var element = document.getElementById('opswidget');
  element.style.display='none';
});        
document.getElementById('opswidget-icon').addEventListener('click',function(){
  var element = document.getElementById('opswidget');
  document.getElementById('ops-formsection').classList.remove('ops-fade-in');
  document.getElementById('ops-skipformsection').classList.remove('ops-fade-in');

  document.querySelector('.ops-action').style.display='block';
  document.querySelector('#optinform').style.display='block';
  document.querySelector('#optin-thank').style.display='none';

  document.querySelector('.ops-content').classList.remove('formopen');
  element.style.display='block';

});

document.getElementById('ops-skip').addEventListener('click',function(){
  var element = document.getElementById('ops-skipformsection');
  element.classList.add('ops-fade-in');
  document.querySelector('.ops-content').classList.add('formopen');
  document.querySelector('.ops-action').style.display='none';
});


var tt=true;
document.getElementById('ops-playbutton').addEventListener('click', function() {
if(tt){
tt=false;
document.getElementById('convertsound_audio').muted = false;
console.log('played');
}
document.getElementById('convertsound_audio').play();
},false);


var division=document.createElement('div');
division.id='soundcontainer';
division.style.width='50%';
division.style.height='50%';
division.style.position='absolute';
division.style.border='none';
division.style.zIndex='0';
division.style.top='0';
// division.style.width='340px';
division.style.left='-5000px';
division.style.background='#fff';
document.body.appendChild(division);
document.body.style.position='relative';
document.body.style.zIndex='1';

document.getElementById('soundcontainer').innerHTML=\"<audio class='form-control' name='dfy_soundpreview' id='convertsound_audio'  controls><source src='\"+cs.audiosrc+\"' type='audio/mpeg'>Your browser does not support the audio tag.</audio><button id='unmuteButton' style='margin-top:20px;''>Play</button>\";


var playonscroll=true;
function scrolltopevent(){
  var doc = document.documentElement;
  var left = (window.pageXOffset || doc.scrollLeft) - (doc.clientLeft || 0);
  var top = (window.pageYOffset || doc.scrollTop)  - (doc.clientTop || 0);
  if(top>=convertsound.st && playonscroll)
  {
    document.getElementById('convertsound_audio').pause();
    document.getElementById('convertsound_audio').currentTime=0;
  document.getElementById('convertsound_audio').muted = false;
    document.getElementById('convertsound_audio').play();
    alert('in');
    console.log('scroll-play');
  } 
}

if(convertsound.delay_time=='' && convertsound.st!=''){
//    this.addEventListener('scroll',scrolltopevent,false);
   // this.addEventListener('touchmove',playondelaymobile,false);
}


document.getElementById('ops-playbutton').addEventListener('click', showPopup);
document.getElementById('ops-closebtn').addEventListener('click', removePopup);


var submit = document.getElementById('ops-chat-submit');
if (submit.addEventListener) {
  submit.addEventListener('click', optinformsubmit);
} else {
  submit.attachEvent('onclick', optinformsubmit);
}

function optinformsubmit (e) {
  e = e || window.event;

    var formdata='';

    formdata+= '&name='+encodeURIComponent(document.querySelector('#optinform input[name=\"name\"]').value);
    formdata+= '&email='+encodeURIComponent(document.querySelector('#optinform input[name=\"email\"]').value);
    formdata+= '&phone='+encodeURIComponent(document.querySelector('#optinform input[name=\"phone\"]').value);
    formdata+= '&cid='+convertsound.cid;
    formdata+= '&id='+convertsound.uid;


  console.log(formdata);

  convertsound.sendData(convertsound.url+'?'+formdata,'callback');
  // if invalid
  if (e.preventDefault) {
    e.preventDefault();
  } else {
    e.returnValue = false;
  }
}

var skipsubmit = document.getElementById('ops-skip-submit');
if (skipsubmit.addEventListener) {
  skipsubmit.addEventListener('click', optinformsubmit1);
} else {
  skipsubmit.attachEvent('onclick', optinformsubmit1);
}

function optinformsubmit1(e) {
  e = e || window.event;

    var formdata='';

    formdata+= '&name='
    formdata+= '&email='+encodeURIComponent(document.querySelector('#skipoptinform input[name=\"email\"]').value);
    formdata+= '&phone='+encodeURIComponent(document.querySelector('#skipoptinform input[name=\"phone\"]').value);
    formdata+= '&cid='+convertsound.cid;
    formdata+= '&id='+convertsound.uid;

  console.log(formdata);

  convertsound.sendData(convertsound.url+'?'+formdata,'callback');

  if (e.preventDefault) {
    e.preventDefault();
  } else {
    e.returnValue = false;
  }
}




}

function showPopup(){
  var element = document.getElementById('opswidget');
  element.classList.add('showpop');
}

function removePopup(){
    var element = document.getElementById('opswidget');
    element.classList.remove('showpop');
}

function playondelay(){
    setTimeout(function(){
    audio.play();
    },convertsound.delay_time*1000);    
}


function playondelaymobile(){
alert('mobile');
}

if(convertsound.ap){
document.addEventListener('visibilitychange', function() {
    if (document.hidden){
      audio.pause();
      console.log('Browser tab is hidden')
    } else {
      audio.play();
      console.log('Browser tab is visible')
    }
});

}

if(convertsound.noactrigger)
{
function setup() {
    this.addEventListener('mousemove', resetTimer, false);
    this.addEventListener('mousedown', resetTimer, false);
    this.addEventListener('keypress', resetTimer, false);
    this.addEventListener('DOMMouseScroll', resetTimer, false);
    this.addEventListener('mousewheel', resetTimer, false);
    this.addEventListener('touchmove', resetTimer, false);
    this.addEventListener('MSPointerMove', resetTimer, false);
    this.addEventListener('scroll', scrolltopevent, false);
    startTimer();
}
setup();

}

function startTimer() {
    timeoutID = window.setTimeout(goInactive, 60000);
}

function resetTimer(e) {
    window.clearTimeout(timeoutID);
    goActive();
}


function goInactive() {
  setTimeout(function(){
    audio.play();
    goActive();
  },convertsound.delay_time*1000);
  console.log('reactive');
}

function goActive() {
    startTimer();
}



if(convertsound.favicon!='')
{
 (function() {
    var link = document.querySelector('link[rel*=\"icon\"]') || document.createElement('link');
    link.type = 'image/x-icon';
    link.rel = 'shortcut icon';
    link.href = convertsound.favicon;
    document.getElementsByTagName('head')[0].appendChild(link);
})();
 
}


  
convertsound.sendData= function  (url,callback){
    if (window.XMLHttpRequest)
    {
      xmlhttp=new XMLHttpRequest();
    }
    else
    {
      xmlhttp=new ActiveXObject('Microsoft.XMLHTTP');
    }
    xmlhttp.onreadystatechange=function()
    {
      if(xmlhttp.readyState==4 && xmlhttp.status==200)
      {
          alert(xmlhttp.responseText);

        if(xmlhttp.responseText=='Success'){
        document.querySelector('#optinform').style.display='none';
        document.querySelector('#skipoptinform').style.display='none';
        document.querySelector('#optin-thank').style.display='block';
        document.querySelector('#skipoptin-thank').style.display='block';
        setTimeout(function(){
        document.querySelector('#opswidget').style.display='none';
        document.querySelector('#optin-thank').style.display='none';
        document.querySelector('#skipoptin-thank').style.display='none';
        document.getElementById('optinform').reset(); 
        document.getElementById('skipoptinform').reset(); 
          },5000);         
        }
 
      }
    };
    xmlhttp.open('GET',url);
    xmlhttp.send();
};


function addCss(css) {
  // ss is style variable
  var ss = document.createElement('style');
  ss.type = 'text/css';
  ss.rel = 'stylesheet';
  ss.media = 'all';
  try {
    ss.styleSheet.cssText = css;
  } catch (t) {}
  try {
    ss.innerHTML = css;
  } catch (t) {}
  document.getElementsByTagName('head')[0].appendChild(ss);
}";

// Create file

        // $data = json_encode(['Example 1','Example 2','Example 3',]);
        // $fileName = time() . '_datafile.json';
        $fileName = $script_name.'.js';
        File::put(public_path('uploads/campaign/'.$fileName),$script);

        echo url('/').'/uploads/campaign/'.$fileName;

    }
}









    public function view($id)
    {
		$campaign = $this->campaign->campaign_edit($id);
		return view('campaign/view',['campaign'=>$campaign]);
    }
    public function edit($id)
    {

        $campaign = $this->campaign->campaign_edit($id);
        $widget=array();
        if($campaign[0]->widget_id!=''){          
        $widget = $this->widget->widget_detail($id);
        }
        $amazonsound =$this->amazonpolly->t2s_detail($campaign[0]->sound_src);
        $domain =  $this->domain->domain_list();
        $country =  $this->country->country_list();
        $language =  $this->language->language_list();
        $niche =  $this->niche->niche_list();
        $trafficsource =  $this->trafficsource->trafficsource_list();
        $soundniche =  $this->soundniche->soundniche_list();
        $sounds=array();
        foreach($soundniche as $key=>$sound)
        {
        $sounds[$sound->niche_category][$sound->trafficsource]=$sound;
        }

        // return view('campaign/add',['niches'=>$niche]);
        return view('campaign/edit',['campaign'=>$campaign,'widget'=>$widget,'domain'=>$domain,'country'=>$country,'language'=>$language,'niche'=>$niche,'trafficsource'=>$trafficsource,'soundniche'=>$sounds,'amazonsound'=>$amazonsound]);


//
//		$campaign = $this->campaign->campaign_edit($id);
//		return view('campaign/edit',['campaign'=>$campaign]);
    }
    public function update(Request $request,$id)
    {

    }
    public function delete(Request $request,$id)
    {
  		$result = $this->campaign->campaign_delete($id);
  		if($result){
  			$request->session()->flash('success', 'Record deleted successfully!');
  		}
  		else{
  			$request->session()->flash('failed', 'Something went wrong!');
  		}
  		return redirect()->back();
    }

    public function savewidget(Request $request)
    {

        $headline_text = $request->input('headline_text');
        $headline_color = $request->input('headline_color');
        $headline_bg = $request->input('headline_bg');
        $description_text = $request->input('description_text');
        $description_color = $request->input('description_color');
        $description_bg = $request->input('description_bg');
        $widget_position = $request->input('widget_position');
        $icon = $request->input('icon');
        echo $result = $this->widget->widget_add($headline_text,$headline_color,$headline_bg,$description_text,$description_color,$description_bg, $widget_position, $icon);

    }


    public function uploadimage(Request $request)
    {
      $file = $request->file('imageedit');
      $filename=rand(1000000000,9999999999);
      $ext=$file->getClientOriginalExtension();
      $destinationPath = 'images/campaign';
      $full_filename=$filename.'.'.$ext;
      $image_url=$destinationPath.'/'.$full_filename;
      $file->move($destinationPath,$full_filename);
      echo $image_url;
    }














}
