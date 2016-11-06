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

Route::get(
    '/',
    function () {
        return view('home');
    }
);

Route::get(
    '/',
    [
        'as'   => 'home',
        'uses' => 'Event\EventController@hom'
    ]
);
Route::get('profile', 'userController@profile');
Route::post(
    '/avatar',
    [
        'as'   => 'avatar',
        'uses' => 'userController@updateAvatar'
    ]
);
Route::post('/profileUpdate', ['as' => 'profileUpdate', 'uses' => 'userController@profileUpdate']);
Route::post('/password', ['as' => 'password', 'uses' => 'userController@password']);
$router->get(
    '/reset-password',
    [
        'as'   => 'reset.password',
        'uses' => 'userController@resetPassword'
    ]
);

$router->get(
    '/contacts',
    [
        'as'   => 'contacts',
        'uses' => 'userController@contacts'
    ]
);


Route::get(
    '/rsvp/',
    [
        'as'   => 'rsvp',
        'uses' => 'Event\EventController@rsvp'
    ]
);


Route::get(
    '/email',
    [
        'as'   => 'email',
        'uses' => 'Event\EventController@email'
    ]
);
Route::get(
    '/ticket',
    [
        'as'   => 'ticket',
        'uses' => 'Event\EventController@ticket'
    ]
);
Route::get(
    '/cat/{ca?}',
    [
        'as'   => 'cat',
        'uses' => 'Event\EventController@cat'
    ]
);

Route::get('/upcoming', 'Event\EventController@upcoming');

Route::get(
    'event',
    function () {
        return view('eventpage');
    }
);
Route::get(
    'create',
    function () {
        return view('create');
    }
);
Route::auth();

Route::get('/home', 'HomeController@index');
Route::post(
    '/search',
    [
        'as'   => 'search',
        'uses' => 'Event\EventController@search'
    ]
);
Route::get(
    '/searchTag/{tag?}',
    [
        'as'   => 'searchTag',
        'uses' => 'Event\EventController@searchtag'
    ]
);
Route::post(
    '/radSearch/',
    [
        'as'   => 'radSearch',
        'uses' => 'Event\EventController@radSearch'
    ]
);
Route::post('/radius', ['as' => 'radius', 'uses' => 'Event\EventController@radius']);
Route::get('/addgroup', ['as' => 'addgroup', 'uses' => 'userController@group']);
Route::get('/updategroup/{grp?}', ['as' => 'updategroup', 'uses' => 'userController@updateGroup']);
Route::get('/deleteGrp', ['as' => 'deleteGrp', 'uses' => 'userController@deleteGrp']);
Route::get('/updateGrp', ['as' => 'updateGrp', 'uses' => 'userController@updateGrp']);
Route::get('/addEmail', ['as' => 'addEmail', 'uses' => 'userController@addEmail']);
Route::get('/deleteGroup/{email?}/{grpID?}/{grpNAME?}', ['as' => 'deleteGroup', 'uses' => 'userController@deleteGroup']);
Route::get('/emailList', ['as' => 'emailList', 'uses' => 'Event\EventController@emailList']);
Route::get('/updateEvent/{id?}', ['as' => 'updateEvent', 'uses' => 'Event\EventController@updateEvent']);
Route::post('/event_update',['as' => 'event_update', 'uses' => 'Event\EventController@event_update']);
Route::get('/profile/{id?}',['as'=>'profile', 'uses' => 'Event\EventController@profile']);
Route::get('/emailOrganizer',['as'=>'emailOrganizer', 'uses' => 'Event\EventController@emailOrganizer']);
Route::get('/register/{id?}',['as'=>'register', 'uses' => 'Event\EventController@register']);
Route::post('invite-contacts/{eventId}', [
    'as' => 'invite-contacts',
    'uses' => 'Event\EventController@inviteContacts'
]);




