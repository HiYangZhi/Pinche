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

Route::group([ 'prefix' => 'pinche' , 'namespace' => 'ZCJY\Pinche\Http\Controllers'], function () {
    Route::get('/', 'FrontController@index');
	Route::get('/weixin', 'FrontController@weixin');	//拼车信息
	Route::get('/create', 'FrontController@create');	//发布信息
	Route::post('/create', 'FrontController@store');	//保存信息
	Route::get('/infoes', 'FrontController@infoes');	//我的拼车
	Route::get('/show/{id}', 'FrontController@show');	//显示我的拼车详情
	Route::get('/detail/{id}', 'FrontController@detail');	//显示拼车信息详情
	Route::get('/participate/{id}', 'FrontController@participate');	//参与拼车 
	Route::get('/cancel/{id}', 'FrontController@cancel');	//取消拼车 
	Route::get('/edit/{id}', 'FrontController@edit');	//修改拼车 
	Route::post('/update/{id}', 'FrontController@update');	//修改拼车 

	Route::get('/passenger', 'FrontController@getPassenger'); //获取用户微信信息


	//Auth::routes();

	Route::get('/home', 'HomeController@index');
	Route::get('/user', 'HomeController@users');
	Route::delete('/info/{id}', 'HomeController@deleteInfo')->name('deleteinfo');

	Route::resource('banners', 'bannerController');

	Route::resource('links', 'LinkController');
});
