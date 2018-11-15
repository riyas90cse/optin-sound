<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;
use Auth;
use App\Http\Requests;
use Carbon\Carbon;

class Language extends Model
{
	public function __construct()
    {
		$this->date = Carbon::now('Asia/Kolkata');
    }
    public function language_list()
	{
		return DB::table('language')->where('status','1')->get();
	}
    public function language_add($language_name,$language_code,$active)
    {
		$user_id = Auth::id();
		return $language_id = DB::table('language')->insertGetId(
		    [
		    'language_name'=>$language_name,
			'language_code'=>$language_code,
			'active'=>$active
			]
		);
    }
	public function language_edit($id)
	{
		return DB::table('language')->where('id',$id)->get();
	}
	public function language_update($id,$language_name,$language_code,$active)
    {
		$user_id = Auth::id();
		return DB::table('language')
            ->where('id', $id)
            ->update([
				    'language_name'=>$language_name,
					'language_code'=>$language_code,
					'active'=>$active
            		]);
    }
    public function language_delete($id)
	{
		return DB::table('language')
            ->where('id', $id)
            ->update(['status' => '0']);
	}
}
