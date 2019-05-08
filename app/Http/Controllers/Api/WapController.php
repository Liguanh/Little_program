<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class WapController extends Controller
{
    //
    protected $wechat = null;

    public function __construct()
    {
    	$this->wechat = \Config::get('wechat');//获取微信的配置信息
    }

	//获取code码的网页授权地址
    public function getCode()
    {
    	$h5AuthUrl = sprintf($this->wechat['wap_code_url'], $this->wechat['app_id'],urlencode('http://www.shopyjr.com/api/wap/callback'));

    	\Log::info("微信第三方网页授权的地址",['h5_url'=> $h5AuthUrl]);

    	return view('wap.code',['h5_url'=>$h5AuthUrl]);
    }

    //网页授权回调
    public function callback(Request $request)
    {
    	$params = $request->all();

    	\Log::info('用户网页授权后回调信息:',[$params]);
    }
}
