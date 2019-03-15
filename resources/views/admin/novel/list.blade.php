@extends('common.admin_base')

@section('title','管理后台-小说列表')

@section('pageHeader')
<div class="pageheader">
      <h2><i class="fa fa-home"></i> 小说列表 <span>Subtitle goes here...</span></h2>
      <div class="breadcrumb-wrapper">
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
                        <th>分类</th>
                         <th>作者</th>
                         <th>封面</th>
                        <th>小说名字</th>
                         <th>状态</th>
                        <th>操作</th>
                      </tr>
                    </thead>
                    <tbody>
                      @if(!empty($novels))
                        @foreach($novels as $novel)
                          <tr>
                          <td>{{$novel['id']}}</td>
                          <td>{{$novel['c_name']}}</td>
                          <td>{{$novel['author_name']}}</td>
                          <td><img src="{{$novel['image_url']}}" style="width: 60px;"></td>
                          <td>{{ $novel['name']}}</td>
                          <td>{{ $novel['status'] == 1 ? "连载": "完结"}}</td>
                          <td>
                             <a href="{{ route('admin.novel.edit',['id'=>$novel['id']])}}" class="btn btn-sm btn-primary">编辑</a>&nbsp;&nbsp;
                              <a href="{{ route('admin.chapter.create',['id'=>$novel['id']])}}" class="btn btn-sm btn-success">章节添加</a>&nbsp;&nbsp;
                               <a href="{{ route('admin.chapter.list',['id'=>$novel['id']])}}" class="btn btn-sm btn-success">章节查看</a>&nbsp;&nbsp;
                            <a href="{{ route('admin.novel.del',['id'=>$novel['id']])}}" class="btn btn-sm btn-danger">删除</a>
                          </td>
                         </tr>
                        @endforeach

                      @endif
                    	
                    </tbody>
                </table>
                {{$novels->links()}}
            </div><!-- table-responsive -->
        </div>
    </div>
@endsection