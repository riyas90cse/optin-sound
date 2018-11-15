<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Report;
use App\Integration;
class ReportController extends Controller
{
    public function __construct()
    {
		$this->report = new Report();
		$this->integration= new Integration();

    }
    public function index()
    {
		$report = $this->report->report_list();
		$count = $report->count();
		// print_r($report);
		return view('report/list',['report'=>$report,'count'=>$count]);
    }
    public function listall()
    {
    	$uid=2;
		$report = $this->report->report_list_byid($uid);
		return json_encode($report);
		return "Success";
    }

    public function save(Request $request)
    {
    	$data = $request->all();
    	// print_r($data);
    	$name=$data['name'];
    	$email=$data['email'];
    	$phone=$data['phone'];
    	$campaign_id=$data['cid'];
    	$uid=$data['id'];
    	$optin=$this->report->add_optin($name, $email,$phone, $campaign_id, $uid);
		$this->aweber_record=$this->integration->check_app_record('aweber',$uid);
		if(!empty($this->aweber_record[0])){
	//		$aweberopt=$this->awebersave($name,$email,$this->aweber_record);			
		}
		$this->zap_record=$this->integration->check_app_record('zapier',$uid);
		if(!empty($this->zap_record[0])){
	//		$zapieropt=$this->zapiersave($name,$email,$this->zap_record);			
		}

		$this->acamp_record=$this->integration->check_app_record('activecampaign',$uid);
		if(!empty($this->acamp_record[0])){
			// $acamp_opt=$this->activecampsave( $name, $email, $this->acamp_record );			
		}


		if($optin)
			return "Success";
		else
			return "Fail";
    }

	public function awebersave($name,$email,$aweberRecord){
        include(app_path() . '/libraries/aweber/aweber_api/aweber_api.php');        
        $consumerKey    = "Aki0hrNmNnnJ64EDYY4NAhP8";
        $consumerSecret = "s47aKNtkMWDbp7yAxqqWfO4y882VAHt6EHo83FJP";
        $this->aweber_record=$aweberRecord;
        $this->aweber = new \AWeberAPI($consumerKey, $consumerSecret);
        $this->account = $this->aweber->getAccount($this->aweber_record[0]->accessToken, $this->aweber_record[0]->accessSecret);
        $foundLists = $this->account->lists->find(array('name' => $this->aweber_record[0]->list_campaign_name));
        $listUrl = "/accounts/".$this->aweber_record[0]->account_id."/lists/".$foundLists[0]->id;
        $list = $this->account->loadFromUrl($listUrl);
        $subscriber = array(
            'email' => $email,
            'name'  => $name
        );
        $newSubscriber = $list->subscribers->create($subscriber);
    }

	public function zapiersave($name,$email,$zapSetting,$phone=''){
		$this->zap_record=$zapSetting;
		if($phone!=''){
	    $parameter = http_build_query(['name'=> $name, 'email'=>$email,'phone'=>$phone]);
		}
		else{

	    $parameter = http_build_query(['name'=> $name, 'email'=>$email]);
		}

	    $urls=json_decode($this->zap_record[0]->hook);
		foreach ($urls as $key => $url) {
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL,$url.'?'.$parameter);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_TIMEOUT, 120);
			$response = curl_exec($ch);
			curl_close($ch);
			$result = json_decode($response);
		}

	}


	public function activecampsave($name,$email,$acampRecord){
		print_r($acampRecord);
		return;

        $apikey=$acampRecord[0]->accessSecret;
        $apiurl=$acampRecord[0]->accessToken;
        include(app_path() . '/libraries/activecampaign/includes/ActiveCampaign.class.php');

		$ac = new \ActiveCampaign($apiurl, $apikey);

		$listid=$acampRecord[0]->list_campaign_id;
		$contact = array(
		"email"              => $email,
		"first_name"         => $name,
		"p[$listid]"      => $listid,
		"status[$listid]" => 1, // "Active" status
		);
		$contact_sync = $ac->api("contact/sync", $contact);
		if (!(int)$contact_sync->success) {
			// entry in log for not success entry 
			return false;
		}
		$contact_id = (int)$contact_sync->subscriber_id;
        return true;

    }


	// public function awebersave($name,$email,$uid){
 //        include(app_path() . '/libraries/aweber/aweber_api/aweber_api.php');        
 //        $consumerKey    = "Aki0hrNmNnnJ64EDYY4NAhP8";
 //        $consumerSecret = "s47aKNtkMWDbp7yAxqqWfO4y882VAHt6EHo83FJP";
 //        $accessToken = 'XXX';
 //        $accessSecret = 'XXX';
 //        $this->aweber_record=$this->integration->check_app_record('aweber',$uid);
 //        $this->aweber = new \AWeberAPI($consumerKey, $consumerSecret);
 //        $this->account = $this->aweber->getAccount($this->aweber_record[0]->accessToken, $this->aweber_record[0]->accessSecret);
 //        $foundLists = $this->account->lists->find(array('name' => $this->aweber_record[0]->list_campaign_name));
 //        $listUrl = "/accounts/".$this->aweber_record[0]->account_id."/lists/".$foundLists[0]->id;
 //        $list = $this->account->loadFromUrl($listUrl);
 //        $subscriber = array(
 //            'email' => $email,
 //            'name'  => $name
 //        );
 //        $newSubscriber = $list->subscribers->create($subscriber);
 //       print_r($newSubscriber);
 //    }
    public function search(Request $request)
    {
		$from_date = $request->input('from_date');
		$to_date = $request->input('to_date');
		$this->validate($request,[
			'from_date'=>'required|date',
			'to_date'=>'required|date'
		]);
		$report = $this->report->report_search($from_date,$to_date);
		$count = $report->count();
		return view('report/list',['report'=>$report,'count'=>$count]);
    }
}
