@extends('common.admin_base')

@section('title','管理后台-支付方式编辑')

<!--页面顶部信息-->
@section('pageHeader')
    <div class="pageheader">
        <h2><i class="fa fa-home"></i> 支付方式编辑 <span>Subtitle goes here...</span></h2>
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

            <h4 class="panel-title">支付方式表单</h4>
        </div>
        <div class="panel-body panel-body-nopadding">

            <form class="form-horizontal form-bordered" action="/admin/payment/save" method="post">
                {{csrf_field()}}
                <input type="hidden" name="id" value="{{$info['id']}}">
                <div class="form-group">
                    <label class="col-sm-3 control-label">支付名称</label>
                    <div class="col-sm-6">
                        <input type="text" placeholder="支付名称" class="form-control" name="pay_name" value="{{$info['pay_name']}}" />
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label">支付方式描述</label>
                    <div class="col-sm-6">
                        <textarea class="form-control" rows="3" name="pay_desc">{{$info['pay_desc']}}</textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label">支付配置</label>
                    <div class="col-sm-6">
                        <textarea class="form-control" rows="3" name="pay_config" placeholder="key=>val|key1=>val2">{{$info['pay_config']}}</textarea>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-3 control-label">排序</label>
                    <div class="col-sm-6">
                        <input type="text" placeholder="排序" class="form-control" name="pay_order" value="{{$info['pay_order']}}" />
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label">状态</label>
                    <div class="col-sm-6">
                        <div class="radio"><label><input type="radio" name="status" value="1" {{$info['status'] == 1 ? "checked" : ""}}> 开启</label></div>
                        <div class="radio"><label><input type="radio" name="status" value="2" {{$info['status'] == 2 ? "checked" : ""}} >关闭</label></div>
                    </div>
                </div>
                <div class="panel-footer">
                    <div class="row">
                        <div class="col-sm-6 col-sm-offset-3">
                            <button class="btn btn-primary btn-danger" id="btn-save">保存支付方式</button>&nbsp;
                        </div>
                    </div>
                </div><!-- panel-footer -->
            </form>

        </div><!-- panel-body -->
        <script type="text/javascript">

            $(".alert-danger").hide();

            $("#btn-save").click(function(){

                var pay_name = $("input[name=pay_name]").val();

                if(pay_name == ''){
                    $("#error_msg").text('名称不能为空');
                    $(".alert-danger").show();
                    return false;
                }

            });
        </script>

@endsection