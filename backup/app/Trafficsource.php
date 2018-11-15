<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;
use Auth;
use App\Http\Requests;
use Carbon\Carbon;

class Trafficsource extends Model
{
	public function __construct()
    {
		$this->date = Carbon::now('Asia/Kolkata');
    }

    public function trafficsource_list()
	{
		return DB::table('trafficsource')->where('status','1')->get();
	}
	
    public function trafficsource_add($sourcename,$active)
    {
		$user_id = Auth::id();
		return $country_id = DB::table('trafficsource')->insertGetId(
		    [
		    'sourcename'=>$sourcename,
			'active'=>$active
			]
		);
    }

	public function trafficsource_edit($id)
	{
		return DB::table('trafficsource')->where('id',$id)->get();
	}

	public function trafficsource_update($id,$sourcename,$active)
    {
		$user_id = Auth::id();
		return DB::table('trafficsource')
            ->where('id', $id)
            ->update([
				'sourcename'=>$sourcename,
				'active'=>$active
        		]);
    }

    public function trafficsource_delete($id)
	{
		return DB::table('trafficsource')
            ->where('id', $id)
            ->update(['status' => '0']);
	}
}
