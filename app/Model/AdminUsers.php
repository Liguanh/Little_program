<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class AdminUsers extends Model
{
    //制定数据表的名字
    protected $table = "admin_users";

    //public $timestamps = true;

    /**
     * @desc  通过用户名获取用户[状态正常的]
     * @param  $username 
     * @return array
     */
    public static function getUserByName($username)
    {
    	$userInfo = self::where('username',$username)
    					->where('status',1)
    					->first();

    	return $userInfo;
    }
}
