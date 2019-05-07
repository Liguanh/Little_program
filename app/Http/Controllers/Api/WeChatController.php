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

        //接受微信服务器发送过来的xml的数据
        $postStr = isset($GLOBALS["HTTP_RAW_POST_DATA"]) ? $GLOBALS["HTTP_RAW_POST_DATA"] :file_get_contents("php://input");
        \Log::info('用户发送的信息内容',[$postStr]);

        //自定义消息分发记录
        $this->responseMsg($postStr);

    }

    //自定义消息分发回复
    public function responseMsg($postStr)
    {
        if(!empty($postStr)){
            //解析xml的内容
            libxml_disable_entity_loader(true);
            $postObj = simplexml_load_string($postStr, 'SimpleXMLElement', LIBXML_NOCDATA);

            $fromUserName = $postObj->FromUserName;//发送者
            $toUserName   = $postObj->ToUserName;//公众号id
            $msgType = $postObj->MsgType;

            $keywords = trim($postObj->Content);

            \Log::info('记录用户发送过来的消息',[$fromUserName,$toUserName,$msgType,$keywords]);

            //回复文本消息的模板
            $textTpl = "<xml>
                            <ToUserName><![CDATA[%s]]></ToUserName>
                            <FromUserName><![CDATA[%s]]></FromUserName>
                            <CreateTime>%s</CreateTime>
                            <MsgType><![CDATA[%s]]></MsgType>
                            <Content><![CDATA[%s]]></Content>
                        </xml>"

            //回复的消息内容
            $reponseMsg = sprintf($textTpl, $fromUserName, $toUserName, time(), 'text', $keywords.",乖乖");

            echo $responseMsg;

        }else{
            echo "please input something";
            exit;
        }

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
