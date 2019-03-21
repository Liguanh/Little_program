<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Novel;

class HomeController extends Controller
{
    //
	//小说首页banner图
    public function banners(Request $request)
    {
    	$num = $request->input('num',3);

    	$novel = new Novel();

    	$list = $novel->getBanners();

    	$return = [
    		'code' => 2000,
    		'msg'  => "获取banner成功",
    		'data' => $list
    	];

    	return json_encode($return);
    }

    //最新小说
    public function newsList(Request $request)
    {
    	$num = $request->input('num',3);

    	$novel = new Novel();

    	$news = $novel->getNews();

    	$return = [
    		'code' => 2000,
    		'msg'  => "获取列表成功",
    		'data' => $news
    	];

    	return json_encode($return);
    }

    //点击排行
    public function clicksList(Request $request)
    {
    	$num = $request->input('num',3);

    	$novel = new Novel();

    	$clicks = $novel->getClicks();

    	$return = [
    		'code' => 2000,
    		'msg'  => "获取列表成功",
    		'data' => $clicks
    	];

    	return json_encode($return);
    }
}
