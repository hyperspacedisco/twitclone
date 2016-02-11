<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::post('/profile/new-comment', 'ProfileController@newComment')->middleware(['web', 'auth']);

Route::post('profile/new-tweet', 'ProfileController@newTweet')->middleware(['web','auth']);

Route::post('/login', 'Auth\AuthController@postLogin')->middleware(['web','auth']);

Route::get('/profile/delete-tweet/{id}/confirm', 'ProfileController@destroyTweet')->middleware(['web', 'auth']);












/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

Route::group(['middleware' => ['web']], function () {



	Route::get('/profile/delete-tweet/{id}', "ProfileController@deleteTweet")->middleware('auth');

    Route::get('/profile/{username}', 'ProfileController@show');
    
    Route::get('/profile', 'ProfileController@index');

 
    Route::get('/login', 'Auth\AuthController@getLogin');

    Route::get('/logout', 'Auth\AuthController@logout');

    Route::post('/register', 'Auth\AuthController@postRegister');
    Route::get('/register', 'Auth\AuthController@getRegister');

    Route::get('/contact', 'ContactController@index');

    Route::get('/', 'HomeController@index');
});
