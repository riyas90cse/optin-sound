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
'favicon':'http://convertsound.com/rdemo/favicon.gif',
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
        $domain_name = $request->input('domain_name');
        $campaign_type = $request->input('campaign_type');
        $voice_variation = $request->input('voice_variation');
        $sound_niche = $request->input('sound_niche');
        $traffic_source = $request->input('traffic_source');
        // $language = $request->input('language');
//        $text_to_speech = $request->input('text_to_speech');
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


        $result = $this->campaign->campaign_ajax_add( $campaign_name, $domain_name, $campaign_type, $voice_variation, $sound_niche, $traffic_source,  $sound_src, $trigger_time, $scroll_height, $repeat_trigger_time,  $script_name );


        if($result){

if($scroll_height)
{}
else{
    $scroll_height=1;
}

$favicon="http://convertsound.com/images/convertsound-fav.png";
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


var audio = document.createElement('audio');
audio.src = convertsound.audiosrc;

var timeloadplay=true;
function playondelay(){
    if(timeloadplay){
        setTimeout(function(){
        audio.play();
        timeloadplay=false;
        },convertsound.delay_time*1000);
    }
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
     audio.play();
     playonscroll=false;
     console.log('play');
  } 
}
if(convertsound.delay_time!='' && convertsound.st=='1'){
    this.addEventListener('scroll',playondelay);    
}
if(convertsound.delay_time=='' && convertsound.st!=''){
    this.addEventListener('scroll',scrolltopevent);
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
        return view('campaign/edit',['campaign'=>$campaign,'domain'=>$domain,'country'=>$country,'language'=>$language,'niche'=>$niche,'trafficsource'=>$trafficsource,'soundniche'=>$sounds]);


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
}
