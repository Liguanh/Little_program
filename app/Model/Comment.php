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

    //添加评论
    public function addComment($data)
    {
        return self::insert($data);
    }

    //获取小说评论列表
    public function getApiList($novelId)
    {
        return self::select('comment.id','user.username','content','comment.created_at')
                ->leftJoin('user','user.id','=','comment.user_id')
                ->where('comment.novel_id',$novelId)
                ->orderBy('comment.id','desc')
                ->get()
                ->toArray();
    }
}
