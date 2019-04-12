<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Tools\ToolsAdmin;
use App\Model\Batch;

class BatchController extends Controller
{
    //批次的列表
    public function list()
    {
    	$batch = new Batch();

    	$assign['batch_list'] = $this->getPageList($batch);

    	return view('admin.batch.list', $assign);
    }
    //添加页面
    public function add()
    {
    	return view('admin.batch.add');
    }

    //执行添加批次
    public function store(Request $request)
    {
    	$params = $request->all();

    	$params = $this->delToken($params);

    	$params['file_path'] = ToolsAdmin::uploadFile($params['file_path'], false);
    	$params['status'] = 2;

    	$batch = new Batch();
    	$res = $this->storeData($batch, $params);


    	if(!$res){
    		return redirect()->back()->with('msg','添加批次失败');
    	}

    	return redirect('/admin/batch/list');
    }

    //执行批次
    public function doBatch($id)
    {
    	$batch = new Batch();
    	$batchInfo = $this->getDataInfo($batch, $id)->toArray();

    	$fileContent = file_get_contents(substr($batchInfo['file_path'], 1));



    	dd($fileContent);
    }
}
