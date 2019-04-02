@extends('common.admin_base')

@section('title','管理后台文章分类列表')


<!--页面顶部信息-->
@section('pageHeader')
    <div class="pageheader">
        <h2><i class="fa fa-home"></i> 文章分类列表 <span>Subtitle goes here...</span></h2>
        <div class="breadcrumb-wrapper">
            <a class="btn btn-sm btn-danger" href="/admin/article/category/add">+ 添加文章分类</a>
        </div>
    </div>
@endsection

@section('content')

    <div class="row" id="list">
        <div class="col-md-12">
            <div class="table-responsive">
                <table class="table table-primary  mb30">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>分类名称</th>
                        <th>分类描述</th>
                        <th>分类排序</th>
                        <th>操作</th>
                    </tr>
                    </thead>
                    <tbody>
                        @if(!empty($list))
                        @foreach($list as $key=>$value)
                    <tr>
                        <td>{{$value['id']}}</td>
                        <td>{{$value['cate_name']}}</td>
                        <td>{{$value['cate_desc']}}</td>
                        <td>{{$value['cate_order']}}</td>
                        <td>
                            <a class="btn btn-sm btn-success" href="/admin/article/category/edit/{{$value['id']}}">编辑</a>
                            <a class="btn btn-sm btn-danger" href="/admin/article/category/del/{{$value['id']}}">删除</a>
                        </td>
                    </tr>
                    @endforeach
                    @endif
                    </tbody>
                </table>
            </div><!-- table-responsive -->
        </div>
    </div>
    <script src="/js/vue.js"></script>
@endsection