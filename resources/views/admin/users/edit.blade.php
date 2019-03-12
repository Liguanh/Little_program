@extends('common.admin_base')

@section('title','管理后台-用户编辑')

@section('pageHeader')
<div class="pageheader">
      <h2><i class="fa fa-home"></i> 用户编辑 <span>Subtitle goes here...</span></h2>
      <div class="breadcrumb-wrapper">
      </div>
    </div>
@endsection

@section('content')

	<div class="alert alert-danger">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <span id="error_msg"></span>
    </div>
      <div class="panel panel-default">
        <div class="panel-heading">
          <div class="panel-btns">
            <a href="" class="panel-close">&times;</a>
            <a href="" class="minimize">&minus;</a>
          </div>

          <h4 class="panel-title">用户编辑</h4>
        </div>
        <div class="panel-body panel-body-nopadding">

          <form class="form-horizontal form-bordered" action="{{route('admin.user.doEdit')}}" method="post" enctype="multipart/form-data">
            {{csrf_field()}}
            <input type="hidden" name="id" value="{{$user->id}}">
            <div class="form-group">
              <label class="col-sm-3 control-label">用户角色</label>
              <div class="col-sm-6">
              	<select name="role_id" class="form-control">
              		@if(!empty($roles))
              			@foreach($roles as $role)
              				<option value="{{$role['id']}}" @if($role_id == $role['id']) selected @endif>{{$role['role_name']}}</option>
              			@endforeach
              		@endif
              	</select>
              </div>
            </div> 

            <div class="form-group">
              <label class="col-sm-3 control-label">用户名</label>
              <div class="col-sm-6">
                <input type="text" placeholder="用户名" class="form-control" name="username" value="{{$user->username}}" />
              </div>
            </div> 
            <div class="form-group">
              <label class="col-sm-3 control-label">用户头像</label>
              <div class="col-sm-6">
                <input type="file" placeholder="用户头像" class="form-control" name="image_url" /><img src="{{$user->image_url}}" style="width: 50px;"> 
              </div>
            </div> 
            
            <div class="form-group">
              <label class="col-sm-3 control-label">是否超管</label>
              <div class="col-sm-6">
					 <div class="radio"><label><input type="radio" name="is_super" value="1" @if($user->is_super == 1) checked @endif> 否</label></div>
					 <div class="radio"><label><input type="radio" name="is_super" value="2" @if($user->is_super == 2) checked @endif>是</label></div>
				  </div>
            </div>
 			<div class="form-group">
              <label class="col-sm-3 control-label">用户状态</label>
              <div class="col-sm-6">
					 <div class="radio"><label><input type="radio" name="status" value="1" @if($user->status == 1) checked @endif> 正常</label></div>
					 <div class="radio"><label><input type="radio" name="status" value="2" @if($user->status == 2) checked @endif>禁用</label></div>
				  </div>
            </div>
            
            <div class="panel-footer">
			 <div class="row">
				<div class="col-sm-6 col-sm-offset-3">
				  <button class="btn btn-primary btn-danger" id="btn-save">修改用户</button>&nbsp;
				</div>
			 </div>
		  </div><!-- panel-footer -->
          </form>
          
        </div><!-- panel-body -->

        <!-- <script type="text/javascript">

        	$(".alert-danger").hide();

        	$("#btn-save").click(function(){

        		var name = $("input[name=name]").val();

        		var url = $("input[name=url]").val();

        		if(name == '' || url == ''){
        			$("#error_msg").text('名字或url地址不能为空');
        			$(".alert-danger").toggle();
        			return false;
        		}

        	});

        </script> -->
@endsection