@extends('common.admin_base')

@section('title','管理后台-分类列表')

@section('pageHeader')
<div class="pageheader">
      <h2><i class="fa fa-home"></i> 分类列表 <span>Subtitle goes here...</span></h2>
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
                        <th>分类名字</th>
                        <th>操作</th>
                      </tr>
                    </thead>
                    <tbody>
                      @if(!empty($categorys))
                        @foreach($categorys as $category)
                          <tr>
                          <td>{{$category['id']}}</td>
                          <td>{{$category['c_name']}}</td>
                          <td>
                            <a href="{{ route('admin.category.del',[ 'id'=>$category['id'] ]) }}" class="btn btn-sm btn-danger">删除</a>
                          </td>
                         </tr>
                        @endforeach

                      @endif
                    	
                    </tbody>
                </table>
                {{$categorys->links()}}
            </div><!-- table-responsive -->
        </div>
    </div>
@endsection