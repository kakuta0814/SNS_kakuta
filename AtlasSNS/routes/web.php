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

// Route::get('/', function () {
//     return view('welcome');
// });
// Route::get('/home', 'HomeController@index')->name('home');

//Auth::routes();


//ログアウト中のページ
Route::get('/login', 'Auth\LoginController@login');
Route::post('/login', 'Auth\LoginController@login');
//ログアウト
Route::get('/logout', 'Auth\LoginController@logout');

Route::get('/register', 'Auth\RegisterController@register');
Route::post('/register', 'Auth\RegisterController@register');

Route::get('/added', 'Auth\RegisterController@added');
Route::post('/added', 'Auth\RegisterController@added');

//ログイン中のページ
Route::get('/top','PostsController@index');
Route::post('/top','PostsController@create');

Route::post('/update','PostsController@update');

Route::get('/profile','UsersController@profile');
Route::post('/profile','UsersController@profile_update');

Route::get('/profile/{userdata}','UsersController@userdata')->name('other');

Route::get('/search','UsersController@search');

Route::post('search/{user}/follow', 'UsersController@follow')->name('follow');
Route::delete('search/{user}/unfollow', 'UsersController@unfollow')->name('unfollow');

Route::get('/follow-list','UsersController@follow_list');
Route::get('/follower-list','UsersController@follower_list');


Route::get('/post/delete/{id}', 'PostsController@delete');
