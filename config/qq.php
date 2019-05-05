<?php

return [
	'app_id' => '101572231',
	'app_key' => '59ff09ec4da3c5b160638918b9700ee4',
	'redirect_url' => 'http://www.shopyjr.com/qq/callback',
	//获取access_token的url地址
	'token_url' => 'https://graph.qq.com/oauth2.0/token?grant_type=authorization_code&client_id=%s&client_secret=%s&code=%s&redirect_uri=%s',

	//获取用户openid的url地址
	'open_url' => 'https://graph.qq.com/oauth2.0/me?access_token=%s',

	//获取用户详情的地址信息
	'user_info_url' => 'https://graph.qq.com/user/get_user_info?access_token=%s&oauth_consumer_key=%s&openid=%s'

];