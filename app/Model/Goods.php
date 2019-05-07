<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Goods extends Model
{
    //
    protected $table = "jy_goods";

    public $timestamps = true;

    //通过关键字获取商品信息
    public function getGoodsByKeywords($keywords)
    {
    	$goodsInfo = self::select('goods_name','goods_sn','market_price','goods_num')
    						->where('goods_name','like', '%'.$keywords.'%')
    						->orWhere('goods_sn', 'like', '%'.$keywords.'%')
    						->first();


    	return $goodsInfo;
    }
}
