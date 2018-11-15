<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;
use Auth;
use App\Http\Requests;
use Carbon\Carbon;

class Userlevel extends Model
{
	public function __construct()
    {
		$this->date = Carbon::now('Asia/Kolkata');
    }

    public function userlevel_list()
	{
		return DB::table('userlevel')->where('status','1')->get();
	}

    public function userlevel_add($level,$active)
    {
		$user_id = Auth::id();
		return $country_id = DB::table('userlevel')->insertGetId(
		    [
		    'level'=>$level,
			'active'=>$active
			]
		);
    }

	public function userlevel_edit($id)
	{
		return DB::table('userlevel')->where('id',$id)->get();
	}

	public function userlevel_update($id,$level,$active)
    {
		$user_id = Auth::id();
		return DB::table('userlevel')
            ->where('id', $id)
            ->update([
				    'level'=>$level,
					'active'=>$active
            		]);
    }

    public function userlevel_delete($id)
	{
		return DB::table('userlevel')
            ->where('id', $id)
            ->update(['status' => '0']);
	}
}
