@extends('common.admin_base')

@section('title','管理后台运营活动')


<!--页面顶部信息-->
@section('pageHeader')
    <div class="pageheader">
        <h2><i class="fa fa-home"></i> 运营活动 <span>Subtitle goes here...</span></h2>
        <div class="breadcrumb-wrapper">
            <a class="btn btn-sm btn-danger" href="/admin/activity/add">+ 运营活动</a>
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
                        <th>活动名称</th>
                        <th>开始时间</th>
                        <th>结束时间</th>
                        <th>活动配置</th>
                        <th>操作</th>
                    </tr>
                    </thead>
                    <tbody>
                @foreach($activites as $ac)
                    <tr>
                        <td>{{$ac['id']}}</td>
                        <td>{{$ac['name']}}</td>
                        <td>{{$ac['start_time']}}</td>
                        <td>{{$ac['end_time']}}</td>
                        <td><?php print_r(unserialize($ac['activity_config']))?></td>
                        <td>
                            <a class="btn btn-sm btn-success" href="/admin/activity/edit/{{$ac['id']}}">编辑</a>
                            <a class="btn btn-sm btn-danger" href="/admin/activity/del/{{$ac['id']}}">删除</a>
                        </td>
                    </tr>
                @endforeach
                    </tbody>
                </table>
            </div><!-- table-responsive -->
        </div>
    </div>
    <script src="/js/vue.js"></script>
@endsection