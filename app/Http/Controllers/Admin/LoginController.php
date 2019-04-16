<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\AdminUsers;
use Mail;
use App\Tools\ToolsEmail;

class LoginController extends Controller
{
    //

	/**
	 * 登陆页面
	 */
    public function index(Request $request)
    {
        
    	$session = $request->session();

    	if($session->has('user')){//如果存在sesion信息的话不用登陆
    		return redirect('/admin/home');
    	}

    	return view('admin.login');
    }

    /**
     * 执行登陆的页面
     * 1、先根据用户名查询账号是否存在
     * 2、如果不存在提示用户不存在
     * 3、校验密码是否正确
     * 4、如果正确登陆成功，否则提示密码错误
     */
    public function doLogin(Request $request)
    {
    	$params = $request->all();

    	$return = [
    		'code' => 2000,
    		'msg'  => '登陆成功'
    	];

    	//用户名不能为空
    	if(!isset($params['username']) || empty($params['username'])){

    		$return = [
    			'code' => 4001,
    			'msg'  => "用户名不能为空"
    		];

    		return json_encode($return);
    	}

    	//密码不能为空
    	if(!isset($params['password']) || empty($params['password'])){

    		$return = [
    			'code' => 4002,
    			'msg'  => "密码不能为空"
    		];

    		return json_encode($return);
    	}

    	//通过用户名获取用户的信息
    	$userInfo = AdminUsers::getUserByName($params['username']);

    	//用户不存在
    	if(empty($userInfo)){

    		$return = [
    			'code' => 4003,
    			'msg'  => "用户不存在"
    		];

    		return json_encode($return);

    	}else{
    		//传递过来的参数密码
    		$postPwd = md5($params['password']);
    		//密码错误
    		if($postPwd !== $userInfo->password){

    			$return = [
    			'code' => 4004,
    			'msg'  => "密码不正确"
    			];

    			return json_encode($return);
    		}else{//密码正确, 执行登陆

    			$session = $request->session();//获取session对象
    			//存储用户id
    			$session->put('user.user_id',$userInfo->id);//用户id
    			$session->put('user.username',$userInfo->username);
    			$session->put('user.image_url',$userInfo->image_url);
                $session->put('user.is_super',$userInfo->is_super);//是否超管

    			return json_encode($return);
    		}

    	}

    }

    /**
     * 用户推出页面
     */
    public function logout(Request $request)
    {
    	//session删除
    	$request->session()->forget('user');

    	//dd('tuichu');

    	return redirect('/admin/login');
    }


    //忘记密码的页面
    public function forget()
    {
        return view('admin.forget.forget');
    }

    //发送邮件的接口
    public function sendEmail(Request $request)
    {
        $email = $request->input('email','');
        $username = $request->input('username','');

        $return  = [
            'code' => 2000,
            'msg'  => "发送成功"
        ];

        //检测邮箱或者用户是否存在

        $adminUsers = new AdminUsers();
        $data1 = $this->getDataInfo($adminUsers, $email, 'email');
        $data2 = $this->getDataInfo($adminUsers, $username, 'username');
        if(empty($data1) || empty($data2)){

            $return= [
                'code' => 4000,
                'msg'  => "用户或邮箱不存在"
            ];
        }

        $url = sprintf(env('APP_URL')."?username=%s&email=%s&activeCode=%s",$username,$email, ToolsEamil::createActiveCode());
        //发送的是html的邮件
        //视图数据
        $viewData =[
            'url'  => 'admin.forget.email',
            'assign' => [
                'username' => $username,
                'url'      => $url,
            ],
        ];

    }

    //重置页面
    public function reset()
    {
        return view('admin.forget.reset');
    }
}
