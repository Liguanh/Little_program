<?php
/**
 * Created by PhpStorm.
 * User: linguanghui
 * Date: 18/10/31
 * Time: 下午6:41
 */

namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use App\Tools\ToolCurl;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class WechatController extends Controller
{
    protected $wechat = null;
    protected $redis  = null;

    public function __construct()
    {
        $this->wechat = \Config::get('wechat');

        $this->redis = new \Redis();
        $this->redis->connect(env('REDIS_HOST'),env('REDIS_PORT'));
    }

    /**
     * @desc  微信公众号二次开发的信息
     * @param Request $request
     */
    public function replayData(Request $request)
    {
        $params = $request->all();

        \Log::info('微信公众号二次开发数据',[$params]);

        $res = $this->checkSignature($params);

        if($res){
            \Log::info('令牌校验成功');
            echo $params['echostr'];
            exit;
        }
        //获取自定义菜单的内容
        $this->getSelfMenu();

        //$postStr = $GLOBALS["HTTP_RAW_POST_DATA"];
        $postStr = isset($GLOBALS['HTTP_RAW_POST_DATA']) ? $GLOBALS['HTTP_RAW_POST_DATA'] : file_get_contents("php://input");
        $this->getWeChatMsg($postStr);

    }



    /**
     * @desc 获取自定义菜单信息
     */
    public function getSelfMenu()
    {
        $accessToken = $this->getAccessToken();

        $menuUrl = sprintf($this->wechat['menu_url'],$accessToken);

        \Log::info('获取自定义菜单栏的url地址',['menu_url'=>$menuUrl]);

        $button['button'] = [
            [
                'type' => "click",
                'name' => "首页",
                'key'  => "index"
            ],
            [
                'name' => "小默记账",
                'type' => "miniprogram",
                'url'  => "http://mp.weixin.qq.com",
                'appid' => "wx142bcc28fd1f4a74",
                'pagepath' => 'pages/home/home'
            ],
            [
                'name' => "图片发送",
                'sub_button' => [
                    [
                        'type' => "pic_photo_or_album",
                        "name" =>  "拍照或者相册发图",
                        "key" => "rselfmenu_1_1",
                    ],
                    [
                        'type' => "pic_weixin",
                        "name" =>  "微信相册",
                        "key" => "rselfmenu_1_3",
                    ],
                ]
            ]
        ];

        $res = ToolCurl::httpCurl($menuUrl,'post', json_encode($button,JSON_UNESCAPED_UNICODE));

        \Log::info('自定义菜单数据',[$res]);

        return $res;
    }

    /**
     * @desc 自定义消息回复
     * @param $postStr
     */
    public function getWeChatMsg($postStr)
    {
        //extract post data
        if (!empty($postStr)){
            /* libxml_disable_entity_loader is to prevent XML eXternal Entity Injection,
               the best way is to check the validity of xml by yourself */
            libxml_disable_entity_loader(true);
            $postObj = simplexml_load_string($postStr, 'SimpleXMLElement', LIBXML_NOCDATA);

            $msgType = $postObj->MsgType;

            switch ($msgType) {
                case "text":
                    $this->responseTextMsg($postObj);
                    break;

                case "image":
                    $this->responseImageMsg($postObj);
                    break;

            }

        }else {
            echo "";
            exit;
        }

    }

    /**
     * @desc  响应文本信息
     * @param $postObj
     */
    public function responseTextMsg($postObj)
    {
        $fromUsername = $postObj->FromUserName;
        $toUsername = $postObj->ToUserName;
        $keyword = trim($postObj->Content);//内容
        $time = time();
        $msgType = $postObj->MsgType;

        //消息模版
        $textTpl = "<xml>
							<ToUserName><![CDATA[%s]]></ToUserName>
							<FromUserName><![CDATA[%s]]></FromUserName>
							<CreateTime>%s</CreateTime>
							<MsgType><![CDATA[%s]]></MsgType>
							<Content><![CDATA[%s]]></Content>
							<FuncFlag>0</FuncFlag>
							</xml>";

        if(!empty( $keyword ))
        {
            $resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $keyword);
            echo $resultStr;
        }else{
            echo "Input something...";
        }

    }

    /**
     * @desc  响应图片信息
     * @param $postObj
     */
    public function responseImageMsg($postObj)
    {
        $fromUsername = $postObj->FromUserName;
        $toUsername = $postObj->ToUserName;
        //$picUrl = $postObj->PicUrl;
        $time = time();
        //$msgType = $postObj->MsgType;
        $MediaId = $postObj->MediaId;

        $imageTpl = "<xml>
                      <ToUserName><![CDATA[%s]]></ToUserName>
                      <FromUserName><![CDATA[%s]]></FromUserName>
                      <CreateTime>%s</CreateTime>
                      <MsgType><![CDATA[image]]></MsgType>
                      <Image>
                        <MediaId><![CDATA[%s]]></MediaId>
                      </Image>
                      </xml>";
        if(!empty($MediaId)){

            $resultStr = sprintf($imageTpl, $fromUsername, $toUsername, $time, $MediaId);
            echo $resultStr;
        }else{
            echo "Input something...";
        }

    }

    /**
     * @desc 获取access_token
     * @return bool|string
     */
    private function getAccessToken()
    {
        //获取access_token的url地址
        $accessTokenKey = 'access_token';

        $accessToken = $this->redis->get($accessTokenKey);
        //token值不存在的情况
        if(empty($accessToken)){
            $tokenURL = sprintf($this->wechat['token_url'],$this->wechat['app_id'], $this->wechat['app_secret']);

            \Log::info('请求微信公众号开发access_token的url地址',['token_url'=>$tokenURL]);

            $response = ToolCurl::httpCurl($tokenURL);

            \Log::info('请求接口返回access_token相应数据：',[$response]);

            $accessToken = $response['access_token'];

            $this->redis->setex($accessTokenKey,$response['expires_in'],$accessToken);
        }

        return $accessToken;
    }

    /**
     * @desc 签名签证接口
     * @param $params
     * @return bool
     */
    private function checkSignature($params)
    {
        $signature = isset($params['signature']) ?? "";
        $timestamp = isset($params['timestamp']) ?? time();
        $nonce = isset($params['nonce']) ?? "";

        $token = $this->wechat['token'];//签名令牌

        $tmpArr = array($token, $timestamp, $nonce);
        sort($tmpArr);
        $tmpStr = implode( $tmpArr );
        $tmpStr = sha1( $tmpStr );

        if( $tmpStr == $signature ){
            return true;
        }else{
            return false;
        }

    }
}
