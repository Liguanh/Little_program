<?php
//配置微信公众号的信息

return [
	'app_id' => "wxce9efeca70c08b5b",//开发者的id
	'app_secret' => "4215d057b7f827f95786958b8ad31b16",//开发者的秘钥
	'token' => "lghweixin",//token值
	'access_token_url' => 'https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=%s&secret=%s',//获取access_token的地址

	'menu_url' => 'https://api.weixin.qq.com/cgi-bin/menu/create?access_token=%s',//获取自定义菜单接口url地址

	//获取网页授权code码的地址
	'wap_code_url' => 'https://open.weixin.qq.com/connect/oauth2/authorize?appid=%s&redirect_uri=%s&response_type=code&scope=snsapi_userinfo&state=test#wechat_redirect'
];