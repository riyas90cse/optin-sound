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

   public function awebersave($name,$email,$uid){
        include(app_path() . '/libraries/aweber/aweber_api/aweber_api.php');        
        $consumerKey    = "Aki0hrNmNnnJ64EDYY4NAhP8";
        $consumerSecret = "s47aKNtkMWDbp7yAxqqWfO4y882VAHt6EHo83FJP";
        $accessToken = 'XXX';
        $accessSecret = 'XXX';
        $this->aweber_record=$this->integration->check_app_record('aweber',$uid);
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
       print_r($newSubscriber);
    } 
	
	public function store(Request $request)
    {
echo   $method = $request->method();

	$data = $request->all();
	print_r(json_encode($data));

exit();   

 	// $name = $request->input('name');
  //   	$email = $request->input('email');
  //   	$uid='2';
  //       $this->aweber_record=$this->integration->check_app_record('aweber', $uid);

  //   	$aweberopt=$this->awebersave($name,$email,$uid);			
        //
    }

    public function save(Request $request)
    {
    	$method = $request->method();
    	$data = $request->all();
    	// print_r($data);
    	// $name=$request->input('name');
    	// $email=$request->input('email');
    	$name=$data['name'];
    	$email=$data['email'];
    	// $uid=$data['id'];
    	$phone='212313';
    	$campaign_id='10';
    	$uid='2';
    	// $optin=$this->report->add_optin($name, $email,$phone, $campaign_id, $uid);
    	$this->aweber_record=$this->integration->check_app_record('aweber');
    	echo json_encode($this->aweber_record);
    	// return json_encode($this->aweber_record);
    	echo 'hello';
    	exit;
    	if($this->aweber_record){   		
		$aweberopt=$this->awebersave($name,$email);			
    	}
// curl -X POST http://convertsound.local/optin  -H "Content-type: application/x-www-form-urlencoded" -d "email=vipinks86@gmail.com&name=revon"

//curl -X POST http://convertsound.local/optin  -H "Content-type: application/x-www-form-urlencoded" -d "{'email':'vipinks86@gmail.com','name':'revon'}"


		//echo	urlencode('name=abc&email=abc@gmail.com&id=kkdasda=');
		// $uid=base64_decode($data['id']);
	
		// $uid=$request->user;
		// $report = $this->report->report_list_byid($uid);
		// return json_encode($report);
		if($optin)
			return "Success";
		else
			return "Fail";
    }
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
