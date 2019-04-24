<?php

namespace App\Http\Controllers\ShopApi;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Order;
use App\Model\Region;

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
}
