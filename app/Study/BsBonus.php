<?php

namespace App\Study;

use Illuminate\Database\Eloquent\Model;

class BsBonus extends Model
{
    //红包表
    protected $table="bs_bonus";

    /**
     * @desc 获取红包信息
     * @param $id
     */
    public static function getBonusInfo($id)
    {

    	$bonus = self::where('id',$id)->first();


    	return $bonus;
    }

    /**
     * @desc 更新红包信息
     */
    public static function updateBonusInfo($data, $id)
    {
    	return self::where('id',$id)->update($data);
    }

    //添加红包的函数
    public static function addBonus($data)
    {
        $res = self::insert($data);

        return $res;
    }

    //获取红包列表
    public static function getBonusList()
    {
        $list = self::orderBy('id','desc')
                    ->get()
                    ->toArray();

        return $list;
    }
}
