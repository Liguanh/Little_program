<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class QQController extends Controller
{
	protected $qq = null;
	protected $redis = null;

	public function __construct()
	{
		$this->qq = \Config::get('qq');

		$this->redis = new \Redis();

		$this->redis->connect(env('REDIS_HOST'),env('REDIS_PORT'));
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

    		//Step2: 通过code授权码来获取access_token的值

    		//access_token请求过来的值，进行数组处理
    		$accessTokenData = [];
    		$response = file_get_contents($tokenUrl);

    		parse_str($response,$accessTokenData);

    		\Log::info('Step2: 请求access_token返回的内容',[$accessTokenData]);
    		//如果返回成功
    		if(isset($accessTokenData['access_token'])){

    			//Step3: 通过access_token来获取用户openID
    			$openUrl = sprintf($this->qq['open_url'], $accessTokenData['access_token']);

    			\Log::info('QQ第三方登陆获取openId的url地址',['open_id_url'=>$openUrl]);

    			$response1 = file_get_contents($openUrl);

    			$openData = $this->getOpenData($response1);

    			//\Log::info('QQ第三方登陆获取获取openid的数据信息',[$response1]);

    			\Log::info('Step3: QQ第三方登陆获取获取openid的数据信息', [$openData]);

    			//通过openid查询数据库中的数据
    			$userInfo = \DB::table('jy_user')->where('open_id', $openData['openid'])->first();

    			if(empty($userInfo)){//如果openid不存在数据库中
    				//Step4: 通过openid获取用户的详情信息
    				$userInfoUrl  = sprintf($this->qq['user_info_url'], $accessTokenData['access_token'], $this->qq['app_id'], $openData['openid']);

    				\Log::info('QQ第三方登陆获取用户详情的url地址',['user_info_url'=>$userInfoUrl]);

    				$userInfo = file_get_contents($userInfoUrl);

    				$userInfo = json_decode($userInfo, true);

    				\Log::info('Step4: QQ第三方登陆获取获取用户详情的数据信息',[$userInfo]);

    				$user = [
    					'open_id'  => $openData['openid'], 
    					'phone'    => '13301191890',
    					'username' => $userInfo['nickname'],
    					'password' => md5('123qwe'),
    					'image_url' => $userInfo['figureurl_qq_1'],
    				];

    				\Log::info('QQ登陆入库信息',[$user]);

    				\DB::table('jy_user')->insert($user);
    			}

    			//授权登陆
    			//生成token的sql语句
            	//$data = \DB::select('select replace(uuid(),"-","") as token');
            	//$token = $data[0]->token;

    		}

    	}
    }

    //获取openID的数据信息
    public function getOpenData($openData)
    {
    	$lpos = strpos($openData, '(');
    	$rpos = strpos($openData, ')');

    	//\Log::info('位置信息',[$lpos, $rpos]);

    	$str = substr($openData, $lpos+1, $rpos-$lpos-1);

    	//\Log::info('截取信息:',[$str]);


    	$openData = json_decode($str, true);

    	return $openData;
    }
}
