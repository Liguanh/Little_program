<?php

namespace App\Study;

use Illuminate\Database\Eloquent\Model;

class BsBonusRecord extends Model
{
    //用户抢到红包的记录表
    protected $table = "bs_bonus_record";


    /**
     * @desc 创建一条记录
     * @data  array 
     */
    public static function createRecord($data)
    {

    	$res = self::insert($data);

    	return $res;
    }

    /**
     * 获取最大金额的红包
     * @param $bonusId int 
     */
    public static function getMaxBonus($bonusId)
    {

    	$res = self::select('id')
    	    ->where('bonus_id', $bonusId)
    		->orderBy('money', 'desc')
    		->first();

    	return $res;
    }

    /**
     * @desc 更新抢红包的记录
     */
    public static function updateBonusRecord($data, $id)
    {

    	return self::where('id',$id)->update($data);
    }

    /**
     * 通过用户id和红包id获取红包的记录
     */
    public static function getRecordById($userId, $bonusId)
    {
    	return self::where('user_id',$userId)
    			->where('bonus_id',$bonusId)
    			->first();
    }
}
