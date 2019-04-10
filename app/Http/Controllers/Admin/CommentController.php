<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Comment;

class CommentController extends Controller
{
    //商品评论列表
    public function list()
    {
    	$comment = new Comment();

    	$assign['comment'] = $comment->getCommentList();

    	return view('admin.comment.list',$assign);
    }

    //删除
    public function del($id)
    {
    	$comment = new Comment();

    	$this->delData($comment,$id);

    	return redirect('/admin/goods/comment/list');
    }
}
