<?php

namespace App\Http\Controllers\ShopApi;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Goods;
use App\Model\GoodsGallery;
use App\Tools\ToolsOss;
use App\Model\GoodsSku;

class GoodsController extends Controller
{
    //商品详情接口
    public function detail($goodsId)
    {

    	$return =[
    			'code' =>2000,
    			'msg'  => "商品详情接口"
    	];
    	//商品基本信息
    	$goods = new Goods();
    	$goodsInfo = $this->getDataInfo($goods, $goodsId)->toArray();

    	//商品相册信息
    	$goodsGallery = new GoodsGallery();
    	$galllers = $this->getDataList($goodsGallery,['goods_id' => $goodsId]);

    	$oss = new ToolsOss();

    	foreach ($galllers as $key => $value) {
    		$galllers[$key]['image_url']  = $oss->getUrl($value['image_url'],true);
    	}

    	// dd($galllers);

    	//商品的spu的信息
    	$goodsSku = new GoodsSku();
    	$spu =  $goodsSku->getSpuHandle($goodsId);

    	//商品sku的属性值
    	$sku = $goodsSku->getSkuList($goodsId);

    	$sku_data = [];
    	//组装前台sku的数据
    	foreach ($sku as $key => $value) {
    		if(!isset($sku_data[$value['attr_id']])){//如果不存在
    			$sku_data[$value['attr_id']] = [
	    			'attr_name' => $value['attr_name'],
	    			'attr_sku'  => [
	    				[
	    				'sku_value' => $value['sku_value'],
	    				'attr_price' => $value['attr_price']
	    			 ]
	    			]
    		  ];
    		}else{
    			$sku_data[$value['attr_id']]['attr_sku'][]=[
    				'sku_value' => $value['sku_value'],
	    			'attr_price' => $value['attr_price']
    			];

    		}
    		
    	}


    	$return['data'] = [
    		'goods'  => $goodsInfo,
    		'gallery' => $galllers,
    		'spu'     => $spu,
    		'sku'     => $sku_data
    	];

    	$this->returnJson($return);
    }
}
