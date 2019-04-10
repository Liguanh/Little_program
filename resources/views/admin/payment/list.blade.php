@extends('common.admin_base')

@section('title','管理后台支付方式列表')


<!--页面顶部信息-->
@section('pageHeader')
    <div class="pageheader">
        <h2><i class="fa fa-home"></i> 支付方式列表 <span>Subtitle goes here...</span></h2>
        <div class="breadcrumb-wrapper">
            <a class="btn btn-sm btn-danger" href="/admin/payment/add">+ 支付方式</a>
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
                        <th>支付名称</th>
                        <th>支付方式描述</th>
                        <th>支付配置</th>
                        <th>排序</th>
                        <th>状态</th>
                        <th>操作</th>
                    </tr>
                    </thead>
                    <tbody>
                @if(!empty($payments))
                    @foreach($payments as $pay)
                    <tr>
                        <td>{{$pay['id']}}</td>
                        <td>{{$pay['pay_name']}}</td>
                        <td>{{$pay['pay_desc']}}</td>
                        <td><?php print_r(unserialize($pay['pay_config'])) ?></td>
                        <td>{{$pay['pay_order']}}</td>
                        <td>{{$pay['status'] == 1 ? "可用" : "禁用"}}</td>
                        <td>
                            <a class="btn btn-sm btn-success" href="/admin/payment/edit/{{$pay['id']}}">编辑</a>
                            <a class="btn btn-sm btn-danger" href="/admin/payment/del/{{$pay['id']}}">删除</a>
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