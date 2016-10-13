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
    return view('home');
});
Route::get('/rad',function(){
   return view('rad');
});
Route::get('/',[
    'as'=>'home',
    'uses'=>'Event\EventController@hom'
]);
Route::resource('profile', 'profileController');

Route::get('/rsvp/', [
    'as' => 'rsvp',
    'uses' => 'Event\EventController@rsvp'
]);


Route::get('/email', [
    'as' => 'email',
    'uses' => 'Event\EventController@email'
]);
Route::get('/ticket', [
    'as' => 'ticket',
    'uses' => 'Event\EventController@ticket'
]);
Route::get('/cat/{ca?}', [
    'as' => 'cat',
    'uses' => 'Event\EventController@cat'
]);

Route::get('/upcoming','Event\EventController@upcoming');

Route::get('event',function(){
	return view('eventpage');
});
Route::get('create',function(){
   return view('create');
});
Route::auth();

Route::get('/home', 'HomeController@index');
 Route::post('/search', [
     'as' => 'search',
     'uses' => 'Event\EventController@search'
 ]);
Route::post('/radius',['as' => 'radius', 'uses' => 'Event\EventController@radSearch']);
