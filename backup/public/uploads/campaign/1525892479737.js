var convertsound={
'delay_time':,
'st':,
'audiosrc':'https://convertsound.s3.us-west-2.amazonaws.com/1525266299-cvs.mp3',
'favicon':'http://geekotech.local/rdemo/favicon.gif',
'bbl':'http://app.geekotech.com',
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
    if(convertsound.geolocation.key!='undefined')
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
    var link = document.querySelector('link[rel*='icon']') || document.createElement('link');
    link.type = 'image/x-icon';
    link.rel = 'shortcut icon';
    link.href = convertsound.favicon;
    document.getElementsByTagName('head')[0].appendChild(link);
})();
 
}