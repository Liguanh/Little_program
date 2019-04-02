<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class ArticleCategory extends Model
{
    //
    protected $table = "jy_article_category";

    public $timestamps = false;


    //获取分类列表的数据
    public function getCategoryList()
    {
    	return  self::get()->toArray();
    }

    //获取分类详情
    public function getInfo($id)
    {
    	return self::where('id',$id)->first();
    }

    //执行分类添加
    public function doAdd($data)
    {
    	return self::insertGetId($data);
    }

    //执行编辑操作
    public function doEdit($data, $id)
    {
    	return self::where('id',$id)->update($data);
    }


    //执行分类的删除操作
    public function del($id)
    {
    	return self::where("id",$id)->delete();
    }
}
