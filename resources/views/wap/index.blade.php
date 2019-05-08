<!DOCTYPE html>
<html>
<head>
	<title>自定义分享接口</title>
</head>
<body>
    <center>
    	<button onclick="shareFriend">分享给朋友</button>
    </center>
	
<script type="text/javascript" src="http://res.wx.qq.com/open/js/jweixin-1.4.0.js"></script>

<script type="text/javascript">
	wx.config({
	    debug: true, // 开启调试模式,调用的所有api的返回值会在客户端alert出来，若要查看传入的参数，可以在pc端打开，参数信息会通过log打出，仅在pc端时才会打印。
	    appId: "{{$wechat['app_id']}}", // 必填，公众号的唯一标识
	    timestamp: "{{$timestamp}}", // 必填，生成签名的时间戳
	    nonceStr: '{{$nonceStr}}', // 必填，生成签名的随机串
	    signature: '{{$signature}}',// 必填，签名
	    jsApiList: [
	    	'updateAppMessageShareData','updateTimelineShareData'
	    ] // 必填，需要使用的JS接口列表
	});

	function shareFriend(){
		wx.updateAppMessageShareData({ 
	        title: '测试', // 分享标题
	        desc: '这是一个测试分享的操作', // 分享描述
	        link: 'http://www.baidu.com', // 分享链接，该链接域名或路径必须与当前页面对应的公众号JS安全域名一致
	        imgUrl: 'http://www.shopyjr.com/images/photos/blog4.jpg', // 分享图标
	        success: function () {
	          // 设置成功
	        }
    	})；
	}
</script>
</body>
</html>