<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
// use App\Mail\SendUserDetails;
use Illuminate\Support\Facades\Mail;

class UserController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$users = User::withTrashed()->where('user_id',Auth::id())->get();
        if(Auth::user()->isLevel1())
        {
            $users = DB::table('users')->where('id',Auth::id())->get();
        }
        else if(Auth::user()->isLevel2())
        {
            $users = DB::table('users')->where('id',Auth::id())->get();
        }
        else if(Auth::user()->isLevel3())
        {
            $users = DB::table('users')->where('id',Auth::id())->get();
        }
        else if(Auth::user()->isLevel4())
        {
            $users = DB::table('users')->where('created_by',Auth::id())->get();
        }
        else if(Auth::user()->isLevel5())
        {
            $users = DB::table('users')->where('created_by',Auth::id())->get();
        }
        else if(Auth::user()->isRoot())
        {
            $users = DB::table('users')->where('created_by',Auth::id())->get();
        }
        else
        {
            return "page not found";
            // $users = User::withTrashed()->get();
        }

        return view('users.list', ['users' => $users]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('users.create');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function save(Request $request)
    {

        $name = $request->input('name');
        $email = $request->input('email');
        $password = $request->input('password');
        $userlevel = $request->input('userlevel');
        $this->validate($request,[
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);

        $user = new User();

        if(Auth::user()->isLevel4())
        {
            // count if can add more
            $users_count = DB::table('users')->where('created_by',Auth::id())->get();

            if($users_count > 100)
            {
                return "cannot add more";
            }

            $user->user_id = Auth::id();
        }

        if(Auth::user()->isLevel5())
        {
            // count if can add more
            $users_count = DB::table('users')->where('created_by',Auth::id())->get();

            if($users_count > 250)
            {
                return "cannot add more";
            }

            $user->user_id = Auth::id();
        }

        $password = bcrypt($password);
        $user->addUser($userlevel,$name,$email,$password);
        // // send mail
        // $user_new['name'] = $request->name;;
        // $user_new['email'] = $request->email;
        // $user_new['password'] = $request->password;

        // $email = new SendUserDetails($user_new);
        // Mail::to($user_new['email'])->queue($email);

        return redirect()->action('UserController@index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = User::find($id);
        if($request->name) {
            $user->name = $request->name;
        }
        if($request->active) {
            $user->active = $request->active;
        }
        if($request->role) {
            DB::table('limits')->where('user_id', $user->id)->delete();
            DB::table('role_user')->where('user_id', $user->id)->delete();
            $user->attachRole($request->role);

            if($request->role == "Basic"){
                $limit = new limits();
                $limit->domains = 10;
                $limit->presets = 10;
                $limit->user_id = $user->id;
                $limit->save();
            }
            else if($request->role == "Pro") {
                $limit = new limits();
                $limit->domains = 10;
                $limit->presets = 100;
                $limit->brochures = 100;
                $limit->magazines = 100;
                $limit->catalogues = 100;
                $limit->user_id = $user->id;
                $limit->save();
            }
            else if ($request->role == "Extreme") {
                $limit = new limits();
                $limit->domains = -1;
                $limit->presets = -1;
                $limit->brochures = -1;
                $limit->magazines = -1;
                $limit->catalogues = -1;
                $limit->user_id = $user->id;
                $limit->save();
            }
            else if ($request->role == "Developer100") {
                $limit = new limits();
                $limit->domains = -1;
                $limit->presets = -1;
                $limit->brochures = -1;
                $limit->magazines = -1;
                $limit->catalogues = -1;
                $limit->users = 100;
                $limit->user_id = $user->id;
                $limit->save();
            }
            else if ($request->role == "Developer250") {
                $limit = new limits();
                $limit->domains = -1;
                $limit->presets = -1;
                $limit->brochures = -1;
                $limit->magazines = -1;
                $limit->catalogues = -1;
                $limit->users = 250;
                $limit->user_id = $user->id;
                $limit->save();
            }
            else if ($request->role == "Developer500") {
                $limit = new limits();
                $limit->domains = -1;
                $limit->presets = -1;
                $limit->brochures = -1;
                $limit->magazines = -1;
                $limit->catalogues = -1;
                $limit->users = 500;
                $limit->user_id = $user->id;
                $limit->save();
            }
        }
        if($request->user_id) {
            $user->user_id = $request->user_id;
        }
        if ($user->save()) {
            return redirect()->action('UserController@index');
        }
    }

    public function reset(Request $request, $id)
    {
        $user = User::find($id);
        // $user = DB::table('users')->where('id',$id)->first();
        if($user) {
            $user->password = bcrypt($request->password);

            // DB::table('users')->where('id',$id)->update([
            //     'password'  => bcrypt($request->password)
            // ]);

            // return redirect()->action('UserController@index');
        }
        // else{
        //     return "unable to change password";
        // }
        if ($user->save()) {
            return redirect()->action('UserController@index');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::destroy($id);
        return redirect()->action('UserController@index');
    }

    /**
     * Restore the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function reinstate($id)
    {
        $user = User::withTrashed()->find($id);
        $user->restore();
        return redirect()->action('UserController@index');
    }

    public function delete($id) {
        $user = User::withTrashed()->find($id);
        $user->forceDelete();
        return redirect()->action('UserController@index');
    }
}
