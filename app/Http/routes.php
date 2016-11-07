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

Route::get('/', 'WelcomeController@index');

Route::get('home', 'HomeController@index');

Route::controllers([
    'auth' => 'Auth\AuthController',
    'password' => 'Auth\PasswordController',
]);

Route::get('/hello', 'Hello@index');
Route::post('/signup', 'UserController@signup');
Route::post('/signup/verify', 'UserController@verifyEmailAddress');
Route::post('/signin', 'UserController@signin');
Route::resource('samplings', 'SamplingsController');
Route::resource('content', 'GeneralContentsController');
Route::resource('sampling-request', 'SamplingRequestController');
Route::resource('terrace-garden-request', 'TGRequestController');

Route::get('test', function() {
    return response()->json(['foo' => 'bar1']);
});

Route::group(['prefix' => 'api'], function() {
    Route::get('test', function() {
        return response()->json(['foo' => 'bar2']);
    });
    
//    Route::post('login', function() {
//        return response()->json(['foo' => 'bar3']);
//    });

    Route::post('login', 'Api\AuthController@login');
//    Route::group(['middleware' => ['jwt.auth', 'jwt.refresh']], function() {
//        Route::post('logout', 'Api\AuthController@logout');
//        Route::get('test', function() {
//            return response()->json(['foo' => 'bar']);
//        });
//    });
});
