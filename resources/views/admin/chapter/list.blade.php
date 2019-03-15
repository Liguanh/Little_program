@extends('common.admin_base')

@section('title','管理后台-小说章节列表')

@section('pageHeader')
<div class="pageheader">
      <h2><i class="fa fa-home"></i> 小说章节列表 <span>Subtitle goes here...</span></h2>
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
                        <th>小说名字</th>
                         <th>章节名字</th>
                         <th>排序</th>
                        <th>操作</th>
                      </tr>
                    </thead>
                    <tbody>
                      @if(!empty($chapter_list))
                        @foreach($chapter_list as $chapter)
                          <tr>
                          <td>{{$chapter['id']}}</td>
                          <td>{{$chapter['name']}}</td>
                          <td>{{$chapter['title']}}</td>
                          <td>{{ $chapter['sort']}}</td>
                          <td>
                          	 <a href="{{ route('admin.chapter.edit',['id'=>$chapter['id']])}}" class="btn btn-sm btn-danger">编辑</a>&nbsp;&nbsp;
                             <a href="{{ route('admin.chapter.del',['id'=>$chapter['id']])}}" class="btn btn-sm btn-danger">删除</a>
                          </td>
                         </tr>
                        @endforeach

                      @endif
                    	
                    </tbody>
                </table>
                {{$chapter_list->links()}}
            </div><!-- table-responsive -->
        </div>
    </div>
@endsection