<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;
use Auth;
use App\Http\Requests;
use Carbon\Carbon;

class Integration extends Model
{

	public function __construct()
    {
		$this->date = Carbon::now('Asia/Kolkata');
    }
    public function integration_list()
	{
		$user_id = Auth::id();
		return  DB::table('integration')->where('active','1')->where('created_by',$user_id)->get();
	}



	public function integration_add($uid, $usertoken, $appname, $hook,$counsumerKey, $counsumerSecret, $accessToken, $accessSecret, $account_id,$list_campaign_id, $list_campaign_name, $active)
    {

		$user_id = Auth::id();
		return $campaign_id = DB::table('integration')->insertGetId(
		    [
		    'uid'=>$uid,
		    'usertoken'=>$usertoken,
		    'appname'=>$appname,
		    'hook'=>$hook,
		    'counsumerKey'=>$counsumerKey,
		    'counsumerSecret'=>$counsumerSecret,
		    'accessToken'=>$accessToken,
		    'accessSecret'=>$accessSecret,
		    'account_id'=>$account_id,
			'list_campaign_id'=>$list_campaign_id,
			'list_campaign_name'=>$list_campaign_name,
			'active'=>$active,
			'created_by' => $user_id,
			'created_at' => $this->date
			]
		);
    }


	public function check_app_record($appname,$uid='')
    {

		if(isset($uid) && $uid!='')
			$user_id=$uid;
		else
			$user_id = Auth::id();
		$appdetails = DB::table('integration')->where('uid',$user_id)->where('appname',$appname)->where('active',1)->get();
    	if(!$appdetails->count())
    	{
			return false;
    	}
    	else {
			return $appdetails;
    	}
    }

	public function update_record($id,$recordname,$value)
    {

		$user_id = Auth::id();
		return DB::table('integration')
            ->where('id', $id)
            ->update([ $recordname=>$value ]);

    }





	public function integration_update($id,$uid, $usertoken, $appname, $hook,$counsumerKey, $counsumerSecret, $accessToken, $accessSecret, $account_id, $list_campaign_id, $list_campaign_name, $active)
    {
		$user_id = Auth::id();
		return DB::table('integration')
            ->where('id', $id)
            ->update([
		    'uid'=>$uid,
		    'usertoken'=>$usertoken,
		    'appname'=>$appname,
		    'hook'=>$hook,
		    'counsumerKey'=>$counsumerKey,
		    'counsumerSecret'=>$counsumerSecret,
		    'accessToken'=>$accessToken,
		    'accessSecret'=>$accessSecret,
		    'account_id'=>$account_id,
			'list_campaign_id'=>$list_campaign_id,
			'list_campaign_name'=>$list_campaign_name,
			'active'=>$active,
			'updated_by' => $user_id,
			'updated_at' => $this->date			
		]);
    }

    public function integration_delete($id)
	{
		$user_id = Auth::id();
		$integration = DB::table('integration')->where('id',$id)->get();
		return DB::table('integration')
            ->where('id', $id)
            ->update(['active' => '0','updated_at' => $this->date,'updated_by' => $user_id]);
	}
}
