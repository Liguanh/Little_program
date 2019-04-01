@extends('common.admin_base')

@section('title','管理后台-商品分类添加')

<!--页面顶部信息-->
@section('pageHeader')
    <div class="pageheader">
        <h2><i class="fa fa-home"></i> 商品分类添加 <span>Subtitle goes here...</span></h2>
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

            <h4 class="panel-title">分类添加表单</h4>
        </div>
        <div class="panel-body panel-body-nopadding">

            <form class="form-horizontal form-bordered" action="/admin/category/doAdd" method="post">
                {{csrf_field()}}

                <div class="form-group">
                    <label class="col-sm-3 control-label">分类名字</label>
                    <div class="col-sm-6">
                        <select class="form-control" name='f_id'>
                            <option value="0">顶级分类</option>
                            @if(!empty($list))
                                @foreach($list as $k => $cate)
                                <option value="{{$cate['id']}}">{{str_repeat('--', $cate['level'])." ".$cate['cate_name']}}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-3 control-label">分类名字</label>
                    <div class="col-sm-6">
                        <input type="text" placeholder="分类名字" class="form-control" name="cate_name" value="" />
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label">是否可用</label>
                    <div class="col-sm-6">
                        <div class="radio"><label><input type="radio" name="status" value="1" checked> 可用</label></div>
                        <div class="radio"><label><input type="radio" name="status" value="2" >禁用</label></div>
                    </div>
                </div>

                <div class="panel-footer">
                    <div class="row">
                        <div class="col-sm-6 col-sm-offset-3">
                            <button class="btn btn-primary btn-danger" id="btn-save">保存分类</button>&nbsp;
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
                    $("#error_msg").text('分类名称不能为空');
                    $(".alert-danger").toggle();
                    return false;
                }

            });

        </script>

@endsection