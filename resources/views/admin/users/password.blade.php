@extends('common.admin_base')

@section('title','修改用户的密码')

@section('pageHeader')
<div class="pageheader">
      <h2><i class="fa fa-home"></i> 用户密码修改 <span>Subtitle goes here...</span></h2>
      <div class="breadcrumb-wrapper">
      </div>
    </div>
@endsection
@section('content')

    <div class="" id="pwd">
        @if(session('msg'))
            <div class="alert alert-danger">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                {{ session('msg') }}
            </div>
        @endif
        <div class="alert alert-danger" v-if="error_show">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            {error_msg}
        </div>
        <div class="panel panel-default">
            <div class="panel-heading">
                <div class="panel-btns">
                    <a href="" class="panel-close">&times;</a>
                    <a href="" class="minimize">&minus;</a>
                </div>

                <h4 class="panel-title">密码修改</h4>
            </div>
            <div class="panel-body panel-body-nopadding">

                <form id="password_form" class="form-horizontal form-bordered" action="/admin/user/password/save" method="post" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <input type="hidden" name="id" value="{{$user_id}}">
                    <div class="form-group">
                        <label class="col-sm-3 control-label">用户名</label>
                        <div class="col-sm-6">
                            <input type="text" value="{{$username or null}}" class="form-control" name="username" disabled>
                            <span class="help-block"></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">用户头像</label>
                        <div class="col-sm-6">
                            <image src="{{$user_pic or null}}" style="width: 70px;"/>
                            <span class="help-block"></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">原密码</label>
                        <div class="col-sm-6">
                            <input type="password" placeholder="输入密码" value="{{old('password')}}" class="form-control" name="old_password">
                            <span class="help-block"></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">密码</label>
                        <div class="col-sm-6">
                            <input type="password" placeholder="输入密码" value="{{old('password')}}" class="form-control" name="password">
                            <span class="help-block"></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">确认密码</label>
                        <div class="col-sm-6">
                            <input type="password" placeholder="输入确认密码" value="{{old('password')}}" class="form-control" name="confirm_password">
                            <span class="help-block"></span>
                        </div>
                    </div>
                </form>
                <div class="panel-footer">
                    <div class="row">
                        <div class="col-sm-6 col-sm-offset-3">
                            <button class="btn btn-primary btn-danger" @click="doEditPwd">修改密码</button>&nbsp;
                            <button class="btn btn-default">取消</button>
                        </div>
                    </div>
                </div><!-- panel-footer -->
            </div><!-- panel-body -->



        </div><!-- panel -->



    </div><!-- contentpanel -->

    <script type="text/javascript" src="/js/vue.js"></script>

    <script type="text/javascript">
        
//修改用户密码的操作
var pwd = new Vue({
    el: "#pwd",
    delimiters: ['{','}'],
    data: {
        error_show: false,
        error_msg: ''
    },
    methods: {
        //执行密码修改
        doEditPwd: function () {

            var old_password = $("input[name=old_password]").val();
            var password = $("input[name=password]").val();

            var confirm = $("input[name=confirm_password]").val();

            if(old_password == ''){
                this.error_show = true;
                this.error_msg = "原密码不能为空";
                return false;
            }

            if(password == ''){
                this.error_show = true;
                this.error_msg = "密码不能为空";
                return false;
            }

            if(confirm == ''){
                this.error_show = true;
                this.error_msg = "确认密码不能为空";
                return false;
            }

            if(confirm != password){
                this.error_show = true;
                this.error_msg = "密码不一致，请重新输入";
                return false;
            }

            this.error_show = false;

            $("#password_form").submit();
        }
    }
});
    </script>
@endsection