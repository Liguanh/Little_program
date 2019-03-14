@extends('common.admin_base')

@section('title','管理后台-用户添加')

@section('pageHeader')
<div class="pageheader">
      <h2><i class="fa fa-home"></i> 用户添加 <span>Subtitle goes here...</span></h2>
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

          <h4 class="panel-title">用户添加表单</h4>
        </div>
        <div class="panel-body panel-body-nopadding">

          <form class="form-horizontal form-bordered" action="{{route('admin.user.store')}}" method="post" enctype="multipart/form-data">
            {{csrf_field()}}
            <div class="form-group">
              <label class="col-sm-3 control-label">用户角色</label>
              <div class="col-sm-6">
              	<select name="role_id" class="form-control">
              		@if(!empty($roles))
              			@foreach($roles as $role)
              				<option value="{{$role['id']}}">{{$role['role_name']}}</option>
              			@endforeach
              		@endif
              	</select>
              </div>
            </div> 

            <div class="form-group">
              <label class="col-sm-3 control-label">用户名</label>
              <div class="col-sm-6">
                <input type="text" placeholder="用户名" class="form-control" name="username" />
              </div>
            </div> 
            <div class="form-group">
              <label class="col-sm-3 control-label">用户密码</label>
              <div class="col-sm-6">
                <input type="password" placeholder="用户密码" class="form-control" name="password" />
              </div>
            </div> 
            <div class="form-group">
              <label class="col-sm-3 control-label">用户头像</label>
              <div class="col-sm-6">
                <input type="file" placeholder="用户头像" class="form-control" name="image_url" />
              </div>
            </div> 
            
            <div class="form-group">
              <label class="col-sm-3 control-label">是否超管</label>
              <div class="col-sm-6">
					 <div class="radio"><label><input type="radio" name="is_super" value="1" checked> 否</label></div>
					 <div class="radio"><label><input type="radio" name="is_super" value="2" >是</label></div>
				  </div>
            </div>
 			<div class="form-group">
              <label class="col-sm-3 control-label">用户状态</label>
              <div class="col-sm-6">
					 <div class="radio"><label><input type="radio" name="status" value="1" checked> 正常</label></div>
					 <div class="radio"><label><input type="radio" name="status" value="2" >禁用</label></div>
				  </div>
            </div>
            
            <div class="panel-footer">
			 <div class="row">
				<div class="col-sm-6 col-sm-offset-3">
				  <button class="btn btn-primary btn-danger" id="btn-save">添加用户</button>&nbsp;
				</div>
			 </div>
		  </div><!-- panel-footer -->
          </form>
          
        </div><!-- panel-body -->

        <script type="text/javascript" src="/js/ueditor/ueditor.config.js"></script>
        <script type="text/javascript" src="/js/ueditor/ueditor.all.min.js"></script>

        <script type="text/javascript">

          var ue = UE.getEditor('container');
          var ue1 = UE.getEditor('container1');

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

        </script>
@endsection