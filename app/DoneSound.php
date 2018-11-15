<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;
use Auth;
use App\Http\Requests;
use Carbon\Carbon;

class DoneSound extends Model
{
	public function __construct()
    {
		$this->date = Carbon::now('Asia/Kolkata');
    }

    public function soundniche_list()
	{
		return DB::table('soundniches')->where('status','1')->get();
	}

    public function soundniche_add($soundname, $niche_category, $trafficsource,$language,$variation,$sound_text,$sound_url,$active)
    {
		$user_id = Auth::id();
		return $country_id = DB::table('soundniches')->insertGetId(
		    [
		    'soundname'=>$soundname,
		    'niche_category'=>$niche_category,
		    'trafficsource'=>$trafficsource,
		    'language'=>$language,
		    'variation'=>$variation,
		    'sound_text'=>$sound_text,
		    'sound_url'=>$sound_url,
			'active'=>$active
			]
		);
    }

	public function soundniche_edit($id)
	{
		return DB::table('soundniches')->where('id',$id)->get();
	}

	public function soundniche_update($id,$soundname, $niche_category, $trafficsource,$language,$variation,$sound_text,$sound_url,$active)
    {
		$user_id = Auth::id();
		return DB::table('soundniches')
            ->where('id', $id)
            ->update([
					    'soundname'=>$soundname,
					    'niche_category'=>$niche_category,
					    'trafficsource'=>$trafficsource,
					    'language'=>$language,
					    'variation'=>$variation,
					    'sound_text'=>$sound_text,
					    'sound_url'=>$sound_url,
						'active'=>$active
            		]);
    }

    public function soundniche_delete($id)
	{
		return DB::table('soundniches')
            ->where('id', $id)
            ->update(['status' => '0']);
	}

    public function count()
	{
		return DB::table('soundniches')->groupBy('id')->count();
	}



}
