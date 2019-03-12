<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Role;
use App\Tools\ToolsAdmin;
use App\Model\AdminUsers;
use App\Model\UserRole;

use Illuminate\Support\Facades\DB;

use Log;

class AdminUsersController extends Controller
{
    
    /**
     *用户添加页面
     */
    public function create()
    {
    	$role = new Role();

    	$assign['roles'] = $role->getRoles();//获取角色列表

    	return view('admin.users.create', $assign);
    }

    /**
     *@desc 执行用户添加操作
     *@param $request array
     */
    public function store(Request $request)
    {
    	$params = $request->all();

    	//文件上传
    	$image_url = ToolsAdmin::uploadFile($params['image_url']);

    	try{
    		DB::beginTransaction();//开启事务

    		$adminUser = new AdminUsers();

    		//添加用户
    		$data = [
    			'username' => $params['username'] ?? '',
    			'password' => md5($params['password']) ?? '',
    			'image_url' => $image_url ?? '',
    			'is_super'  => $params['is_super'] ?? 1,
    			'status'    => $params['status'] ?? 1,
    			];

    		//dd($data);

    		$adminUser->addRecord($data);

    		$id = $adminUser->getMaxId();//获取最新添加的用户id

    		//添加用户和角色关联关系
    		$userRole = new UserRole();
    		$data1 = [
    			'user_id' => $id->id,
    			'role_id' => $params['role_id'] ?? 0
    		];
    		$userRole->addUserRole($data1);

    		DB::commit();//提交事务
    	}catch(\Exception $e){
    		DB::rollBack();//事务回滚

    		Log::error('用户添加失败'.$e->getMessage());

    		return redirect()->back();
    	}

    	return redirect('/admin/user/list');

    }

    /**
     *用户列表页面
     */
    public function list()
    {
    	$list = AdminUsers::getList();

    	return view('admin.users.list',['list' => $list]);
    }

    /**
     * 用户删除操作
     */
    public function delUser($id)
    {

    	try{
    		AdminUsers::del($id);//删除用户

    		$userRole = new UserRole();

    		$userRole->delByUserId($id);//删除用户角色关联关系;

    	}catch(\Exception $e){
    		Log::error('用户删除失败'.$e->getMessage());
    	}
    	

    	return redirect('/admin/user/list');
    }

    /**
     * 用户编辑页面
     * @param $id
     */
    public function edit($id)
    {
    	$role = new Role();

    	$assign['roles'] = $role->getRoles();//获取角色列表

    	$userRole = new UserRole();
    	$assign['role_id'] = $userRole->getByUserId($id)->role_id ?? 0;//获取当前编辑用户的角色id

    	$assign['user'] = AdminUsers::getUserById($id);//获取用户的信息


    	return view('admin.users.edit',$assign);
    }

    /**
     * 执行用户的编辑操作
     */
    public function doEdit(Request $request)
    {
    	$params = $request->all();

    	$image_url = "";

    	if(!empty($params['image_url'])){
    		$image_url = ToolsAdmin::uploadFile($params['image_url']);
    	}

    	try{
    		DB::beginTransaction();//开启事务

    		$adminUser = new AdminUsers();

    		//用户修改的操作
    		$data = [
    			'username' => $params['username'] ?? '',
    			'is_super'  => $params['is_super'] ?? 1,
    			'status'    => $params['status'] ?? 1,
    			];

    		if(!empty($image_url)){
    			$data['image_url'] = $image_url;
    		}

    		
    		$adminUser->updateUser($data,$params['id']);

    		//添加用户和角色关联关系
    		$userRole = new UserRole();

    		//先删除之前的关联记录
    		$userRole->delByUserId($params['id']);

    		$data1 = [
    			'user_id' => $params['id'],
    			'role_id' => $params['role_id'] ?? 0
    		];
    		$userRole->addUserRole($data1);

    		DB::commit();//提交事务
    	}catch(\Exception $e){
    		DB::rollBack();//事务回滚

    		Log::error('用户添加失败'.$e->getMessage());

    		return redirect()->back()->with('error_msg',$e->getMessage());
    	}

    	return redirect("/admin/user/list");
    }

}
