@extends('common.admin_base')

@section('title','管理后台-测试添加')

<!--页面顶部信息-->
@section('pageHeader')
    <div class="pageheader">
        <h2><i class="fa fa-home"></i> 测试添加 <span>Subtitle goes here...</span></h2>
        <div class="breadcrumb-wrapper">
        </div>
    </div>
@endsection

@section('content')
    @if (count($errors) > 0)
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="panel-btns">
                <a href="" class="panel-close">&times;</a>
                <a href="" class="minimize">&minus;</a>
            </div>

            <h4 class="panel-title">广告位添加表单</h4>
        </div>
        <div class="panel-body panel-body-nopadding">

            <form class="form-horizontal form-bordered" action="/admin/test/store" method="post">
                {{csrf_field()}}
                <div class="form-group">
                    <label class="col-sm-3 control-label">广告位名称</label>
                    <div class="col-sm-6">
                        <input type="text" placeholder="广告名称" class="form-control" name="position_name" value="" />
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label">广告位描述</label>
                    <div class="col-sm-6">
                        <textarea class="form-control" rows="3" name="position_desc"></textarea>
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

@endsection