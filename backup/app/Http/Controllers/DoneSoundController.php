<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\DoneSound;
use App\Niche;
use App\Userlevel;
use App\Trafficsource;
use App\Language;

class DoneSoundController extends Controller {
   
   public function __construct()
   {
      $this->soundniche = new DoneSound();
      $this->niche = new Niche();
      $this->userlevel = new Userlevel();
      $this->trafficsource = new Trafficsource();
      $this->language = new Language();
   }

   public function index(){
      $soundniche = $this->soundniche->soundniche_list();
      $count = $this->soundniche->count();
      $niche=$this->niche->niche_list();
      $trafficsource=$this->trafficsource->trafficsource_list();
      $language=$this->language->language_list();
      return view('donesound/list',['soundniche'=>$soundniche,'count'=>$count,'niche'=>$niche,'trafficsource'=>$trafficsource,'language'=>$language]);


      return view('uploadfile');
   }

   public function add()
   {
      $soundniche=$this->soundniche->soundniche_list();
      // $userlevel=$this->userlevel->userlevel_list();
      $niche=$this->niche->niche_list();
      $trafficsource=$this->trafficsource->trafficsource_list();
      $language=$this->language->language_list();
      return view('  donesound/add',['soundniche'=>$soundniche, 'niche'=>$niche,'trafficsource'=>$trafficsource,'language'=>$language]);
   }

   public function save(Request $request)
   {
      
      $soundname = $request->input('soundname');
      $niche_category = $request->input('niche_category');
      $trafficsource = $request->input('trafficsource');
      $language = $request->input('language');
      $variation = $request->input('variation');
      $sound_text = $request->input('sound_text');
      $file = $request->file('filename');
   

      $active = $request->input('active');
      $this->validate($request,[
         'soundname'=>'required',
         'niche_category'=>'required',
         'trafficsource'=>'required',
         'language'=>'required',
         'variation'=>'required',
         'filename' => 'required',
         'filename.*' => 'required|mimes:mp3,wav',
         'active'=>'required'
      ]);
/*   
      //Display File Name
      echo 'File Name: '.$file->getClientOriginalName();
      //Display File Extension
      echo 'File Extension: '.$file->getClientOriginalExtension();
   
      //Display File Real Path
      echo 'File Real Path: '.$file->getRealPath();
      //Display File Size
      echo 'File Size: '.$file->getSize();   
      //Display File Mime Type
      echo 'File Mime Type: '.$file->getMimeType();
   
*/
      //Move Uploaded File
      $file = $request->file('filename');
      // print_r($file);
      $filename=rand(1000000000,9999999999);
      $ext=$file->getClientOriginalExtension();
      $destinationPath = 'uploads';
      $full_filename=$filename.'.'.$ext;
      $sound_url=$destinationPath.'/'.$full_filename;
      $file->move($destinationPath,$full_filename);

      $result = $this->soundniche->soundniche_add($soundname, $niche_category, $trafficsource,$language,$variation,$sound_text,$sound_url,$active);
      if($result){
         $request->session()->flash('Success', 'Record added successfully!');
      }
      else{
         $request->session()->flash('Failed', 'Something went wrong!');
      }
      return redirect()->back();

      // return redirect()->action('NicheController@index');
      // return back()->with('success', 'Your files has been successfully added');

   }

   public function edit($id)
   {
      $soundniche=$this->soundniche->soundniche_edit($id);
      // $userlevel=$this->userlevel->userlevel_list();
      $niche=$this->niche->niche_list();
      $trafficsource=$this->trafficsource->trafficsource_list();
      $language=$this->language->language_list();
      return view('  donesound/edit',['soundniche'=>$soundniche, 'niche'=>$niche,'trafficsource'=>$trafficsource,'language'=>$language]);
   }

   public function update(Request $request,$id)
   {
      

      $soundname = $request->input('soundname');
      $niche_category = $request->input('niche_category');
      $trafficsource = $request->input('trafficsource');
      $language = $request->input('language');
      $variation = $request->input('variation');
      $sound_text = $request->input('sound_text');
      $file = $request->file('filename');
      $hidden_file = $request->input('hidden_filename');
      $active = $request->input('active');

      if($file){
         $this->validate($request,[
            'soundname'=>'required',
            'niche_category'=>'required',
            'trafficsource'=>'required',
            'language'=>'required',
            'variation'=>'required',
            'filename' => 'required',
            'filename.*' => 'required|mimes:mp3,wav',
            'active'=>'required'
         ]);      
      }
      else{


         $this->validate($request,[
            'soundname'=>'required',
            'niche_category'=>'required',
            'trafficsource'=>'required',
            'language'=>'required',
            'variation'=>'required',
            'active'=>'required'
         ]);      

      }

if($file){
      //Move Uploaded File
      $file = $request->file('filename');
      $filename=rand(1000000000,9999999999);
      $ext=$file->getClientOriginalExtension();
      $destinationPath = 'uploads';
      $full_filename=$filename.'.'.$ext;
      $sound_url=$destinationPath.'/'.$full_filename;
      $file->move($destinationPath,$full_filename);

}
else{
      $sound_url=$hidden_file;
}
// echo $sound_url;
// print_r($file);

// exit;

      $result = $this->soundniche->soundniche_update($id,$soundname, $niche_category, $trafficsource,$language,$variation,$sound_text,$sound_url,$active);
      if($result){
         $request->session()->flash('Success', 'Record added successfully!');
      }
      else{
         $request->session()->flash('Failed', 'Something went wrong!');
      }
      return redirect()->back();

      // return redirect()->action('NicheController@index');
      // return back()->with('success', 'Your files has been successfully added');

   }

    public function delete(Request $request,$id)
    {
      $result = $this->soundniche->soundniche_delete($id);
      if($result){
         $request->session()->flash('success', 'Record deleted successfully!');
      }
      else{
         $request->session()->flash('failed', 'Something went wrong!');
      }
      return redirect()->back();
    }

   public function showUploadFile(Request $request){
	   	$this->validate($request, [
			'filename' => 'required',
			'filename.*' => 'mimes: mp3,wav'
		]);
      $file = $request->file('filename');
   
      //Display File Name
      echo 'File Name: '.$file->getClientOriginalName();
      echo '<br>';
   
      //Display File Extension
      echo 'File Extension: '.$file->getClientOriginalExtension();
      echo '<br>';
   
      //Display File Real Path
      echo 'File Real Path: '.$file->getRealPath();
      echo '<br>';
   
      //Display File Size
      echo 'File Size: '.$file->getSize();
      echo '<br>';
   
      //Display File Mime Type
      echo 'File Mime Type: '.$file->getMimeType();
   
      //Move Uploaded File
      $destinationPath = 'uploads';
      $file->move($destinationPath,$file->getClientOriginalName());
      return back()->with('success', 'Your files has been successfully added');
   }
}