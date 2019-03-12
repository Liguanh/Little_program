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
    
}
