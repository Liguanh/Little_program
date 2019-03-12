<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    //
    protected $table = "role";

    /**
     * 获取所有的角色列表
     */
    public function getRoles()
    {
    	return self::get()
    			->toArray();
    }

    /**
     * 角色删除
     */
    public function delRole($id)
    {
        return self::where('id',$id)->delete();
    }

    /**
     * 获取角色详情
     */
    public function getRoleById($id)
    {
        return self::where('id',$id)->first();
    }

    /**
     * 添加
     */
    public function addRole($data)
    {
        return self::insert($data);
    }
    
    /**
     * 角色编辑
     */
    public function updateRole($data, $id)
    {
        return self::where('id',$id)->update($data);
    }


    
}
