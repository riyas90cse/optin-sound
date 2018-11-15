<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;
use Auth;
use App\Http\Requests;
use Carbon\Carbon;

class Report extends Model
{
	public function __construct()
    {
		$this->date = Carbon::now('Asia/Kolkata');
    }
    public function report_list()
	{
		$user_id = Auth::id();

		return DB::table('report')
		->where([
		['status','1'],
		['created_by', '=' ,$user_id]
		])
		->orderBy('id', 'desc')
		->get();
	}
	public function report_list_byid($id)
	{

		return DB::table('report')
		->where([
		['status','1'],
		['created_by', '=' ,$id]
		])
		->orderBy('id', 'desc')
		->get();
	}

	public function add_optin($name, $email,$phone, $campaign_id, $uid)
    {

		return $opt_id = DB::table('report')->insertGetId(
		    [
		    'name'=>$name,
		    'email'=>$email,
		    'phone'=>$phone,
		    'campaign_id'=>$campaign_id,
			'created_by' => $uid,
			'created_at' => $this->date,
			'status' => '1'
			]
		);
    }

	public function report_search($from_date,$to_date)
	{
		$user_id = Auth::id();
		$from_date = date_format(date_create($from_date),"Y-m-d");
		$to_date = date_format(date_create($to_date),"Y-m-d");
		return DB::table('report')
		->where([
		['status','1'],
		['created_by', '=' ,$user_id]
		])
		->orderBy('id', 'desc')
		->whereBetween('created_at', [$from_date, $to_date])
		->get();
	}
}
