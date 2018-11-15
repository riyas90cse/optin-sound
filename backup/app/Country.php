<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;
use Auth;
use App\Http\Requests;
use Carbon\Carbon;

class Country extends Model
{
	public function __construct()
    {
		$this->date = Carbon::now('Asia/Kolkata');
    }
    public function country_list()
	{
		return DB::table('country')->where('status','1')->get();
	}
    public function country_add($country_name,$country_code,$active)
    {
		$user_id = Auth::id();
		return $country_id = DB::table('country')->insertGetId(
		    [
		    'country_name'=>$country_name,
			'country_code'=>$country_code,
			'active'=>$active
			]
		);
    }
	public function country_edit($id)
	{
		return DB::table('country')->where('id',$id)->get();
	}
	public function country_update($id,$country_name,$country_code,$active)
    {
		$user_id = Auth::id();
		return DB::table('country')
            ->where('id', $id)
            ->update([
				    'country_name'=>$country_name,
					'country_code'=>$country_code,
					'active'=>$active
            		]);
    }
    public function country_delete($id)
	{
		return DB::table('country')
            ->where('id', $id)
            ->update(['status' => '0']);
	}
}
