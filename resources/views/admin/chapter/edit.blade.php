@extends('common.admin_base')

@section('title','管理后台-小说章节编辑')

<!--页面顶部信息-->
@section('pageHeader')
<div class="pageheader">
      <h2><i class="fa fa-home"></i> 小说章节编辑 <span>Subtitle goes here...</span></h2>
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

          <h4 class="panel-title">小说章节编辑表单</h4>
        </div>
        <div class="panel-body panel-body-nopadding">

          <form class="form-horizontal form-bordered" action="{{route('admin.chapter.doEdit')}}" method="post" enctype="multipart/form-data">
            {{csrf_field()}}
            <input type="hidden" name="novel_id" value="{{$chapter->novel_id}}">
            <input type="hidden" name="id" value="{{$chapter->id}}">
            <div class="form-group">
              <label class="col-sm-3 control-label">章节标题</label>
              <div class="col-sm-6">
                <input type="text" placeholder="章节标题" class="form-control" name="title" value="{{$chapter->title}} "/>
              </div>
            </div>

            <div class="form-group">
              <label class="col-sm-3 control-label">章节排序</label>
              <div class="col-sm-6">
                <input type="text" placeholder="章节排序" class="form-control" name="sort" value="{{$chapter->sort}}" />
              </div>
            </div> 

            <div class="form-group">
              <label class="col-sm-3 control-label">章节内容</label>
              <div class="col-sm-8">
                <textarea class="form-control" name="content" style="border: none;" id="container">{{$chapter->content}}</textarea>
              </div>
            </div> 
           
            <div class="panel-footer">
			 <div class="row">
				<div class="col-sm-6 col-sm-offset-3">
				  <button class="btn btn-primary btn-danger" id="btn-save">保存小说章节</button>&nbsp;
				</div>
			 </div>
		  </div><!-- panel-footer -->
          </form>
          
        </div><!-- panel-body -->
        <script type="text/javascript" src="/js/ueditor/ueditor.config.js"></script>
        <script type="text/javascript" src="/js/ueditor/ueditor.all.min.js"></script>
        <script type="text/javascript">

          var ue = UE.getEditor('container');

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