<?php
require_once('aweber_api/aweber_api.php');
// Replace with the keys of your application
// NEVER SHARE OR DISTRIBUTE YOUR APPLICATIONS'S KEYS!
$consumerKey    = "Aki0hrNmNnnJ64EDYY4NAhP8";
$consumerSecret = "s47aKNtkMWDbp7yAxqqWfO4y882VAHt6EHo83FJP";

$aweber = new AWeberAPI($consumerKey, $consumerSecret);

if (empty($_COOKIE['accessToken'])) {
    if (empty($_GET['oauth_token'])) {
        $callbackUrl = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
        list($requestToken, $requestTokenSecret) = $aweber->getRequestToken($callbackUrl);
        setcookie('requestTokenSecret', $requestTokenSecret);
        setcookie('callbackUrl', $callbackUrl);
        header("Location: {$aweber->getAuthorizeUrl()}");
        exit();
    }

    $aweber->user->tokenSecret = $_COOKIE['requestTokenSecret'];
    $aweber->user->requestToken = $_GET['oauth_token'];
    $aweber->user->verifier = $_GET['oauth_verifier'];
    list($accessToken, $accessTokenSecret) = $aweber->getAccessToken();
    setcookie('accessToken', $accessToken);
    setcookie('accessTokenSecret', $accessTokenSecret);
    header('Location: '.$_COOKIE['callbackUrl']);
    exit();
}

# set this to true to view the actual api request and response
$aweber->adapter->debug = false;

$account = $aweber->getAccount($_COOKIE['accessToken'], $_COOKIE['accessTokenSecret']);

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>AWeber Test Application</title>
  <link type="text/css" rel="stylesheet" href="styles.css" />
<body>
<?php
foreach($account->lists as $offset => $list) {
?>
<h1>List: <?php echo $list->name; ?></h1>
<h3><?php echo $list->id; ?></h3>
<table>
  <tr>
    <th class="stat">Subject</th>
    <th class="value">Sent</th>
    <th class="value">Stats</th>
  </tr>
<?php
foreach($list->campaigns as $campaign) {
    if ($campaign->type == 'broadcast_campaign') {
?>
    <tr>
        <td class="stat"><em><?php echo $campaign->subject; ?></em></td>
        <td class="value"><?php echo date('F j, Y h:iA', strtotime($campaign->sent_at)); ?></td>
        <td class="value"><ul>
              <li><b>Opened:</b> <?php echo $campaign->total_opens; ?></li>
              <li><b>Sent:</b>  <?php echo $campaign->total_sent; ?></li>
              <li><b>Clicked:</b>  <?php echo $campaign->total_clicks; ?></li>
            </ul>
        </td>
    <?php
    }
} ?>
</table>
<?php }
?>
<body>
</html>
n















<div id='cs_popup' style='position: fixed; border: medium none; z-index: 99999; right: 0px; bottom: 0px; display: block; text-align: center; width: 300px;'><div id='pp-main'><div style='clear: both; float: none; color: rgb(255, 0, 0); background-color: rgb(255, 255, 255); margin: 0px; border-radius: 8px 8px 0px 0px; border-bottom: 1px solid rgb(238, 238, 238); padding: 10px;'><div style='float: left; background: beige none repeat scroll 0% 0%; border-top: 1px solid rgb(238, 238, 238); border-bottom: 1px solid rgb(238, 238, 238); border-left: 1px solid rgb(238, 238, 238); -moz-border-top-colors: none; -moz-border-right-colors: none; -moz-border-bottom-colors: none; -moz-border-left-colors: none; border-image: none; border-radius: 50%; width: 60px; height: 60px;'><img style='width:100%; padding:10px;' src='http://convertsound.com/images/convertsound-fav.png'></div><div style='float: left; width: 220px;' height:72px;'=''><h2 style='color: rgb(0, 0, 0); font-size: 20px; margin: 0px; text-align: left; padding: 8% 0px 0px 12px;'>Nishant Sharma</h2></div><div style='clear:both;float:none;'></div></div><h2 id='pp_ht' style='color: rgb(255, 0, 0); background-color: rgb(255, 255, 255); margin: 0px; padding: 10px 5px; border-bottom: 1px solid rgb(238, 238, 238); font-size: 20px;'>Big offer for early birds</h2><div id='pp_icon_blk' style='background: rgb(255, 255, 255) none repeat scroll 0% 0%; float: left; height: 76px; width: 200px;'><p id='pp_dt' style='color:#2239c8;background-color:#dccece; margin:0;padding:10px 5px; height:89px; '>Tap below to reveal the offer for you!!!</p></div><div id='pp_icon_blk' style='background: rgb(255, 255, 255) none repeat scroll 0% 0%; float: left; width: 100px;'><span id='pp_circle' style='border:2px solid #000;border-radius:50%;display:inline-block;padding:10px;margin:5px;'><img id='pp_icon' style='width: 55px;' src='http://app.convertsound.com/images/convertsound-fav-def.gif'></span></div></div></div>