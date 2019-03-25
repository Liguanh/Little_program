<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Comment;

class CommentController extends Controller
{
    //添加评论的接口
    public function add(Request $request)
    {
    	$params = $request->all();

    	$return = [
    		'code' => 2000,
    		'msg'  => "评论成功"
    	];

    	$data = [
    		'novel_id' => $params['novel_id'],
    		'user_id'  => isset($params['user_id']) ?? 1,
    		'content'  => $params['content'],
    		'status'   => 1,
    		'created_at' => date('Y-m-d H:i:s',time())
    	];

    	$comment = new Comment();

    	$res = $comment->addComment($data);

    	if(!$res){
    		$return = [
    			'code' => 4005,
    			'msg'  => "评论失败"
    		];
    	}

    	return json_encode($return);
    }

    //获取评论列表的接口
    public function list($novelId)
    {
    	$comment = new Comment();

    	$list = $comment->getApiList($novelId);

    	$return = [
    		'code' => 2000,
    		'msg'  => "评论成功",
    		'data' => $list,
    	];

    	return json_encode($return);
    }

    //评论删除的接口
    public function del($id)
    {
    	$return = [
    		'code' => 2000,
    		'msg'  => "删除评论成功"
    	];

    	$comment = new Comment();
    	$res = $comment->delRecord($id);

    	if(!$res){
    		$return = [
    			'code' => 4001,
    			'msg'  => "删除评论失败"
    		];
    	}

    	return json_encode($return);
    }
}
