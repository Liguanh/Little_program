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

	//echo "hello Laravel";exit;
    return view('welcome');
});

//学习类的路由组
Route::prefix('study')->group(function(){

    //红包首页路由
    Route::get('bonus/index','Study\BonusController@index');
    //红包添加路由
    Route::post('bonus/add','Study\BonusController@addBonus');
    //红包列表
    Route::get('bonus/list','Study\BonusController@getList');

    Route::get('bonus/record/list','Study\BonusController@getBonusRecord');

    Route::any('get/bonus', 'Study\BonusController@getBonus'); //获取红包的路由
});



//登陆页面
Route::get('admin/login','Admin\LoginController@index');
//执行登陆
Route::post('admin/doLogin','Admin\LoginController@doLogin');

//管理后台RBAC功能类的路由组
Route::prefix('admin')->group(function(){

    //管理后台首页
    Route::get('home','Admin\HomeController@home');
});