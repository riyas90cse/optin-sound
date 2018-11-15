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
        $consumerKey    = "Aki0hrNmNnnJ64EDYY4NAhP8";
        $consumerSecret = "s47aKNtkMWDbp7yAxqqWfO4y882VAHt6EHo83FJP";
        $accessToken = 'XXX';
        $accessSecret = 'XXX';
        $this->aweber = new \AWeberAPI($consumerKey, $consumerSecret);
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
    
    public function awebersave($name,$email){
        // include(app_path() . '/libraries/aweber/aweber_api/aweber_api.php');        
        $consumerKey    = "Aki0hrNmNnnJ64EDYY4NAhP8";
        $consumerSecret = "s47aKNtkMWDbp7yAxqqWfO4y882VAHt6EHo83FJP";
        $accessToken = 'XXX';
        $accessSecret = 'XXX';
        $this->aweber_record=$this->integration->check_app_record('aweber');
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
//        print_r($newSubscriber);
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
          $listname .='<option value="'.$list->name.'">'.$list->name.'</option>';
        }
        // echo json_encode($listname);
        // echo json_encode($listname, JSON_FORCE_OBJECT);
        echo $listname;
        exit;
    }

    public function aweberlistsave_ajax(Request $request){
        $listname=$request->input('listname');
        $record=$this->integration->check_app_record('aweber');
        $this->integration->update_record($record[0]->id,'list_campaign_name',$listname);
        $this->awebersave('Raven','vipinks86@gmail.com');
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


    public function inte($category,$title)
    {
        echo $category;
        echo $title     ;
        $integration =  $this->integration->integration_list();
            return view('inte/create',['integrations'=>$integration]);
    }


}
