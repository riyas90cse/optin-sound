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
use App\Overlay;


class OverlayController extends Controller
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
        $this->overlay= new Overlay();
    }

    public function index()
    {
        $overlay = $this->overlay->overlay_list();
        $campaign = $this->campaign->campaign_list();
        $domain =  $this->domain->domain_list();
        $country =  $this->country->country_list();
        $language =  $this->language->language_list();
        $niche =  $this->niche->niche_list();
        $trafficsource =  $this->trafficsource->trafficsource_list();
        $soundniche =  $this->soundniche->soundniche_list();
	    $count = $overlay->count();
		return view('overlay/list',['overlays'=>$overlay,'campaigns'=>$campaign,'domain'=>$domain,'country'=>$country,'language'=>$language,'niche'=>$niche,'trafficsource'=>$trafficsource,'soundniche'=>$soundniche,'count'=>$count]);
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

        // return view('overlay/add',['niches'=>$niche]);
        return view('overlay/create',['campaigns'=>$campaign,'domain'=>$domain,'country'=>$country,'language'=>$language,'niche'=>$niche,'trafficsource'=>$trafficsource,'soundniche'=>$sounds]);
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

        // return view('overlay/add',['niches'=>$niche]);
		return view('overlay/add',['campaigns'=>$campaign,'domain'=>$domain,'country'=>$country,'language'=>$language,'niche'=>$niche,'trafficsource'=>$trafficsource,'soundniche'=>$soundniche]);
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
        $overlay_name = $request->input('overlay_name');
        $overlay_siteurl = $request->input('overlay_siteurl');
        $meta_title = $request->input('meta_title');
        $meta_description = $request->input('meta_description');
        $meta_image = $request->input('meta_image');
        $campaign_name = $request->input('campaign_name');
        $campaign_id = $request->input('campaign_id');
        $domain_name = $request->input('domain_name');
        $domain_id = $request->input('domain_id');
        $handle = $request->input('handle');
        $custom_link = $request->input('custom_link');
        $remarketing_pixels = $request->input('remarketing_pixels');
        $active = 1;
        $result = $this->overlay->overlay_ajax_add($overlay_name,$overlay_siteurl,$meta_title, $meta_description,$meta_image,$campaign_name,$campaign_id, $domain_name, $domain_id, $handle, $custom_link, $remarketing_pixels, $active);
    }



    public function ajaxupdate(Request $request)
    {

        $overlay_id = $request->input('overlay_id');
        $overlay_name = $request->input('overlay_name');
        $overlay_siteurl = $request->input('overlay_siteurl');
        $meta_title = $request->input('meta_title');
        $meta_description = $request->input('meta_description');
        $meta_image = $request->input('meta_image');
        $campaign_name = $request->input('campaign_name');
        $campaign_id = $request->input('campaign_id');
        $domain_name = $request->input('domain_name');
        $domain_id = $request->input('domain_id');
        $handle = $request->input('handle');
        $custom_link = $request->input('custom_link');
        $remarketing_pixels = $request->input('remarketing_pixels');
        $active = 1;
        $result = $this->overlay->overlay_ajax_update($overlay_id,$overlay_name,$overlay_siteurl, $meta_title, $meta_description,$meta_image,$campaign_name,$campaign_id, $domain_name, $domain_id, $handle, $custom_link, $remarketing_pixels, $active);
    }



    public function view($id)
    {
		$campaign = $this->campaign->campaign_edit($id);
		return view('overlay/view',['campaign'=>$campaign]);
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

        // return view('overlay/add',['niches'=>$niche]);
        return view('overlay/edit',['campaign'=>$campaign,'widget'=>$widget,'domain'=>$domain,'country'=>$country,'language'=>$language,'niche'=>$niche,'trafficsource'=>$trafficsource,'soundniche'=>$sounds,'amazonsound'=>$amazonsound]);


//
//      $campaign = $this->campaign->campaign_edit($id);
//      return view('overlay/edit',['campaign'=>$campaign]);
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


    public function handle($id)
    {
        $overlay = $this->overlay->overlay_by_handle($id);
        $campaign_data = $this->campaign->campaign_edit($overlay[0]->campaign_id);
        return view('overlay/handle',['campaign'=>$overlay[0],'campaign_data'=>$campaign_data[0]]);
    }



}
