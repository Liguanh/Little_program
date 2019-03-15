<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    //
    protected $table="comment";

    //获取评论列表
    public function getLists()
    {
    	return self::select('comment.id','novel.name','user.username','content','comment.status')
		    		->leftJoin('novel','novel.id','=','comment.novel_id')
		    		->leftJoin('user','user.id','=','comment.user_id')
		    		->orderBy('comment.id','desc')
		    		->paginate(5)
		    		->toArray();
    }


    public function checkComment($id)
    {
    	return self::where('id',$id)->where('status',1)->update(['status'=>2]);
    }

    public function delRecord($id)
    {
    	return self::where('id',$id)->delete();
    }
}
