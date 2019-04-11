<?php

namespace App\Tools;

/**
 * 公共方法类
 */
class ToolsAdmin
{
	
	/**
	 * 无限级分类的数据组装函数
	 * @param $array $data
	 * @param $fid 父类id
	 */
	public static function buildTree($data, $fid=0)
	{
		if(empty($data)){
			return [];
		}

		//dd($data);

		static $menus = [];//定义一个静态变量，用来存储无限级分类的数据

		foreach ($data as $key => $value) {

			//dd($value);
			
			if($value['fid'] == $fid){//当前循环的内容中fid是否等于函数fid参数

				if(!isset($menus[$fid])){//如果数据没有fid的key

					$menus[$value['id']] = $value;
				}else{

					$menus[$fid]['son'][$value['id']] = $value;
				}

				//删除已经添加过得数据
				unset($data[$key]);

				self::buildTree($data,$value['id']);//执行递归调用

			}
		}

		return $menus;
	}

	//创建无限级分类树的结构
	public static function buildTreeString($data,$fid=0, $level=0,$fKey="fid")
	{

		if(empty($data)){
			return [];
		}


		static $tree = [];

		foreach ($data as $key => $value) {
				
			//判断当前的父类id是否递归调用传过来的id
			if($value[$fKey] == $fid){

				$value['level'] = $level;
				$tree[] = $value;

				unset($data[$key]);

				self::buildTreeString($data, $value['id'],$level+1, $fKey);
			}
		}

		return $tree;
	}

	/**
	 * 文件上传函数
	 * @param $files $object
	 * @return string url
	 */
	public static function uploadFile($files)
	{
		//参数为空
		if(empty($files)){
			return "";
		}

		//oss文件上传
		$oss = new ToolsOss();

		$url =  $oss->putFile($files);

		return $url;

		// //文件上传的目录
		// $basePath = 'uploads/'.date("Y-m-d",time());

		// //目录不存在
		// if(!file_exists($basePath)){
		// 	@mkdir($basePath, 755, true);
		// }

		// //文件名字
		// $filename = "/".date("YmdHis",time()).rand(0,10000).".".$files->extension();

		// @move_uploaded_file($files->path(), $basePath.$filename);//执行文件的上传

		// return '/'.$basePath.$filename;
	}

	/**
	 * 获取用户所有权限的主键id
	 * 1、根据用户userId 查询角色id
	 * 2、根据角色id查询权限id
	 */

	public static function getUserPermissionIds($userId)
	{

		if(!isset($userId) || empty($userId)){
			return [];
		}

		$userRole =  new \App\Model\UserRole();

		$roles = $userRole->getByUserId($userId);//根据用户id去查询角色id

		//角色id没有不存在
		if( empty($roles) ){
			return [];	
		}	


		$roleP = new \App\Model\RolePermission();

		$pids = $roleP->getPermissionByRoleId($roles->role_id);//根据用户的角色id去调用权限id集合

		return $pids;
	}

	/**
	 * 获取当前登录用户的所有的权限url地址
	 */
	public static function getUrlsByUserId($userId)
	{
		$pids = self::getUserPermissionIds($userId); //获取所有权限节点id


		$urls = \App\Model\Permissions::getUrlsByIds($pids);//根据权限节点id获取所有的权限的url地址


		return $urls;
	}

	//生成货号
	public static function buildGoodsSn($string = 16)
	{
		return "JY".date("YmdH",time()).rand(1,1000);
	}
	
}