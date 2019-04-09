<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Goods;
use App\Model\GoodsAttr;
use App\Model\GoodsSku;

class GoodsSkuController extends Controller
{
    //商品属性或sku的编辑页面
    public function edit($goodsId)
    {
    	//商品的详情
    	$goods = new  Goods();
    	$goods_info = $this->getDataInfo($goods,$goodsId);

    	//手动录入的商品的属性
        $goodsAttr = new GoodsAttr();

        //手动录入的通用属性
        $where = [
        	'cate_id' => $goods_info->type_id
        ];
        $handle = $goodsAttr->getAttrHandle($where);

        //商品已经绑定过属性关系
        $goodsSku = new GoodsSku();
        $spu = $goodsSku->getSpuHandle($goodsId);


        foreach ($handle as $key => $value) {//通用属性
        	foreach ($spu as $k => $v) {//spu属性循环
        		if($value['id'] == $v['attr_id']){
        			$value['sku_value'] = $v['sku_value'];
        		}
        	}
        	$handle[$key] = $value;
        }

        $assign['handle'] = $handle;
        $assign['goods_id'] = $goods_info->id;

    	return  view('admin.goodsSku.edit', $assign);
    }

    public function doEdit(Request $request)
    {
    	$params = $request->all();

    	dd($params);
    }


    //获取sku属性列表接口
  	public function getSkuAttr($goodsId)
  	{
  		//商品的详情
    	$goods = new  Goods();
    	$goods_info = $this->getDataInfo($goods,$goodsId);

  		//列表录入的商品的属性
        $goodsAttr = new GoodsAttr();
        $where = [
        	'cate_id' => $goods_info->type_id
        ];

        $data = $goodsAttr->getAttrList($where);

        $return = [
        	'code' => 2000,
        	'msg'  => '成功',
        	'data' => $data
        ];

       
        return json_encode($return);
  	}

  	//获取属性的value值
  	public function getAttrValues($id)
  	{
  		//列表录入的商品的属性
        $goodsAttr = new GoodsAttr();

        $data = $goodsAttr->getAttrValue($id);

        $string = str_replace('"""', '', $data->attr_value);
        $arr = explode("\r\n", $string);

        $return = [
        	'code' => 2000,
        	'msg'  => '成功',
        	'data' => $arr
        ];

       
        return json_encode($return);
  	}
}
