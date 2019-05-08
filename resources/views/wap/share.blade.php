<!DOCTYPE html>
<html>
<head>
	<title>测试微信js-sdk包的使用</title>
</head>
<body>
	<style type="text/css">
		.button {
			margin-top: 20%; 
			background: #ff0000; 
			height: 50px; 
			line-height: 50px; 
			width: 40%;
			border-radius: 5px;
			border: none;
			color: #fff;
		}
	</style>

	<center><button class="button" onclick="shareFriends()">测试分享</button></center>


	<script type="text/javascript" src="http://res.wx.qq.com/open/js/jweixin-1.4.0.js"></script>

	<script type="text/javascript">
		
		//配置js-sdk
		wx.config({
		    debug: true, // 开启调试模式,调用的所有api的返回值会在客户端alert出来，若要查看传入的参数，可以在pc端打开，参数信息会通过log打出，仅在pc端时才会打印。
		    appId: '{{$app_id}}', // 必填，公众号的唯一标识
		    timestamp: '{{$timestamp}}', // 必填，生成签名的时间戳
		    nonceStr: '{{$nonceStr}}', // 必填，生成签名的随机串
		    signature: '{{$signature}}',// 必填，签名
		    jsApiList: ['checkJsApi','onMenuShareAppMessage','onMenuShareTimeline','updateAppMessageShareData'] // 必填，需要使用的JS接口列表
		});
		wx.ready(function(){
			// config信息验证后会执行ready方法，所有接口调用都必须在config接口获得结果之后，config是一个客户端的异步操作，所以如果需要在页面加载时就调用相关接口，则须把相关接口放在ready函数中调用来确保正确执行。对于用户触发时才调用的接口，则可以直接调用，不需要放在ready函数中。
			wx.checkJsApi({
			    jsApiList: ['checkJsApi','onMenuShareAppMessage','onMenuShareTimeline'], // 需要检测的JS接口列表，所有JS接口列表见附录2,
			    success: function(res) {
			    	console.log(res);
			    // 以键值对的形式返回，可用的api值true，不可用为false
			    // 如：{"checkResult":{"chooseImage":true},"errMsg":"checkJsApi:ok"}
			    }
			});

			wx.onMenuShareAppMessage({ 
		        title: '测试分享', // 分享标题
		        desc: '测试分享的内容', // 分享描述
		        link: 'http://www.shopyjr.com/api/wap/share', // 分享链接，该链接域名或路径必须与当前页面对应的公众号JS安全域名一致
		        imgUrl: 'http://www.shopyjr.com/images/photos/blog4.jpg', // 分享图标
		        success: function (res) {
		        	alert('分享成功');
		          // 设置成功
		        },
		        cancel: function(res) {
		        	alert('取消分享了');
		        }
		    });

		    wx.onMenuShareTimeline({
			    title: '测试分享朋友圈', // 分享标题
			    link: 'http://www.shopyjr.com/api/wap/share', // 分享链接，该链接域名或路径必须与当前页面对应的公众号JS安全域名一致
			    imgUrl: 'http://www.shopyjr.com/images/photos/blog4.jpg', // 分享图标
			    success: function () {
			    // 用户点击了分享后执行的回调函数
				},

				cancel: function(res) {
		        	alert('取消分享了');
		        }
    
				});

		});



		//分享给朋友
		function shareFriends(){
			wx.updateAppMessageShareData({ 
		       	title: '测试分享', // 分享标题
		        desc: '测试分享的内容', // 分享描述
		        link: 'http://www.shopyjr.com/api/wap/share', // 分享链接，该链接域名或路径必须与当前页面对应的公众号JS安全域名一致
		        imgUrl: 'http://www.shopyjr.com/images/photos/blog4.jpg', // 分享图标
		        success: function () {
		          // 设置成功
		        }
		    });
		}
		
	</script>

</body>
</html>