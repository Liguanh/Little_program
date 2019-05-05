<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class QQController extends Controller
{
	protected $qq = null;

	public function __construct()
	{
		$this->qq = \Config::get('qq');

	}

    //QQ地址回调
    public function callback(Request $request)
    {
    	$params = $request->all();
    	\Log::info('Step1: QQ第三方登陆获取code授权码:',[$params]);

    	//Step1:  点击链接地址获取授权码
    	if(isset($params['code'])){//code授权码存在

    		$code = $params['code'];//code授权码

    		//获取token的url地址信息
    		$tokenUrl = sprintf($this->qq['token_url'],$this->qq['app_id'],$this->qq['app_key'],$code,urlencode($this->qq['redirect_url']));

    		\Log::info('QQ第三方登陆获取access_token的url地址', ['access_token_url'=>$tokenUrl]);

    		//access_token请求过来的值，进行数组处理
    		$accessTokenData = [];
    		$response = file_get_contents($tokenUrl);

    		parse_str($response,$accessTokenData);

    		\Log::info('请求access_token返回的内容',[$accessTokenData]);

    	}
    }
}
