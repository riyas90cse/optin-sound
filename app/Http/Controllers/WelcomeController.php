<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Welcome;

class WelcomeController extends Controller
{
    public function __construct()
    {
		$this->dashboard = new Welcome();
    }
    public function index()
    {
		$user = Auth::user();
		$user_id = $user->id;
		$user_name = $user->name;
		
		return view('welcome');
    }
}
