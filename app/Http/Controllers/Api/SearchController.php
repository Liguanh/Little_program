<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Novel;

class SearchController extends Controller
{
    //
	//通过关键词来搜索内容
    public function getSearchList(Request $request)
    {
    	$name = $request->input('name');

    	$novel = new Novel();

    	$list = $novel->getNovelByName($name);

    	$totalNum = count($list);

    	$return = [
    		'code' => 2000,
    		'msg'  => '成功',
    		'data' =>[
    			'list' => $list,
    			'total_num' => $totalNum
    		]
    	];

    	return json_encode($return);
    }
}
