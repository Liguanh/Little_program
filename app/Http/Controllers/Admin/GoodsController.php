<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Category;
use App\Model\Brand;
use App\Model\GoodsType;
use App\Model\Goods;
use App\Model\GoodsGallery;
use App\Tools\ToolsAdmin;
use Illuminate\Support\Facades\DB;

class GoodsController extends Controller
{
    //列表页面
    public function list()
    {
    	return view('admin.goods.list');
    }

    //添加页面
    public function add()
    {
    	//商品类型
    	$type = new GoodsType();
    	$assign['type_list'] = $this->getDataList($type, ['status'=> GoodsType::USE_ABLE]);
    	//商品品牌
    	$brand = new Brand();

    	$assign['brand_list'] = $this->getDataList($brand, ['status'=> Brand::USE_ABLE]);
    	//商品分类
    	$category = new Category();

    	$assign['cate_list'] = $this->getDataList($category, ['status'=> Category::USE_ABLE]);
    	$assign['cate_list'] = ToolsAdmin::buildTreeString($assign['cate_list'],0,0,'f_id');

    	//商品货号
    	$assign['goods_sn'] = ToolsAdmin::buildGoodsSn();
    	return view('admin.goods.add', $assign);
    }

    //执行添加的操作
    public function store(Request $request)
    {
    	$params = $request->all();

    	//上传图片的上限
    	if(isset($params['gallery']) && count($params['gallery'])>5){
    		return redirect()->back()->with('msg','已经超过相册上传的上限');
    	}

    	//
    	$params = $this->delToken($params);

    	//拿到相册的数据
    	$gallery = $params['gallery'];
    	unset($params['gallery']);

    	//dd($gallery, $params);
    	try{
    		//事务开启
    		DB::beginTransaction();

    		//添加商品信息
    		$goods = new Goods();
    		$goodsId = $this->storeDataGetId($goods, $params);

    		//添加相册的信息

    		//1 格式化相册的数据
    		foreach ($gallery as $key => $value) {
    			$value['image_url'] = ToolsAdmin::uploadFile($value['image_url']);//上传后图片地址
    			$value['goods_id'] = $goodsId;
    			$gallery[$key] = $value;
    		}
    		
    		//2、执行添加的操作
    		$goodsGallery = new GoodsGallery();

    		$this->storeDataMany($goodsGallery, $gallery);//执行添加的操作
    		//事务提交
    		DB::commit();
    	}catch(\Exception $e){
    		DB::rollback();

    		\Log::error('商品添加失败'.$e->getMessage());
    		return redirect()->back()->with('msg','商品添加失败');
    	}

    	return redirect('/admin/goods/list');
    }
}
