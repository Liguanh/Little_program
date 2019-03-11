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
}
