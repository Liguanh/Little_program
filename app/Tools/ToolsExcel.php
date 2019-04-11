<?php

namespace App\Tools;

use Excel;
error_reporting( E_ALL&~E_NOTICE );
/**
 * Excel 文件批量导入导出的功能
 */
class ToolsExcel 
{

	//excel文件的导入的功能
	public static function import($files)
	{
		//dd($files);
		if(empty($files)){
			return false;
		}

		$data = Excel::load($files->path(), function($reader){
		})->toArray();

		return $data;
	}
}