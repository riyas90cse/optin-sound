<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Language;

class LanguageController extends Controller
{
    public function __construct()
    {
		$this->language = new Language();
    }
    public function index()
    {
		$language = $this->language->language_list();
		$count = $language->count();
		return view('language/list',['language'=>$language,'count'=>$count]);
    }
    public function add()
    {
		return view('language/add');
    }
    public function save(Request $request)
    {
		$language_name = $request->input('language_name');
		$language_code = $request->input('language_code');
		$active = $request->input('active');
		// print_r($request);
		// exit;
		$this->validate($request,[
			'language_name'=>'required',
			'language_code'=>'required',
			'active'=>'required'
		]);
		$result = $this->language->language_add($language_name,$language_code,$active);
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
		$language = $this->language->language_edit($id);
		return view('language/edit',['language'=>$language]);
    }
    public function update(Request $request,$id)
    {
		$language_name = $request->input('language_name');
		$language_code = $request->input('language_code');
		$active = $request->input('active');

		$this->validate($request,[
			'language_name'=>'required',
			'language_code'=>'required',
			'active'=>'required'
		]);

		$result = $this->language->language_update($id,$language_name,$language_code,$active);
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
		$result = $this->language->language_delete($id);
		if($result){
			$request->session()->flash('success', 'Record deleted successfully!');
		}
		else{
			$request->session()->flash('failed', 'Something went wrong!');
		}
		return redirect()->back();
    }
}
