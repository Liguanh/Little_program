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

     /**
     * @desc  通过id获取用户
     * @param  $id 
     * @return array
     */
    public static function getUserById($id)
    {
        $userInfo = self::where('id',$id)
                        ->first();

        return $userInfo;
    }

    /**
     * 用户保存
     * @param $data array 
     * @return array
     */
    public function addRecord($data)
    {
        return  self::insert($data);
    }

    /**
     * 修改用户信息
     */
    public function updateUser($data, $id)
    {

        return self::where('id',$id)->update($data);
    }

    /**
     * 获取最新id
     */
    public function getMaxId()
    {
        return self::select('id')->orderBy('id','desc')->first();
    }

    

     /**
     * 获取用户列表信息
     */
    public static function getList()
    {
        return self::paginate(1);
    }

    /**
     * 用户删除
     * @param id
     */
    public static function del($id)
    {
        return self::where('id',$id)->delete();
    }
}
