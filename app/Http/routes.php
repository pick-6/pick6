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

// Play Game
Route::get('/play', function () {
	if (!Auth::check()) {
		return redirect('/login');
	}
    return view('playGame');
});

// How To Play
Route::get('/howtoplay', function () {
    return view('howtoplay');
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

Route::get('/account/edit', 'AccountController@edit');

Route::get('/account/info', 'AccountController@info');

Route::get('/account', 'AccountController@show');

// Resource routing

Route::resource('bets', 'BetsController');

Route::resource('users', 'UsersController');

Route::resource('charities', 'CharitiesController');
