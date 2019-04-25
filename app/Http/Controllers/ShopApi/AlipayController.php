<?php

namespace App\Http\Controllers\ShopApi;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Yansongda\Pay\Pay;
use Yansongda\Pay\Log;

class AlipayController extends Controller
{
    //支付接口

    public function alipay(Request $request)
    {
    	$params = $request->all();

    	$config = \Config::get('alipay');//获取支付宝的配置信息

    	$order = [
            'out_trade_no' => time(),
            'total_amount' => '10',
            'subject' => 'test subject - 测试',
        ];

        $alipay = Pay::alipay($config)->web($order);

        return $alipay;// laravel 框架中请直接 `return $alipay`
    }

    //同步回调
    public function returnUrl(Request $request)
    {

    	echo "支付成功";

    	return redirect('http://www.360buy.com/index/goods/returnUrl');
    }

    //异步回调地址
    public function notifyUrl(Request $request)
    {
        $params = $request->all();

        \Log::info('支付宝异步回调',[$params]);
    }
}
