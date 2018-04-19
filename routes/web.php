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
    return view('welcome');
});
Route::get('/login','LoginController@create')->name('login');
Route::post('/login','LoginController@store')->name('login');
Route::get('/logout','LoginController@destroy')->name('logout');
Route::resource('shopusers','ShopUsersController');
//Route::get('shop_users/create','ShopUsersController@create');
Route::get('/test','TestController@index');