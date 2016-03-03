<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/



Route::get('/', function () {
    return view('user.index');
});	


Route::get('ecodryer', function () {
    return view('pages.site.main');
});


//Register Vehicle
Route::get('/registerV', 'UserController@vehicleRegisterView');
Route::post('/registerV', 'UserController@registerVehicle');
//Route::get('/registerV', 'UserController@userlist');
//Register License
Route::get('/registerL', 'UserController@licenseRegisterView');
Route::post('/registerL', 'UserController@registerLicense');

// Route::get('/qrCode', 'UserController@generateQR');
// Route::get('/test','UserController@doSession');
// Route::get('/test1','UserController@getSession');

Route::group(['middleware' => 'auth'], function () {
    
    Route::get('/home', function () {
    return view('pages.homie');
		});
       	
	Route::get('/about', function () {
	    return view('pages.about');
	});	

	Route::get('/viewQueue', function () {
	    return view('pages.viewQueue');
	});

	Route::get('/intopdfRV', 'userController@RVtoPDF');

	Route::get('/intopdfRL', 'userController@RLtoPDF');

});


// Route::get('/login', 'UserController@showLogin');
// Route::post('/login', 'UserController@doLogin');
Route::get('auth/login', ['as'=>'login', 'uses'=>'Auth\AuthController@getLogin']);
Route::post('auth/login', 'Auth\AuthController@postLogin');
Route::get('auth/logout', 'Auth\AuthController@getLogout');

Route::get('auth/register', ['as'=>'register', 'uses'=>'Auth\AuthController@getRegister']);
Route::post('auth/register', 'Auth\AuthController@postRegister');

Route::controllers([
   'password' => 'Auth\PasswordController',
]);

