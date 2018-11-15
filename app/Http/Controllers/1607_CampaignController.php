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
'widget':{'tbt':'".$topbar_text."', 'tbc':'".$topbar_color."', 'tbb':'".$topbar_bg."','brandicon':'".$brandlogo."','ht':'".$headline_text."', 'hc':'".$headline_color."', 'hb':'".$headline_bg."', 'dt':'".$description_text."', 'dc':'".$description_color."', 'db':'".$description_bg."', 'position':'bottom-right', 'icon':'".$play_icon."'},
'opw':{'optinM':'".$optin_message."','sp_optinM':'".$sp_optin_message."','thankyou':'".$thankyou_message."'},
'url':'".url('/')."/optin',
'uid':'".$user_id = Auth::id()."',
'cid':'".$result."'

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

document.getElementById('cs_popup').innerHTML=\"<div id='pp-main'><div style='clear: both; float: none; color: rgb(255, 0, 0); background-color: \"+convertsound.widget.tbb+\"; margin: 0px; border-radius: 8px 8px 0px 0px; border-bottom: 1px solid rgb(238, 238, 238); padding: 10px;'><div style='float: left; background: beige none repeat scroll 0% 0%; border-top: 1px solid rgb(238, 238, 238); border-bottom: 1px solid rgb(238, 238, 238); border-left: 1px solid rgb(238, 238, 238); -moz-border-top-colors: none; -moz-border-right-colors: none; -moz-border-bottom-colors: none; -moz-border-left-colors: none; border-image: none; border-radius: 50%; width: 60px; height: 60px;'><img style='width:100%; padding:10px;' src='\"+convertsound.widget.brandicon+\"'></div><div style='float: left; width: 218px;' height:72px;'=''><h2 style='color:\"+convertsound.widget.tbc+\"; font-size: 20px; margin: 0px; text-align: left; padding: 8% 0px 0px 12px;'>\"+convertsound.widget.tbt+\"</h2></div><div style='clear:both;float:none;'></div></div><h2 id='pp_ht' style='color: \"+convertsound.widget.hc+\"; background-color: \"+convertsound.widget.hb+\"; margin: 0px; padding: 10px 5px; border-bottom: 1px solid rgb(238, 238, 238); font-size: 20px;'>\"+convertsound.widget.ht+\"</h2><div id='pp_icon_blk' style='background: rgb(255, 255, 255) none repeat scroll 0% 0%; float: left; height: 76px; width: 200px;'><p id='pp_dt' style='color:\"+convertsound.widget.dc+\";background-color:\"+convertsound.widget.db+\"; margin:0;padding:10px 5px; height:89px; '>\"+convertsound.widget.dt+\"</p></div><div id='pp_icon_blk' style='background: rgb(255, 255, 255) none repeat scroll 0% 0%; float: left; width: 100px;'><span id='pp_circle' style='border:2px solid #000;border-radius:50%;display:inline-block;padding:10px;margin:5px;'><img id='pp_icon' style='width: 55px;' src='\"+convertsound.widget.icon+\"'></span></div></div>\";



var tt=true;
document.getElementById('pp_icon').addEventListener('click', function() {
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

document.getElementById('soundcontainer').innerHTML=\"<audio class='form-control' name='dfy_soundpreview' id='convertsound_audio'  controls><source src='".$sound_src."' type='audio/mpeg'>Your browser does not support the audio tag.</audio><button id='unmuteButton' style='margin-top:20px;''>Play</button>\";


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








var chatpopup=document.createElement('div');
chatpopup.id='ops-chat';
document.body.appendChild(chatpopup);

var chat_innerHtml=\"<header class='clearfix'>\
      <a href='#' id='chat-close' class='chat-close'>x</a>\
      <h4>\"+convertsound.widget.tbt+\"</h4>\
      <span class='chat-message-counter'>3</span>\
    </header>\
    <div class='chat'>\
      <div class='chat-history'>\
        <div class='chat-message clearfix'>\
          <img src='http://lorempixum.com/32/32/people' alt='' width='32' height='32'>\
          <div class='chat-message-content clearfix'>\
            <p class='ops-message'>\"+convertsound.opw.sp_optinM+\"</p>\
            <p class='enter-details-title'>Enter your details-</p>\
          </div>\
        </div>\
        <hr>\
        <div>\
        <hr>\
      </div>\
      <form action='#' id='optinform' method='post'>\
          <input type='text' required='required' name='name' placeholder='Your Name*' autofocus>\
          <input type='text' required='required' name='email' placeholder='Your Email*'>\
          <input type='text' name='phone' placeholder='Your Phone Number'>\
          <input type='hidden' name='account' value='accountid'>\
          <button type='submit' id='ops-chat-submit'>Submit</button>\
      </form>\
      <div id='optin-thank'><p>\"+convertsound.opw.thankyou+\"</p></div>\
    </div>\
  </div>\";

addCss(\"#optin-thank{display:none;}#optin-thank p{padding:45px 4px;} #ops-chat h4,#ops-chat h5{line-height:1.5em;margin:0}#ops-chat hr{background:#e9e9e9;border:0;-moz-box-sizing:content-box;box-sizing:content-box;height:1px;margin:0;min-height:1px}#ops-chat img{border:0;display:block;height:auto;max-width:100%}#ops-chat input{border:0;color:inherit;font-family:inherit;font-size:100%;line-height:normal;margin:0}#ops-chat p{margin:0}#ops-chat .clearfix:before,.clearfix:after{content:'';display:table}#ops-chat .clearfix:after{clear:both}#ops-chat.showpop{display:block;} #ops-chat{display:none;color:#666;font:100%/1.5em 'Droid Sans',sans-serif;z-index:1000;bottom:0;font-size:12px;right:310px;position:fixed;width:300px}#ops-chat a{text-decoration:none}#ops-chat header{background:#293239;border-radius:5px 5px 0 0;color:#fff;cursor:pointer;padding:16px 24px}#ops-chat h4:before{background:#1a8a34;border-radius:50%;content:'';display:inline-block;height:8px;margin:0 8px 0 0;width:8px}#ops-chat h4{font-size:16px}#ops-chat h5{font-size:10px}#ops-chat form{padding:18px 0}#ops-chat input[type=text]{border:1px solid #ccc;border-radius:3px;padding:8px;outline:0;width:234px;margin-bottom:10px}#ops-chat .chat-message-counter{background:#e62727;border:1px solid #fff;border-radius:50%;display:none;font-size:12px;font-weight:700;height:28px;left:0;line-height:28px;margin:-15px 0 0 -15px;position:absolute;text-align:center;top:0;width:28px}#ops-chat .chat-close{background:#1b2126;border-radius:50%;color:#fff;display:block;float:right;font-size:10px;height:16px;line-height:16px;margin:2px 0 0;text-align:center;width:16px}#ops-chat .enter-details-title{font-size:20px;padding:30px 0 0}#ops-chat .chat{background:#fff}#ops-chat .chat-history{padding:8px 24px}#ops-chat .chat-message{margin:16px 0}#ops-chat .chat-message img{border-radius:50%;float:left}#ops-chat .chat-time{float:right;font-size:10px}#ops-chat .chat-feedback{font-style:italic;margin:0 0 0 80px}#ops-chat-submit{background:#293239;border-radius:20px;box-sizing:border-box;color:#fff;font-size:14px;font-weight:600;padding:7px 18px;transition:all .15s linear 0s;border:0}\");
document.getElementById('ops-chat').innerHTML=chat_innerHtml;

document.getElementById('pp_icon').addEventListener('click', showPopup);
document.getElementById('chat-close').addEventListener('click', removePopup);


var submit = document.getElementById('ops-chat-submit');
if (submit.addEventListener) {
  submit.addEventListener('click', returnToPreviousPage);
} else {
  submit.attachEvent('onclick', returnToPreviousPage);
}

function returnToPreviousPage (e) {
  e = e || window.event;
  // validation code

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



}

function showPopup(){
    var element = document.getElementById('ops-chat');
    element.classList.add('showpop');
}

function removePopup(){
    var element = document.getElementById('ops-chat');
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

        if(xmlhttp.responseText=='Success'){
        document.querySelector('#optinform').style.display='none';
        document.querySelector('#optin-thank').style.display='block';
        setTimeout(function(){
        document.querySelector('#cs_popup').style.display='none';
        document.querySelector('#ops-chat').style.display='none';
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

        $campaign_id = $request->input('campaign_id');
        $campaign_name = $request->input('campaign_name');
        $campaign_type = $request->input('campaign_type');
        $domain_id = $request->input('domain_id');
        $domain_name = $request->input('domain_name');
        $voice_variation = $request->input('voice_variation');
        $sound_niche = $request->input('sound_niche');
        $traffic_source = $request->input('traffic_source');
        // $language = $request->input('language');
//        $text_to_speech = $request->input('text_to_speech');
        $widget_id = $request->input('widget_id');
        // $action_type = $request->input('action_type');
        $sound_src = $request->input('sound_src');
        $trigger_time = $request->input('trigger_time');
        $scroll_height = $request->input('scroll_height');
        $repeat_trigger_time = $request->input('repeat_trigger_time');
        $script_name= $request->input('script_name');

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


        $result = $this->campaign->campaign_ajax_update( $campaign_id,$campaign_name, $domain_name, $campaign_type, $widget_id,$voice_idvariation, $sound_niche, $traffic_source,  $sound_src, $trigger_time, $scroll_height, $repeat_trigger_time,  $script_name );


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
'geolocation':".$geolocation."
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

//var audio = document.createElement('audio');
//audio.src = convertsound.audiosrc;
window.onload = function() {

var division=document.createElement('div');
division.id='soundcontainer';
division.style.width='50%';
division.style.height='50%';
division.style.position='absolute';
division.style.border='none';
division.style.zIndex='0';
division.style.top='0';
division.style.left='-5000px';
division.style.background='#fff';
document.body.appendChild(division);
document.body.style.position='relative';
document.body.style.zIndex='1';

document.getElementById('soundcontainer').innerHTML=\"<audio class='form-control' name='dfy_soundpreview' id='convertsound_audio' muted autoplay controls><source src='".$sound_src."' type='audio/mpeg'>Your browser does not support the audio tag.</audio><button id='unmuteButton' style='margin-top:20px;''>Play</button>\";
var tt=true;
document.addEventListener('click', function() {
if(tt){
tt=false;
document.getElementById('convertsound_audio').muted = false;
console.log('played');
}
document.getElementById('convertsound_audio').play();
},false);

if( /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) ) {
 // some code..
}
else{
document.getElementById('unmuteButton').click();
}

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

var playonscroll=true;
function scrolltopevent(){
  var doc = document.documentElement;
  var left = (window.pageXOffset || doc.scrollLeft) - (doc.clientLeft || 0);
  var top = (window.pageYOffset || doc.scrollTop)  - (doc.clientTop || 0);
  if(top>=convertsound.st && playonscroll)
  {
  
   var audio = document.createElement('audio');
   audio.src = convertsound.audiosrc;

   audio.play();
     audio.muted=false;
     playonscroll=false;
alert('in');
     console.log('play');
  } 
}
//document.addEventListener('touchmove',scrolltopevent);

if(convertsound.delay_time!='' && convertsound.st=='1'){
//    this.addEventListener('scroll',playondelay);
   // this.addEventListener('touchmove',playondelaymobile,false);
}
if(convertsound.delay_time=='' && convertsound.st!=''){
  //  this.addEventListener('scroll',scrolltopevent);
   // this.addEventListener('touchmove',playondelaymobile,false);
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
