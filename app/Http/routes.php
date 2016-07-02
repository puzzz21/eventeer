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
    return view('welcome');
});

Route::resource('profile', 'profileController');

//Route::get('create',function(){
//	return view('profileform');
//});

Route::get('event',function(){
	return view('eventpage');
});
Route::auth();

Route::get('/home', 'HomeController@index');
