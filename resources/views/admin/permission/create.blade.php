@extends('common.admin_base')

@section('title','管理后台-权限添加')

<!--页面顶部信息-->
@section('pageHeader')
<div class="pageheader">
      <h2><i class="fa fa-home"></i> 权限添加 <span>Subtitle goes here...</span></h2>
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

          <h4 class="panel-title">权限添加表单</h4>
        </div>
        <div class="panel-body panel-body-nopadding">

          <form class="form-horizontal form-bordered" action="{{route('admin.permission.doCreate')}}" method="post">
            {{csrf_field()}}
            <div class="form-group">
              <label class="col-sm-3 control-label">上级表单</label>
              <div class="col-sm-6">
              	<select name="fid" class="form-control">
              		<option value="0">顶级菜单</option>
              		@foreach($permissions as $permission)
              		<option value="{{$permission['id']}}">{{$permission['name']}}</option>
              		@endforeach
              	</select>
              </div>
            </div> 

            <div class="form-group">
              <label class="col-sm-3 control-label">权限名字</label>
              <div class="col-sm-6">
                <input type="text" placeholder="权限名字" class="form-control" name="name" />
              </div>
            </div> 
            <div class="form-group">
              <label class="col-sm-3 control-label">Url地址</label>
              <div class="col-sm-6">
                <input type="text" placeholder="Url地址" class="form-control" name="url" />
              </div>
            </div> 
            
            <div class="form-group">
              <label class="col-sm-3 control-label">是否菜单</label>
              <div class="col-sm-6">
					 <div class="radio"><label><input type="radio" name="is_menu" value="1" checked> 是</label></div>
					 <div class="radio"><label><input type="radio" name="is_menu" value="2" >否</label></div>
				  </div>
            </div>

            <div class="form-group">
              <label class="col-sm-3 control-label">排序</label>
              <div class="col-sm-6">
                <input type="text" placeholder="排序" class="form-control" name="sort" value="100" />
              </div>
            </div> 
            <div class="panel-footer">
			 <div class="row">
				<div class="col-sm-6 col-sm-offset-3">
				  <button class="btn btn-primary btn-danger" id="btn-save">添加权限</button>&nbsp;
				</div>
			 </div>
		  </div><!-- panel-footer -->
          </form>
          
        </div><!-- panel-body -->

        <script type="text/javascript">

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