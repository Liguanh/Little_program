<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class AdPosition extends Model
{
    //
    protected $table = "jy_ad_position";

    public $timestamps = false;


    //执行添加操作
    public  function doAdd($data)
    {
    	return self::insert($data);
    }

    //获取广告位列表
    public function getList()
    {
    	return self::get()->toArray();
    }

    //执行删除的操作
    public function del($id)
    {
    	return self::where('id',$id)->delete();
    }
}
