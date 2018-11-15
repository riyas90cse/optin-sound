var convertsound={
'delay_time':'',
'st':'1',
'audiosrc':'https://convertsound.s3.us-west-2.amazonaws.com/1531860284-cvs.mp3',
'favicon':'http://app.optinsound.com/images/convertsound-fav-def.gif',
'bbl':'',
'noactrigger':'',
'mb':'',
'pr':'',
'ap':'',
'geolocation':{},
'insite_trigger':'',
'trigger_elements':'',
'play_condition':'onload',
'exclude_pages':{"0":{"0":"specific_url","1":"talktoneha.com"}},
'exit_intent_pop':'',
'widget':{'tbt':'Pilgrim Production', 'tbc':'', 'tbb':'','brandicon':'http://app.optinsound.com/images/campaign/8074045307.png','ht':'Where Passion is the Religion', 'hc':'', 'hb':'', 'dt':'Replay Your Dreams by showcasing your Talent to the World. Reveal it here!!!', 'dc':'', 'db':'', 'position':'bottom-right', 'icon':'http://app.optinsound.com/images/convertsound-fav-def.gif','closebtn':'http://app.optinsound.com/images/switch.png','playbtn':'http://app.optinsound.com/images/optin-play-action.png'},
'opw':{'optinM':'Pilgrim Production helps you to take action in order to create your own New Success Stories... Join Now!','sp_optinM':'Your time is important to us. Just quickly provide your email below, so we can connect further on right time.','thankyou':'We appreciate your considered time & will get in touch with you shortly through email. Thank You!!!'},
'url':'http://app.optinsound.com/optin',
'uid':'6',
'cid':'26',
'domain':'Talktoneha.com'

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
var opswidgetHtml="<header class='ops-header'>\
    <div class='ops-brandname'>"+cs.widget.tbt+"</div>\
    <div class='ops-brandlogo'><img title='Brand name' alt='Brand Logo' src='"+cs.widget.brandicon+"'/></div>\
    <div class='ops-closebtn' id='ops-closebtn'><img title='Close button' alt='Close Button' src='"+cs.widget.closebtn+"'/></div>\
  </header>\
  <div class='ops-content'>\
    <div class='ops-heading'>"+cs.widget.ht+"</div>\
    <div class='ops-contenttxt'>"+cs.widget.dt+"</div>\
    <div class='ops-formsection' id='ops-formsection'>\
      <div class='ops-message'>"+cs.opw.optinM+"</div>\
	<div id='optin-thank'>"+cs.opw.thankyou+"</div>\
	<form action='#' id='optinform' method='post'>\
        <input required='required' name='name' placeholder='Your Name*' autofocus='' type='text'>\
        <input required='required' name='email' placeholder='Your Email*' type='text'>\
        <input name='phone' placeholder='Your Phone Number' type='text'>\
        <input name='account' value='accountid' type='hidden'>\
        <button type='submit' id='ops-chat-submit'>Submit</button>\
      </form> \
    </div> \
      <div class='ops-action'>\
      <div class='ops-full'>\
        <button class='ops-playbutton' id='ops-playbutton'>Listen!</button>\
      </div><div class='ops-full'>\
        <!-- <a class='ops-skip'>Skip</a> -->\
      </div>\
    </div>\
  </div>";
opswidgetHtml+="<div class='ops-footer'><div class='copyrite'>Powered By <a href='http://optinsound.com/' target='_blank'><span style='color:#43bcb6'>Optin</span> <span style='color: #767c7c'>Sound</span></a></div></div>";
document.getElementById('opswidget').innerHTML=opswidgetHtml;
var opswidgetIcon=document.createElement('div');
opswidgetIcon.id='opswidget-icon';
document.body.appendChild(opswidgetIcon);
document.getElementById('opswidget-icon').innerHTML="<div class='ops-brandlogo pulse'><img title='Brand name' alt='Brand Logo' src='"+cs.widget.brandicon+"'/></div>";

addCss("#ops-chatpop,#opswidget{font-family:sans-serif;position:fixed;width:286px;border-right:1px solid #eee; border-left:1px solid #eee;z-index:99999;bottom:0;text-align:center;background:#eee;border-radius:16px 16px 0 0}.ops-brandname,.ops-heading{font-weight:600;text-transform:uppercase}.ops-brandname,.ops-heading,.ops-playbutton{text-transform:uppercase}.ops-footer .copyrite a,.ops-skip{text-decoration:none}#ops-chat-submit,.ops-playbutton{box-sizing:border-box;transition:all .15s linear 0s}#opswidget{right:5px;display:block;}#ops-chatpop{right:270px;border:1px solid #eee;display:none} .ops-header{background:#636363;height:90px; border-radius:16px 16px 0 0; position:relative;z-index:1} .ops-brandname{color:#fff;font-size:14px;padding:30px 0}.ops-brandlogo img,.ops-closebtn img{font-size:10px;vertical-align:middle;text-align:center}.ops-brandlogo{position:absolute;z-index:2;height:70px;bottom:-35px;text-align:center;width:100%;display:block}.ops-brandlogo img{height:70px;width:70px;display:inline-block;border-radius:50%;background:#d7d7d7;color:#fff}.ops-closebtn{position:absolute;z-index:3;background:#fff;height:27px;width:26px;top:6px;right:6px;display:block;border-radius:50%;padding:2px;cursor:pointer}.ops-closebtn img{height:22px;width:22px;display:inline-block;color:#333}.ops-content{background:#fff;min-height:100px;border-radius:0 0 16px 16px;position:relative;margin-bottom:5px;padding:40px 0 80px}.ops-contenttxt,.ops-heading{padding:5px 10px 10px;width:100%}.ops-heading{color:#000;font-size:18px;line-height:1.4}.ops-message,.ops-skip{line-height:1.2;color:#636363}.ops-contenttxt{color:#636363;font-weight:400;font-size:12px;line-height:1.2}.ops-action{text-align:center;width:100%;display:block;position:absolute;bottom:0;height:80px}.ops-playbutton{background:url('http://app.optinsound.com/images/optin-play-action.png') left no-repeat #3b569b;border-radius:12px;color:#fff;font-size:12.5px;font-weight:600;padding:7px 18px 7px 35px;border:0;cursor:pointer}.ops-full{width:100%;text-align:center}.ops-skip{font-weight:400;font-size:8px;padding:10px 0;width:auto;cursor:pointer;display:inline-block}.ops-content:after{content:'';position:absolute;bottom:0;left:50%;width:0;height:0;border:5px solid transparent;border-top-color:#fff;border-bottom:0;margin-left:-5px;margin-bottom:-5px}.ops-footer{height:20px;position:relative;width:100%}.ops-footer .copyrite{height:16px;color:#636363;font-weight:400;font-size:10px;padding:4px 0}.ops-footer .copyrite span{font-weight:600}.ops-message{font-weight:400;font-size:12px;padding:5px 10px 10px;max-width:100%}.ops-formsection{opacity:0;height:0;visibility:hidden;position:relative;bottom:-50px}.ops-fade-in{opacity:1;visibility:visible;height:auto;animation-name:fadeInOpacity;animation-iteration-count:1;animation-timing-function:ease-in;animation-duration:.2s;z-index:5}@keyframes fadeInOpacity{0%{opacity:0}100%{opacity:1}}#ops-chat-submit{background:#3b569b;border-radius:20px;color:#fff;font-size:14px;font-weight:600;padding:7px 18px;border:0}#ops-chatpop form{padding:10px}.ops-formsection input[type=text]{font-size:12px;border:1px solid #ccc;border-radius:3px;margin-bottom:10px;outline:0;padding:8px;width:240px}div#opswidget-icon{cursor:pointer;background:0 0;border-radius:43px;bottom:10px;display:block;height:85px;right:10px;position:fixed;width:85px;z-index:100}.visit-us{background:#fff;border-radius:30px;font-family:sans-serif;font-size:12px;padding:10px;position:absolute;top:20px;width:190px;z-index:1;border:1px solid #eee}#opswidget-icon .ops-brandlogo img{height:75px;width:75px;border:5px solid #fafafa}#opswidget-icon .ops-brandlogo{bottom:15px;display:block;position:absolute;right:0;text-align:right;z-index:2}@keyframes pulse_animation{0%,100%,30%,50%,60%,80%{transform:scale(1)}40%{transform:scale(1.08)}70%{transform:scale(1.05)}}.pulse{animation-name:pulse_animation;animation-duration:5s;transform-origin:70% 70%;animation-iteration-count:infinite;animation-timing-function:linear}#optin-thank{display:block;font-size: 12px; font-weight: 400; max-width: 100%; padding: 5px 10px 10px;}#optin-thank p{padding:45px 4px}");



/*
addCss("#ops-chatpop,#opswidget{font-family:sans-serif;position:fixed;width:260px;z-index:99999;bottom:0;text-align:center;background:#eee;border-radius:16px 16px 0 0}.ops-brandname,.ops-heading{font-weight:600;text-transform:uppercase}.ops-brandname,.ops-heading,.ops-playbutton{text-transform:uppercase}.ops-footer .copyrite a,.ops-skip{text-decoration:none}#ops-chat-submit,.ops-playbutton{box-sizing:border-box;transition:all .15s linear 0s}#opswidget{right:5px;display:block;}#ops-chatpop{right:270px;border:1px solid #eee;display:none}.ops-header{background:#636363;height:90px;border-radius:16px 16px 0 0;position:relative;z-index:1}.ops-brandname{color:#fff;font-size:14px;padding:30px 0}.ops-brandlogo img,.ops-closebtn img{font-size:10px;vertical-align:middle;text-align:center}.ops-brandlogo{position:absolute;z-index:2;height:70px;bottom:-35px;text-align:center;width:100%;display:block}.ops-brandlogo img{height:70px;width:70px;display:inline-block;border-radius:50%;background:#d7d7d7;color:#fff}.ops-closebtn{position:absolute;z-index:3;background:#fff;height:27px;width:26px;top:6px;right:6px;display:block;border-radius:50%;padding:2px;cursor:pointer}.ops-closebtn img{height:22px;width:22px;display:inline-block;color:#333}.ops-content{    border-left: 1px solid #eee;border-right: 1px solid #eee;background:#fff;min-height:100px;border-radius:0 0 16px 16px;position:relative;margin-bottom:5px;padding:40px 0 80px}.ops-contenttxt,.ops-heading{padding:5px 10px 10px;width:100%}.ops-heading{color:#000;font-size:18px;line-height:1.4}.ops-message,.ops-skip{line-height:1.2;color:#636363}.ops-contenttxt{color:#636363;font-weight:400;font-size:12px;line-height:1.2}.ops-action{text-align:center;width:100%;display:block;position:absolute;bottom:0;height:80px}.ops-playbutton{background:url('http://app.optinsound.com/images/optin-play-action.png.') left no-repeat #3b569b;border-radius:12px;color:#fff;font-size:12.5px;font-weight:600;padding:7px 18px 7px 35px;border:0;cursor:pointer}.ops-full{width:100%;text-align:center}.ops-skip{font-weight:400;font-size:8px;padding:10px 0;width:auto;cursor:pointer;display:inline-block}.ops-content:after{content:'';position:absolute;bottom:0;left:50%;width:0;height:0;border:5px solid transparent;border-top-color:#fff;border-bottom:0;margin-left:-5px;margin-bottom:-5px}.ops-footer{height:26px;position:relative;width:100%}.ops-footer .copyrite{height:16px;color:#636363;font-weight:400;font-size:10px;padding:4px 0}.ops-footer .copyrite span{font-weight:600}.ops-message{font-weight:400;font-size:12px;padding:5px 10px 10px;max-width:100%}.ops-formsection{opacity:0;height:0;visibility:hidden;position:relative;bottom:-50px}.ops-fade-in{opacity:1;visibility:visible;height:auto;animation-name:fadeInOpacity;animation-iteration-count:1;animation-timing-function:ease-in;animation-duration:.2s;z-index: 5;}@keyframes fadeInOpacity{0%{opacity:0}100%{opacity:1}}#ops-chat-submit{background:#3b569b;border-radius:20px;color:#fff;font-size:14px;font-weight:600;padding:7px 18px;border:0}#ops-chatpop form{padding:10px}.ops-formsection input[type=text]{border:1px solid #ccc;border-radius:3px;margin-bottom:10px;outline:0;padding:8px;width:220px}div#opswidget-icon{cursor:pointer;background:0 0;border-radius:37px;bottom:5px;display:block;height:76px;right:5px;position:fixed;width:220px;z-index:100;border:2px solid #999}.visit-us{background:#fff;border-radius:30px;font-family:sans-serif;font-size:12px;padding:10px;position:absolute;top:17px;width:190px;z-index:1;border:1px solid #eee}#opswidget-icon .ops-brandlogo{bottom:1px;display:block;height:70px;position:absolute;right:3px;text-align:right;width:100%;z-index:2}#optin-thank{display:none;font-size: 12px; font-weight: 400; max-width: 100%; padding: 5px 10px 10px;}#optin-thank p{padding:45px 4px}");
*/

document.getElementById('ops-playbutton').addEventListener('click',function(){
  var element = document.getElementById('ops-formsection');
  element.classList.add('ops-fade-in');
  document.querySelector('#ops-playbutton').style.display='none';
  document.querySelector('#optin-thank').style.display='none';


});        
document.getElementById('ops-closebtn').addEventListener('click',function(){
  var element = document.getElementById('opswidget');
  element.style.display='none';
});        
document.getElementById('opswidget-icon').addEventListener('click',function(){
  var element = document.getElementById('opswidget');
  document.getElementById('ops-formsection').classList.remove('ops-fade-in');
  document.querySelector('#ops-playbutton').style.display='inline-block';
  element.style.display='block';
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

document.getElementById('soundcontainer').innerHTML="<audio class='form-control' name='dfy_soundpreview' id='convertsound_audio'  controls><source src='"+cs.audiosrc+"' type='audio/mpeg'>Your browser does not support the audio tag.</audio><button id='unmuteButton' style='margin-top:20px;''>Play</button>";


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
  submit.addEventListener('click', returnToPreviousPage);
} else {
  submit.attachEvent('onclick', returnToPreviousPage);
}

function returnToPreviousPage (e) {
  e = e || window.event;

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
          alert(xmlhttp.responseText);

        if(xmlhttp.responseText=='Success'){
        document.querySelector('#optinform').style.display='none';
        document.querySelector('#optin-thank').style.display='block';
        setTimeout(function(){
         document.querySelector('#opswidget').style.display='none';
        // document.querySelector('#ops-chat').style.display='none';
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
