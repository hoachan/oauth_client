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

Route::get('/', 'HomeController@index')->name('home');
Route::get('/user-list', 'UserController@getUsers');
Route::get('/user-profile', 'UserController@getUsers');
Route::get('/oauth-setting', 'UserController@getUsers');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/auth/facebook', 'Auth\LoginController@redirectToProvider');
Route::get('/auth/facebook/callback', 'Auth\LoginController@handleProviderCallback');