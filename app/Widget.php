<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;
use Auth;
use App\Http\Requests;
use Carbon\Carbon;

class Widget extends Model
{
	public function __construct()
    {
		$this->date = Carbon::now('Asia/Kolkata');
    }
    public function widget_list()
	{
		$user_id = Auth::id();
		return  DB::table('widgets')->where('created_by',$user_id)->get();
	}
	
    public function widget_detail($id)
	{
		$user_id = Auth::id();
		return  DB::table('widgets')->where('id',$id)->get();
	}

    public function widget_add($headline_text,$headline_color,$headline_bg,$description_text,$description_color,$description_bg, $widget_position, $icon )
    {
		$user_id = Auth::id();
		return $widget_id = DB::table('widgets')->insertGetId(
		    [
		    'headline_text'=>$headline_text,
		    'headline_color'=>$headline_color,
		    'headline_bg'=>$headline_bg,
		    'description_text'=>$description_text,
		    'description_color'=>$description_color,
		    'description_bg'=>$description_bg,
		    'widget_position'=>$widget_position,
		    'icon'=>$icon,
			'created_by' => $user_id,
			'created_at' => $this->date			
			]);
    }

    public function widget_update($id, $headline_text,$headline_color,$headline_bg,$description_text,$description_color,$description_bg, $widget_position, $icon )
    {
		$user_id = Auth::id();
		return DB::table('widgets')
            ->where('id', $id)
            ->update([
		    'headline_text'=>$headline_text,
		    'headline_color'=>$headline_color,
		    'headline_bg'=>$headline_bg,
		    'description_text'=>$description_text,
		    'description_color'=>$description_color,
		    'description_bg'=>$description_bg,
		    'widget_position'=>$widget_position,
		    'icon'=>$icon,
			'created_by' => $user_id,
			'created_at' => $this->date
		]);
    }
}
