<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class ArticleContent extends Model
{
    //
    protected $table = "jy_article_content";
    public $timestamps = false;

    //添加操作
    public function doAdd($data)
    {
    	return self::insert($data);
    }

    public function doEdit($data, $aid)
    {
    	return self::where('a_id',$aid)->update($data);
    }

    //获取内容详情
    public function getInfo($id)
    {
    	return self::where('a_id',$id)->first();
    }

    //删除
    public function del($aid)
    {
    	return self::where('a_id',$aid)->delete();
    }
}
