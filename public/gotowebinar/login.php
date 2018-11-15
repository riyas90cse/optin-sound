<?php
include "citrix.php";

// $get_organizer_key='4539366031178014981';
// $get_access_token='dYoMGUL96ouJWF97aytDH3pAm0jL';

$citrix = new Citrix('N4fwrDtxFmDbudCeDRgxFYlg4bfPMFwO');

$citrix->set_organizer_key($get_organizer_key);
$citrix->set_access_token($get_access_token);

// if($get_organizer_key!=='')
//	$organizer_key = $citrix->get_organizer_key();

//$citrix->pr($organizer_key);

// if(!$organizer_key)
// {
// 	$url = $citrix->auth_citrixonline();
// 	echo "<script type='text/javascript'>top.location.href = '$url';</script>";
// 	exit;
// }

// $citrix->pr($citrix->get_organizer_key());
// $citrix->pr($citrix->get_access_token());

try
{
	$webinars = $citrix->citrixonline_get_list_of_webinars() ;
	print_r($webinars);
	// $citrix->pr($webinars);
}catch (Exception $e) {	
	$citrix->pr($e->getMessage());
}

try
{
	$response = $citrix->citrixonline_create_registrant_of_webinar('410502403', $data = array('first_name' => 'First Name', 'last_name' => 'Lastnmae', 'email'=>'email@email.com')) ;
	$citrix->pr($response);
}catch (Exception $e) {	
	$citrix->pr($e->getMessage());
}


