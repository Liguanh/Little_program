<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="/images/favicon.png" type="image/png">
    <title>忘记密码页面</title>
    <link href="/css/style.default.css" rel="stylesheet">

    <script src="/js/jquery-1.11.1.min.js"></script>
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="/js/html5shiv.js"></script>
    <script src="/js/respond.min.js"></script>
    <![endif]-->

    <script src="/js/bootstrap.min.js"></script>
</head>

<body class="signin">
<section>

    <div class="signinpanel" id="forget">

        <div class="row">
            <div class="col-md-2" >&nbsp;</div>
            <div class="col-md-8" >
                <div :class="'alert '+error_class" v-if="error_show">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    {error_msg}
                </div>
                @if(session('msg'))
                    <div class="alert alert-danger">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        {{ session('msg') }}
                    </div>
                @endif
                <form method="post" action="/admin/doLogin" onsubmit="return false">
                    {{ csrf_field() }}
                    <h4 class="nomargin">找回密码</h4>
                    <p class="mt5 mb20"></p>
                    <input type="text" name="email" class="form-control" placeholder="请输入邮箱地址" />
                    <input type="text" name="username" class="form-control" placeholder="请输入您的后台账户信息" />
                    <button class="btn btn-primary btn-block login" @click="sendEmail" v-if="sending==1">发送邮件</button>
                    <button class="btn btn-danger btn-block login"  v-else-if="sending==2" disabled>邮件发送中....</button>
                    <button class="btn btn-success btn-block login"  v-else-if="sending==3" disabled>发送成功</button>
                    <button class="btn btn-warning btn-block login" v-else disabled>发送失败</button>
                </form>

            </div><!-- col-sm-5 -->
            <div class="col-md-2" >&nbsp;</div>

        </div><!-- row -->

        <div class="signup-footer" >
            <div class="pull-left" >
                &copy; 2019. 乐知享版权所有
            </div>
        </div>

    </div><!-- signin -->

</section>
<script src="/js/vue.js"></script>

<script type="text/javascript">
    var forget = new Vue({
        el: "#forget",
        delimiters: ['{','}'],
        data:{

        },

        methods:{
            sendEmail: function(){

                var that = this;
                var email = $("input[name=email]").val();
                var username = $("input[name=username]").val();

                $.ajax({
                    url:"/admin/forget/sendEmail",
                    type: "post",
                    data:{email: email, username: username,_token: $("input[name=_token]").val()},
                    dataType: "json",
                    success: function(res){
                        console.log(res);
                    }
                })
            }
        }
    })
</script>
</body>
</html>
