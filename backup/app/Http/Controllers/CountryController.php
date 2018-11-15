<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Country;

class CountryController extends Controller
{
    public function __construct()
    {
		$this->country = new Country();
    }
    public function index()
    {
		$country = $this->country->country_list();
		$count = $country->count();
		return view('country/list',['country'=>$country,'count'=>$count]);
    }
    public function add()
    {
		return view('country/add');
    }
    public function save(Request $request)
    {
		$country_name = $request->input('country_name');
		$country_code = $request->input('country_code');
		$active = $request->input('active');
		// print_r($request);
		// exit;
		$this->validate($request,[
			'country_name'=>'required',
			'country_code'=>'required',
			'active'=>'required'
		]);
		$result = $this->country->country_add($country_name,$country_code,$active);
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
		$country = $this->country->country_edit($id);
		return view('country/edit',['country'=>$country]);
    }
    public function update(Request $request,$id)
    {
		$country_name = $request->input('country_name');
		$country_code = $request->input('country_code');
		$active = $request->input('active');

		$this->validate($request,[
			'country_name'=>'required',
			'country_code'=>'required',
			'active'=>'required'
		]);

		$result = $this->country->country_update($id,$country_name,$country_code,$active);
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
		$result = $this->country->country_delete($id);
		if($result){
			$request->session()->flash('success', 'Record deleted successfully!');
		}
		else{
			$request->session()->flash('failed', 'Something went wrong!');
		}
		return redirect()->back();
    }
}
