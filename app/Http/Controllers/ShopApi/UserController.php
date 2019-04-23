<?php

namespace App\Http\Controllers\ShopApi;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Member;
use App\Model\MemberInfo;
use App\Model\userFundHistory;
use App\Model\Region;
use App\Model\UserAddress;

class UserController extends Controller
{
    //获取用户中心用户的详情信息
    public function userInfo($id)
    {
    	$return = [
    		'code' => 2000,
    		'msg'  => "获取用户信息成功"
    	];

    	$member = new Member();

    	$info = $member->getInfo($id)->toArray();

    	$return['data'] = $info;

    	$this->returnJson($return);
    }

    //修改用户信息的操作
    public function userModify(Request $request)
    {
    	$params = $request->all();

    	$return = [
    		'code' => 2000,
    		'msg'  => "用户信息修改成功"
    	];

    	try{

    		\DB::beginTransaction();

    		//修改信息到user表
    		$member = Member::find($params['id']);

    		// $this->returnJson($member);

    		$user = [
    			'username' => $params['username']
    		];

    		$this->storeData($member, $user);


    		//修改userInfo表的信息
    		$memberInfo = new MemberInfo();

    		$userInfo = $this->getDataInfo($memberInfo,$params['id'],'user_id');

    		$info = [
    			'email'  => $params['email'],
    			'sex'  => $params['sex'],
    			'link_name'  => $params['link_name'],
    			'link_phone'  => $params['link_phone'],
    		];
    		$this->storeData($userInfo, $info);

    		\DB::commit();
    	}catch(\Exception $e){
    		\DB::rollback();

    		\Log::error('用户中心修改信息失败'.$e->getMessage());

    		$return = [
    			'code' => $e->getCode(),
    			'msg'  => $e->getMessage()
    		];
    	}

    	$this->returnJson($return);
    }

    //用户资金流水接口
    public function userFundHistory($userId)
    {
    	$return = [
    		'code' => 2000,
    		'msg'  => "获取用户资金流水"
    	];

    	$fundHistory = new UserFundHistory();

    	$fund = $this->getDataList($fundHistory, ['user_id'=>$userId]);

    	$return['data'] = $fund;
    	$this->returnJson($return);
    }

    //获取地址信息
    public function getRegion($fid)
    {
    	$return = [
    		'code' => 2000,
    		'msg'  => "获取地址信息"
    	];

    	$region = new Region();

    	$list = $this->getDataList($region, ['f_id'=> $fid]);

    	$return['data'] = $list;

    	$this->returnJson($return);
    }

    //新增用户收货地址的接口
    public function addUserAddress(Request $request)
    {
    	$return = [
    		'code' => 2000,
    		'msg'  => "新增收货地址"
    	];

    	$params = $request->all();

    	$res = \DB::table('jy_user_address')->insert($params);


    	if(!$res){

    		$return = [
    		'code' => 4000,
    		'msg'  => "新增收货地址失败"
    		];
    	}

    	$this->returnJson($return);
    }

    //获取用户的地址信息
    public function getUserAddress($userId)
    {
    	$userAddress = new UserAddress();

    	$return = [
    		'code' => 2000,
    		'msg'  => "获取地址信息数据"
    	];

    	$region = new Region();

    	$address = $this->getDataList($userAddress, ['user_id'=>$userId]);

    	foreach ($address as $key => $value) {
    		$country = $this->getDataInfo($region, $value['country']);
    		$address[$key]['country'] = $country->region_name;

    		$province = $this->getDataInfo($region, $value['province']);
    		$address[$key]['province'] = $province->region_name;

    		$city = $this->getDataInfo($region, $value['city']);
    		$address[$key]['city'] = $city->region_name;

    		$district = $this->getDataInfo($region, $value['district']);
    		$address[$key]['district'] = $district->region_name;
    	}

    	$return['data'] = $address;

    	$this->returnJson($return);
    }
}
