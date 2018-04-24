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
Route::get('/change/{businessuser}','ChangesController@edit')->name('change.edit');
Route::post('/change/{businessuser}','ChangesController@update')->name('change.update');
Route::get('/logout','LoginController@destroy')->name('logout');
Route::get('/logout2','LoginController@destroy2')->name('logout2');
Route::resource('shopusers','ShopUsersController');
Route::resource('businessuser','BusinessUserController');
Route::resource('commodity','CommodityController');
//Route::resource('foods','FoodsController');
Route::get('/foods/{commodity}', 'FoodsController@index')->name('foods.index');//用户列表
Route::get('/food/{commodity}', 'FoodsController@create')->name('foods.create');//用户列表
Route::post('/store/{commodity}', 'FoodsController@store')->name('foods.store');//用户列表
Route::get('/edit/{food}', 'FoodsController@edit')->name('foods.edit');//用户列表
Route::post('/update/{food}', 'FoodsController@update')->name('foods.update');//用户列表
Route::get('/showa/{activity}', 'BusinessUserController@showa')->name('activity.showa');//用户列表
Route::get('/show/{food}', 'FoodsController@show')->name('foods.show');//用户列表
Route::get('/delete/{food}', 'FoodsController@destroy')->name('foods.destroy');//用户列表
//Route::get('/oss', function()
//{
//    $client = App::make('aliyun-oss');
    ////    $client->putObject(getenv('OSS_BUCKET'), "2.txt", "hello mother funker");
////    $result = $client->getObject(getenv('OSS_BUCKET'), "2.txt");
////    echo $result;
//
//        try{
//            $client->putObject(getenv('OSS_BUCKET'),$object, $content);
//        }catch (\OSS\Core\OssException $e){
//
//        }
//});
Route::post('/set','PicController@create');