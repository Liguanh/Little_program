@extends('common.admin_base')

@section('title','管理后台-作者列表')

@section('pageHeader')
<div class="pageheader">
      <h2><i class="fa fa-home"></i> 作者列表 <span>Subtitle goes here...</span></h2>
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
                        <th>作者名字</th>
                        <th>作者描述</th>
                        <th>操作</th>
                      </tr>
                    </thead>
                    <tbody>
                      @if(!empty($authors))
                        @foreach($authors as $author)
                          <tr>
                          <td>{{$author['id']}}</td>
                          <td>{{$author['author_name']}}</td>
                          <td>{{$author['author_desc']}}</td>
                          <td>
                            <a href="{{ route('admin.author.del',[ 'id'=>$author['id'] ]) }}" class="btn btn-sm btn-danger">删除</a>
                          </td>
                         </tr>
                        @endforeach

                      @endif
                    	
                    </tbody>
                </table>
                {{$authors->links()}}
            </div><!-- table-responsive -->
        </div>
    </div>
@endsection