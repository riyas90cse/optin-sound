<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Trafficsource;

class TrafficsourceController extends Controller
{
    public function __construct()
    {
		$this->trafficsource = new Trafficsource();
    }
    public function index()
    {
		$trafficsource = $this->trafficsource->trafficsource_list();
		$count = $trafficsource->count();
		return view('trafficsource/list',['trafficsource'=>$trafficsource,'count'=>$count]);
    }
    public function add()
    {
		return view('trafficsource/add');
    }
    public function save(Request $request)
    {
		$sourcename = $request->input('sourcename');
		$active = $request->input('active');
		$this->validate($request,[
			'sourcename'=>'required',
			'active'=>'required'
		]);
		$result = $this->trafficsource->trafficsource_add($sourcename,$active);
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
		$trafficsource = $this->trafficsource->trafficsource_edit($id);
		return view('trafficsource/edit',['trafficsource'=>$trafficsource]);
    }
    public function update(Request $request,$id)
    {

		$sourcename = $request->input('sourcename');
		$active = $request->input('active');
		$this->validate($request,[
			'sourcename'=>'required',
			'active'=>'required'
		]);

		$result = $this->trafficsource->trafficsource_update($id, $sourcename, $active);
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
		$result = $this->trafficsource->trafficsource_delete($id);
		if($result){
			$request->session()->flash('success', 'Record deleted successfully!');
		}
		else{
			$request->session()->flash('failed', 'Something went wrong!');
		}
		return redirect()->back();
    }
}
