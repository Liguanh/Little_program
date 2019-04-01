<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    //
    protected $table="jy_brand";

    public $timestamps = false;

    //获取品牌列表数据
    public static function getList()
    {
    	return self::get()->toArray();
    }


    //获取品牌的详情
    public static function getInfo($id)
    {
    	return self::where('id',$id)->first();
    }


    //添加商品品牌
    public static function create($data)
    {
    	return self::insert($data);
    }

    //执行修改的操作
    public static function doUpdate($data, $id)
    {
    	return self::where('id',$id)->update($data);
    }

    //执行删除的操作
    public static function del($id)
    {
    	return self::where('id',$id)->delete();
    }


}
