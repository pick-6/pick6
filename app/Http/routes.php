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

// Welcome page

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', function () {
    return view('welcome');
});


// How To Play
Route::get('/howtoplay', function () {
    return view('howtoplay');
});

// Charities
Route::get('/charities', function () {
    return view('charities');
});

// Contact
Route::get('/contact', function () {
    return view('contact');
});


//Logging in and out

Route::get('/login', 'Auth\AuthController@getLogin');

Route::post('/login', 'Auth\AuthController@postLogin');

Route::get('/logout', 'Auth\AuthController@getLogout');


//Registration routes

Route::get('/register', 'Auth\AuthController@getRegister');

Route::post('/register', 'Auth\AuthController@postRegister');


//get requests for account and account information

Route::get('/account/{username}/edit', 'AccountController@edit');

Route::get('/account/{username}/info', 'AccountController@info');

Route::get('/account/{username}', 'AccountController@index');


// Resource routing

Route::resource('bets', 'BetsController');

Route::resource('users', 'UsersController');

