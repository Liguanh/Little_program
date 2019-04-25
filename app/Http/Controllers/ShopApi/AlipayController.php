<?php

namespace App\Http\Controllers\ShopApi;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Model\Order;

use Yansongda\Pay\Pay;
use Yansongda\Pay\Log;

class AlipayController extends Controller
{
	protected $config = null;

	public function __construct()
	{
		$this->config = \Config::get('alipay');//获取支付宝的配置信息
	}
    //支付接口

    public function alipay(Request $request)
    {
    	$order = $request->all();


    	// $order = [
     //        'out_trade_no' => time(),
     //        'total_amount' => '10',
     //        'subject' => 'test subject - 测试',
     //    ];

        $alipay = Pay::alipay($this->config)->web($order);

        return $alipay;// laravel 框架中请直接 `return $alipay`
    }

    //同步回调
    public function returnUrl(Request $request)
    {
    	$params = $request->all();

    	$data = Pay::alipay($this->config)->verify(); // 是的，验签就这么简单！

    	$orders = new Order();
    	$object = $this->getDataInfo($orders,$data->out_trade_no, 'order_sn');

    	$this->storeData($object,['pay_status'=>2]);

    	// 订单号：$data->out_trade_no
        // 支付宝交易号：$data->trade_no
        // 订单总金额：$data->total_amount

        \Log::info('同步回调信息如下',[$params, $data]);

    	return redirect('http://www.360buy.com/index/goods/returnUrl?'.http_build_query($params));
    }

    //异步回调地址
    public function notifyUrl(Request $request)
    {
        $params = $request->all();

        \Log::info('支付宝异步回调',[$params]);

        $alipay = Pay::alipay($this->config);

        try{
            $data = Pay::alipay($this->config)->verify(); // 是的，验签就这么简单！

            \Log::info('支付宝异步支付验签数据',[$data]);

            $orderData = [
                    'paid_price' => $data->receipt_amount,
                ];

            if($data->trade_status == 'TRADE_SUCCESS'){//  支付成功
                \Log::info('支付成功');
                $orderData['pay_status'] = '3';  
            }else{
                $orderData['pay_status'] = '4';  

                //回退库存
            }
            \Log::info('修改订单数据',[$orderData]);

            Order::where('order_sn', $data->out_trade_no)->update($orderData);

            // 请自行对 trade_status 进行判断及其它逻辑进行判断，在支付宝的业务通知中，只有交易通知状态为 TRADE_SUCCESS 或 TRADE_FINISHED 时，支付宝才会认定为买家付款成功。
            // 1、商户需要验证该通知数据中的out_trade_no是否为商户系统中创建的订单号；
            // 2、判断total_amount是否确实为该订单的实际金额（即商户订单创建时的金额）；
            // 3、校验通知中的seller_id（或者seller_email) 是否为out_trade_no这笔单据的对应的操作方（有的时候，一个商户可能有多个seller_id/seller_email）；
            // 4、验证app_id是否为该商户本身。
            // 5、其它业务逻辑情况

            //Log::debug('支付宝异步回调数据', $data->all());
        } catch (\Exception $e) {
             //$e->getMessage();
        }

        return $alipay->success();// laravel 框架中请直接 `return $alipay->success()
    }
}
