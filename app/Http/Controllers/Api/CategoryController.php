<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Category;
use App\Model\Novel;

class CategoryController extends Controller
{
    //

    //获取分类列表接口
    public function getCategory()
    {
    	$category = new Category();

    	$cList = $category->getCategory();

    	$return = [
    		'code' => 2000,
    		'msg'  => "获取分类的接口",
    		'data' => $cList
    	];

    	return json_encode($return);
    }

    /**
     * 获取小说的分类列表
     */
    public function getCategoryNovel(Request $request)
    {
    	$cId = $request->input('c_id',1);

    	$novel = new Novel();

    	$list = $novel->getNovelByCid($cId);

    	$return = [
    		'code' => 2000,
    		'msg'  => "获取分类小说列表的接口",
    		'data' => $list
    	];

    	return json_encode($return);
    }
}
