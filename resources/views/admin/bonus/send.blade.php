@extends('common.admin_base')

@section('title','管理后台-发送红包')

<!--页面顶部信息-->
@section('pageHeader')
    <div class="pageheader">
        <h2><i class="fa fa-home"></i> 发送红包 <span>Subtitle goes here...</span></h2>
        <div class="breadcrumb-wrapper">
        </div>
    </div>
@endsection

@section('content')
    @if(session('msg'))
        <div class="alert alert-danger">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            {{ session('msg') }}
        </div>
    @endif
    <div class="alert alert-danger" id="alert-danger">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <span id="error_msg"></span>
    </div>
    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="panel-btns">
                <a href="" class="panel-close">&times;</a>
                <a href="" class="minimize">&minus;</a>
            </div>

            <h4 class="panel-title">发送红包表单</h4>
        </div>
        <div class="panel-body panel-body-nopadding">

            <form class="form-horizontal form-bordered" action="/admin/bonus/doSend" method="post">
                {{csrf_field()}}

                <input type="hidden" name="bonus_id" value="{{$bonus_info->id}}">
                <input type="hidden" name="expires" value="{{$bonus_info->expires}}">
                <div class="form-group">
                    <label class="col-sm-3 control-label">红包名称</label>
                    <div class="col-sm-6">
                        <input type="text" placeholder="红包名称" class="form-control" name="bonus_name" value="{{$bonus_info->bonus_name}}"  disabled />
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label">用户手机号</label>
                    <div class="col-sm-6">
                        <input type="text" placeholder="请输入用户手机号" class="form-control" name="phone" value="" />
                    </div>
                </div>

                <div class="panel-footer">
                    <div class="row">
                        <div class="col-sm-6 col-sm-offset-3">
                            <button class="btn btn-primary btn-danger" id="btn-save">发送红包</button>&nbsp;
                        </div>
                    </div>
                </div><!-- panel-footer -->
            </form>

        </div><!-- panel-body -->
        <script type="text/javascript" src="/js/datetimepicker/bootstrap-datetimepicker.min.js"></script>
        <script type="text/javascript" src="/js/datetimepicker/bootstrap-datetimepicker.zh-CN.js"></script>
        <link rel="stylesheet" type="text/css" href="/css/datetimepicker/bootstrap-datetimepicker.min.css">
        <script type="text/javascript">

            $("#alert-danger").hide();

                $("#btn-save").click(function(){

                var phone = $("input[name=phone]").val();

                if(phone == ''){
                    $("#error_msg").text('请输入用户的手机');
                    $(".alert-danger").show();
                    return false;
                }

            });

            //开始日期
            $("#start_time,#end_time").datetimepicker({
                format: 'yyyy-mm-dd hh:ii:ss',
                autoclose: true,
                minView: 0,
                language:  'zh-CN',
                minuteStep:1
            });

        </script>

@endsection