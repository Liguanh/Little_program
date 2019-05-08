<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class WapController extends Controller
{
    //
    protected $wechat = null;

    protected $redis = null;

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

    	if(!empty($params['code'])){

    		$pageAccessTokenKey = "page_access_token";

    		//if()

    		$pageTokenUrl = sprintf($this->wechat['page_access_token_url'],$this->wechat['app_id'],$this->wechat['app_secret'], $params['code']);

    		\Log::info('获取网页授权access_token的url地址',['page_token_url'=>$pageTokenUrl]);


    		$response = file_get_contents($pageTokenUrl);

    		$response = json_decode($response, true);

    		\Log::info("获取网页access_token返回的数据",[$response]);


    		if(isset($response['access_token'])){

    			$userInfoUrl = sprintf($this->wechat['user_info_url'], $response['access_token'], $response['openid']);

    			\Log::info('获取用户信息的url地址',['user_info_url'=>$userInfoUrl]);


    			$userInfo = file_get_contents($userInfoUrl);

    			$userInfo = json_decode($userInfo, true);

    			\Log::info('获取用户信息返回的数据',[$userInfo]);
    		}

    	}
    }


    public function index(Request $request)
    {
    	$params = $request->all();

    	\Log::info('参数信息',[$params]);
    }
}
