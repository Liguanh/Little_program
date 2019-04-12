@extends('common.admin_base')

@section('title','管理后台-地区添加')

<!--页面顶部信息-->
@section('pageHeader')
    <div class="pageheader">
        <h2><i class="fa fa-home"></i> 地区添加 <span>Subtitle goes here...</span></h2>
        <div class="breadcrumb-wrapper">
        </div>
    </div>
@endsection

@section('content')
    @if(session('msg'))
        <div class="alert alert-danger" id="alert-danger">
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

            <h4 class="panel-title">地区表单</h4>
        </div>
        <div class="panel-body panel-body-nopadding">

            <form class="form-horizontal form-bordered" action="" method="post">
                {{csrf_field()}}
                <div class="form-group">
                    <label class="col-sm-3 control-label">上级地址</label>
                    <div class="col-sm-6">
                        <select name="fid" class="form-control">
                            <option>中国</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label">地区名称</label>
                    <div class="col-sm-6">
                        <input type="text" placeholder="广告名称" class="form-control" name="region_name" value="" />
                    </div>
                </div>

                <div class="panel-footer">
                    <div class="row">
                        <div class="col-sm-6 col-sm-offset-3">
                            <button class="btn btn-primary btn-danger" id="btn-save">保存地区</button>&nbsp;
                        </div>
                    </div>
                </div><!-- panel-footer -->
            </form>

        </div><!-- panel-body -->
        <script type="text/javascript">

            $("#alert-danger").hide();

            $("#btn-save").click(function(){

                var region_name = $("input[name=region_name]").val();

                if(region_name == ''){
                    $("#error_msg").text('地区名称不能为空');
                    $(".alert-danger").show();
                    return false;
                }

            });
        </script>

@endsection