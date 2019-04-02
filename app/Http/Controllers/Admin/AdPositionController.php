<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\AdPosition;

class AdPositionController extends Controller
{
    //广告位列表
    public function list()
    {
    	$position = new AdPosition();
    	$assign['position'] = $position->getList();

    	return view('admin.position.list',$assign);
    }

    //添加页面
    public function add()
    {
    	return view('admin.position.add');
    }

    //执行保存信息
    public function store(Request $request)
    {
    	$params = $request->all();

    	$params = $this->delToken($params);

    	$position = new AdPosition();

    	$res = $this->storeData($position, $params);

    	if(!$res){
    		return redirect()->back()->with('msg','广告位添加失败');
    	}

    	return redirect('/admin/position/list');
    }


    //编辑页面
    public function edit($id)
    {
    	$position = new AdPosition();

    	$assign['info'] = $this->getDataInfo($position, $id);

    	return view('admin.position.edit',$assign);
    }

    //执行编辑的操作
    public function doEdit(Request $request)
    {
    	$params = $request->all();

    	$params = $this->delToken($params);

    	$position = AdPosition::find($params['id']);

    	$res = $this->storeData($position, $params);

    	if(!$res){
    		return redirect()->back()->with('msg','广告位修改失败');
    	}

    	return redirect('/admin/position/list');
    }

    //执行删除的操作
    public function del($id)
    {
    	$position = new AdPosition();

    	$res = $position->del($id);

    	return redirect('/admin/position/list');
    }
}
