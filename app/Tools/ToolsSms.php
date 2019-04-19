<?php

namespace App\Tools;

use AlibabaCloud\Client\AlibabaCloud;
use AlibabaCloud\Client\Exception\ClientException;
use AlibabaCloud\Client\Exception\ServerException;
/**
 * 阿里云短息服务的类
 */
class ToolsSms
{
	
	//发送短信验证码
	//手机号，验证码
	public static function sendSms($phone, $code)
	{
		//阿里云接口测试
    	$config = \Config::get('sms');

    	//dd($config);

    	$params = [
    		'code'  => $code
    		];

    	AlibabaCloud::accessKeyClient($config['accessKeyId'], $config['accessKeySecret'])
                        ->regionId('cn-hangzhou') // replace regionId as you need
                        ->asGlobalClient();
		try {
		    $result = AlibabaCloud::rpcRequest()
		                          ->product('Dysmsapi')
		                          // ->scheme('https') // https | http
		                          ->version("2017-05-25")
		                          ->action('SendSms')
		                          ->method('POST')
		                          ->options([
		                                        'query' => [
		                                          'PhoneNumbers' => $phone,
		                                          'SignName' => $config['signName'],
		                                          'TemplateCode' => $config['templateCode'],
		                                          'TemplateParam' => json_encode($params),
		                                        ],
		                                    ])
		                          ->request();

		    \Log::info('阿里云短信发送成功',[$result->toArray()]);

		    return [
		    	'status' => true
		    	];
		} catch (ClientException $e) {

			\Log::error('阿里云短信发送失败'.$e->getErrorMessage());

			return [
		    	'status' => false,
		    	'msg'    => $e->getErrorMessage()
		    	];
		    
		} catch (ServerException $e) {

		    \Log::error('阿里云短信发送失败'.$e->getErrorMessage());

		    return [
		    	'status' => false,
		    	'msg'    => $e->getErrorMessage()
		    	];
		}
	}
}