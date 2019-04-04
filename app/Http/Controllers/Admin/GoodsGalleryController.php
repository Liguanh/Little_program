<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\GoodsGallery;

class GoodsGalleryController extends Controller
{
    //商品相册列表数据
    public  function getGallery($goodsId)
    {
    	$return = [
    		'code'  =>2000,
    		'msg'  => '获取列表成功'
    	];

    	$gallery = new GoodsGallery();

    	$where = [
    		'goods_id' => $goodsId
    	];

    	$list = $this->getDataList($gallery, $where);

    	$return['data'] = $list;

    	return json_encode($return);
    }

    //执行相册删除操作
    public function del($id)
    {
    	$return = [
    		'code' => 2000,
    		'msg'  => '删除相册成功'
    	];

    	$gallery = new GoodsGallery();

    	$res =  $this->delData($gallery, $id);

    	if(!$res){

    		$return = [
	    		'code' => 4000,
	    		'msg'  => '删除相册失败'
    		];
    	}

    	return json_encode($return);
    }
}
