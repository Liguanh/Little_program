@extends('common.admin_base')

@section('title','管理后台地区列表')


<!--页面顶部信息-->
@section('pageHeader')
    <div class="pageheader">
        <h2><i class="fa fa-home"></i> 地区列表 <span>Subtitle goes here...</span></h2>
        <div class="breadcrumb-wrapper">
            <a class="btn btn-sm btn-success" href="/admin/region/list">< 返回顶级</a>
            <a class="btn btn-sm btn-danger" href="/admin/region/add">+ 添加地区</a>
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
                        <th>地区名称</th>
                        <th>级别</th>
                        <th>操作</th>
                    </tr>
                    </thead>
                    <tbody>
                @if(!empty($region_list))
                @foreach($region_list as $region)
                    <tr>
                        <td>{{$region['id']}}</td>
                        <td>{{$region['region_name']}}</td>
                        <td>{{$region['level']}}</td>
                        <td>
                            <a class="btn btn-sm btn-primary" href="/admin/region/list/{{$region['id']}}">子级</a>
                            <a class="btn btn-sm btn-success" href="/admin/region/edit">编辑</a>
                            <a class="btn btn-sm btn-danger" href="/admin/region/del/{{$region['id']}}">删除</a>
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