<!DOCTYPE HTML>
<html>

	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1 maximum-scale=2, user-scalable=no">
		<meta name="apple-mobile-web-app-capable" content="yes" />
		<meta name="mobile-web-app-capable" content="yes">
		<meta name="apple-mobile-web-app-title" content="Add to Home">
		<meta name="format-detection" content="telephone=no">
		<meta http-equiv="x-rim-auto-match" content="none">
		<title>首汽约车—砸蛋抽奖</title>
		<meta name="keywords" content="首汽约车—砸蛋抽奖">
		<meta name="description" content="首汽约车—砸蛋抽奖">
		<meta name="Copyright" content="首汽约车—砸蛋抽奖">
		<meta name="author" content="首汽约车—砸蛋抽奖">
		<!-- 网站的ico图标 -->
		<link rel="shortcut icon" href="/img/favicon.jpg" type="image/x-icon">
		<link href="/css/publi.css" rel="stylesheet" type="text/css">
		<link href="/css/chuyouwuyi01.css" rel="stylesheet" type="text/css">
		<script src="/js/jquery1.8.3.min.js"></script>
		<script type="text/javascript">
			var phoneWidth = parseInt(window.screen.width);
			var phoneScale = phoneWidth / 640;
			var ua = navigator.userAgent;
			if (/Android (\d+\.\d+)/.test(ua)) {
				var version = parseFloat(RegExp.$1);
				// andriod 2.3
				if (version > 2.3) {
					document.write('<meta name="viewport" content="width=640, minimum-scale = ' + phoneScale + ', maximum-scale = ' + phoneScale + ', target-densitydpi=device-dpi">');
					// andriod 2.3以上
				} else {
					document.write('<meta name="viewport" content="width=640, target-densitydpi=device-dpi">');
				}
				// 其他系统
			} else {
				document.write('<meta name="viewport" content="width=640, user-scalable=no, target-densitydpi=device-dpi">');
			}
		</script>
		<!--[if lt IE 9]>
<script src="js/html5.js"></script>
<script src="js/respond.min.js"></script>
<![endif]-->
	</head>

	<body>
		<!-- ====================================loading -->
		<!--<section id="loading"></section>-->
		<!-- ====================================页面开始 -->
		<!--登录-->
		<section class="zadan">
			<div class="zd_logo">
				<img src="/img/160615zadan/zd_cion03.png">
			</div>
			<div class="zd_middle">
				<div class="zd_title">
					<img src="/img/160615zadan/zd_cion04.png">
				</div>
				<div class="zd_zadan">
					<div class="zd_bg">
						<img src="/img/160615zadan/zd_cion18.png"  class="zd_bg01">
						<img src="/img/160615zadan/zd_cion18.png"  class="zd_bg02">
					</div>
					<div class="zd_jindan ">
						<img src="/img/160615zadan/zd_cion16.png">
					</div>
					<ul class="zd_bigcaidai">
						<li class="cardai01 cardai">
							<img src="/img/160615zadan/zd_cion15.png">
						</li>
						<li class="cardai02 cardai">
							<img src="/img/160615zadan/zd_cion14.png">
						</li>
						<li class="cardai03 cardai">
							<img src="/img/160615zadan/zd_cion13.png">
						</li>
						<li class="cardai04 cardai">
							<img src="/img/160615zadan/zd_cion12.png">
						</li>
						<li class="cardai05 cardai">
							<img src="/img/160615zadan/zd_cion11.png">
						</li>
						<li class="cardai06 cardai">
							<img src="/img/160615zadan/zd_cion10.png">
						</li>
					</ul>
					<div class="zd_chuizi">
						<img src="/img/160615zadan/zd_cion01.png">
					</div>
					<div class="zd_txt">
						{{csrf_field()}}
						<input type="text" id="iphone1" placeholder="请输入手机号" />
						<a href="javascript:;" id="submit" class="mom_btn tc">
							<img src="/img/160615zadan/zd_cion07.png">
						</a>
						<a href="http://m.01zhuanche.com" class="mom_load tc">下载客户端</a>
					</div>
				</div>

			</div>
			<div class="zd_bottom">
				<img src="/img/160615zadan/zd_cion08.png">
			</div>

		</section>
		<!--弹出层-->
		<article id="tip">
			<div class="pack pack_yl">
				<h1 class="tc">温馨提示</h1>
				<p class="tc"></p>
				<a href="#">确定</a>
			</div>
		</article>
		<!-- 网站要用到的一些类库 -->

		<script type="text/javascript">
			var checkPhone = function(a) {
				var patrn = /^((?:13|15|18|14|17)\d{9}|0(?:10|2\d|[3-9]\d{2})[1-9]\d{6,7})$/;
				if (!patrn.exec(a)) return false;
				return true;
			};
			$(function() {
				$(window).on("load", function() {
						$("#loading").fadeOut();
					})
					// ========================================浮层控制
				$("#tip .pack a").on("click", function() {
					$("#tip").fadeOut()
					$("#tip .pack p").html("")
					return false;
				})

				function alerths(str) {
					$("#tip").fadeIn()
					$("#tip .pack p").html(str)
					return false;
				}
				$("#submit").on("click", function() {
					$('html,body').animate({scrollTop:0}); 
					var str = $("#iphone1").val();
					var token = $("input[name=_token]").val();//获取csrf的值
					if (str.length == 11 && checkPhone(str)) {
						//ajax请求接口
						$.ajax({
							url: "/study/lottery/do",
							type: "post",
							data: {
								phone: str,
								_token: token
							},
							dataType:"json",
							success: function(res){

								// 判断是不是11位手机号，为真提交
								$(".zd_jindan").addClass("zd_jindan01");
								$(".cardai01").fadeIn(500);
								$(".cardai02").animate({
									top: '240px',
									left: '173px'
								}, 500);
								$(".cardai03").animate({
									top: '225px',
									left: '345px'
								}, 600);
								$(".cardai04").animate({
									top: '230px',
									left: '202px'
								}, 700);
								$(".cardai05").animate({
									top: '230px',
									left: '230px'
								}, 800);
								$(".cardai06").animate({
									top: '340px',
									left: '246px'
								}, 1000, function() {
									//写中奖后的东西
									$(".cardai").addClass("cardai07");
									$(".zd_jindan").removeClass("zd_jindan01");
									alerths(res.msg);
								});	
							}

						});
						
					} else {
						alerths("请输入正确的手机号！")
					}
					return false;
				})
			})
		</script>
	</body>

</html>