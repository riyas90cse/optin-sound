<?php 
error_reporting(1);
//Link to purl_include.php from your Purlem landing page (index.php) file
// include ("./getresponse/purl_include.php");


// function get_response($url){

$url='https://api.getresponse.com/v3';
$url='https://api.getresponse.com/v3/accounts';
// $url='https://api.getresponse.com/v3/campaigns';
// $url='https://api.getresponse.com/v3/contacts';
$target_site = $url;

$timeout = 30;

// $headers[]='X-Auth-Client:878mgp91zxk4q1dbo7cje1ybnvghg55';
// $headers[]='X-Auth-Token:n5gqenrb9xo2u6ii1sszt1hgdnuytcs';

// a12b48c847c24044954f90249d53f6bf
// $headers[]='X-Auth-Client:5iua4vc40dtykpc321ffn6djx4f2ntp';
$headers[]='X-Auth-Token: api-key a12b48c847c24044954f90249d53f6bf';
$headers[]='Accept:application/json';
$headers[]='Content-Type:application/json';

$ch = curl_init();

curl_setopt($ch, CURLOPT_URL, $target_site);
curl_setopt($ch, CURLOPT_HTTPHEADER,$headers);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);                                                                      
curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
$result=curl_exec($ch);
curl_close($ch);
$result=json_decode($result);
print_r($result);

exit();

$data=array();
$data['name']='vipin1';
$data['email']='vipinks88@gmail.com';
$data['campaign']=["campaignId"=>"6S32Z"];

$parameters=json_encode($data);
print_r($parameters);



curl_setopt($ch, CURLOPT_URL, $target_site);
curl_setopt($ch, CURLOPT_HTTPHEADER,$headers);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS,$parameters);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);                                                                      
curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
$result=curl_exec($ch);
curl_close($ch);
$result=json_decode($result);
print_r($result);

?>