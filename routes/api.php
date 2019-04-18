<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

/************[首页]******************/
//首页banner图接口
Route::post('home/banners','Api\HomeController@banners');
//首页最新小说的接口
Route::post('home/news','Api\HomeController@newsList');
//首页最新小说的接口
Route::post('home/clicks','Api\HomeController@clicksList');

//分类列表接口
Route::post('category/list','Api\CategoryController@getCategory');
//分类小说列表接口
Route::post('category/novel','Api\CategoryController@getCategoryNovel');

//小说搜索接口
Route::post('search/novel', 'Api\SearchController@getSearchList');

//小说书单接口
Route::get('book/list','Api\NovelController@bookList');
//小说阅读榜单接口
Route::post('read/rank','Api\NovelController@bookRank');

//小说详情接口
Route::post('novel/detail/{id}','Api\NovelController@detail');
Route::any('novel/clicks/{id}','Api\NovelController@clicks');
Route::any('novel/read/{id}','Api\NovelController@readNum');

//小说章节列表接口
Route::post('chapter/list/{novel_id}','Api\ChapterController@chapterList');
Route::post('chapter/info/{id}','Api\ChapterController@chapterInfo');

//评论添加接口
Route::post('comment/add','Api\CommentController@add');
//列表接口
Route::post('comment/list/{novelId}','Api\CommentController@list');
//删除接口
Route::post('comment/del/{id}','Api\CommentController@del');


/*********************###########[电商类的接口]######################**********************/

Route::prefix('shop')->group(function(){
	//商品分类的接口
	Route::post('home/category', 'ShopApi\HomeController@category');
	
	//首页banner图，广告位的接口
	Route::post('home/ad', 'ShopApi\HomeController@ad');

	//商品类型接口

	//品牌列表接口

	//最新文章接口

});


/*********************###########[电商类的接口]######################**********************/