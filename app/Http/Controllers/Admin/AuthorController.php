<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Author;

class AuthorController extends Controller
{
    //作者列表
    public function list()
    {
    	$author = new Author();

    	$assign['authors'] = $author->getLists();

    	return view('admin.author.list', $assign);
    }

    /**
     * 作者添加页面
     */
    public function create()
    {
    	return view('admin.author.create');
    }

    //执行作者添加
    public function store(Request $request)
    {
    	$params = $request->all();

    	$author = new Author();

    	$data = [
    		'author_name'  => $params['author_name'] ?? "",
    		'author_desc'  => $params['author_desc'] ?? ""
    	];

    	$res =  $author->addRecord($data);

    	if(!$res){
    		return redirect()->back();
    	}

    	return redirect('/admin/author/list');
    }

    //小说删除操作
    public function del($id)
    {
    	$author = new Author();

    	$author->delRecord($id);

    	return redirect('/admin/author/list');
    }
}
