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


Route::get('/', 'PostController@index');
Route::get('/search', 'PostController@search');
Route::get('/posts/create', 'PostController@create')->middleware('auth');
Route::get('/posts/rank','PostController@rank');
Route::get('/posts/{post}','PostController@show');
Route::get('/posts/{post}/edit','PostController@edit');


Route::get('/profiles/create','ProfileController@create')->middleware('auth');
Route::get('/profiles/mypage','ProfileController@myshow')->middleware('auth');
Route::get('/profiles/{profile}','ProfileController@show');
Route::get('/profiles/{profile}/edit','ProfileController@edit');



Route::get('/likes/{like}', 'LikeController@index')->middleware('auth');

Route::get('login/google', 'Auth\LoginController@redirectToGoogle');
Route::get('login/google/callback', 'Auth\LoginController@handleGoogleCallback');

Route::get('/home', 'HomeController@index')->name('home');

Route::post('/posts/store', 'PostController@store')->middleware('auth');

Route::post('/profiles/store', 'ProfileController@store')->middleware('auth');

Route::post('/likes','LikeController@store')->middleware('auth');

Route::put('/posts/{post}/update','PostController@update');

Route::put('/profiles/{profile}/update','ProfileController@update');

Route::delete('/posts/{post}/delete','PostController@destroy');
Route::delete('/profiles/{profile}/delete','ProfileController@destroy');

Auth::routes();






