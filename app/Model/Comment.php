<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    //
    protected $table="jy_comment";

    const  
    	GOODS_TYPE = 1,//商品评论
    	END        = true;


    //商品评论的列表
    public function getCommentList($where = [])
    {
    	$comment  = self::select('jy_comment.id','goods_name','username','jy_user.image_url','jy_comment.content')
    				->leftJoin('jy_goods','jy_comment.comment_id','=','jy_goods.id')
    				->leftJoin('jy_user','jy_comment.user_id','=','jy_user.id')
    				->where('type', self::GOODS_TYPE)
    				->where($where)
    				->paginate(5);

    	return $comment;
    }
}
