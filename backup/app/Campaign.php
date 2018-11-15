<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;
use Auth;
use App\Http\Requests;
use Carbon\Carbon;

class Campaign extends Model
{
	public function __construct()
    {
		$this->date = Carbon::now('Asia/Kolkata');
    }
    public function campaign_list()
	{
		$user_id = Auth::id();
		return  DB::table('campaign')->where('status','1')->where('created_by',$user_id)->get();
	}
	
    public function campaign_add($domain_name, $campaign_type, $language, $voice_variation, $sound_niche, $traffic_source, $sound_src, $text_to_speech, $trigger_time, $scroll_height,$favicon_url, $repeat_trigger_time, $back_button_redirect, $vibration_mobile, $script_name )
    {

		$user_id = Auth::id();
		return $campaign_id = DB::table('campaign')->insertGetId(
		    [
		    'domain_name'=>$domain_name,
		    'campaign_type'=>$campaign_type,
		    'language'=>$language,
		    'voice_variation'=>$voice_variation,
		    'sound_niche'=>$sound_niche,
		    'traffic_source'=>$traffic_source,
		    'sound_src'=>$sound_src,
		    'text_to_speech'=>$text_to_speech,
			'trigger_time'=>$trigger_time,
			'scroll_height'=>$scroll_height,
			'favicon_icon'=>$favicon_url,
			'repeat_trigger_time'=>$repeat_trigger_time,
			'back_button_redirect'=>$back_button_redirect,
			'vibration_mobile'=>$vibration_mobile,
			'script_name'=>$script_name,
			'created_by' => $user_id,
			'created_at' => $this->date,
			'status' => '1'
			]
		);
    }

    public function campaign_ajax_add($campaign_name, $domain_name, $campaign_type, $voice_variation, $sound_niche, $traffic_source,  $sound_src, $trigger_time, $scroll_height, $repeat_trigger_time,  $script_name, $brandlogo,$description_bg,$description_color,$description_text,$exit_intent_popup,$headline_bg,$headline_color,$headline_text,$insite_trigger,$exclude_pages,$optin_message,$play_condition,$play_icon,$sp_optin_message,$thankyou_message,$topbar_bg,$topbar_color,$topbar_text,$trigger_elements)
    {

		$user_id = Auth::id();
		return $campaign_id = DB::table('campaign')->insertGetId(
		    [
		    'campaign_name'=>$campaign_name,
		    'domain_name'=>$domain_name,
		    'campaign_type'=>$campaign_type,
		    'voice_variation'=>$voice_variation,
		    'sound_niche'=>$sound_niche,
		    'traffic_source'=>$traffic_source,
		    'sound_src'=>$sound_src,
			'trigger_time'=>$trigger_time,
			'scroll_height'=>$scroll_height,
			'repeat_trigger_time'=>$repeat_trigger_time,
			'script_name'=>$script_name,
			'brandlogo'=>$brandlogo,
			'description_bg'=>$description_bg,
			'description_color'=>$description_color,
			'description_text'=>$description_text,
			'exit_intent_pop'=>$exit_intent_popup,
			'headline_bg'=>$headline_bg,
			'headline_color'=>$headline_color,
			'headline_text'=>$headline_text,
			'insite_trigger'=>$insite_trigger,
			'exclude_pages'=>$exclude_pages,
			'optin_message'=>$optin_message,
			'play_condition'=>$play_condition,
			'playicon'=>$play_icon,
			'sp_optin_message'=>$sp_optin_message,
			'thankyou_message'=>$thankyou_message,
			'topbar_bg'=>$topbar_bg,
			'topbar_color'=>$topbar_color,
			'topbar_text'=>$topbar_text,
			'trigger_elements'=>$trigger_elements,
			'created_by' => $user_id,
			'created_at' => $this->date,
			'status' => '1'
		    // 'widget_id'=>$widget_id,
		    // 'action_type'=>$action_type,
		    // 'language'=>$language,
		    // 'text_to_speech'=>$text_to_speech,
			// 'favicon_icon'=>$favicon_url,
			// 'back_button_redirect'=>$back_button_redirect,
			// 'vibration_mobile'=>$vibration_mobile,
			]
		);
    }

    public function campaign_ajax_update($id,$campaign_name,$domain_name, $campaign_type,  $widget_id, $voice_variation, $sound_niche, $traffic_source,  $sound_src, $trigger_time, $scroll_height, $repeat_trigger_time,  $script_name)
    {

		$user_id = Auth::id();
		return DB::table('campaign')
            ->where('id', $id)
            ->update([
		    'campaign_name'=>$campaign_name,
		    'campaign_type'=>$campaign_type,
		    'domain_name'=>$domain_name,
		    // 'action_type'=>$action_type,
		    'widget_id'=>$widget_id,

		    // 'language'=>$language,
		    'voice_variation'=>$voice_variation,
		    'sound_niche'=>$sound_niche,
		    'traffic_source'=>$traffic_source,
		    'sound_src'=>$sound_src,
		    // 'text_to_speech'=>$text_to_speech,
			'trigger_time'=>$trigger_time,
			'scroll_height'=>$scroll_height,
			// 'favicon_icon'=>$favicon_url,
			'repeat_trigger_time'=>$repeat_trigger_time,
			// 'back_button_redirect'=>$back_button_redirect,
			// 'vibration_mobile'=>$vibration_mobile,
			'script_name'=>$script_name,
			'updated_by' => $user_id,
			'updated_at' => $this->date,
			'status' => '1'
			]);
    }


    public function campaigntype_name($id)
	{
		return true;
	}

	public function campaign_edit($id)
	{
		return DB::table('campaign')->where('id',$id)->get();
	}
	public function campaign_update($id,$campaign)
    {



		return true;
    }
    public function campaign_delete($id)
	{
		$user_id = Auth::id();
		$campaign = DB::table('campaign')->where('id',$id)->get();
		return DB::table('campaign')
            ->where('id', $id)
            ->update(['status' => '0','updated_at' => $this->date,'updated_by' => $user_id]);
	}
}
