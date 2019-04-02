<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Ad extends Model
{
    //
    protected $table = "jy_ad";

    public $timestamps = false;

    //获取广告的列表
    public function getAdList()
    {
    	return self::select('jy_ad.*','jy_ad_position.position_name')
    			->leftJoin('jy_ad_position','jy_ad.position_id','=','jy_ad_position.id')
    			->paginate(2);
    }
}
