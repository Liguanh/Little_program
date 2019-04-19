<?php

namespace App\Http\Controllers\ShopApi;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Tools\ToolsSms;
use App\Model\Member;
use App\Model\MemberInfo;

class LoginController extends Controller
{
    //发送短信验证码的接口
    public function sendSms(Request $request)
    {
    	$phone = $request->input('phone');

    	$return =[
    			'code' =>2000,
    			'msg'  => "短信发送成功"
    		];

    	if(empty($phone)){
    		$return =[
    			'code' =>4001,
    			'msg'  => "手机号不能为空"
    		];

    		$this->returnJson($return);
    	}

    	//验证手机号格式
    	if(!preg_match("/^1[34578]\d{9}$/", $phone)){

    		$return =[
    			'code' =>4003,
    			'msg'  => "手机号格式不正确"
    		];

    		$this->returnJson($return);
    	}

    	//实例化redis
    	$redis = new \Redis();
    	//链接redis
    	$redis->connect(env("REDIS_HOST"), env("REDIS_PORT"));

    	//校验手机号发送的次数
    	//当前手机号已经发送过得短信验证码的次数key
    	$key1 = $phone."_NUMS";
    	$nums = $redis->get($key1);

    	if($nums >=3){
    		$return =[
    			'code' =>4004,
    			'msg'  => "今天短信发送次数已经到达上限,请明天再来",
    		];

    		$this->returnJson($return);
    	}

    	//生成手机号验证码
    	$code = rand(100000,999999);
    	//存储验证码的key
    	$key = "REGISTER_".$phone."_CODE";

    	\Log::info('手机号'.$phone.'发送的短信验证码:'.$code);

    	//设置redis值
    	$redis->setex($key, 1800,$code);


    	//发送短信验证码
    	$res = ToolsSms::sendSms($phone, $code);

    	//短信发送失败
    	if(!$res['status']){
    		$return =[
    			'code' =>4002,
    			'msg'  => $res['msg']
    		];

    		$this->returnJson($return);
    	}

    	//给用户短信发送次数自增一次
    	$redis->incr($key1);
    	//设置过期时间
    	$redis->expire($key1,24*3600);

    	$this->returnJson($return);
    }

    //用户注册的功能
    public function register(Request $request)
    {
    	$params = $request->all();

    	$return =[
    			'code' =>2000,
    			'msg'  => "短信发送成功"
    		];

    	//实例化redis
    	$redis = new \Redis();
    	//链接redis
    	$redis->connect(env("REDIS_HOST"), env("REDIS_PORT"));

    	//获取缓存存储的短信验证码的值
    	$code = $redis->get("REGISTER_".$params['phone']."_CODE");

    	if($code != $params['code']){
    		$return =[
    			'code' =>4000,
    			'msg'  => "手机验证码错误,请重新输入"
    		];

    		$this->returnJson($return);
    	}

    	//删除验证码
    	$redis->del("REGISTER_".$params['phone']."_CODE");


    	//用户注册的功能
    	try{
    		//开启事务
    		\DB::beginTransaction();

    		//添加到user主表信息
    		$member = new Member();

    		$data = [
    			'phone' => $params['phone'],
    			'password' => md5($params['password'])
    		];

    		$userId = $this->storeDataGetId($member, $data);

    		//添加user_info表信息

    		$memberInfo = new MemberInfo();

    		$data1 = [
    			'user_id' => $userId,
    			'invite_code' => rand(100000,999999)
    		];

    		$this->storeData($memberInfo,$data1);

    		\DB::commit();
    	}catch(\Exception $e){
    		\DB::rollback();

    		\Log::error('用户注册失败'.$e->getMessage());
    		$return =[
    			'code' =>$e->getCode(),
    			'msg'  => $e->getMessage()
    		];
    	}

    	$this->returnJson($return);
    }
}
