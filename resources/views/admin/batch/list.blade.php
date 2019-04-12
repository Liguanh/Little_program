@extends('common.admin_base')

@section('title','管理后台批次列表')


<!--页面顶部信息-->
@section('pageHeader')
    <div class="pageheader">
        <h2><i class="fa fa-home"></i> 批次列表 <span>Subtitle goes here...</span></h2>
        <div class="breadcrumb-wrapper">
            <a class="btn btn-sm btn-danger" href="/admin/batch/add">+ 批次列表</a>
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
                        <th class="col-md-2">文件路径</th>
                        <th>批次类型</th>
                        <th>内容</th>
                        <th>状态</th>
                        <th>备注</th>
                        <th>操作</th>
                    </tr>
                    </thead>
                    <tbody>

                @if(!empty($batch_list))
                    @foreach($batch_list as $batch)
                    <tr>
                        <td>{{$batch->id}}</td>
                        <td>{{$batch->file_path}}</td>
                        <td>
                            @if($batch->type == 1)
                            发红包
                            @elseif($batch->type == 2)
                            发短信
                            @else 
                            发邮件
                            @endif
                        </td>
                        <td>{{$batch->content}}</td>
                        <td>
                            @if($batch->status == 1)
                            未审核
                            @elseif($batch->status == 2)
                            待处理
                            @else 
                            已处理
                            @endif
                        </td>
                        <td>{{$batch->note}}</td>
                        <td>
                            @if($batch->status<=2)
                            <a class="btn btn-sm btn-success" href="/admin/batch/do/{{$batch->id}}">执行</a>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                    @endif
                    </tbody>
                </table>
                {{$batch_list->links()}}
            </div><!-- table-responsive -->
        </div>
    </div>
    <script src="/js/vue.js"></script>
@endsection