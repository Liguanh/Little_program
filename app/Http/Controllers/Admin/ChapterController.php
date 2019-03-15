<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Chapter;

class ChapterController extends Controller
{
    //
	//小说章节添加页面
    public function create($id)
    {
    	$assign['novel_id'] = $id;

    	return view('admin.chapter.create',$assign);
    }

    //保存章节
    public function store(Request $request)
    {
    	$params = $request->all();

    	$chapter = new Chapter();

    	unset($params['_token']);

    	$res = $chapter->addRecord($params);

    	if(!$res){
    		return redirect('/admin/chapter/add/'+$params['novel_id']);
    	}

    	return redirect('/admin/chapter/list');
    }

    //获取章节列表
    public function list($novelId = 0)
    {
    	$chapter = new Chapter();

    	$assign['chapter_list'] = $chapter->getLists($novelId);


    	return view('admin.chapter.list', $assign);
    }

    //编辑页面
    public function edit($id)
    {
    	$chapter = new Chapter();

    	$assign['chapter'] = $chapter->getChapter($id);

    	return view('admin.chapter.edit',$assign);
    }

    //执行编辑
    public function doEdit(Request $request)
    {
    	$params = $request->all();

    	$chapter = new Chapter();
    	$id = $params['id'];//获取主键id

    	unset($params['_token']);

    	$res = $chapter->editRecord($params,$id);

    	if(!$res){
    		return redirect('/admin/chapter/edit/'+$params['novel_id']);
    	}

    	return redirect('/admin/chapter/list/'.$params['novel_id']);
    }

    //章节删除
    public function del($id)
    {
    	$chapter = new Chapter();

    	$chapter->delRecord($id);

    	return redirect('/admin/chapter/list');
    }
}
