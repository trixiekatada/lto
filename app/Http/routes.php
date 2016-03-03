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
Route::get('/client/login', 'ClientController@index');
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

Route::get('/teller/logout', 'TellerController@get_logout');

//dashboard 
Route::get('/dashboard', 'TellerController@index');
Route::post('/dashboard', 'QueueController@next_queue');
Route::get('/client/transaction/',function(){
	return view('client.transaction');
});
//queue routes11



