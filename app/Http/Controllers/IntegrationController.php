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
use App\Integration;


class IntegrationController extends Controller
{
    public function __construct()
    {
        include(app_path() . '/libraries/aweber/aweber_api/aweber_api.php');        
        include(app_path() . '/libraries/gotowebinar/citrix.php');     
        $aweberconsumerKey    = "Aki0hrNmNnnJ64EDYY4NAhP8";
        $aweberconsumerSecret = "s47aKNtkMWDbp7yAxqqWfO4y882VAHt6EHo83FJP";
        $accessToken = 'XXX';
        $accessSecret = 'XXX';
        $this->aweber = new \AWeberAPI($aweberconsumerKey, $aweberconsumerSecret);

        $this->citrix = new \Citrix('N4fwrDtxFmDbudCeDRgxFYlg4bfPMFwO'); // gotowebinar

        $this->integration= new Integration();

    }
    public function findList($listName) {
        try {
            $foundLists = $this->account->lists->find(array('name' => $listName));
            //must pass an associative array to the find method

            return $foundLists[0];
        }

        catch(Exception $exc) {
            print $exc;
        }
    }

    public function index()
    {
        $integration =  $this->integration->integration_list();
        $intArray=array();
        foreach($integration as $key=>$value){
          if($value->active==1)
          $intArray[$value->appname]=$value;
        }
        return view('integration/list',['integrations'=>$intArray]);
    }
   

    public function gotowebinar( Request $request)
    {

        $record=$this->integration->check_app_record('gotowebinar');
        print_r($record);
        // exit();
        if(!$record){
            $organizer_key = $this->citrix->get_organizer_key();

        print_r($organizer_key);
        // exit();

            if(!$organizer_key){
            $url = $this->citrix->auth_citrixonline();
            echo "<script type='text/javascript'>top.location.href = '$url';</script>";
            exit;
            }
            else{
            
            $organizer_key= $this->citrix->get_organizer_key();
            $access_token= $this->citrix->get_access_token();

            $uid = Auth::id();
            $usertoken=base64_encode('user'.$uid);
            $appname='gotowebinar';
            $this->integration->integration_add($uid, $usertoken, $appname,'' ,'counsumerKey', 'counsumerSecret', $organizer_key, $access_token, '','','',1);
            }

        }
        $record=$this->integration->check_app_record('gotowebinar');

        // $get_organizer_key='4539366031178014981';
        // $get_access_token='dYoMGUL96ouJWF97aytDH3pAm0jL';

        $this->citrix->set_organizer_key($record[0]->accessToken);
        $this->citrix->set_access_token($record[0]->accessSecret);
        try
        {
            $webinars = $this->citrix->citrixonline_get_list_of_webinars() ;
            print_r($webinars);
            // $citrix->pr($webinars);
        }catch (Exception $e) { 
            $this->citrix->pr($e->getMessage());
        }

        $this->integration->update_record($record[0]->id,'hook',json_encode($webinars));
        $record=$this->integration->check_app_record('gotowebinar');
        // print_r($record);
        exit();
        return redirect()->action('IntegrationController@index', ['pop'=>'gotowebinar']);

    }
    public function gotowebinarlist_ajax(){
        $record=$this->integration->check_app_record('gotowebinar');
        $this->citrix->set_organizer_key($record[0]->accessToken);
        $this->citrix->set_access_token($record[0]->accessSecret);

        try
        {
            $webinars = $this->citrix->citrixonline_get_list_of_webinars() ;
            print_r($webinars);
            // $citrix->pr($webinars);
        }catch (Exception $e) { 
            $this->citrix->pr($e->getMessage());
        }

        $this->integration->update_record($record[0]->id,'hook',json_encode($webinars));

        $listname  = '<option value=""></option>';
        
        foreach($webinars['upcoming']['webinars'] as $offset => $list)
        {
          $listname .='<option value="'.$list->webinarID.'">'.$list->subject.'</option>';
        }
        // echo json_encode($listname);
        // echo json_encode($listname, JSON_FORCE_OBJECT);
        echo $listname;
        exit;
    }

    public function aweber(Request $request)
    {

      $record=$this->integration->check_app_record('aweber');
    // unset($_COOKIE['accessToken']);
    // unset($_COOKIE['accessTokenSecret']);
    // setcookie('accessToken', null, -1, '/');
    // setcookie('accessTokenSecret', null, -1, '/');
        // print_r($record);
      if(!$record)
        if (empty($_COOKIE['accessToken'])) {
            if (empty($_GET['oauth_token'])) {
                $callbackUrl = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
                list($requestToken, $requestTokenSecret) = $this->aweber->getRequestToken($callbackUrl);
                setcookie('requestTokenSecret', $requestTokenSecret);
                setcookie('callbackUrl', $callbackUrl);
                header("Location: {$this->aweber->getAuthorizeUrl()}");
                exit();
            }

            $this->aweber->user->tokenSecret = $_COOKIE['requestTokenSecret'];
            $this->aweber->user->requestToken = $_GET['oauth_token'];
            $this->aweber->user->verifier = $_GET['oauth_verifier'];
            list($accessToken, $accessTokenSecret) = $this->aweber->getAccessToken();
            setcookie('accessToken', $accessToken);
            setcookie('accessTokenSecret', $accessTokenSecret);
            $uid = Auth::id();
            $usertoken=base64_encode('user'.$uid);
            $appname='aweber';
            $this->integration->integration_add($uid, $usertoken, $appname,'' ,'counsumerKey', 'counsumerSecret', $accessToken, $accessTokenSecret, '','','',1);

            header('Location: '.$_COOKIE['callbackUrl']);
            exit();
        }

        $this->accessToken=$record[0]->accessToken;
        $this->accessSecret=$record[0]->accessSecret;

        # set this to true to view the actual api request and response
        $this->aweber->adapter->debug = false;

//        $account = $this->aweber->getAccount($_COOKIE['accessToken'], $_COOKIE['accessTokenSecret']);
        // $this->account = $this->aweber->getAccount($_COOKIE['accessToken'], $_COOKIE['accessTokenSecret']);
        $this->account = $this->aweber->getAccount($this->accessToken, $this->accessSecret);
        
        $accountid=$this->account->data['id'];
        $this->integration->update_record($record[0]->id,'account_id',$accountid);
        return redirect()->action('IntegrationController@index', ['pop'=>'aweber']);

//        $this->list = $this->findList(' list 2');
//        $this->list = $this->findList('firstlist');
    }
    

    public function aweberlist_ajax(){
        $record=$this->integration->check_app_record('aweber');
        $this->accessToken=$record[0]->accessToken;
        $this->accessSecret=$record[0]->accessSecret;
        $this->account = $this->aweber->getAccount($this->accessToken, $this->accessSecret);
        $lists=$this->account->lists;   
        $listname  = '<option value=""></option>';
        
        foreach($lists as $offset => $list)
        {
          $listname .='<option value="'.$list->id.'">'.$list->name.'</option>';
        }
        // echo json_encode($listname);
        // echo json_encode($listname, JSON_FORCE_OBJECT);
        echo $listname;
        exit;
    }

    public function aweberlistsave_ajax(Request $request){
        $listname=$request->input('listname');
        $listtxt=$request->input('listtxt');
        $record=$this->integration->check_app_record('aweber');
        $this->integration->update_record($record[0]->id,'list_campaign_name',$listtxt);
        $this->integration->update_record($record[0]->id,'list_campaign_id',$listname);
        echo 'success';
        exit;
    }



    public function savezapier_ajax(Request $request){
        $hookurl=$request->input('hookurl');
        
        $hooks=json_encode($hookurl,JSON_FORCE_OBJECT);
        print_r($hookurl);
        $record=$this->integration->check_app_record('zapier');
        if($record[0])
        {
          if($record[0]->id){
            $this->integration->update_record($record[0]->id,'hook',$hooks);
          }
        }
        else{
            $uid = Auth::id();
            $usertoken=base64_encode('user'.$uid);
            $appname='zapier';
            $this->integration->integration_add($uid, $usertoken, $appname,$hooks ,'', '', '', '', '','','',1);          
        }
        echo 'success';
        exit;
    }


    public function saveactivecamp_ajax(Request $request){
        $apikey=$request->input('acampapikey');
        $apiurl=$request->input('acampapiurl');
        include(app_path() . '/libraries/activecampaign/includes/ActiveCampaign.class.php');

        $ac = new \ActiveCampaign($apiurl, $apikey);

        if (!(int)$ac->credentials_test()) {
            echo "<p>Access denied: Invalid credentials (URL and/or API key).</p>";
            exit();
        }

        $record=$this->integration->check_app_record('activecampaign');
        if(count($record)>0)
        {
            if(isset($record[0]))
            foreach($record as $rec)
            {
                $this->integration->update_record($rec->id,'active',0);
            } 
        }

        $uid = Auth::id();
        $usertoken=base64_encode('user'.$uid);
        $appname='activecampaign';
        $this->integration->integration_add($uid, $usertoken, $appname,'' ,$apiurl, $apikey, '', '', '','','',1);

        $params = [
                'ids'  => 'all',
                'full' => '1'
            ];
        $lists  = $ac->api("list/list_", $params );
        $lists =json_encode($lists);
        $lists = json_decode($lists,true);
        $arr=array();


        $listname  = '<option value=""></option>';
        foreach ($lists as $key => $value) {
            if(is_array($value)){
                $listname .='<option value="'.$value['id'].'">'.$value['name'].'</option>';
                // $arr[$key][]=$value['id'];
                // $arr[$key][]=$value['name'];
            }
        }
        echo $listname;
        // $lists=json_encode($arr);
        // echo $lists;
        exit;
    }

    public function savegotowebinarlist_ajax(Request $request){
        $camp_listid=$request->input('listid');
        $camp_listname=$request->input('listname');
        $uid = Auth::id();
        $record=$this->integration->check_app_record('gotowebinar');
        $this->integration->update_record($record[0]->id,'list_campaign_id',$camp_listid);
        $this->integration->update_record($record[0]->id,'list_campaign_name',$camp_listname);
        echo 'success';
        exit;
    }

    public function saveactivecamplist_ajax(Request $request){
        $acamp_listid=$request->input('listid');
        $acamp_listname=$request->input('listname');
        $uid = Auth::id();
        $record=$this->integration->check_app_record('activecampaign');
        $this->integration->update_record($record[0]->id,'list_campaign_id',$acamp_listid);
        $this->integration->update_record($record[0]->id,'list_campaign_name',$acamp_listname);
        echo 'success';
        exit;
    }


    public function savegetresponse_ajax(Request $request){
        $apikey=$request->input('getresponsekey');

        $url='https://api.getresponse.com/v3/accounts';
        $target_site = $url;
        $timeout = 30;
        $headers[]='X-Auth-Token: api-key '.$apikey;
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
        if(isset($result->accountId)){
            // print_r($result);
            $record=$this->integration->check_app_record('getresponse');
            if(count($record)>0)
            {
                if(isset($record[0]))
                foreach($record as $rec)
                {
                    $this->integration->update_record($rec->id,'active',0);
                } 
            }
            $uid = Auth::id();
            $usertoken=base64_encode('user'.$uid);
            $appname='getresponse';
            $this->integration->integration_add($uid, $usertoken, $appname,'' ,$apikey,'' , '', '', '','','',1);

            $url='https://api.getresponse.com/v3/campaigns';
            $target_site = $url;
            $timeout = 30;

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $target_site);
            curl_setopt($ch, CURLOPT_HTTPHEADER,$headers);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);                                                                      
            curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
            $result=curl_exec($ch);
            curl_close($ch);
            $lists=json_decode($result,true);
            // print_r($lists);
            $arr=array();
            $listname  = '<option value=""></option>';
            foreach ($lists as $key => $value) {
                if(is_array($value)){
                    $listname .='<option value="'.$value['campaignId'].'">'.$value['name'].'</option>';
                }
            }
            echo $listname;
        }
        else{
            echo "error";            
        }
        exit(); 
    }


    public function savegetresponselist_ajax(Request $request){
        $camp_listid=$request->input('listid');
        $camp_listname=$request->input('listname');
        $uid = Auth::id();
        $record=$this->integration->check_app_record('getresponse');
        $this->integration->update_record($record[0]->id,'list_campaign_id',$camp_listid);
        $this->integration->update_record($record[0]->id,'list_campaign_name',$camp_listname);
        echo 'success';
        exit;
    }



    public function savesgauto_ajax(Request $request){
        
        include(app_path() . '/libraries/sg_api/API_SG.php');
        $memberid=$request->input('sgautomemberid');
        $codeactivation=$request->input('sgautoapikey');
        $sgApi = new \API_SG($memberid, $codeactivation);

        $sgApi->set('parent', '')
            ->set('detail', true);
        //appel
        try{
            $call = $sgApi->call('get_list');
            $response=json_decode($call,true);
            $result=$response['reponse'];
            if(isset($result[0]['id'])){
                $record=$this->integration->check_app_record('sgautoresponder');
                if(count($record)>0)
                {
                    if(isset($record[0]))
                    foreach($record as $rec)
                    {
                        $this->integration->update_record($rec->id,'active',0);
                    } 
                }
                $uid = Auth::id();
                $usertoken=base64_encode('user'.$uid);
                $appname='sgautoresponder';
                $this->integration->integration_add($uid, $usertoken, $appname,'' ,$memberid,$codeactivation , '', '', '','','',1);

                $arr=array();
                $listname  = '<option value=""></option>';
                foreach ($result as $key => $value) {
                    if(is_array($value)){
                        $listname .='<option value="'.$value['id'].'">'.$value['nom'].'</option>';
                    }
                }
                echo $listname;
            }
            else{
                echo "error";            
            }
            exit(); 

        } catch (Exception $e){
        //    SG Non joignable.
            echo "error";            
            exit();
        }        
    }


    public function savesgautolist_ajax(Request $request){
        $camp_listid=$request->input('listid');
        $camp_listname=$request->input('listname');
        $uid = Auth::id();
        $record=$this->integration->check_app_record('sgautoresponder');
        $this->integration->update_record($record[0]->id,'list_campaign_id',$camp_listid);
        $this->integration->update_record($record[0]->id,'list_campaign_name',$camp_listname);
        echo 'success';
        exit;
    }











    public function uploadimage(Request $request)
    {

        $file = $request->file('imageedit');
        // print_r($file);
        $filename=rand(1000000000,9999999999);
        $ext=$file->getClientOriginalExtension();
        $destinationPath = 'images/campaign';
        $full_filename=$filename.'.'.$ext;
        $image_url=$destinationPath.'/'.$full_filename;
        $file->move($destinationPath,$full_filename);
        echo $image_url;
    }

    public function disconnect_app(Request $request)
    {
        $appname=$request->input('app');    

        $record=$this->integration->check_app_record($appname);
        if(count($record)>0)
        {
            if(isset($record[0]))
            foreach($record as $rec)
            {
                if($rec->id){
                    $this->integration->update_record($rec->id,'active',0);
                } 
            }  
            sleep(1); 
            echo 'success';
            exit;
        }

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


    public function inte()
    {
        $integration =  $this->integration->integration_list();
            return view('inte/create',['integrations'=>$integration]);
    }


}

// ALTER TABLE `integration` CHANGE `list_campaign_id` `list_campaign_id` VARCHAR(100) NULL DEFAULT NULL; 