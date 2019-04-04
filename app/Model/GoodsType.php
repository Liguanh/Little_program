<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class GoodsType extends Model
{
    //
    protected $table = "jy_goods_type";

    public $timestamps = false;

    const 
    	USE_ABLE = 1,//可用
    	USE_DISABLE = 2,//禁用
    	END = TRUE;
}
