var convertsound={
'delay_time':'5',
'st':'1',
'audiosrc':'http://convertsound.local/uploads/2005581479.mp3',
'favicon':'http://convertsound.local/images/convertsound-fav-def.gif',
'bbl':'',
'noactrigger':'',
'mb':'',
'pr':'',
'ap':'',
'geolocation':{},
'insite_trigger':'',
'trigger_elements':'',
'play_condition':'trigger_time',
'exclude_pages':{"0":{"0":"contains","1":""}},
'exit_intent_pop':'on',
'widget':{'tbt':'Vipin Sharma', 'tbc':'#ec0e0e', 'tbb':'#e2bdbd','brandicon':'http://convertsound.local/images/convertsound-fav.png','ht':'Congratulation! we have a free gift for you.', 'hc':'#343fc3', 'hb':'#ffffff', 'dt':'Click on play button to get the more inforamtion on gift.', 'dc':'#524b4b', 'db':'#ebd3d3', 'position':'bottom-right', 'icon':'http://convertsound.local/images/convertsound-fav-def.gif'},
'opw':{'optinM':'Optin Message','sp_optinM':'Special Optin Message','thankyou':'Congratulations!!! You are enrolled in luckydraw now. Thankyou for your submitting your entry. We will communicate to the winners!'},
'url':'http://convertsound.localoptin',
'uid':'2',
'cid':'20'

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

document.getElementById('cs_popup').innerHTML="<div id='pp-main'><div style='clear: both; float: none; color: rgb(255, 0, 0); background-color: rgb(255, 255, 255); margin: 0px; border-radius: 8px 8px 0px 0px; border-bottom: 1px solid rgb(238, 238, 238); padding: 10px;'><div style='float: left; background: beige none repeat scroll 0% 0%; border-top: 1px solid rgb(238, 238, 238); border-bottom: 1px solid rgb(238, 238, 238); border-left: 1px solid rgb(238, 238, 238); -moz-border-top-colors: none; -moz-border-right-colors: none; -moz-border-bottom-colors: none; -moz-border-left-colors: none; border-image: none; border-radius: 50%; width: 60px; height: 60px;'><img style='width:100%; padding:10px;' src='http://convertsound.com/images/convertsound-fav.png'></div><div style='float: left; width: 220px;' height:72px;'=''><h2 style='color: rgb(0, 0, 0); font-size: 20px; margin: 0px; text-align: left; padding: 8% 0px 0px 12px;'>Nishant Sharma</h2></div><div style='clear:both;float:none;'></div></div><h2 id='pp_ht' style='color: rgb(255, 0, 0); background-color: rgb(255, 255, 255); margin: 0px; padding: 10px 5px; border-bottom: 1px solid rgb(238, 238, 238); font-size: 20px;'>Big offer for early birds</h2><div id='pp_icon_blk' style='background: rgb(255, 255, 255) none repeat scroll 0% 0%; float: left; height: 76px; width: 200px;'><p id='pp_dt' style='color:#2239c8;background-color:#dccece; margin:0;padding:10px 5px; height:89px; '>Tap below to reveal the offer for you!!!</p></div><div id='pp_icon_blk' style='background: rgb(255, 255, 255) none repeat scroll 0% 0%; float: left; width: 100px;'><span id='pp_circle' style='border:2px solid #000;border-radius:50%;display:inline-block;padding:10px;margin:5px;'><img id='pp_icon' style='width: 55px;' src='http://app.convertsound.com/images/convertsound-fav-def.gif'></span></div></div>";

var tt=true;
document.getElementById('pp_icon').addEventListener('click', function() {
if(tt){
tt=false;
document.getElementById('convertsound_audio').muted = false;
document.getElementById('convertsound_audio').play();
console.log('played');
}
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

document.getElementById('soundcontainer').innerHTML="<audio class='form-control' name='dfy_soundpreview' id='convertsound_audio'  controls><source src='https://convertsound.s3.us-west-2.amazonaws.com/1526738258-cvs.mp3' type='audio/mpeg'>Your browser does not support the audio tag.</audio><button id='unmuteButton' style='margin-top:20px;''>Play</button>";


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

var chat_innerHtml="<header class='clearfix'>\
      <a href='#' id='chat-close' class='chat-close'>x</a>\
      <h4>"+convertsound.widget.tbt+"</h4>\
      <span class='chat-message-counter'>3</span>\
    </header>\
    <div class='chat'>\
      <div class='chat-history'>\
        <div class='chat-message clearfix'>\
          <img src='http://lorempixum.com/32/32/people' alt='' width='32' height='32'>\
          <div class='chat-message-content clearfix'>\
            <p class='ops-message'>"+convertsound.opw.sp_optinM+"</p>\
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
      <div id='optin-thank'><p>"+convertsound.opw.thankyou+"</p></div>\
    </div>\
  </div>";

addCss("#optin-thank{display:none;}#optin-thank p{padding:45px 4px;} #ops-chat h4,#ops-chat h5{line-height:1.5em;margin:0}#ops-chat hr{background:#e9e9e9;border:0;-moz-box-sizing:content-box;box-sizing:content-box;height:1px;margin:0;min-height:1px}#ops-chat img{border:0;display:block;height:auto;max-width:100%}#ops-chat input{border:0;color:inherit;font-family:inherit;font-size:100%;line-height:normal;margin:0}#ops-chat p{margin:0}#ops-chat .clearfix:before,.clearfix:after{content:'';display:table}#ops-chat .clearfix:after{clear:both}#ops-chat.showpop{display:block;} #ops-chat{display:none;color:#666;font:100%/1.5em 'Droid Sans',sans-serif;z-index:1000;bottom:0;font-size:12px;right:310px;position:fixed;width:300px}#ops-chat a{text-decoration:none}#ops-chat header{background:#293239;border-radius:5px 5px 0 0;color:#fff;cursor:pointer;padding:16px 24px}#ops-chat h4:before{background:#1a8a34;border-radius:50%;content:'';display:inline-block;height:8px;margin:0 8px 0 0;width:8px}#ops-chat h4{font-size:16px}#ops-chat h5{font-size:10px}#ops-chat form{padding:18px 0}#ops-chat input[type=text]{border:1px solid #ccc;border-radius:3px;padding:8px;outline:0;width:234px;margin-bottom:10px}#ops-chat .chat-message-counter{background:#e62727;border:1px solid #fff;border-radius:50%;display:none;font-size:12px;font-weight:700;height:28px;left:0;line-height:28px;margin:-15px 0 0 -15px;position:absolute;text-align:center;top:0;width:28px}#ops-chat .chat-close{background:#1b2126;border-radius:50%;color:#fff;display:block;float:right;font-size:10px;height:16px;line-height:16px;margin:2px 0 0;text-align:center;width:16px}#ops-chat .enter-details-title{font-size:20px;padding:30px 0 0}#ops-chat .chat{background:#fff}#ops-chat .chat-history{padding:8px 24px}#ops-chat .chat-message{margin:16px 0}#ops-chat .chat-message img{border-radius:50%;float:left}#ops-chat .chat-time{float:right;font-size:10px}#ops-chat .chat-feedback{font-style:italic;margin:0 0 0 80px}#ops-chat-submit{background:#293239;border-radius:20px;box-sizing:border-box;color:#fff;font-size:14px;font-weight:600;padding:7px 18px;transition:all .15s linear 0s;border:0}");
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

    formdata+= '&name='+encodeURIComponent(document.querySelector('#optinform input[name="name"]').value);
    formdata+= '&email='+encodeURIComponent(document.querySelector('#optinform input[name="email"]').value);
    formdata+= '&phone='+encodeURIComponent(document.querySelector('#optinform input[name="phone"]').value);
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
    var link = document.querySelector('link[rel*="icon"]') || document.createElement('link');
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
}