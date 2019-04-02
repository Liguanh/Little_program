@extends('common.admin_base')

@section('title','管理后台-文章分类编辑')

<!--页面顶部信息-->
@section('pageHeader')
    <div class="pageheader">
        <h2><i class="fa fa-home"></i> 文章分类编辑 <span>Subtitle goes here...</span></h2>
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

            <h4 class="panel-title">文章分类编辑表单</h4>
        </div>
        <div class="panel-body panel-body-nopadding">

            <form class="form-horizontal form-bordered" action="/admin/article/category/save" method="post">
                {{csrf_field()}}
                <input type="hidden" name="id" value="{{$info->id}}">
                <div class="form-group">
                    <label class="col-sm-3 control-label">文章分类名称</label>
                    <div class="col-sm-6">
                        <input type="text" placeholder="文章分类名称" class="form-control" name="cate_name" value="{{$info->cate_name}}" />
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label">文章分类描述</label>
                    <div class="col-sm-6">
                        <textarea class="form-control" rows="3" name="cate_desc">{{$info->cate_desc}}</textarea>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-3 control-label">文章分类排序</label>
                    <div class="col-sm-6">
                        <input type="text" placeholder="文章分类排序" class="form-control" name="cate_order" value="{{$info->cate_order}}" />
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

                var cate_name = $("input[name=cate_name]").val();

                if(cate_name == ''){
                    $("#error_msg").text('文章分类名称不能为空');
                    $(".alert-danger").show();
                    return false;
                }

            });
        </script>

@endsection