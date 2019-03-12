<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Role;
use App\Model\UserRole;
use App\Model\RolePermission;
use App\Model\Permissions;

use Illuminate\Support\Facades\DB;
use Log;

class RoleController extends Controller
{
    //角色列表
    public function list()
    {
    	$roles = new Role();

    	$assign['role_list'] = $roles->getRoles();

    	return view('admin.roles.list',$assign);
    }

    /**
     * 角色删除page页
     */
    public function delRole($id)
    {
    	try{
    		DB::beginTransaction();
    		$role = new Role();
    		$userRole = new UserRole();
    		$rolePer = new RolePermission();

    		//删除角色记录
    		$role->delRole($id);

    		//删除当前角色用户角色记录
    		$userRole->delByRoleId($id);

    	    //删除当前角色的角色权限记录
    	    $rolePer->delByRoleId($id);

    	    DB::commit();
    	}catch(\Exception $e){
    		DB::rollBack();

    		Log::error('角色删除失败'.$e->getMessage());
    	}

    	return redirect('/admin/role/list');
    }

    /**
     * 创建角色页面
     */
    public function create()
    {
    	return view('admin.roles.create');
    }

    /**
     * @desc 执行角色添加操作
     */
    public function store(Request $request)
    {

    	$params = $request->all();

    	$role = new Role();

    	$data = [
			'role_name' => $params['role_name'] ?? "",
    		'role_desc' => $params['role_desc'] ?? "",
    	];

    	$res = $role->addRole($data);

    	//执行失败
    	if(!$res){
    		return redirect()->back();
    	}
    	return redirect('/admin/role/list');
    }

    /**
     * 角色编辑
     */
    public function edit($id)
    {
    	$role = new Role();
    	$assign['role'] = $role->getRoleById($id);
    	return view('admin.roles.edit', $assign);
    }

    /**
     * 执行角色编辑
     */
    public function doEdit(Request $request)
    {
    	$params = $request->all();

    	$data = [
    		'role_name' => $params['role_name'] ?? "",
    		'role_desc' => $params['role_desc'] ?? "",
    	];

    	$role = new Role();

    	$res = $role->updateRole($data, $params['id']);

    	//执行失败
    	if(!$res){
    		return redirect()->back();
    	}
    	return redirect('/admin/role/list');
    }

    /**
     * 编辑角色权限的页面
     */
    public function rolePermission($roleId)
    {
    	$role = new Role();
    	$roleP = new RolePermission();

    	$assign['role'] = $role->getRoleById($roleId);//获取角色信息

    	$assign['permissions']  = Permissions::getAllPermissions();//获取所有的权限节点

    	//通过用户角色的id获取所分配的所有权限节点id
    	$assign['p_ids'] = $roleP->getPermissionByRoleId($assign['role']->id);

    	// dd($assign);

    	return view('admin.roles.permissions',$assign);
    }

    /**
     * 保存角色和权限的节点信息
     */
    public function saveRolePermission(Request $request)
    {

    	$params = $request->all();


    	try{

    		$roleP = new RolePermission();

    		//先删除原有的权限节点数据
    		$roleP->delByRoleId($params['role_id']);

    		//添加新的节点数据
    		$data = [];

    		foreach ($params['permissions'] as $key => $value) {
    			$data[$key] = [
    				'role_id' => $params['role_id'],
    				'p_id'    => $value
    			];
    		}

    		$roleP->addRolePermission($data);

    	}catch(\Exception $e){
    		Log::error('保存失败'.$e->getMessage());

    		return redirect()->back();
    	}

    	return redirect('/admin/role/list');
    }
}
