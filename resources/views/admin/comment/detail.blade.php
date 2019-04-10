@extends('common.admin_base')

@section('title','管理后台-用户详情')

<!--页面顶部信息-->
@section('pageHeader')
    <div class="pageheader">
        <h2><i class="fa fa-home"></i> 用户详情 <span>Subtitle goes here...</span></h2>
        <div class="breadcrumb-wrapper">
        </div>
    </div>
@endsection

@section('content')
    <!--标签切换-->
    <div id="goods_add">
    <p>
        <button :class="tab == 1 ? 'btn btn-sm btn-success': 'btn btn-sm btn-danger' " data-tab="1" data-title="基本信息" @click="switchTab">基本信息</button>&nbsp;
        <button :class="tab == 2 ? 'btn btn-sm btn-success': 'btn btn-sm btn-danger'" data-tab="2" data-title="用户红包"  @click="switchTab">用户红包</button>&nbsp;
        <button :class="tab == 3 ? 'btn btn-sm btn-success': 'btn btn-sm btn-danger'" data-tab="3"  data-title="资金流水" @click="switchTab">资金流水</button>&nbsp;
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
        <form class="form-horizontal form-bordered" action="/admin/goods/store" method="post" enctype="multipart/form-data">
            {{csrf_field()}}
        <!--通用信息-->
        <div class="panel-body panel-body-nopadding" v-show="tab==1">
                <div class="form-group">
                    <label class="col-sm-2 control-label">用户名</label>
                    <div class="col-sm-4">
                     ###
                    </div>
                     <label class="col-sm-2 control-label">手机号</label>
                    <div class="col-sm-4">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">账户积分</label>
                    <div class="col-sm-4">
                       sddssdsssd
                    </div>
                     <label class="col-sm-2 control-label">账户余额</label>
                    <div class="col-sm-4">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">状态</label>
                    <div class="col-sm-4">
                       
                    </div>
                     <label class="col-sm-2 control-label">默认收货地址</label>
                    <div class="col-sm-4">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">邮箱</label>
                    <div class="col-sm-4">
                       
                    </div>
                     <label class="col-sm-2 control-label">性别</label>
                    <div class="col-sm-4">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">紧急联系人</label>
                    <div class="col-sm-4">
                        
                    </div>
                     <label class="col-sm-2 control-label">紧急联系人手机号</label>
                    <div class="col-sm-4">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">激活码</label>
                    <div class="col-sm-4">
                        
                    </div>
                
                </div>
        </div>
        <!--通用信息-->
        <!--用户红包-->
        <div class="panel-body panel-body-nopadding" v-show="tab==2">
                <div class="col-md-12">
            <div class="table-responsive">
                <table class="table table-primary  mb30">
                    <thead>
                    <tr>
                        <th>红包名</th>
                        <th>红包金额</th>
                        <th>开始时间</th>
                        <th>结束时间</th>
                        <th>最小使用金额</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>121321321</td>
                        <td>##</td>
                        <td>##</td>
                        <td>##</td>
                        <td>##</td>
                    </tr>
                    </tbody>
                </table>
            </div><!-- table-responsive -->
        </div>
        </div>
        <!--用户红包-->
        <!--资金流水-->
        <div class="panel-body panel-body-nopadding" v-show="tab==3">
                     <div class="col-md-12">
            <div class="table-responsive">
                <table class="table table-success  mb30">
                    <thead>
                    <tr>
                        <th>金额</th>
                        <th>类型</th>
                        <th>添加时间</th>
                        <th>更新时间</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>+100.00</td>
                        <td>##</td>
                        <td>##</td>
                        <td>##</td>
                        
                    </tr>
                    </tbody>
                </table>
            </div><!-- table-responsive -->
        </div>
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
                    panel_title:"用户详情",
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