<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
  <meta name="description" content="">
  <meta name="author" content="">
  <link rel="shortcut icon" href="images/favicon.png" type="image/png">

  <title>@yield('title')</title>

  <link href="/css/style.default.css" rel="stylesheet">

  <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!--[if lt IE 9]>
  <script src="js/html5shiv.js"></script>
  <script src="js/respond.min.js"></script>
  <![endif]-->

  <!-- js文件 -->
  <script src="/js/jquery-1.11.1.min.js"></script>
  <script src="/js/jquery-migrate-1.2.1.min.js"></script>
  <script src="/js/jquery-ui-1.10.3.min.js"></script>
  <script src="/js/bootstrap.min.js"></script>
  <script src="/js/modernizr.min.js"></script>
  <script src="/js/jquery.sparkline.min.js"></script>
  <script src="/js/toggles.min.js"></script>
  <script src="/js/retina.min.js"></script>
  <script src="/js/jquery.cookies.js"></script>

  <script src="/js/flot/jquery.flot.min.js"></script>
  <script src="/js/flot/jquery.flot.resize.min.js"></script>
  <script src="/js/flot/jquery.flot.spline.min.js"></script>
  <script src="/js/morris.min.js"></script>
  <script src="/js/raphael-2.1.0.min.js"></script>

  <script src="/js/custom.js"></script>
  <script src="/js/dashboard.js"></script>
</head>

<body>
<!-- Preloader -->

<section>

  <div class="leftpanel">

	    <div class="logopanel">
	      <h1><span>[</span> 管理后台 <span>]</span></h1>
	    </div><!-- logopanel -->

	    <div class="leftpanelinner">

	      <!-- This is only visible to small devices -->
	      <div class="visible-xs hidden-sm hidden-md hidden-lg">
	        <div class="media userlogged">
	          <img alt="" src="images/photos/loggeduser.png" class="media-object">
	          <div class="media-body">
	            <h4>John Doe</h4>
	            <span>"Life is so..."</span>
	          </div>
	        </div>

	        <h5 class="sidebartitle actitle">Account</h5>
	        <ul class="nav nav-pills nav-stacked nav-bracket mb30">
	          <li><a href="profile.html"><i class="fa fa-user"></i> <span>Profile</span></a></li>
	          <li><a href=""><i class="fa fa-cog"></i> <span>Account Settings</span></a></li>
	          <li><a href=""><i class="fa fa-question-circle"></i> <span>Help</span></a></li>
	          <li><a href="signout.html"><i class="fa fa-sign-out"></i> <span>Sign Out</span></a></li>
	        </ul>
	      </div>

	      <h5 class="sidebartitle">Navigation</h5>
	      <ul class="nav nav-pills nav-stacked nav-bracket">

          @if(!empty($menus))
            @foreach($menus as $menu)
              @if(isset($menu['son']))
                <li class="nav-parent"><a href="{{ \Route::has($menu['url']) ? route($menu['url']) : '#'}}"><i class="fa fa-edit"></i> <span>{{$menu['name']}}</span></a>
                  <ul class="children">
                      @foreach($menu['son'] as $m)
                      <li><a href="{{ \Route::has($m['url']) ? route($m['url']) : '#'}}"><i class="fa fa-caret-right"></i> {{$m['name']}}</a></li>
                      @endforeach
                  </ul>
                </li>
              @else 
                <li class="active"><a href="{{ \Route::has($menu['url']) ? route($menu['url']) : '#'}}"><i class="fa fa-home"></i> <span>{{$menu['name']}}</span></a></li>
              @endif

            @endforeach

          @endif
	       <!--  <li class="active"><a href="首页.html"><i class="fa fa-home"></i> <span>首页</span></a></li>
	        <li class="nav-parent"><a href=""><i class="fa fa-edit"></i> <span>表单</span></a>
	          <ul class="children">
	            <li><a href="表单页面.html"><i class="fa fa-caret-right"></i> 添加/编辑表单</a></li>
	          </ul>
	        </li>
	        <li class="nav-parent"><a href=""><i class="fa fa-edit"></i> <span>列表</span></a>
	          <ul class="children">
	            <li><a href="列表模板.html"><i class="fa fa-caret-right"></i> 列表页面</a></li>
	          </ul>
	        </li> -->

	      </ul>

	    </div><!-- leftpanelinner -->
  </div><!-- leftpanel -->

  <div class="mainpanel">

    <div class="headerbar">

      <a class="menutoggle"><i class="fa fa-bars"></i></a>

      <form class="searchform" action="index.html" method="post">
        <input type="text" class="form-control" name="keyword" placeholder="Search here..." />
      </form>

      <div class="header-right">
        <ul class="headermenu">
          <li>
            <div class="btn-group">
              <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                <img src="{{$user_pic}}" alt="" />
                {{$username}}
                <span class="caret"></span>
              </button>
              <ul class="dropdown-menu dropdown-menu-usermenu pull-right">
                <li><a href="#"><i class="glyphicon glyphicon-cog"></i> 账户设置</a></li>
                <li><a href="#"><i class="glyphicon glyphicon-question-sign"></i> 修改密码</a></li>
                <li><a href="/admin/logout"><i class="glyphicon glyphicon-log-out"></i> 退出登录</a></li>
              </ul>
            </div>
          </li>
        </ul>
      </div><!-- header-right -->

    </div><!-- headerbar -->

    @yield('pageHeader')

    <div class="contentpanel">

      <!--布局变动的部分-->
      @yield('content')

    </div><!-- contentpanel -->

  </div><!-- mainpanel -->
</section>




</body>
</html>
