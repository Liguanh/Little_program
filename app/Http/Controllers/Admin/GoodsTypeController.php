<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\GoodsType;
use App\Model\GoodsAttr;
use Illuminate\Support\Facades\DB;

class GoodsTypeController extends Controller
{
	protected $type = null;
	protected $attr = null;

	public function __construct()
	{
		$this->type = new GoodsType();
		$this->attr = new GoodsAttr();
	}

    //商品类型列表
    public function list()
    {
    	$assign['list'] = $this->getDataList($this->type);
    	return view('admin.goodsType.list',$assign);
    }

    //添加页面
    public function add()
    {
    	return view('admin.goodsType.add');
    }

    //执行添加操作
    public function store(Request $request)
    {

    	$params = $request->all();

    	$params = $this->delToken($params);


    	$res = $this->storeData($this->type, $params);

    	if(!$res){
    		return redirect()->back()->with('msg','添加失败');
    	}
    	
    	return redirect('/admin/goods/type/list');
    }

    //修改页面
    public function edit($id)
    {
    	//获取数据
    	$assign['info'] = $this->getDataInfo($this->type,$id);

    	return view('admin.goodsType.edit',$assign);
    }

    //执行修改
    public function doEdit(Request $request)
    {
    	$params = $request->all(); 

    	$params = $this->delToken($params);

    	$type =  GoodsType::find($params['id']);

    	$res = $this->storeData($type,$params);

    	if(!$res){
    		return redirect()->back()->with('msg','修改失败');
    	}
    	
    	return redirect('/admin/goods/type/list');
    }

    //执行删除的操作
    public function del($id)
    {
    	try{
    		DB::beginTransaction();

    		//删除商品类型
    		$this->delData($this->type,$id);
    		//删除类型属性
    		$this->delData($this->attr,$id, 'cate_id');

    		\Log::info('商品类型删除成功');
    		DB::commit();
    	}catch(\Exception $e){
    		DB::rollback();

    		\Log::info('商品类型删除失败'.$e->getMessage());
    	}

    	return redirect('/admin/goods/type/list');
    }
}
