<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class GoodsAttr extends Model
{
	const 
        PAGE_SIZE = 5,
        END       = true;
    //
    protected $table = "jy_goods_attr";

    public $timestamps = false;

    //获取属性列表
    public function getList($where=[])
    {
    	$list = self::select('jy_goods_attr.id','attr_name','jy_goods_type.type_name','input_type','attr_value','jy_goods_attr.status')
    			->leftJoin('jy_goods_type','jy_goods_attr.cate_id','=','jy_goods_type.id')
    			->where($where)
    			->paginate(self::PAGE_SIZE);

        return $list;
    }
}
