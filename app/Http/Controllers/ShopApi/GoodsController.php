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
                        'sku_id' => $value['id'],
	    				'sku_value' => $value['sku_value'],
	    				'attr_price' => $value['attr_price']
	    			 ]
	    			]
    		  ];
    		}else{
    			$sku_data[$value['attr_id']]['attr_sku'][]=[
                    'sku_id' => $value['id'],
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

    //获取商品sku属性的列表信息
    public function getGoodsAttr(Request $request)
    {
        $sku_ids = $request->input('sku_ids');//传过来的sku的ids

        $sku_ids = explode(',', $sku_ids);

        $sku = \DB::table('jy_goods_sku')->select('attr_id','sku_value')->whereIn('id',$sku_ids)->get();

        $skuData = [];

        foreach ($sku as $key => $value) {
            //获取属性名
            $attr = \DB::table('jy_goods_attr')->select('attr_name')->where('id',$value->attr_id)->first();
            $skuData[$key]['sku_value'] = $value->sku_value;
            $skuData[$key]['attr_name'] = $attr->attr_name;
        }

        $this->returnJson($skuData);
    }
}
