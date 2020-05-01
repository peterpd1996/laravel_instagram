<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteSer
viceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/



// posts
Auth::routes();

Route::group([
    'middleware' => ['auth'],
], function () {
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
Route::post('/load-message', 'MessengerController@loadMessage')->name('messages.load');
Route::post('/send-message', 'MessengerController@storeMessage')->name('messages.store');

// favorite post
Route::post('/favorite', 'PostFavouriteController@store')->name('favorite.store');

//admin
	Route::group(['prefix'=>"admin"],function (){
	    Route::get('/',function (){
	        return view('admin.dashboard');
	    });
	    Route::get('/list-post','Admin\PostAdminController@index')->name('list-post');
	    Route::delete('/delete/{id}','Admin\PostAdminController@destroy');

	    Route::get('/list-account','Admin\AccountAdminController@index')->name('list-account');
	});
});


