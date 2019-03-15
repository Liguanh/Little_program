<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Category;

class CategoryController extends Controller
{
    //

	//分类列表
    public function list()
    {
    	$category = new Category();

    	$assgin['categorys'] = $category->getLists();
    	return view('admin.category.list',$assgin);
    }

    //小说分类添加页面
    public function create()
    {
    	return view('admin.category.create');
    }

    //保存分类
    public function store(Request $request)
    {

    	$params = $request->all();

    	$data = [
    		'c_name' => $params['c_name'] ?? "",
    	];

    	$category = new Category();

    	$res = $category->addRecord($data);

    	if(!$res){
    		return redirect()->back();
    	}

    	return redirect('/admin/category/list');
    }

    //删除分类
    public function del($id)
    {

    	$category = new Category();

    	$category->delRecord($id);

    	return redirect('/admin/category/list');
    }
}
