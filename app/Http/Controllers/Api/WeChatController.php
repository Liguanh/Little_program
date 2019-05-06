<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class WeChatController extends Controller
{
    //
    protected $wechat = null;

    public function __construct()
    {
    	$this->wechat = \Config::get('wechat');//获取微信的配置信息
    }

    //微信公众号的入口路由
    public function index(Request $request)
    {
    	$params  = $request->all();

    	\Log::info('微信公众平台请求数据:',[$params]);

    	$res = $this->checkSignature($params);

    	if($res){
    		echo $params['echostr'];
    		exit;
    	}else{
    		echo "校验失败";
    		exit;
    	}

    }

    //验证微信服务器传输数据签名的有效性
    private function checkSignature($params)
    {

    	$signature = isset($params['signature']) ?? "";
    	$nonce = isset($params['nonce']) ?? null;
    	$timestamp = isset($params['timestamp']) ?? null;

    	$token = $this->wechat['token'];

    	$tmpArr = array($token,$timestamp,$nonce);//组装成数组

    	sort($tmpArr, SORT_STRING);//对数组进行sort排序

    	$tmpStr = implode($tmpArr);
    	$tmpStr = sha1($tmpStr);

    	if($tmpStr !=$signature){
    		return false;
    	}

    	return true;
    }
}
