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
Route::get('/posts/search', 'PostController@search');
Route::get('/posts/create', 'PostController@create')->middleware('auth');
Route::get('/posts/{post}','PostController@show');
Route::get('/posts/{post}/edit','PostController@edit');


Route::get('/profiles/create','ProfileController@create');
Route::get('/profiles/mypage','ProfileController@myshow')->middleware('auth');
Route::get('/profiles/{profile}','ProfileController@show');
Route::get('/profiles/{profile}/edit','ProfileController@edit');



Route::get('/likes/{like}', 'LikeController@index');

Route::get('/comments/', 'CommentController@index');

Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

Route::post('/posts/store', 'PostController@store');

Route::post('/profiles/store', 'ProfileController@store');

Route::put('/posts/{post}/update','PostController@update');

Route::put('/profiles/{profile}/update','ProfileController@update');

Route::delete('/posts/{post}/delete','PostController@destroy');
Route::delete('/profiles/{profile}/delete','ProfileController@destroy');
Route::delete('/tags/{tag}/delete','TagController@destroy');


Route::post('/likes/','LikeController@store')->middleware('auth');

