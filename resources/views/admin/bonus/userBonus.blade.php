@extends('common.admin_base')

@section('title','管理后台红包发送记录')


<!--页面顶部信息-->
@section('pageHeader')
    <div class="pageheader">
        <h2><i class="fa fa-home"></i> 红包发送记录 <span>Subtitle goes here...</span></h2>
        
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
                        <th>用户名</th>
                        <th >用户手机</th>
                        <th>红包名称</th>
                        <th>红包发送时间</th>
                        <th>使用截至时间</th>
                        <th>状态</th>
                    </tr>
                    </thead>
                    <tbody>
                @if(!empty($user_bonus))
                 @foreach($user_bonus as $bonus)
                    <tr>
                        <td>{{$bonus->id}}</td>
                        <td>{{$bonus->username}}</td>
                        <td>{{$bonus->phone}}</td>
                        <td>{{$bonus->bonus_name}}</td>
                        <td>{{$bonus->start_time}}</td>
                        <td>{{$bonus->end_time}}</td>
                        <td>
                            @if($bonus->status == 1) 
                            未使用
                            @elseif($bonus->status == 2) 
                             已使用 
                            @else 
                             已过期 
                            @endif
                        </td>
                    </tr>
                  @endforeach
                 @endif
                    </tbody>
                </table>
                {{$user_bonus->links()}}
            </div><!-- table-responsive -->
        </div>
    </div>
    <script src="/js/vue.js"></script>
@endsection