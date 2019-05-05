<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class QQController extends Controller
{
    //QQ地址回调
    public function callback(Request $request)
    {
    	$params = $request->all();

    	\Log::info('QQ第三方登陆地址回调',[$params]);
    }
}
