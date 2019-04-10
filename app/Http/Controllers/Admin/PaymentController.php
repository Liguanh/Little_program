<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Payment;

class PaymentController extends Controller
{
    //支付方式列表
    public function list()
    {
    	$payment = new Payment();

    	$assign['payments'] = $this->getDataList($payment);

    	return view('admin.payment.list',$assign);
    }

    //添加页面
    public function add()
    {
    	return view('admin.payment.add');
    }

    //执行添加的操作
    public function store(Request $request)
    {
    	$params = $request->all();

    	$params = $this->delToken($params);

    	//处理支付方式的配置信息，进行序列化
    	if(!empty($params['pay_config'])){
    		$pay_config = [];

    		$arr = explode('|', $params['pay_config']);

    		foreach ($arr as $key => $value) {

    			$arr1 = explode("=>", $value);

    			$pay_config[$arr1[0]] = $arr1[1];
    		}

    		$params['pay_config'] = serialize($pay_config);
    	}

    	$payment = new Payment();

    	$res = $this->storeData($payment, $params);

    	if(!$res){
    		return redirect()->back()->with('msg','添加支付方式失败');
    	}

    	return redirect('/admin/payment/list');
    }

    //编辑
    public function edit($id)
    {
    	$payment = new Payment();

    	$assign['info'] = $this->getDataInfo($payment, $id)->toArray();

    	$pay_config = unserialize($assign['info']['pay_config']);

    	$string =  "";
    	foreach ($pay_config as $key => $value) {
    		$string .= $key."=>".$value."|";
    	}

    	$assign['info']['pay_config'] = substr($string, 0,-1);

    	return view('admin.payment.edit',$assign);
    }

    //执行编辑页面
    public function doEdit(Request $request)
    {
    	$params = $request->all();
    	$params = $this->delToken($params);

    	//处理支付方式的配置信息，进行序列化
    	if(!empty($params['pay_config'])){
    		$pay_config = [];

    		$arr = explode('|', $params['pay_config']);

    		foreach ($arr as $key => $value) {

    			$arr1 = explode("=>", $value);

    			$pay_config[$arr1[0]] = $arr1[1];
    		}

    		$params['pay_config'] = serialize($pay_config);
    	}

    	$payment = Payment::find($params['id']);

    	$res = $this->storeData($payment, $params);

    	if(!$res){
    		return redirect()->back()->with('msg','修改支付方式失败');
    	}

    	return redirect('/admin/payment/list');
    }

    //执行删除
    public function del($id)
    {
    	$payment = new Payment();

    	$this->delData($payment, $id);

    	return redirect('/admin/payment/list');
    }
}
