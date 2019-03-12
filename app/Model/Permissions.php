<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

use App\Tools\ToolsAdmin;

class Permissions extends Model
{
    //指定表名
    protected $table = "Permissions";

    const 
    	IS_MENU = 1, //是菜单
    	IS_NO_MENU = 2, //不是菜单

    	END = true;
    
    /**
     * 获取左侧菜单栏的权限数据
     * @return array
     */
    public static function getMeuns()
    {
    	$permissions = self::select('id','fid','name','url')
    				->where('is_menu',self::IS_MENU)
    				->orderBy('sort')
    				->get()
    				->toArray();

        $leftMenu = ToolsAdmin::buildTree($permissions);
    	return $leftMenu;
    }

    /**
     * 获取所有的权限节点
     */
    public static function getAllPermissions()
    {
        $permissions = self::select('id','fid','name','url')
                        ->orderBy('sort')
                        ->get()
                        ->toArray();

        $permissions = ToolsAdmin::buildTree($permissions);

        return $permissions;
    }

    /**
     * 获取权限列表
     * @return array
     */
    public static function getListByFid($fid=0)
    {
    	$list = self::select('id', 'fid','name','url','is_menu','sort')
    				->where('fid',$fid)
    				->orderBy('sort')
    				->get()
    				->toArray();

    	return $list;
    }

    /**
     * 添加权限
     * @return bool
     */
    public static function addRecord($data)
    {

    	return self::insert($data);
    }

    /**
     * 删除权限的函数
     */
    public static function delRecord($id)
    {
    	return self::where('id',$id)->delete();
    }

   
}
