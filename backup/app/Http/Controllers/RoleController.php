<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Role;

class RoleController extends Controller
{
    public function __construct()
    {
		$this->role = new Role();
    }
    public function index()
    {
		$role = $this->role->role_list();
		$count = $role->count();
		return view('role/list',['role'=>$role,'count'=>$count]);
    }
    public function add()
    {
		return view('role/add');
    }
    public function save(Request $request)
    {
		$name = $request->input('name');
		$min = $request->input('min');
		$max = $request->input('max');
		$this->validate($request,[
			'name'=>'required',
			'max'=>'required'
		]);
		$result = $this->role->role_add($name,$min,$max);
		if($result){
			$request->session()->flash('success', 'Record added successfully!');
		}
		else{
			$request->session()->flash('failed', 'Something went wrong!');
		}
		return redirect()->back();
    }
    public function edit($id)
    {
		$role = $this->role->role_edit($id);
		return view('role/edit',['role'=>$role]);
    }
    public function update(Request $request,$id)
    {
		$name = $request->input('name');
		$min = $request->input('min');
		$max = $request->input('max');
		$this->validate($request,[
			'name'=>'required',
			'max'=>'required'
		]);
		$result = $this->role->role_update($id,$name,$min,$max);
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
		$result = $this->role->role_delete($id);
		if($result){
			$request->session()->flash('success', 'Record deleted successfully!');
		}
		else{
			$request->session()->flash('failed', 'Something went wrong!');
		}
		return redirect()->back();
    }
}
