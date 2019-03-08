<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LoginController extends Controller
{
    //

	/**
	 * 登陆页面
	 */
    public function index()
    {
    	return view('admin.login');
    }

    /**
     * 执行登陆的页面
     */
    public function doLogin(Request $request)
    {

    }
}
