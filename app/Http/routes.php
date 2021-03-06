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
    return view('welcome-new');
});

Route::get('/addCreditFromNav', function () {
    return view('partials.navbar.addCreditFromNav');
});

Route::get('/getProfilePic', function () {
    return view('account.profileImage');
});

Route::get('/SignUpLoginView', function () {
    return view('partials.SignUpLogin');
});

// Dashboard
Route::get('/dashboard', 'DashboardController@index');
Route::get('/gamesForWeek', 'DashboardController@getGamesForWeekView');
Route::get('/myCurrentGames', 'DashboardController@getMyCurrentGamesView');
Route::get('/lastWeekResults', 'DashboardController@getLastWeekResultsView');
Route::get('/leaderboard', 'DashboardController@getLeaderboardView');
Route::get('/nextWeekGames', 'DashboardController@getNextWeekGamesView');

Route::get('/cancel/{game}', 'SelectionsController@gameCancelled');
Route::get('/checkGamesCancelled/{userId}', 'SelectionsController@checkGamesCancelled');

// Account
Route::get('/account', 'AccountController@show');
Route::get('/account/edit', 'AccountController@edit');
Route::post('/account/update', 'AccountController@update');
Route::put('/account/updatePassword', 'AccountController@updatePassword');
Route::post('/account/updateFavTeam/{team}', 'AccountController@updateFavTeam');
Route::get('/account/changePassword', 'AccountController@editPassword');
Route::post('/upload', 'AccountController@uploadProfilePic');
Route::get('/account/{user}', 'AccountController@show');
Route::delete('/account/delete', 'AccountController@destroy');

Route::post('/postContact', 'AccountController@postContact');
Route::get('/winningGames', 'AccountController@getUserWinningGames');
Route::get('/favTeam', 'AccountController@getUserFavTeamLogo');
Route::get('/avatar', 'AccountController@getUserAvatar');

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
Route::post('/charge', 'PaymentController@charge');
Route::post('/freecharge', 'PaymentController@freecharge');


// Password reset link request routes...
Route::get('password/email', 'Auth\PasswordController@getEmail');
Route::post('password/email', 'Auth\PasswordController@postEmail');

// Password reset routes...
Route::get('password/reset/{token}', 'Auth\PasswordController@getReset');
Route::post('password/reset', 'Auth\PasswordController@postReset');

// Send Message
Route::get('/message', 'MessagesController@index');
