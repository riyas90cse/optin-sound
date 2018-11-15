<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;
use Auth;
use App\Http\Requests;
use Carbon\Carbon;

class Overlay extends Model
{
	public function __construct()
    {
		$this->date = Carbon::now('Asia/Kolkata');
    }
    public function overlay_list()
	{
		$user_id = Auth::id();
		return  DB::table('overlay')->where('active','1')->where('created_by',$user_id)->get();
	}
	
    public function overlay_add($overlay_name, $overlay_siteurl, $meta_title, $meta_description,$meta_image,$campaign_name,$campaign_id, $domain_name, $domain_id, $handle, $custom_link, $remarketing_pixels, $active)
    {
		$user_id = Auth::id();
		return $overlay_id = DB::table('overlay')->insertGetId(
		    [
		    'overlay_name'=>$overlay_name,
		    'overlay_siteurl'=>$overlay_siteurl,
		    'meta_title'=>$meta_title,
		    'meta_description'=>$meta_description,
		    'meta_image'=>$meta_image,
		    'campaign_name'=>$campaign_name,
		    'campaign_id'=>$campaign_id,
		    'domain_name'=>$domain_name,
		    'domain_id'=>$domain_id,
		    'handle'=>$handle,
		    'custom_link'=>$custom_link,
			'remarketing_pixels'=>$remarketing_pixels,
			'active'=>$active,
			'created_by' => $user_id,
			'created_at' => $this->date
			]
		);
    }

    public function overlay_ajax_add($overlay_name, $overlay_siteurl, $meta_title, $meta_description,$meta_image,$campaign_name,$campaign_id, $domain_name, $domain_id, $handle, $custom_link, $remarketing_pixels, $active)
    {

		$user_id = Auth::id();
		return $overlay_id = DB::table('overlay')->insertGetId(
		    [
		    'overlay_name'=>$overlay_name,
		    'overlay_siteurl'=>$overlay_siteurl,
		    'meta_title'=>$meta_title,
		    'meta_description'=>$meta_description,
		    'meta_image'=>$meta_image,
		    'campaign_name'=>$campaign_name,
		    'campaign_id'=>$campaign_id,
		    'domain_name'=>$domain_name,
		    'domain_id'=>$domain_id,
		    'handle'=>$handle,
		    'custom_link'=>$custom_link,
			'remarketing_pixels'=>$remarketing_pixels,
			'active'=>$active,
			'created_by' => $user_id,
			'created_at' => $this->date
			]
		);
    }

    public function overlay_ajax_update($id,$overlay_name,$overlay_siteurl,$meta_title, $meta_description,$meta_image,$campaign_name,$campaign_id, $domain_name, $domain_id, $handle, $custom_link, $remarketing_pixels, $active)
    {
		$user_id = Auth::id();
		return DB::table('overlay')
            ->where('id', $id)
            ->update([
		    'overlay_name'=>$overlay_name,
		    'overlay_siteurl'=>$overlay_siteurl,
		    'meta_title'=>$meta_title,
		    'meta_description'=>$meta_description,
		    'meta_image'=>$meta_image,
		    'campaign_name'=>$campaign_name,
		    'campaign_id'=>$campaign_id,
		    'domain_name'=>$domain_name,
		    'domain_id'=>$domain_id,
		    'handle'=>$handle,
		    'custom_link'=>$custom_link,
			'remarketing_pixels'=>$remarketing_pixels,
			'active'=>$active,
			'updated_by' => $user_id,
			'updated_at' => $this->date
			]);
    }


    public function overlaytype_name($id)
	{
		return true;
	}


	public function overlay_edit($id)
	{
		return DB::table('overlay')->where('id',$id)->get();
	}

    public function overlay_delete($id)
	{
		$user_id = Auth::id();
		$overlay = DB::table('overlay')->where('id',$id)->get();
		return DB::table('overlay')
            ->where('id', $id)
            ->update(['active' => '0','updated_at' => $this->date,'updated_by' => $user_id]);
	}

    public function overlay_by_handle($handle)
	{
		return  DB::table('overlay')->where('active','1')->where('handle',$handle)->get();
	}



}
