<?php
//配置微信公众号的信息

return [
	'app_id' => "wxce9efeca70c08b5b",//开发者的id
	'app_secret' => "4215d057b7f827f95786958b8ad31b16",//开发者的秘钥
	'token' => "lghweixin",//token值
	'access_token_url' => 'https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=%s&secret=%s',//获取access_token的地址
];