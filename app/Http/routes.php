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
Route::get('/registerV', 'UserController@userlist');
//Register License
Route::get('/registerL', 'UserController@licenseRegisterView');
Route::post('/registerL', 'UserController@registerLicense');

Route::get('/qrCode', 'TellerController@generateQRCode');

Route::get('/test','UserController@getSession');

   
Route::get('/tellerindex', function () {
	return view('pages.tellerindex');
});


//client routes
Route::get('client/login', 'ClientController@index');
Route::post('client/login', 'ClientController@post_login');

//teller routes
/*
Route::get('teller/login', 'TellerController@index');
Route::post('teller/login', 'TellerController@post_login');
Route::post('teller/login', 'TellerController@getLogout'); */
//queue routes11
Route::post('queue/change', 'QueueController@change_teller');

Route::get('/teller/login', 'TellerController@index');
Route::post('/teller/login', 'TellerController@login');

Route::post('/teller/register', 'TellerController@store');
Route::get('/teller/register', 'TellerController@register');

Route::get('/teller/logout', 'TellerController@get_logout');

//dashboard 
Route::get('/dashboard', 'TellerController@index');
Route::post('/dashboard', 'QueueController@next_queue');

//queue routes11



/*
Route::get('/auth/login', ['as'=>'login', 'uses'=>'Auth\AuthController@getLogin']);
Route::post('/auth/login', 'Auth\AuthController@postLogin');
Route::get('/auth/logout', 'Auth\AuthController@getLogout');
Route::post('/auth/login', 'TellerController@login');
*/

/*
Route::get('/auth/register', ['as'=>'register', 'uses'=>'Auth\AuthController@getRegister']);
Route::post('/auth/register', 'Auth\AuthController@postRegister');
Route::post('/auth/register', 'TellerController@store');
Route::get('/auth/register', 'TellerController@index');
*/

Route::controllers([
   'password' => 'Auth\PasswordController',
]);


Route::get('/pages/approving', function()
{
	return View::make('pages.approving');
});
Route::get('/pages/approving','TellerController@apProcess');
Route::post('/pages/approving','TellerController@aProcess');


Route::get('/pages/receiving', function()
{
	return View::make('pages.receiving');
});
Route::get('/pages/receiving','TellerController@reProcess');
Route::post('/pages/receiving','TellerController@rProcess');

Route::get('/pages/cashier', function()
{
	return View::make('pages.cashier');
});
Route::get('/pages/cashier','TellerController@caProcess');
Route::post('/pages/cashier','TellerController@cProcess');

Route::get('/pages/photosignature', function()
{
	return View::make('pages.photosignature');
});
Route::get('/pages/photosignature','TellerController@phProcess');
Route::post('/pages/photosignature','TellerController@pProcess');


Route::get('/pages/registration', function()
{
	return View::make('pages.registration');
});
Route::get('/pages/registration','TellerController@validationProcess');
Route::post('/pages/registration','TellerController@valProcess');
