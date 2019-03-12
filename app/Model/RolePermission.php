<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class RolePermission extends Model
{
    //
    protected $table = "role_permissions";

    /**
     * 通过role_i删除角色权限的记录
     */
    public function delByRoleId($roleId)
    {
    	return self::where('role_id',$roleId)->delete();
    }

    /**
     * 通过用户角色的id获取所分配的所有权限节点id
     */
    public function getPermissionByRoleId($roleId)
    {
    	$data = self::select('p_id')
    	            ->where('role_id',$roleId)
    				->get()
    				->toArray();

    	$pids = [];

    	foreach ($data as $key => $value) {
    		$pids[] = $value['p_id'];
    	}

    	return $pids;
    }

    /**
     * 添加新的角色权限节点
     */
    public function addRolePermission($data)
    {
        return self::insert($data);
    }
}
