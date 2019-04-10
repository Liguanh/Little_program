<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class GoodsAttr extends Model
{
	const 
        PAGE_SIZE = 5,
        INPUT_HANDEL = 1,//手动录入
        INPUT_LIST   = 2, //列表录入
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

    //获取手动录入的属性
    public function getAttrHandle($where=[])
    {
        return self::select('id','attr_name')->where($where)->where('input_type',self::INPUT_HANDEL)->get()->toArray();
    }

    //获取列表选取的属性
    public function getAttrList($where=[])
    {
        return self::select('id','attr_name','attr_value')
                ->where($where)
                ->where('input_type', self::INPUT_LIST)
                ->get()
                ->toArray();
    }

    //获取sku属性列表的值
    public function getAttrValue($where=[])
    {
        return self::select('attr_value')
                    ->where('id',$id)
                    ->first();
    }
}
