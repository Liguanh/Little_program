@extends('common.admin_base')

@section('title','管理后台-广告位编辑')

<!--页面顶部信息-->
@section('pageHeader')
    <div class="pageheader">
        <h2><i class="fa fa-home"></i> 广告位编辑 <span>Subtitle goes here...</span></h2>
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

            <h4 class="panel-title">广告位编辑表单</h4>
        </div>
        <div class="panel-body panel-body-nopadding">

            <form class="form-horizontal form-bordered" action="/admin/position/save" method="post">
                {{csrf_field()}}
                <input type="hidden" name="id" value="{{$info->id}}">
                <div class="form-group">
                    <label class="col-sm-3 control-label">广告位名称</label>
                    <div class="col-sm-6">
                        <input type="text" placeholder="广告名称" class="form-control" name="position_name" value="{{$info->position_name}}" />
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label">广告位描述</label>
                    <div class="col-sm-6">
                        <textarea class="form-control" rows="3" name="position_desc">{{$info->position_desc}}</textarea>
                    </div>
                </div>

                <div class="panel-footer">
                    <div class="row">
                        <div class="col-sm-6 col-sm-offset-3">
                            <button class="btn btn-primary btn-danger" id="btn-save">保存广告位</button>&nbsp;
                        </div>
                    </div>
                </div><!-- panel-footer -->
            </form>

        </div><!-- panel-body -->
        <script type="text/javascript">

            $(".alert-danger").hide();

            $("#btn-save").click(function(){

                var position_name = $("input[name=position_name]").val();

                if(position_name == ''){
                    $("#error_msg").text('广告位名称不能为空');
                    $(".alert-danger").show();
                    return false;
                }

            });
        </script>

@endsection