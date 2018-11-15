<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;
use Auth;
use App\Http\Requests;
use Carbon\Carbon;

class Role extends Model
{
	public function __construct()
    {
		$this->date = Carbon::now('Asia/Kolkata');
    }
    public function role_list()
	{
		return DB::table('role')->where('status','1')->get();
	}
    public function role_add($name,$min,$max)
    {
		$user_id = Auth::id();
		return $role_id = DB::table('role')->insertGetId(
		    ['name' => $name,'min'=>$min,'max'=>$max, 'created_at' => $this->date,'created_by' => $user_id]
		);
    }
	public function role_edit($id)
	{
		return DB::table('role')->where('id',$id)->get();
	}
	public function role_update($id,$name,$min,$max)
    {
		$user_id = Auth::id();
		return DB::table('role')
            ->where('id', $id)
            ->update(['name' => $name,'min'=>$min,'max'=>$max, 'updated_at' => $this->date,'updated_by' => $user_id]);
    }
    public function role_delete($id)
	{
		$user_id = Auth::id();
		$role = DB::table('role')->where('id',$id)->get();
		foreach($role as $value){
			$name = $value->name;
		}
		return DB::table('role')
            ->where('id', $id)
            ->update(['status' => '0','updated_at' => $this->date,'updated_by' => $user_id]);
	}
}
