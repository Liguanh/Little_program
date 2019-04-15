@extends('common.admin_base')

@section('title','管理后台-订单导入')

<!--页面顶部信息-->
@section('pageHeader')
    <div class="pageheader">
        <h2><i class="fa fa-home"></i> 订单导入 <span>Subtitle goes here...</span></h2>
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

            <h4 class="panel-title">订单导入表单</h4>
        </div>
        <div class="panel-body panel-body-nopadding">

            <form class="form-horizontal form-bordered" action="/admin/order/doImport" method="post" enctype="multipart/form-data">
                {{csrf_field()}}
                <div class="form-group">
                    <label class="col-sm-3 control-label">excel文件</label>
                    <div class="col-sm-6">
                        <input type="file" placeholder="广告名称" class="form-control" name="file_name" value="" />
                    </div>
                </div>

                <div class="panel-footer">
                    <div class="row">
                        <div class="col-sm-6 col-sm-offset-3">
                            <button class="btn btn-primary btn-danger" id="btn-save">上传文件</button>&nbsp;
                        </div>
                    </div>
                </div><!-- panel-footer -->
            </form>

        </div><!-- panel-body -->
        <script type="text/javascript">

            $("#alert-danger").hide();

            $("#btn-save").click(function(){

                var file_name = $("input[name=file_name]").val();

                if(file_name == ''){
                    $("#error_msg").text('请上传文件');
                    $(".alert-danger").show();
                    return false;
                }

            });
        </script>

@endsection