<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Goods;
use App\Model\GoodsAttr;
use App\Model\GoodsSku;
use Illuminate\Support\Facades\DB;

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

    //执行保存的操作
    public function doEdit(Request $request)
    {
    	$params = $request->all();

        // dd($params);

        $params = $this->delToken($params);

        try{
            DB::beginTransaction();
            $goodsSku = new GoodsSku();
            //先删除之前关联过得数据
            $this->delData($goodsSku,$params['goods_id'],'goods_id');

            $sku_arr = [];
            //添加spu的数据
            foreach ($params['sku'] as $key => $value) {
                $value['goods_id'] = $params['goods_id'];
                $sku_arr[$key] = $value;
            }

            $this->storeDataMany($goodsSku, $sku_arr);


            //添加sku的数据
            $sku1_arr = [];
            foreach ($params['sku1'] as $k => $v) {
                $v['goods_id'] = $params['goods_id'];
                $sku1_arr[$k] = $v;
            }

            // dd($sku1_arr);

            $goodsSku1 = new GoodsSku();

            $this->storeDataMany($goodsSku1, $sku1_arr);

            DB::commit();
        }catch(\Exception $e){
            DB::rollback();
            \Log::error('sku属性保存失败'.$e->getMessage());
        }

        return redirect()->back();
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
  	public function getAttrValues($goodsId)
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

        $arr = [];
        $string = '';
        foreach ($data as $key => $value) {
            $string .= str_replace('"""', '', $value['attr_value'])."\r\n";
        }

        $arr = array_filter(explode("\r\n", $string));

        $return = [
        	'code' => 2000,
        	'msg'  => '成功',
        	'data' => $arr
        ];

       
        return json_encode($return);
  	}

    public function getSkuList($goodsId)
    {
        //商品已经绑定过属性关系
        $goodsSku = new GoodsSku();
        $sku = $goodsSku->getSkuList($goodsId);
        dd($sku);
    }
}
