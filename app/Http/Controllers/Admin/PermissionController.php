<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Permissions;

class PermissionController extends Controller
{
    //
    /**
     * @权限列表页面
     */
    public function list()
    {
    	return view('admin.permission.list');
    }

    /**
     * 获取权限列表
     * @param  $fid int default 0
     * @return json
     */
    public function getPermissionList($fid=0)
    {
    	$return = [
    		'code' => 2000,
    		'msg'  => '获取列表成功',
    		'data' => []
    	];

    	$list = Permissions::getListByFid($fid);//获取权限列表

    	$return['data'] = $list;

    	return json_encode($return);
    }

    /**
     * @权限添加页面
     */
    public function create()
    {
    	$list = Permissions::getListByFid();//获取权限列表

    	return view('admin.permission.create',['permissions'=>$list]);
    }

    /**
     * 执行权限添加功能
     */
    public function doCreate(Request $request)
    {
    	$params  = $request->all();

    	$data = [
    		'fid' => $params['fid'],
    		'name' => $params['name'],
    		'url'  => $params['url'],
    		'is_menu' => $params['is_menu'],
    		'sort' => $params['sort']
    	];

    	$res = Permissions::addRecord($data);//执行添加的操作

    	if($res){
    		return redirect('/admin/permission/list');
    	}else{
    		return redirect()->back();
    	}
    }

    /**
     * 删除的方法
     */
    public function del($id)
    {

    	$res = Permissions::delRecord($id);

    	if($res){
    		$return = [
    		'code' => 2000,
    		'msg'  => '删除成功',
    		];
    	}else{
    		$return = [
    		'code' => 4000,
    		'msg'  => '删除失败',
    		];
    	}
    	

    	return json_encode($return);
    }
}
