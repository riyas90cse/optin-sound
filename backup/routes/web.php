<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

// header('Access-Control-Allow-Origin: *');

Route::group(['middleware' => 'auth'], function () {
    //Logout
	Route::get('/logout', function () {
	    Auth::logout();
	    return redirect('/');
	});
	
	//Test
	Route::get('/test','TestController@index');
	
	//Change password
	Route::get('/changepassword','ChangepasswordController@index');
	Route::post('/changepassword','ChangepasswordController@save');
	
	//Edit Profile
	Route::get('/editprofile','EditprofileController@index');
	Route::post('/editprofile','EditprofileController@save');
	
	//Dashboard
	Route::get('/dashboard','WelcomeController@index');



	//Country - List
	Route::get('/country','CountryController@index');
	//Country - create
	Route::get('/country/add','CountryController@add');
	Route::post('/country/save','CountryController@save');
	//Country - update
	Route::get('/country/edit/{id}','CountryController@edit');
	Route::post('/country/update/{id}','CountryController@update');
	//Country - Delete
	Route::get('/country/delete/{id}','CountryController@delete');

	//Domain - List
	Route::get('/domain','DomainController@index');
	//Domain - create
	Route::get('/domain/add','DomainController@add');
	Route::post('/domain/save','DomainController@save');
	//Domain - update
	Route::get('/domain/edit/{id}','DomainController@edit');
	Route::post('/domain/update/{id}','DomainController@update');
	//Domain - Delete
	Route::get('/domain/delete/{id}','DomainController@delete');

	//Language - List
	Route::get('/language','LanguageController@index');
	//Language - create
	Route::get('/language/add','LanguageController@add');
	Route::post('/language/save','LanguageController@save');
	//Language - update
	Route::get('/language/edit/{id}','LanguageController@edit');
	Route::post('/language/update/{id}','LanguageController@update');
	//Language - Delete
	Route::get('/language/delete/{id}','LanguageController@delete');

	//Niche - List
	Route::get('/niche','NicheController@index');
	//Niche - create
	Route::get('/niche/add','NicheController@add');
	Route::post('/niche/save','NicheController@save');
	//Niche - update
	Route::get('/niche/edit/{id}','NicheController@edit');
	Route::post('/niche/update/{id}','NicheController@update');
	//Niche - Delete
	Route::get('/niche/delete/{id}','NicheController@delete');

	//Trafficsource - List
	Route::get('/trafficsource','TrafficsourceController@index');
	//Trafficsource - create
	Route::get('/trafficsource/add','TrafficsourceController@add');
	Route::post('/trafficsource/save','TrafficsourceController@save');
	//Trafficsource - update
	Route::get('/trafficsource/edit/{id}','TrafficsourceController@edit');
	Route::post('/trafficsource/update/{id}','TrafficsourceController@update');
	//Trafficsource - Delete
	Route::get('/trafficsource/delete/{id}','TrafficsourceController@delete');


	//Campaign - List
	Route::get('/campaign','CampaignController@index');
	//Campaign - create
	Route::get('/campaign/create','CampaignController@create');
	Route::get('/campaign/add','CampaignController@add');
	Route::post('/campaign/save','CampaignController@save');
	Route::get('/campaign/ajaxsave','CampaignController@ajaxsave');
	Route::get('/campaign/ajaxupdate','CampaignController@ajaxupdate');
	Route::post('/campaign/uploadimage','CampaignController@uploadimage');
	Route::post('/campaign/uploadsound','CampaignController@uploadsound');
	Route::get('/campaign/savewidget','CampaignController@savewidget');
	//Campaign - update
	Route::get('/campaign/edit/{id}','CampaignController@edit');
	Route::post('/campaign/update/{id}','CampaignController@update');
	//Campaign - Delete
	Route::get('/campaign/delete/{id}','CampaignController@delete');
	
	// Ajax
	Route::get('/t2speech/ajax','CampaignController@amazon_text2speech');


	//Userlevel - List
	Route::get('/userlevel','UserlevelController@index');
	//Userlevel - create
	Route::get('/userlevel/add','UserlevelController@add');
	Route::post('/userlevel/save','UserlevelController@save');
	//Userlevel - update
	Route::get('/userlevel/edit/{id}','UserlevelController@edit');
	Route::post('/userlevel/update/{id}','UserlevelController@update');
	//Userlevel - Delete
	Route::get('/userlevel/delete/{id}','UserlevelController@delete');


	//Userlevel - List
	Route::get('/users','UserController@index');
	//Userlevel - create
	Route::get('/users/create','UserController@create');
	Route::post('/users/save','UserController@save');
	//Userlevel - update
	Route::get('/users/edit/{id}','UserController@edit');
	Route::post('/users/update/{id}','UserController@update');
	//Userlevel - Delete
	Route::get('/users/delete/{id}','UserController@delete');



	//Role - List
	Route::get('/role','RoleController@index');
	//Role - create
	Route::get('/role/add','RoleController@add');
	Route::post('/role/save','RoleController@save');
	//Role - update
	Route::get('/role/edit/{id}','RoleController@edit');
	Route::post('/role/update/{id}','RoleController@update');
	//Role - Delete
	Route::get('/role/delete/{id}','RoleController@delete');


	//Classes - List
	Route::get('/membertype','MembertypeController@index');
	//Classes - create
	Route::get('/membertype/add','MembertypeController@add');
	Route::post('/membertype/save','MembertypeController@save');
	//Classes - update
	Route::get('/membertype/edit/{id}','MembertypeController@edit');
	Route::post('/membertype/update/{id}','MembertypeController@update');
	//Classes - Delete
	Route::get('/membertype/delete/{id}','MembertypeController@delete');


	//Classes - List
	Route::get('/donesound','DoneSoundController@index');
	//Classes - create
	Route::get('/donesound/add','DoneSoundController@add');
	Route::post('/donesound/save','DoneSoundController@save');
	//Classes - update
	Route::get('/donesound/edit/{id}','DoneSoundController@edit');
	Route::post('/donesound/update/{id}','DoneSoundController@update');
	//Classes - Delete
	Route::get('/donesound/delete/{id}','DoneSoundController@delete');


//UploadSound
//	Route::get('/donesound','DoneSoundController@index');
//	Route::post('/donesound','DoneSoundController@showUploadFile');


	Route::get('/integration','IntegrationController@index');
	Route::get('/integration/getlist','IntegrationController@aweberlist_ajax');
	Route::get('/integration/savelist','IntegrationController@aweberlistsave_ajax');
	Route::get('/integration/savezapier','IntegrationController@savezapier_ajax');
	Route::get('/aweberauth','IntegrationController@aweber');


	Route::get('/records','ReportController@index');
	Route::post('/records','ReportController@search');



	Route::get('/apiintegraion/add','IntegrationController@inte');
	Route::post('/apiintegraion/upload','IntegrationController@uploadimage');

	
});
Route::get('/uploadfile','UploadFileController@index');
Route::post('/uploadfile','UploadFileController@showUploadFile');

Route::get('/', function () {
	if(Auth::check()){
		// return view('welcome');
		 return redirect()->action('WelcomeController@index');
	}
	else{
		// return view('login');
		return redirect()->action('LoginController@index');
	}
});

//Login
Route::get('/login','LoginController@index');
Route::post('/login','LoginController@login');

Route::get('/testing','ReportController@listall')->middleware('cors');
// Route::post('/optin','ReportController@save')->middleware('cors');
// Route::get('/optin','ReportController@store')->middleware('cors');


Route::get('/optin', ['middleware' => 'cors',function(){

	return ['status'=>'success'];
}]);

// custom url 
// Route::get('{category}/{title}',['uses' => 'IntegrationController@inte']);



// exit;
// Route::group(array('domain' => '{subdomain}.convertsound.com'), function () {
 
//     Route::get('/', function ($subdomain) {
 
//         $name = DB::table('users')->where('name', $subdomain)->get();
 
//         dd($name);
 
//     });
// });
