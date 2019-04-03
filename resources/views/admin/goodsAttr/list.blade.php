@extends('common.admin_base')

@section('title','管理后台商品属性')


<!--页面顶部信息-->
@section('pageHeader')
    <div class="pageheader">
        <h2><i class="fa fa-home"></i> 商品属性 <span>Subtitle goes here...</span></h2>
        <div class="breadcrumb-wrapper">
            <a class="btn btn-sm btn-danger" href="/admin/goods/attr/add">+ 商品属性</a>
            <a class="btn btn-sm btn-black" href="/admin/goods/type/list"> 商品类型</a>
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
                        <th>属性名称</th>
                        <th>商品类型</th>
                        <th>录入方式</th>
                        <th>可选值</th>
                        <th>状态</th>
                        <th>操作</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if(!empty($attr_list))
                    @foreach($attr_list as $attr)
                        <tr>
                            <td>{{$attr->id}}</td>
                            <td>{{$attr->attr_name}}</td>
                            <td>{{$attr->type_name}}</td>
                            <td>{{$attr->input_type==1 ? "手动录入" : "列表选择"}}</td>
                            <td>{{$attr->attr_value}}</td>
                            <td>{{$attr->status == 1 ? "可用" : "不可用"}}</td>
                            <td>
                                <a class="btn btn-sm btn-warning" href="/admin/goods/attr/edit/{{$attr['id']}}">编辑</a>&nbsp;
                                <a class="btn btn-sm btn-danger" href="/admin/goods/attr/del/{{$attr['id']}}">删除</a>
                            </td>
                        </tr>
                    @endforeach
                    @endif
                    </tbody>
                </table>
                {{$attr_list->links()}}
            </div><!-- table-responsive -->
        </div>
    </div>
    <script src="/js/vue.js"></script>
@endsection