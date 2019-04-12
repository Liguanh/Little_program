@extends('common.admin_base')

@section('title','管理后台-红包添加')

<!--页面顶部信息-->
@section('pageHeader')
    <div class="pageheader">
        <h2><i class="fa fa-home"></i> 红包添加 <span>Subtitle goes here...</span></h2>
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
    <div class="alert alert-danger">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <span id="error_msg"></span>
    </div>
    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="panel-btns">
                <a href="" class="panel-close">&times;</a>
                <a href="" class="minimize">&minus;</a>
            </div>

            <h4 class="panel-title">红包添加表单</h4>
        </div>
        <div class="panel-body panel-body-nopadding">

            <form class="form-horizontal form-bordered" action="/admin/bonus/store" method="post">
                {{csrf_field()}}

                 <div class="form-group">
                    <label class="col-sm-3 control-label">红包名称</label>
                    <div class="col-sm-6">
                        <input type="text" placeholder="红包名称" class="form-control" name="bonus_name" value="" />
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label">红包金额</label>
                    <div class="col-sm-6">
                        <input type="text" placeholder="红包金额" class="form-control" name="money" value="" />
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label">最小使用金额</label>
                    <div class="col-sm-6">
                        <input type="text" placeholder="最小使用金额" class="form-control" name="min_money" value="" />
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label">有效天数</label>
                    <div class="col-sm-6">
                        <input type="text" placeholder="有效天数" class="form-control" name="expires" value="" />
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label">发放开始时间</label>
                    <div class="col-sm-6">
                        <input type="text" placeholder="开始时间" id="start_time" class="form-control" name="send_start_date" value="" />
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label">发放结束时间</label>
                    <div class="col-sm-6">
                        <input type="text" placeholder="结束时间" class="form-control" id="end_time" name="send_end_date" value="" />
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label">状态</label>
                    <div class="col-sm-6">
                        <div class="radio"><label><input type="radio" name="status" value="1" checked> 可用</label></div>
                        <div class="radio"><label><input type="radio" name="status" value="2" >不可用</label></div>
                    </div>
                </div>

                <div class="panel-footer">
                    <div class="row">
                        <div class="col-sm-6 col-sm-offset-3">
                            <button class="btn btn-primary btn-danger" id="btn-save">保存红包</button>&nbsp;
                        </div>
                    </div>
                </div><!-- panel-footer -->
            </form>

        </div><!-- panel-body -->
        <script type="text/javascript" src="/js/datetimepicker/bootstrap-datetimepicker.min.js"></script>
        <script type="text/javascript" src="/js/datetimepicker/bootstrap-datetimepicker.zh-CN.js"></script>
        <link rel="stylesheet" type="text/css" href="/css/datetimepicker/bootstrap-datetimepicker.min.css">
        <script type="text/javascript">

            $(".alert-danger").hide();

            $("#btn-save").click(function(){

                var money = $("input[name=money]").val();
                var bonus_name = $("input[name=bonus_name]").val();
                var min_money = $("input[name=min_money]").val();
                var expires = $("input[name=expires]").val();
                var send_start_date = $("input[name=send_start_date]").val();
                var send_end_date = $("input[name=send_end_date]").val();

                
                if(bonus_name == ''){
                    $("#error_msg").text('红包名称不能为空');
                    $(".alert-danger").show();
                    return false;
                }
                if(money == ''){
                    $("#error_msg").text('请输入红包金额');
                    $(".alert-danger").show();
                    return false;
                }
                if(min_money == ''){
                    $("#error_msg").text('请输入最小使用金额');
                    $(".alert-danger").show();
                    return false;
                }
                if(expires == ''){
                    $("#error_msg").text('有效天数不能为空');
                    $(".alert-danger").show();
                    return false;
                }

                if(send_end_date == '' || send_start_date==''){
                    $("#error_msg").text('时间不能为空');
                    $(".alert-danger").show();
                    return false;
                }

                if(send_end_date < send_start_date){
                    $("#error_msg").text('结束时间不能小于开始时间');
                    $(".alert-danger").toggle();
                    return false;
                }

            });

            //开始日期
            $("#start_time,#end_time").datetimepicker({
                format: 'yyyy-mm-dd',
                autoclose: true,
                maxView: 4,
                language:  'zh-CN',
                minuteStep:3
            });

        </script>

@endsection