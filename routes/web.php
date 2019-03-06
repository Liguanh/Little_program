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

    Route::any('get/bonus', 'Study\BonusController@getBonus'); //获取红包的路由
});

//管理后台RBAC功能类的路由组
Route::prefix('admin')->group(function(){

});