<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    const 
        PAGE_SIZE = 10,
        END       = TRUE;

    //删除_token下划线token值
    public function delToken(array $params)
    {
    	if(!isset($params['_token'])){
    		return false;
    	}

    	unset($params['_token']);

    	return $params;
    }

    //保存数据，此方法可用于添加和修改
    public function storeData($object, $params)
    {
    	if(empty($params)){
    		return false;
    	}

    	foreach ($params as $key => $value) {
    		$object->$key = $value;
    	}

    	return $object->save();
    }

    //保存数据并且获取id，单条
    public function storeDataGetId($object, $params)
    {
        return $object->insertGetId($params);
    }

    //多条数据添加
    public function storeDataMany($object, $params)
    {
        return $object->insert($params);
    }

    //获取数据的公共方法操作
    public function getDataInfo($object, $id, $key="id",$fields= "*")
    {
    	if(empty($id)){
    		return false;
    	}

    	$info = $object->select($fields)->where($key, $id)->first();

    	return $info;
    }

    //通过where条件查询记录
    public function getDataInfoByWhere($object, $where=[])
    {
        $info = $object->where($where)->first();

        return $info;
    }

    //没有分页的数据列表
    public function getDataList($object, $where = [])
    {
        $list = $object->where($where)->get()->toArray();

        return $list;
    }

    //获取限制输出的条数
    public function getLimitDataList($object, $limit=5, $where=[])
    {
        $list = $object->where($where)->limit($limit)->get()->toArray();

        return $list;
    }

    //获取带有分页的数据列表
    public function getPageList($object, $where=[])
    {
        $list = $object->where($where)
                    ->orderBy('id','desc')
                    ->paginate(self::PAGE_SIZE);

        return $list;
    }

    //删除公共方法
    public function delData($object, $id,$key="id")
    {
    	return $object->where($key,$id)->delete();
    }

    /**
     * @desc 接口返回json的格式数据
     * @param array $data
     */
    public function returnJson($data = [])
    {
        if(!headers_sent()){
            header(sprintf('%s:%s','Content-Type','application/json'));
        }
        exit(json_encode($data));
    }

    //校验token是否过期的方式
    public function checkToken($token)
    {
            //实例化redis
            $redis = new \Redis();
            //链接redis
            $redis->connect(env("REDIS_HOST"), env("REDIS_PORT"));

            $data = $redis->get($token);

            if(!empty($data)){
                //查询出用户的信息
                $user = \DB::table('jy_user')->where(['phone'=>$data])->first();

                $return = [
                    'status' => true,
                    'data'   => [
                        'id'  => $user->id,
                        'phone' => $user->phone,
                        'username' => $user->username
                    ],
                ];
            }else{
                $return = [
                    'status' => false
                ];
            }

            return $return;
    }

}
