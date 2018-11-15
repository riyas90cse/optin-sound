<?php

namespace App;

use DB;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Auth;
use App\Http\Requests;
use Carbon\Carbon;


class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'email_token', 'domains', 'user_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function __construct()
    {
        $this->date = Carbon::now('Asia/Kolkata');
    }

    public function count_domains()
    {
        $data = DB::table('domain')->where('user_id',$this->id)->count();
        return $data;
    }

    public function domains()
    {
        return $this->hasMany('App\Domain');
    }

    // public function limits()
    // {
    //     return $this->hasMany('App\limits');
    // }


    public function isLevel1()
    {
        // $data = DB::table('role_user')->where('user_id',$this->id)->first();

        $level = 1;
        $data = DB::table('users')->where('id',$this->id)->where('userlevel',$level)->first();
        if($data){
            return true;
        }
        
        return false;
    }

    public function isLevel2()
    {
        $level = 2;
        $data = DB::table('users')->where('id',$this->id)->where('userlevel',$level)->first();
        if($data){
            return true;
        }
        
        return false;
    }

    public function isLevel3()
    {
        $level = 3;
        $data = DB::table('users')->where('id',$this->id)->where('userlevel',$level)->first();
        if($data){
            return true;
        }
        
        return false;
    }

    public function isLevel4()
    {
        $level = 4;
        $data = DB::table('users')->where('id',$this->id)->where('userlevel',$level)->first();
        if($data){
            return true;
        }
        
        return false;
    }

    public function isLevel5()
    {
        $level = 5;
        $data = DB::table('users')->where('id',$this->id)->where('userlevel',$level)->first();
        if($data){
            return true;
        }
        
        return false;
    }

    public function isRoot()
    {
        $level = 10;
        $data = DB::table('users')->where('id',$this->id)->where('userlevel',$level)->first();
        if($data){
            return true;
        }
        
        return false;
    }

    public function devAccounts()
    {
        return DB::table('users')->where('created_by',$this->id)->count();
    }

    public function hasRole($id){

        // $level = DB::table('users')->select('userlevel')->where('id', '=', $id)->get();

        // return $level;
        $userdetails=DB::table('users')->where('id', '=', $id)->get();
        $level= $userdetails[0]->userlevel;
        $userlevel=DB::table('userlevel')->where('id', '=', $level)->get();
        if($level==10)
        {
            return 'Super Admin'; 
        }
        else 
        {
            return $userlevel[0]->level;
        }
    }

    public function addUser($userlevel,$name,$email,$password){

        $user_id = Auth::id();
        return $id = DB::table('users')->insertGetId(
            [
            'user_group'=>3,
            'userlevel'=>$userlevel,
            'name'=>$name,
            'email'=>$email,
            'password'=>$password,
            'created_by' => $user_id,
            'created_at' => $this->date,
            'status' => '1'
            ]
        );
    }

    public function userExist($email)
    {
        $data = DB::table('users')->where('email',$email)->get();
        if($data){
            return true;
        }
        return false;
    }    

}
