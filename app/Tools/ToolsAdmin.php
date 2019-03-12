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

		//文件上传的目录
		$basePath = 'uploads/'.date("Y-m-d",time());

		//目录不存在
		if(!file_exists($basePath)){
			@mkdir($basePath, 755, true);
		}

		//文件名字
		$filename = "/".date("YmdHis",time()).rand(0,10000).".".$files->extension();

		@move_uploaded_file($files->path(), $basePath.$filename);//执行文件的上传

		return '/'.$basePath.$filename;
	}
	
}