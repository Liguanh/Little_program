<?php
//配置微信公众号的信息

return [
	'app_id' => "wxf2b8313e84f65edf",//开发者的id
	'app_secret' => "bfd7c72a67af9983830a3323a2d668f5",//开发者的秘钥
	'token' => "9kI3GSayOOgVAsafnLdBpYJ3B5elyYyX",//token值
	'access_token_url' => 'https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=%s&secret=%s',//获取access_token的地址

	'menu_url' => 'https://api.weixin.qq.com/cgi-bin/menu/create?access_token=%s',//获取自定义菜单接口url地址
];