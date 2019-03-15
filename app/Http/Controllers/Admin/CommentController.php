<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Comment;

class CommentController extends Controller
{
    //
	//列表
    public function list()
    {
    	return view('admin.comment.list');
    }

    //获取评论的数据
    public function getComment()
    {
    	$return  = [
    		'code' => 2000,
    		'msg'  => '成功'
    	];

    	$comment = new Comment();

    	$data = $comment->getLists();

    	$return['data']=[
    		'total_page' => $data['last_page'],
    		'page' => $data['current_page'],
    		'comment' => $data['data']
    	];

    	return json_encode($return);
    }

    //审核
    public function check($id)
    {
    	$comment = new Comment();

    	$comment->checkComment($id);

    	$return  = [
    		'code' => 2000,
    		'msg'  => '成功'
    	];

    	return json_encode($return);
    }

    //删除
    public function del($id)
    {
    	$comment = new Comment();

    	$comment->delRecord($id);

    	$return  = [
    		'code' => 2000,
    		'msg'  => '成功'
    	];

    	return json_encode($return);
    }
}
