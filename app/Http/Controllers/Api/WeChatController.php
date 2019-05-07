<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Tools\ToolsCurl;

class WeChatController extends Controller
{
    //
    protected $wechat = null;

    protected $redis = null;

    protected $accessTokenKey = "access_token_cache";//redis存储的token的key值

    public function __construct()
    {
    	$this->wechat = \Config::get('wechat');//获取微信的配置信息

    	$this->redis = new \Redis();

    	$this->redis->connect(env('REDIS_HOST'), env('REDIS_PORT'));
    }

    //微信公众号的入口路由
    public function index(Request $request)
    {
    	$params  = $request->all();

    	\Log::info('微信公众平台请求数据:',[$params]);

    	// $res = $this->checkSignature($params);//验证微信服务器请求签名的有效性

    	// if($res){
    	// 	echo $params['echostr'];
    	// 	exit;
    	// }else{
    	// 	echo "校验失败";
    	// 	exit;
    	// }

    	//获取微信公众号的自定义的菜单栏
    	$this->getSelfMenu();

        //接受用户请求过来的消息
        $postStr = isset($GLOBALS["HTTP_RAW_POST_DATA"]) ?? file_get_contents("php://input");
        \Log::info('用户发送的信息内容',[$postStr]);

    }


    //获取微信公众号的自定义菜单
    public function getSelfMenu()
    {
    	//获取access_token的值
    	$accessToken = $this->getAccessToken();

    	$menuUrl = sprintf($this->wechat['menu_url'], $accessToken);

    	\Log::info('获取微信公众号的自定义菜单接口的url地址',['menu_url'=> $menuUrl]);

    	//自定义菜单的内容
    	$button['button'] = [

    		[
    			'type' => "click",
    			'name' => "首页",
    			'key'  => "index"
    		],

    		[
    			'name' => "其他",
    			'sub_button' => [
    				[
    					'name' => '网站后台',
    					'type' => 'view',
    					'url'  => 'http://www.shopyjr.com/admin/login'

    				],
    				[
    					'name' => '小默记账',
    					'type' => 'miniprogram',
    					'url'  => 'http://mp.weixin.qq.com',
    					'appid' => 'wx142bcc28fd1f4a74',
    					'pagepath' => 'pages/home/home'
    				]
    			]
    		]

    	];

    	$res = ToolsCurl::httpCurl($menuUrl, "post", json_encode($button,JSON_UNESCAPED_UNICODE));

    	\Log::info('调用自定义菜单接口返回数据:', [$res]);


    	return $res;
    }


    //获取access_token的值
    public function getAccessToken()
    {
    	//获取缓存中的token值
    	$accessToken = $this->redis->get($this->accessTokenKey);

    	if(empty($accessToken)){
    		//请求获取access_token的接口
    		$accessTokenUrl = sprintf($this->wechat['access_token_url'], $this->wechat['app_id'],$this->wechat['app_secret']);

    		\Log::info('请求获取access_token的接口url地址',['access_token_url'=>$accessTokenUrl]);

    		//请求access_token;
    		$response = ToolsCurl::httpCurl($accessTokenUrl);

    		\Log::info('获取到的access_token接口返回的数据:',[$response]);

    		$accessToken = $response['access_token'];
    	}


    	return $accessToken;
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
