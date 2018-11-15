<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Userlevel;

class UserlevelController extends Controller
{
    public function __construct()
    {
		$this->userlevel = new Userlevel();
    }
    public function index()
    {
		$userlevel = $this->userlevel->userlevel_list();
		$count = $userlevel->count();
		return view('userlevel/list',['userlevel'=>$userlevel,'count'=>$count]);
    }
    public function add()
    {
		return view('userlevel/add');
    }
    public function save(Request $request)
    {
		$userlevel_name = $request->input('level');
		$active = $request->input('active');
		$this->validate($request,[
			'level'=>'required',
			'active'=>'required'
		]);
		$result = $this->userlevel->userlevel_add($userlevel_name,$active);
		if($result){
			$request->session()->flash('Success', 'Record added successfully!');
		}
		else{
			$request->session()->flash('Failed', 'Something went wrong!');
		}
		return redirect()->back();
    }
    public function edit($id)
    {
		$userlevel = $this->userlevel->userlevel_edit($id);
		return view('userlevel/edit',['userlevel'=>$userlevel]);
    }
    public function update(Request $request,$id)
    {
		$userlevel_name = $request->input('level');
		
		$active = $request->input('active');

		$this->validate($request,[
			'level'=>'required',
			'active'=>'required'
		]);

		$result = $this->userlevel->userlevel_update($id,$userlevel_name,$active);
		if($result){
			$request->session()->flash('success', 'Record updated successfully!');
		}
		else{
			$request->session()->flash('failed', 'Something went wrong!');
		}
		return redirect()->back();
    }
    public function delete(Request $request,$id)
    {
		$result = $this->userlevel->userlevel_delete($id);
		if($result){
			$request->session()->flash('success', 'Record deleted successfully!');
		}
		else{
			$request->session()->flash('failed', 'Something went wrong!');
		}
		return redirect()->back();
    }
}
