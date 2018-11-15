<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Domain;

class DomainController extends Controller
{
    public function __construct()
    {
		$this->domain = new Domain();
    }
    public function index()
    {
		$domain = $this->domain->domain_list();
		$count = $this->domain->count();
		return view('domain/list',['domain'=>$domain,'count'=>$count]);
    }
    public function add()
    {
    	$domain=$this->domain->domain_list();
		return view('domain/add',['domain'=>$domain,]);
    }
    public function save(Request $request)
    {
		$domain_name = $request->input('domain_name');
		$parent_domain = $request->input('parent_domain');
		$this->validate($request,[
			'domain_name'=>'required'
		]);
		$result = $this->domain->domain_add($domain_name,$parent_domain);
		if($result){
			$request->session()->flash('Success', 'Record added successfully!');
		}
		else{
			$request->session()->flash('Failed', 'Something went wrong!');
		}
		
		// $domain = $this->domain->domain_list();
		// $count = $this->domain->count();
		return redirect()->action('DomainController@index');

    }
    public function edit($id)
    {

		$domain = $this->domain->domain_edit($id);
		return view('domain/edit',['domain'=>$domain]);
    }
    public function update(Request $request,$id)
    {

		$domain_name = $request->input('domain_name');
		$parent_domain = $request->input('parent_domain');
		$this->validate($request,[
			'domain_name'=>'required'		]);
		$result = $this->domain->domain_update($id,$domain_name,$parent_domain);
		if($result){
			$request->session()->flash('Success', 'Record added successfully!');
		}
		else{
			$request->session()->flash('Failed', 'Something went wrong!');
		}
		return redirect('domain');
    }
    public function delete(Request $request,$id)
    {
		$result = $this->domain->domain_delete($id);
		if($result){
			$request->session()->flash('success', 'Record deleted successfully!');
		}
		else{
			$request->session()->flash('failed', 'Something went wrong!');
		}
		return redirect()->back();
    }
}
