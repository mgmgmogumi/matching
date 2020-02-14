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

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::resource('users', 'UserController')->middleware('auth');
Route::post('/likes/{user}', 'LikeController@store')->name('likes.store')->middleware('auth');
Route::delete('/likes/{user}', 'LikeController@destroy')->name('likes.delete')->middleware('auth');
Route::get('/matching', 'UserController@matching')->name('matching')->middleware('auth');
Route::get('/liked', 'UserController@liked')->name('liked')->middleware('auth');
Route::get('/like', 'UserController@like')->name('like')->middleware('auth');