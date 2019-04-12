@extends('common.admin_base')

@section('title','管理后台-添加批次')

<!--页面顶部信息-->
@section('pageHeader')
    <div class="pageheader">
        <h2><i class="fa fa-home"></i> 添加批次 <span>Subtitle goes here...</span></h2>
        <div class="breadcrumb-wrapper">
        </div>
    </div>
@endsection

@section('content')
    <!--标签切换-->
    <div id="goods_add">
    <p>
        <button :class="tab == 1 ? 'btn btn-sm btn-success': 'btn btn-sm btn-danger' " data-tab="1" data-title="发红包" @click="switchTab">发红包</button>&nbsp;
        <button :class="tab == 2 ? 'btn btn-sm btn-success': 'btn btn-sm btn-danger'" data-tab="2" data-title="发短信"  @click="switchTab">发短信</button>&nbsp;
        <button :class="tab == 3 ? 'btn btn-sm btn-success': 'btn btn-sm btn-danger'" data-tab="3"  data-title="发邮件" @click="switchTab">发邮件</button>&nbsp;
    </p>
    <!--标签切换-->
    <div class="panel panel-default">
        
        <div class="panel-heading">
            <div class="panel-btns">
                <a href="" class="panel-close">&times;</a>
                <a href="" class="minimize">&minus;</a>
            </div>
            <h4 class="panel-title">{panel_title}</h4>
        </div>
        <form class="form-horizontal form-bordered" action="/admin/batch/store" method="post" enctype="multipart/form-data">
            {{csrf_field()}}
        <!--通用信息-->
        <div class="panel-body panel-body-nopadding" v-if="tab==1">
                <input type="hidden" name="type" value="1">
                <div class="form-group">
                    <label class="col-sm-2 control-label">上传文件</label>
                    <div class="col-sm-6">
                     <input type="file" class="form-control" name="file_path">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">内容</label>
                    <div class="col-sm-6">
                     <textarea class="form-control" name='content'></textarea>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2 control-label">备注</label>
                    <div class="col-sm-6">
                     <textarea class="form-control" name='note'></textarea>
                    </div>
                </div>
               
        </div>
        <!--通用信息-->
        <!--用户红包-->
        <div class="panel-body panel-body-nopadding" v-if="tab==2">
                <input type="hidden" name="type" value="2">
                <div class="form-group">
                    <label class="col-sm-2 control-label">上传文件</label>
                    <div class="col-sm-6">
                     <input type="file" class="form-control" name="file_path">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">内容</label>
                    <div class="col-sm-6">
                     <textarea class="form-control" name='content'></textarea>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2 control-label">备注</label>
                    <div class="col-sm-6">
                     <textarea class="form-control" name='note'></textarea>
                    </div>
                </div>
        </div>
        <!--用户红包-->
        <!--资金流水-->
        <div class="panel-body panel-body-nopadding" v-if="tab==3">
                    <input type="hidden" name="type" value="3">
                <div class="form-group">
                    <label class="col-sm-2 control-label">上传文件</label>
                    <div class="col-sm-6">
                     <input type="file" class="form-control" name="file_path">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">内容</label>
                    <div class="col-sm-6">
                     <textarea class="form-control" name='content'></textarea>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2 control-label">备注</label>
                    <div class="col-sm-6">
                     <textarea class="form-control" name='note'></textarea>
                    </div>
                </div>

        </div>
        <div class="panel-footer">
                    <div class="row">
                        <div class="col-sm-6 col-sm-offset-3">
                            <button class="btn btn-primary btn-danger" id="btn-save">保存批次</button>&nbsp;
                        </div>
                    </div>
                </div><!-- panel-footer -->
            </div><!-- panel-body -->
        <!--资金流水-->
        
        </form>
    </div>
</div>
        <!-- panel-body -->
        <script type="text/javascript" src="/js/vue.js"></script>
        <script type="text/javascript" src="/js/datetimepicker/bootstrap-datetimepicker.min.js"></script>
        <script type="text/javascript" src="/js/datetimepicker/bootstrap-datetimepicker.zh-CN.js"></script>
        <link rel="stylesheet" type="text/css" href="/css/datetimepicker/bootstrap-datetimepicker.min.css">
        <script type="text/javascript" src="/js/ueditor/ueditor.config.js"></script>
        <script type="text/javascript" src="/js/ueditor/ueditor.all.js"></script>
        
        <script type="text/javascript">
            //ueditor
            var ue = UE.getEditor('content');
            ue.ready(function(){
                ue.setHeight(280);
            })
            //vue的代码
            var goodsAdd = new Vue({
                el: "#goods_add",
                delimiters: ['{','}'],
                data: {
                    tab: 1,
                    gallery_data:[],
                    gallery_num:0,
                    panel_title:"发红包",
                },
                methods: {
                    //标签切换
                    switchTab: function(e){
                        console.log(e.target.dataset.tab);//获取当前对象属性
                        this.tab = e.target.dataset.tab;
                        this.panel_title = e.target.dataset.title;
                    },
                    //添加相册的表单元素
                    add_upload: function(){
                        this.gallery_num++;
                        this.gallery_data.push({'data-value':this.gallery_num});
                    },
                    //删除执行的表单元素
                    del_upload: function(index){
                        // this.gallery_data.splice(index,1);
                        $("#data_"+index).hide();
                    }
                }
            })

            
        </script>
@endsection