<?php

namespace App\Http\Controllers\ShopApi;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\UserBonus;

class BonusController extends Controller
{
    //用户中心红包记录
    public function userBonusList($userId)
    {
    	$return = [
    		'code' => 2000,
    		'msg'  => "获取用户红包成功"
    	];

    	$userBonus = new UserBonus();

    	$bonusList = $userBonus->getRecordByUid($userId);

    	$return['data'] = $bonusList;

    	$this->returnJson($return);
    }
}
