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

Route::get('/client/login', function(){
	return view('client.login');
});
Route::post('/client/login', 'ClientController@p_login');
Route::get('/client/logout', 'ClientController@getLogout');

Route::controllers([
   'password' => 'Auth\PasswordController',
]);
Route::get('/scanner',function(){
	return view('service_unit.scanner');
});

// Route::get('/client/login', 'ClientController@index');
// Route::post('/client/login', 'ClientController@post_login');
Route::post('/client/register', 'ClientController@store');
Route::get('/client/register', 'ClientController@register');


Route::get('/teller/login', 'TellerController@login');
Route::post('/teller/login', 'TellerController@login');
Route::post('/teller/register', 'TellerController@store');
Route::get('/teller/register', 'TellerController@register');
Route::get('/teller/logout/', 'TellerController@get_logout');


Route::get('/queue', 'QueueController@view_all');


//dashboard 
Route::get('/dashboard', 'TellerController@index');
Route::post('/dashboard', 'QueueController@next_queue');


Route::get('/client/transaction/',function(){
	return view('client.transaction');
});


//page routes
Route::get('/pages/receiving', 'TellerController@page_receiving');
Route::get('/pages/registration', 'TellerController@page_registration');
Route::get('/pages/approving', 'TellerController@page_approving');
Route::get('/pages/photo_and_signature', 'TellerController@page_photo_and_signature');
Route::get('/pages/cashier', 'TellerController@page_cashier');
Route::get('/pages/releasing', 'TellerController@page_releasing');
Route::post('/pages/receiving', 'QueueController@next_queue');
Route::post('/pages/registration', 'QueueController@next_queue');
Route::post('/pages/approving', 'QueueController@next_queue');
Route::post('/pages/photo_and_signature', 'QueueController@next_queue');
Route::post('/pages/cashier', 'QueueController@next_queue');
Route::post('/pages/releasing', 'QueueController@next_queue');

Route::post('/queue/check', 'QueueController@check_queue');
Route::get('/queue/check', 'QueueController@check_queue');

//customer routes
Route::get('/client/index',function(){
	return view('client.index');
});

Route::get('/client/registerLicense',function(){
	return view('client.registerLicense');
});
Route::get('/client/registerLicense','ClientController@rl_view');
Route::post('/client/registerLicense','ClientController@rLicense');
Route::get('/intopdfRL/', 'ClientController@RLtoPDF');

Route::get('/qrcode/', 'ClientController@qrcodeToPDF');
