<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Activity;

class ActivityController extends Controller
{
    //活动列表
    public function list()
    {
    	$activity = new Activity();

    	$assign['activites'] = $this->getDataList($activity);

    	return view('admin.activity.list',$assign);
    }

    //添加页面
    public function add()
    {
    	return view('admin.activity.add');
    }

    //保存的操作
    public function store(Request $request)
    {
    	$params = $request->all();

    	$params = $this->delToken($params);

    	//处理支付方式的配置信息，进行序列化
    	if(!empty($params['activity_config'])){
    		$activity_config = [];

    		$arr = explode('|', $params['activity_config']);

    		foreach ($arr as $key => $value) {

    			$arr1 = explode("=>", $value);

    			$activity_config[$arr1[0]] = $arr1[1];
    		}

    		$params['activity_config'] = serialize($activity_config);
    	}

    	$activity = new Activity();

    	$res = $this->storeData($activity, $params);

    	if(!$res){
    		return redirect()->back()->with('msg','添加活动失败');
    	}

    	return redirect('/admin/activity/list');

    }

    public function edit($id)
    {
    	$activity = new Activity();

    	$assign['info'] = $this->getDataInfo($activity, $id)->toArray();

    	$activity_config = unserialize($assign['info']['activity_config']);

    	$string =  "";
    	foreach ($activity_config as $key => $value) {
    		$string .= $key."=>".$value."|";
    	}

    	$assign['info']['activity_config'] = substr($string, 0,-1);

    	return view('admin.activity.edit', $assign);
    }

    public function save(Request $request)
    {

    }

    public function del($id)
    {
    	$activity = new Activity();

    	$this->delData($activity,$id);

    	return redirect('/admin/activity/list');
    }
}
