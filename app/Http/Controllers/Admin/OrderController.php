<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Model\Order;
use App\Model\OrderGoods;
use App\Model\Region;
use App\Model\Member;
use App\Tools\ToolsExcel;

class OrderController extends Controller
{
    //订单列表
    public function list()
    {
    	$order = new Order();

    	$assign['list'] = $this->getPageList($order);

    	return view('admin.order.list',$assign);
    }

    //订单详情页面
    public function detail($id)
    {
    	$order = new Order();
    	$orderGoods = new OrderGoods();
    	$region = new Region();
    	$member = new Member();

    	//订单基本信息
    	$order = $this->getDataInfo($order,$id);

    	//收货人的地址信息
    	$country = $this->getDataInfo($region,$order->country);//国家
    	$province = $this->getDataInfo($region,$order->province);//省份
    	$city = $this->getDataInfo($region,$order->city);//市
    	$district = $this->getDataInfo($region,$order->district);//地区/县
    	$assign = [
    		'country' => $country->region_name,
    		'province' => $province->region_name,
    		'city' => $city->region_name,
    		'district' => $district->region_name,
    	];


    	$assign['order'] = $order;
    	//订单商品信息
    	$assign['order_goods'] =  $this->getDataList($orderGoods);

    	$assign['member'] = $this->getDataInfo($member, $order->user_id);

    	return view('admin.order.detail', $assign);
    }

    //订单的导出功能
    public function export()
    {
    	$order = new Order();

    	$data = $this->getDataList($order);

    	//导出的数据
        $exportData = [];
        $head = ['order_sn','goods_price','user_id','consignee','phone','shipping_name','pay_name'];//excel的head头

        $exportData[] = ['订单号','商品总价','用户id','收货人','收货人手机','配送方式','支付方式'];

        //组装打印的数据
        foreach ($data as $key => $value) {

            $tmpArr = [];
            foreach ($head as $column) {
                $tmpArr[] = $value[$column];
            }
            $exportData[] = $tmpArr;
        }

        //dd($exportData);
        ToolsExcel::exportData($exportData,'订单数据');
    }

    //导入的页面
    public function import()
    {
    	return view('admin.order.import');
    }

    //执行导入的操作
    public function doImport(Request $request)
    {
    	$params = $request->all();

        $files = $params['file_name'];

        //判断文件的后缀名
        if($files->extension() !="xls" && $files->extension()!="xlsx"){
            return redirect()->back()->with('msg','文件格式不正确，请上传xls，xlsx后缀名文件');
        }

        $data = ToolsExcel::import($files);

        //dd($data);

        //dd($data);

        $order = new Order();

        $orderData = [];

        foreach ($data as $key => $value) {
            $value['order_sn'] = "SHOP".date("Ymd").rand(100000,999999);

            $orderData[$key] = $value;
        }

        //dd($orderData);

        $res = $this->storeDataMany($order, $orderData);

        if(!$res){
            return redirect()->back()->with('msg','导入失败');
        }

        return redirect('/admin/order/list');
    }
}
