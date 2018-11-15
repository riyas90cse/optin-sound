<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;
use Auth;
use App\Http\Requests;
use Carbon\Carbon;

class Amazonpolly extends Model
{
	public function __construct()
    {
		$this->date = Carbon::now('Asia/Kolkata');
    }
    public function t2s_list()
	{
		$user_id = Auth::id();
		return  DB::table('text2speech')->where('created_by',$user_id)->get();
	}
	
    public function t2s_detail($sound_url)
	{
		$user_id = Auth::id();
		return  DB::table('text2speech')->where('sound_url',$sound_url)->get();
	}

    public function t2s_add( $voice_id, $text, $language, $sound_url )
    {

		$user_id = Auth::id();
		return $campaign_id = DB::table('text2speech')->insertGetId(
		    [
		    'voice_id'=>$voice_id,
		    'text'=>$text,
		    'language'=>$language,
		    'sound_url'=>$sound_url,
			'created_by' => $user_id,
			'created_at' => $this->date			]
		);
    }
}
