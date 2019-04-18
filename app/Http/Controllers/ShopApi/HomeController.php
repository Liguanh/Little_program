<?php

namespace App\Http\Controllers\ShopApi;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Category;
use App\Tools\ToolsAdmin;
use App\Tools\ToolsOss;

class HomeController extends Controller
{
    //商品分类接口
    public function category()
    {

    	$category = new Category();

    	$data = $this->getDataList($category);

    	$data = ToolsAdmin::buildTree($data,0,"f_id");

   	    $return = [
   	    	'code' => 2000,
   	    	'msg'  => "成功",
   	    	'data' => $data
   	    ];

    	$this->returnJson($return);
    }

    //首页广告位的接口
    public function ad(Request $request)
    {
    	//广告位的id参数
    	$position = $request->input('postion_id',1);
    	//广告的条数
    	$nums  = $request->input('nums',1);

    	$currentTime = date("Y-m-d H:i:s");

    	//$ad = \DB::table('jy_ad')->count();
    	$ad  = \DB::table('jy_ad')->select('id','ad_name','image_url','ad_link')
    				->where('position_id',$position)
    				->where('start_time','<',$currentTime)
    				->where('end_time','>', $currentTime)
    				->limit($nums)
    				->get();


    	//组装广告的数据
    	$ad_data = [];

    	$toolsOss = new  ToolsOss();

    	foreach ($ad as $key => $value) {
    		$ad_data[$key] = [

    			'id'  => $value->id,
    			'ad_name' => $value->ad_name,
    			'image_url' => $toolsOss->getUrl($value->image_url, true),
    			'ad_link'   => $value->ad_link
    		];
    	}

    	$return = [
   	    	'code' => 2000,
   	    	'msg'  => "成功",
   	    	'data' => $ad_data
   	    ];

    	$this->returnJson($return);
    }

    //商品类型列表
    public function goodsList(Request $request)
    {

    }

    //品牌列表
    public function brand(Request $request)
    {

    }

    //最新文章
    public function newsArticle(Request $request)
    {

    }
}
