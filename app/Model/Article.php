<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    //
    protected $table = "jy_article";

    //执行添加操作
    public function doAdd($data)
    {
    	return self::insertGetId($data);
    }

    //修改操作
    public function doEdit($data, $id)
    {
    	return self::where('id',$id)->update($data);
    }

    //获取文章列表
    public function getList()
    {
    	$list = self::select('jy_article.id','jy_article_category.cate_name','title','publish_at','clicks','status')
    			->leftJoin('jy_article_category', 'jy_article.cate_id','=','jy_article_category.id')
    			->paginate(2);


    	return $list;
    }

    //获取详情信息
    public function getInfo($id)
    {
    	return self::where('id',$id)->first();
    }

    public function del($id)
    {
    	return self::where('id',$id)->delete();
    }
}
