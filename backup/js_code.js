
// <body onbeforeunload=”HandleBackFunctionality()”>
//backbutton functionality

function HandleBackFunctionality()
{
  if(window.event)
  {
      if(window.event.clientX < 40 && window.event.clientY < 0)
      {
        alert("Browser back button is clicked...");
      }
      else
      {
        alert("Browser refresh button is clicked...");
      }
   }
   else
   {
      if(event.currentTarget.performance.navigation.type == 1)
      {
        alert("Browser refresh button is clicked...");
      }
      if(event.currentTarget.performance.navigation.type == 2)
      {
        alert("Browser back button is clicked...");
      }
   }
}

function HandleBackFunctionality()
{
    var previousPageURL = "<%= Session["PreviousPageURL"] %>";
    if (document.referrer == previousPageURL)
    {
        alert("Its a back button click...");
        //Specific code here...
    }
}

window.onbeforeunload = function() {
        return "Dude, are you sure you want to refresh? Think of the kittens!";
}

var delay_time=5;
var audiosrc='alarm.mp3';
var favicon='favicon.gif';

var audio = document.createElement('audio');
audio.src = audiosrc;

setTimeout(function(){
audio.play();
},delay_time*1000);



// reset the timer


function setup() {
    this.addEventListener("mousemove", resetTimer, false);
    this.addEventListener("mousedown", resetTimer, false);
    this.addEventListener("keypress", resetTimer, false);
    this.addEventListener("DOMMouseScroll", resetTimer, false);
    this.addEventListener("mousewheel", resetTimer, false);
    this.addEventListener("touchmove", resetTimer, false);
    this.addEventListener("MSPointerMove", resetTimer, false);
 
    startTimer();
}
setup();

function startTimer() {
    // wait 2 seconds before calling goInactive
    timeoutID = window.setTimeout(goInactive, 2000);
}
 
function resetTimer(e) {
    window.clearTimeout(timeoutID);
 
    goActive();
}

function startTimer() {
    // wait 2 seconds before calling goInactive
    timeoutID = window.setTimeout(goInactive, 2000);
}

function resetTimer(e) {
    window.clearTimeout(timeoutID);
 
    goActive();
}

function goActive() {
// do something         
    startTimer();
}



(function() {
    var link = document.querySelector("link[rel*='icon']") || document.createElement('link');
    link.type = 'image/x-icon';
    link.rel = 'shortcut icon';
    link.href = favicon;
    document.getElementsByTagName('head')[0].appendChild(link);
})();






















// INSERT INTO `products` (`id`, `name`, `description`, `purchase_url`, `price`, `geekotech_id`, `active`, `created`, `modified`) VALUES (NULL, 'ScrapperKosh', 'Find the local informations on business page, company details etc.', 'https://geekotech.com/product/scrapperkosh/', '17', '3505', '1', CURRENT_DATE(), CURRENT_TIMESTAMP);
// INSERT INTO `products` (`id`, `name`, `description`, `purchase_url`, `price`, `geekotech_id`, `active`, `created`, `modified`) VALUES (NULL, 'SupportKosh', 'Use a interactive customer support system.', 'https://geekotech.com/product/supportkosh/', '37', '3506', '1', CURRENT_DATE(), CURRENT_TIMESTAMP);
// INSERT INTO `products` (`id`, `name`, `description`, `purchase_url`, `price`, `geekotech_id`, `active`, `created`, `modified`) VALUES (NULL, 'PixelKosh', 'Edit your image', 'https://geekotech.com/product/pixelkosh/', '17', '3507', '1', CURRENT_DATE(), CURRENT_TIMESTAMP);
// INSERT INTO `products` (`id`, `name`, `description`, `purchase_url`, `price`, `geekotech_id`, `active`, `created`, `modified`) VALUES (NULL, 'JourneyKosh', 'Create you timeline of success', 'https://geekotech.com/product/journeykosh/', '19', '3508', '1', CURRENT_DATE(), CURRENT_TIMESTAMP);
// INSERT INTO `products` (`id`, `name`, `description`, `purchase_url`, `price`, `geekotech_id`, `active`, `created`, `modified`) VALUES (NULL, 'TrackerKosh', 'Shorten the log URLs', 'https://geekotech.com/product/trackerkosh/', '21', '3509', '1', CURRENT_DATE(), CURRENT_TIMESTAMP);
// INSERT INTO `products` (`id`, `name`, `description`, `purchase_url`, `price`, `geekotech_id`, `active`, `created`, `modified`) VALUES (NULL, 'SmsKosh', 'SMS API Intergrations', 'https://geekotech.com/product/smskosh/', '49', '3510', '1', CURRENT_DATE(), CURRENT_TIMESTAMP);

// https://www.kirupa.com/html5/detecting_if_the_user_is_idle_or_inactive.htm
// https://forums.asp.net/t/1899214.aspx?If+no+activity+for+15+minutes+display+an+alert+on+web+page+and+then+either+continue+or+logout