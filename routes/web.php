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
Route::get('/login-google','LoginSocialiteController@LoginGoogle')->name('login.google');
Route::get('/google-callback', 'LoginSocialiteController@loginGoogleCallback')->name('google.callback');
Route::get('/login-facebook','LoginSocialiteController@LoginFacebook')->name('login.facebook');
Route::get('/facebook-callback', 'LoginSocialiteController@loginFacebookCallback')->name('facebook.callback');

Route::group([
    'middleware' => ['auth','locate'],
], function () {

Route::post('/laguage','LanguageController@changeLanguage')->name('changeLang');
    //change password
Route::get('/changePassword','HomeController@showChangePasswordForm')->name('changePassword');
Route::post('/changePassword','HomeController@changePassword');

Route::get('/','PostController@index')->name('home');
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
	Route::group(['prefix'=>"admin" ,'namespace' =>'Admin'],function (){
	    Route::get('/','DashboardController@index');
	    Route::get('/list-post','PostAdminController@index')->name('list-post');
	    Route::delete('/delete/{id}','PostAdminController@destroy');

	    Route::get('/list-account','AccountAdminController@index')->name('list-account');
            //chart
        Route::get('/get-post-chart-data', 'ChartDataController@getMonthlyPostData');
	});
});


