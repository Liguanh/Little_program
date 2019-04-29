<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Events\RegisterSuccess;

class TestController extends Controller
{
    //

    public function add()
    {
    	return view('admin.test.test');
    }


    public function store(Request $request)
    {

    	$this->validate($request, [
    			'position_name'  => 'required',
    			'position_desc'  => 'boolean'
    		]);

    	//测试一下事件系统机制的调用
    	//event(new RegisterSuccess(['user_id'=>1]));

    	//注册成功的事件
        \Event::fire(new \App\Events\RegisterSuccess(['user_id'=>1,'bonus_id'=>1]));

    }
}
