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



// posts
Auth::routes();
Route::get('/','PostController@index');
Route::get('/p/create','PostController@create');
Route::post('/p','PostController@store');
Route::get('/p/{post}','PostController@show');
Route::get('/p/edit/{post}','PostController@edit');
Route::post('/p/update','PostController@update');
Route::post('/p/delete','PostController@delete');
// commnet
Route::post('/comment','CommentController@store');
// fetch comment
Route::post('/fetch','CommentController@fetch');

//notification
Route::post('/notification','NotificationController@show');
//search
Route::post('/search','SearchController@searchUser');
// follow 
Route::get('/follow','FollowController@index')->name('follow');
Route::post('follow/{user}','FollowController@store');
//like
Route::post('/like','LikeController@store');
// profile
Route::get('/profile/{user}', 'ProfileController@index')->name('profile.show');
Route::get('/profile/{user}/edit', 'ProfileController@edit')->name('profile.show');
Route::patch('/profile/{user}', 'ProfileController@update')->name('profile.update');

// message
Route::get('/messages', 'MessengerController@index')->name('messages.show');