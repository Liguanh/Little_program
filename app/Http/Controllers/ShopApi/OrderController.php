<?php

namespace App\Http\Controllers\ShopApi;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Order;
use App\Model\OrderGoods;
use App\Model\Goods;
use App\Model\Region;
use App\Model\Shipping;
use App\Model\Payment;
use App\Tools\ToolsAdmin;
use App\Model\UserAddress;

class OrderController extends Controller
{
    //用户订单列表
    public function userOrder($userId)
    {
    	$return = [
    		'code' => 2000,
    		'msg'  => "获取用户订单信息成功"
    	];

    	$order = new Order();

    	$data = $this->getDataList($order, ['user_id'=>$userId]);

    	$region = new Region();
    	foreach ($data as $key => $value) {
    		$country = $this->getDataInfo($region, $value['country']);
    		$data[$key]['country'] = $country->region_name;

    		$province = $this->getDataInfo($region, $value['province']);
    		$data[$key]['province'] = $province->region_name;

    		$city = $this->getDataInfo($region, $value['city']);
    		$data[$key]['city'] = $city->region_name;

    		$district = $this->getDataInfo($region, $value['district']);
    		$data[$key]['district'] = $district->region_name;
    	}

    	$return['data'] = $data;

    	$this->returnJson($return);
    }

    //配送方式
    public function shipping()
    {

        $shipping = new Shipping();

        $data = $this->getDataList($shipping);

        $this->returnJson($data);

    }

    //支付方式
    public function payment()
    {
        $payment = new Payment();

        $data = $this->getDataList($payment);

        $this->returnJson($data);
    }


    public function createOrder(Request $request)
    {
        $return = [
            'code' => 2000,
            'msg'  => "订单添加成功"
        ];
        $params = $request->all();

        //执行添加订单
        try{
            \DB::beginTransaction();//开启

            $orderSn = ToolsAdmin::buildGoodsSn();
            //创建订单
            $object = new UserAddress();
            $address = $this->getDataInfo($object, $params['address']);
        
            $orderInfo = [
                'user_id' => $params['user_id'],
                'order_sn' => $orderSn,//订单号
                'order_status'=>2,
                'shipping_status' => 1,
                'pay_status' => 1,
                'zcode'      => rand(100000,999999),
                'consignee'  => $address['consignee'],
                'country'    => 1,
                'province'  => $address['province'],
                'city'  => $address['city'],
                'district'  => $address['district'],
                'address'  => $address['address'],
                'phone'  => $address['mobile'],
                'pay_name'  => $params['payment'],
                'shipping_name' => $params['shipping'],
                'goods_price' => $params['goods_price'],
                'shipping_fee' => $params['shipping_fee'],
                'pay_price' => $params['pay_price'],
                'paid_price' => 0,
                'bonus_price' => $params['bonus_price'],
                'note' => $params['note'],
                'confirm_time' => date('Y-m-d H:i:s'),
                'pay_time' => date('Y-m-d H:i:s'),
            ];

            $order = new Order();
            $orderId = $this->storeDataGetId($order, $orderInfo);

            //创建订单关联的商品信息

            $goodsInfo = json_decode($params['goods_info'], true);
            $orderGoodsData = [];

            foreach ($goodsInfo as $key => $value) {
                $orderGoodsData[] = [
                    'goods_id' => $value['goods_id'],
                    'order_id' => 0,
                    'goods_name' => $value['goods_name'],
                    'goods_num' => $value['nums'],
                    'shop_price'=> $value['market_price'],
                    'market_price'=> $value['market_price'],
                    'goods_attr' => serialize($value['attr_sku']),
                ];
            }

            $orderGoods = new OrderGoods();
            $this->storeDataMany($orderGoods, $orderGoodsData);

            //修改商品的库存
            foreach ($orderGoodsData as $k => $v) {

                $goods = Goods::find($v['goods_id']);
                
                $data = [
                    'goods_num' => $goods->goods_num - $v['goods_num']
                ];
                $this->storeData($goods, $data);
            }

            $return['data'] = [
                'order_sn' => $orderSn
            ];

            \DB::commit();
        }catch(\Exception $e){
            \DB::rollback();

            \Log::error('订单创建失败,失败原因是:'.$e->getMessage());

            $return = [
                'code' => $e->getCode(),
                'msg'  => $e->getMessage()
            ];

        }

        $this->returnJson($return);
    }
}
