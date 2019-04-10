<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    //会员表
    protected $table = "jy_user";

    //获取详情
    public function getInfo($id)
    {
    	$info = self::select('*')
    			->leftJoin('jy_user_info','jy_user_info.user_id','=','jy_user.id')
    			->where('jy_user.id',$id)
    			->first();

    	return $info;
    }
}
