<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/* Static Pages */
// Home
Route::get('/', 'StaticController@home');

// FAQ
Route::get('/faq', 'StaticController@faq');

/* Dynamic Pages */
// You
Route::get('/you', 'DynamicController\YouController@get');
Route::post('/you', 'DynamicController\YouController@post');

// Search
Route::get('/search', 'DynamicController\SearchController@get');
Route::post('/search', 'DynamicController\SearchController@post');

/* Forms */
// Sign Up
Route::get('/signup', 'FormController\SignUpController@get');
Route::post('/signup', 'FormController\SignUpController@post');

// Sign In
Route::get('/signin', 'FormController\SignInController@get');
Route::post('/signin', 'FormController\SignInController@post');

// Sign Out
Route::get('/signout', 'FormController\SignOutController@get');

// Activate
Route::get('/activate', 'FormController\ActivateController@get');

/* Testing Ground */
Route::get('/test', 'TestController@test');
