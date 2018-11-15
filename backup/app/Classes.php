<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;
use Auth;
use App\Http\Requests;
use Carbon\Carbon;

class Classes extends Model
{
	public function __construct()
    {
		$this->date = Carbon::now('Asia/Kolkata');
    }
    public function class_list()
	{
		return DB::table('class')->where('status','1')->get();
	}
    public function class_add($name)
    {
		$user_id = Auth::id();
		return $class_id = DB::table('class')->insertGetId(
		    ['name' => $name, 'created_at' => $this->date,'created_by' => $user_id]
		);
    }
	public function class_edit($id)
	{
		return DB::table('class')->where('id',$id)->get();
	}
	public function class_update($id,$name)
    {
		$user_id = Auth::id();
		return DB::table('class')
            ->where('id', $id)
            ->update(['name' => $name, 'updated_at' => $this->date,'updated_by' => $user_id]);
    }
    public function class_delete($id)
	{
		$user_id = Auth::id();
		$class = DB::table('class')->where('id',$id)->get();
		foreach($class as $value){
			$name = $value->name;
		}
		return DB::table('class')
            ->where('id', $id)
            ->update(['status' => '0','updated_at' => $this->date,'updated_by' => $user_id]);
	}
}
