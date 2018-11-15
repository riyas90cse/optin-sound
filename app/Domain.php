<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;
use Auth;
use App\Http\Requests;
use Carbon\Carbon;

class Domain extends Model
{
	public function __construct()
    {
		$this->date = Carbon::now('Asia/Kolkata');
    }

    public function domain_list()
	{
		$user_id = Auth::id();
		return DB::table('domain')->where('status','1')->where('created_by',$user_id)->get();
	}

    public function domain_add($domain_name,$parent_domain)
    {
		$user_id = Auth::id();
		return $country_id = DB::table('domain')->insertGetId(
		    [
		    'domain_name'=>$domain_name,
		    'parent_domain'=>$parent_domain,
		    'created_by'=>$user_id,
			'created_at' => $this->date,

			]
		);
    }

	public function domain_edit($id)
	{
		return DB::table('domain')->where('id',$id)->get();
	}

	public function domain_update($id,$domain_name,$parent_domain)
    {
		$user_id = Auth::id();
		return DB::table('domain')
            ->where('id', $id)
            ->update([
				    'domain_name'=>$domain_name,
					'parent_domain'=>$parent_domain,
					'updated_at' => $this->date
            		]);
    }

    public function domain_delete($id)
	{
		return DB::table('domain')
            ->where('id', $id)
            ->update(['status' => '0','deleted_at' => $this->date]);
	}
    public function count()
	{
		return DB::table('domain')->groupBy('id')->count();
	}



}
