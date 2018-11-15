<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;
use Auth;
use App\Http\Requests;
use Carbon\Carbon;

class Niche extends Model
{
	public function __construct()
    {
		$this->date = Carbon::now('Asia/Kolkata');
    }

    public function niche_list()
	{
		return DB::table('niches')->where('status','1')->get();
	}

    public function niche_add($niche_category,$userlevel,$active)
    {
		$user_id = Auth::id();
		return $country_id = DB::table('niches')->insertGetId(
		    [
		    'niche_category'=>$niche_category,
		    'user_level'=>$userlevel,
			'active'=>$active
			]
		);
    }

	public function niche_edit($id)
	{
		return DB::table('niches')->where('id',$id)->get();
	}

	public function niche_update($id,$niche_category,$userlevel,$active)
    {
		$user_id = Auth::id();
		return DB::table('niches')
            ->where('id', $id)
            ->update([
				    'niche_category'=>$niche_category,
					'user_level'=>$userlevel,
					'active'=>$active
            		]);
    }

    public function niche_delete($id)
	{
		return DB::table('niches')
            ->where('id', $id)
            ->update(['status' => '0']);
	}
    public function count()
	{
		return DB::table('niches')->groupBy('id')->count();
	}



}
