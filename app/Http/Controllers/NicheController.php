<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Niche;
use App\Userlevel;

class NicheController extends Controller
{
    public function __construct()
    {
		$this->niche = new Niche();
		$this->userlevel = new Userlevel();
    }
    public function index()
    {
		$niche = $this->niche->niche_list();
		$count = $this->niche->count();
    	$userlevel=$this->userlevel->userlevel_list();
		return view('niche/list',['niche'=>$niche,'count'=>$count,'userlevel'=>$userlevel]);
    }
    public function add()
    {
    	$niche=$this->niche->niche_list();
    	$userlevel=$this->userlevel->userlevel_list();
		return view('niche/add',['niche'=>$niche,'userlevel'=>$userlevel]);
    }
    public function save(Request $request)
    {
		$niche_category = $request->input('niche_category');
		$userlevel = $request->input('user_level');
		$active = $request->input('active');
		$this->validate($request,[
			'niche_category'=>'required',
			'active'=>'required'
		]);
		$result = $this->niche->niche_add($niche_category,$userlevel,$active);
		if($result){
			$request->session()->flash('Success', 'Record added successfully!');
		}
		else{
			$request->session()->flash('Failed', 'Something went wrong!');
		}
		
		$niche = $this->niche->niche_list();
		$count = $this->niche->count();
		return redirect()->action('NicheController@index');

    }
    public function edit($id)
    {

		$niche = $this->niche->niche_edit($id);
		$userlevel=$this->userlevel->userlevel_list();
		return view('niche/edit',['niche'=>$niche,'userlevel'=>$userlevel]);
    }
    public function update(Request $request,$id)
    {

		$niche_category = $request->input('niche_category');
		$userlevel = $request->input('user_level');
		$active = $request->input('active');
		$this->validate($request,[
			'niche_category'=>'required',
			'active'=>'required'
		]);
		$result = $this->niche->niche_update($id,$niche_category,$userlevel,$active);
		if($result){
			$request->session()->flash('Success', 'Record added successfully!');
		}
		else{
			$request->session()->flash('Failed', 'Something went wrong!');
		}
		return redirect()->back();
    }
    public function delete(Request $request,$id)
    {
		$result = $this->niche->niche_delete($id);
		if($result){
			$request->session()->flash('success', 'Record deleted successfully!');
		}
		else{
			$request->session()->flash('failed', 'Something went wrong!');
		}
		return redirect()->back();
    }
}
