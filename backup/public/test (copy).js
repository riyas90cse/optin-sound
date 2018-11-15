var convertsound={
'delay_time':'',
'st':'1',
'audiosrc':'https://convertsound.s3.us-west-2.amazonaws.com/1526738258-cvs.mp3',
'favicon':'http://app.convertsound.com/images/convertsound-fav-def.gif',
'bbl':'',
'noactrigger':'',
'mb':'',
'pr':'',
'ap':'',
'geolocation':{},
'widget':{'ht':'Big offer for early birds', 'hc':'#ff0000', 'hb':'#ffffff', 'dt':'Tap below to reveal the offer for you!!!', 'dc':'#2239c8', 'db':'#dccece', 'position':'bottom-right', 'icon':'http://app.convertsound.com/images/convertsound-fav-def.gif'}
}

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

var popup=document.createElement('div');
popup.id='cs_popup';
// popup.style.width='50%';
// popup.style.height='50%';
// popup.style.background='#fff';

popup.style.position='fixed';
popup.style.border='none';
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
popup.style.right='0';
popup.style.bottom='0';
}
popup.style.display='block';
popup.style.textAlign='center';

document.body.appendChild(popup);
document.body.style.position='relative';
document.body.style.zIndex='1';
document.getElementById('cs_popup').innerHTML="<div id='pp-main'><h2 id='pp_ht' style='color:"+cs.widget.hc+";background-color:"+cs.widget.hb+"; margin:0;padding:10px 5px;border-radius:8px 8px 0 0;'>"+cs.widget.ht+"</h2><p id='pp_dt' style='color:"+cs.widget.dc+";background-color:"+cs.widget.db+"; margin:0;padding:10px 5px;  '>"+cs.widget.dt+"</p><div id='pp_icon_blk' style='background:#ffffff;'><span id='pp_circle' style='border:2px solid #000;border-radius:50%;display:inline-block;padding:10px;margin:5px;'><img id='pp_icon' style='width:55px;' src='"+cs.widget.icon+"'/></span></div></div>";


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
division.style.left='-5000px';
division.style.background='#fff';
document.body.appendChild(division);
document.body.style.position='relative';
document.body.style.zIndex='1';

document.getElementById('soundcontainer').innerHTML="<audio class='form-control' name='dfy_soundpreview' id='convertsound_audio'  controls><source src='https://convertsound.s3.us-west-2.amazonaws.com/1526738258-cvs.mp3' type='audio/mpeg'>Your browser does not support the audio tag.</audio><button id='unmuteButton' style='margin-top:20px;''>Play</button>";

/*
var tt=true;
document.addEventListener('click', function() {
if(tt){
tt=false;
document.getElementById('convertsound_audio').muted = false;
document.getElementById('convertsound_audio').play();
console.log('played');
}
},false);

if( /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) ) {
 
}
else{
document.getElementById('unmuteButton').click();
}
*/

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
    var link = document.querySelector('link[rel*="icon"]') || document.createElement('link');
    link.type = 'image/x-icon';
    link.rel = 'shortcut icon';
    link.href = convertsound.favicon;
    document.getElementsByTagName('head')[0].appendChild(link);
})();
 
}
