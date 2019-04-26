<?php

namespace App\Http\Controllers\ShopApi;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Model\Order;

use Yansongda\Pay\Pay;
use Yansongda\Pay\Log;

class AlipayController extends Controller
{
    //支付接口
    protected $config;

    public function __construct()
    {
        $this->config = \Config::get('alipay');//获取支付宝的配置信息
    }

    public function alipay(Request $request)
    {
    	$order = $request->all();

    	$config = \Config::get('alipay');//获取支付宝的配置信息

    	// $order = [
     //        'out_trade_no' => time(),
     //        'total_amount' => '10',
     //        'subject' => 'test subject - 测试',
     //    ];

        $alipay = Pay::alipay($config)->web($order);

        return $alipay;// laravel 框架中请直接 `return $alipay`
    }

    //同步回调
    public function returnUrl(Request $request)
    {

    	$params = $request->all();

        sleep(5);

    	return redirect('http://www.360buy.com/index/goods/returnUrl'.http_build_query($params));
    }

    //异步回调地址
    public function notifyUrl(Request $request)
    {
        $params = $request->all();

        \Log::info('支付宝异步回调返回的参数',[$params]);

         $alipay = Pay::alipay($this->config);

        try{
            $data = $alipay->verify(); // 是的，验签就这么简单！

            \Log::info('支付宝异步回调验签数据:',[$data]);

            //要修改的订单的数据
            $orderData = [
            'paid_price' => $data->buyer_pay_amount
            ];

            //支付成功状态
            if($data->trade_status == "TRADE_SUCCESS" || $data->trade_status="TRADE_FINISHED"){

                if($data->buyer_pay_amount != $data->total_amount){
                    $orderData['pay_status'] = 5;
                    \Log::info('修改订单的信息,部分支付成功：',[$orderData]);
                }
                $orderData['pay_status'] = 3;
                \Log::info('修改订单的信息,支付成功：',[$orderData]);
            }else{
                $orderData['pay_status'] = 4;
                \Log::info('修改订单的信息,支付失败：',[$orderData]);

                //库存还原
            }

            //更新订单
            Order::where('order_sn', $data->out_trade_no)->update($orderData);

            // 请自行对 trade_status 进行判断及其它逻辑进行判断，在支付宝的业务通知中，只有交易通知状态为 TRADE_SUCCESS 或 TRADE_FINISHED 时，支付宝才会认定为买家付款成功。
            // 1、商户需要验证该通知数据中的out_trade_no是否为商户系统中创建的订单号；
            // 2、判断total_amount是否确实为该订单的实际金额（即商户订单创建时的金额）；
            // 3、校验通知中的seller_id（或者seller_email) 是否为out_trade_no这笔单据的对应的操作方（有的时候，一个商户可能有多个seller_id/seller_email）；
            // 4、验证app_id是否为该商户本身。
            // 5、其它业务逻辑情况

            Log::info('Alipay notify', $data->all());
        } catch (\Exception $e) {
             //$e->getMessage();
        }

        return $alipay->success();// laravel 框架中请直接 `return $alipay->success()
        
    }
}
