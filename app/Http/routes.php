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

// Welcome/Home page
Route::get('/', function () {
    // return view('welcome');
    return view('welcome-new');
});

// Dashboard
Route::get('/dashboard', 'DashboardController@dashboard');

// Account
Route::get('/account/edit', 'AccountController@edit');
Route::put('/account/update', 'AccountController@update');
Route::put('/account/updatePassword', 'AccountController@updatePassword');
Route::get('/account/changePassword', 'AccountController@editPassword');
Route::post('/upload', 'AccountController@uploadProfilePic');

// About Us Page
Route::get('/about', function () {
    return view('about');
});

// How To Play
Route::get('/howtoplay', function () {
    return view('howtoplay');
});

// Contact
Route::get('/contact', function () {
    return view('contact');
});

// Terms & Conditions
Route::get('/terms', function () {
    return view('terms');
});

// Resource routing
Route::resource('selections', 'SelectionsController');
Route::resource('play', 'GamesController');


//Logging in and out
Route::get('/login', 'Auth\AuthController@getLogin');
Route::post('/login', 'Auth\AuthController@postLogin');
Route::get('/logout', 'Auth\AuthController@getLogout');


//Registration routes
Route::get('/register', 'Auth\AuthController@getRegister');
Route::post('/register', 'Auth\AuthController@postRegister');


// Payment
Route::post('/charge/{amount}', 'PaymentController@charge');


// Password reset link request routes...
Route::get('password/email', 'Auth\PasswordController@getEmail');
Route::post('password/email', 'Auth\PasswordController@postEmail');

// Password reset routes...
Route::get('password/reset/{token}', 'Auth\PasswordController@getReset');
Route::post('password/reset', 'Auth\PasswordController@postReset');
