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



//client routes
Route::get('/client/login', 'UnitController@viewTransaction');
Route::post('/client/login', 'ClientController@post_login');

Route::post('/client/register', 'ClientController@store');
Route::get('/client/register', 'ClientController@register');
//teller routes
/*
Route::get('teller/login', 'TellerController@index');
Route::post('teller/login', 'TellerController@post_login');
Route::post('teller/login', 'TellerController@getLogout'); */
//queue routes11


Route::get('/teller/login', 'TellerController@login');
Route::post('/teller/login', 'TellerController@login');

Route::post('/teller/register', 'TellerController@store');
Route::get('/teller/register', 'TellerController@register');

Route::get('/teller/logout/', 'TellerController@get_logout');

//dashboard 
Route::get('/dashboard', 'TellerController@index');
Route::post('/dashboard', 'QueueController@next_queue');
Route::get('/client/transaction/',function(){
	return view('client.transaction');
});
//queue routes11

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

