@extends('common.admin_base')

@section('title','管理后台-商品SKU属性')

<!--页面顶部信息-->
@section('pageHeader')
    <div class="pageheader">
        <h2><i class="fa fa-home"></i> 商品SKU属性 <span>Subtitle goes here...</span></h2>
        <div class="breadcrumb-wrapper">
        </div>
    </div>
@endsection

@section('content')
    @if(session('msg'))
        <div class="alert alert-danger">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            {{ session('msg') }}
        </div>
    @endif
    <div class="alert alert-danger">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <span id="error_msg"></span>
    </div>
    <!--标签切换-->
    <div id="goods_sku">
    <p>
        <button :class="tab == 1 ? 'btn btn-sm btn-success': 'btn btn-sm btn-danger' " data-tab="1" @click="switchTab">通用属性</button>&nbsp;
        <button :class="tab == 2 ? 'btn btn-sm btn-success': 'btn btn-sm btn-danger'" data-tab="2" @click="switchTab">商品sku属性</button>&nbsp;
    </p>
    <!--标签切换-->
    <div class="panel panel-default">
        
        <div class="panel-heading">
            <div class="panel-btns">
                <a href="" class="panel-close">&times;</a>
                <a href="" class="minimize">&minus;</a>
            </div>
            <h4 class="panel-title">商品SKU属性表单</h4>
        </div>
        <form class="form-horizontal form-bordered" action="/admin/goods/sku/save" method="post" enctype="multipart/form-data">
            {{csrf_field()}}
            <input type="hidden" name="goods_id" value="{{$goods_id}}">
        <!--通用信息-->
        <div class="panel-body panel-body-nopadding" v-show="tab==1">

            @if(!empty($handle))
            @foreach($handle as $k=>$v)
                <div class="form-group">
                    <label class="col-sm-3 control-label">{{$v['attr_name']}}</label>
                    <div class="col-sm-6">
                        <input type="hidden" name="sku[{{$k}}][attr_id]" value="{{$v['id']}}">
                        <input type="text" placeholder="{{$v['attr_name']}}" class="form-control" name="sku[{{$k}}][sku_value]" value="{{$v['sku_value'] or null}}" />
                    </div>
                </div>
            @endforeach
            @endif
        </div>
        <!--通用信息-->
       
        <!--商品相册-->
        <div class="panel-body panel-body-nopadding" v-show="tab==2">
                    {{csrf_field()}}
                    <!-- 相册添加表单-->
                        <div class="form-group">
                            <label class="col-sm-1 control-label">sku列表</label>
                            <div class="col-sm-3">
                                <select name="sku1[0][attr_id]" class="form-control" >
                                    <option v-for="sku in attr_name_list" :value="sku.id">{sku.attr_name}</option>
                                </select>
                                <span class="help-block"></span>
                            </div>
                            <label class="col-sm-1 control-label">sku的值</label>
                            <div class="col-sm-3">
                                <select name="sku1[0][sku_value]" class="form-control">
                                    <option v-for="value in attr_value_list" :value="value">{value}</option>
                                </select>
                                <span class="help-block"></span>
                            </div>
                            <div class="col-sm-2">
                                <input type="text" class="form-control" placeholder="属性价格" name="sku1[0][attr_price]">
                            </div>
                            <div class="col-sm-1">
                                <a class="btn btn-sm btn-primary" @click="add_upload"><i class="glyphicon glyphicon-plus"></i> </a>
                            </div>
                        </div>
                        <div class="form-group" v-for="(value,index) in gallery_data" :id="'data_'+index">
                            <label class="col-sm-1 control-label">sku列表</label>
                            <input type="hidden" value="">
                            <div class="col-sm-3">
                                <select :name="'sku1['+(index+1)+'][attr_id]'" class="form-control" >
                                    <option v-for="sku in attr_name_list" :value="sku.id">{sku.attr_name}</option>
                                </select>
                                <span class="help-block"></span>
                            </div>
                            <label class="col-sm-1 control-label">sku的值</label>
                            <div class="col-sm-3">
                                 <select :name="'sku1['+(index+1)+'][sku_value]'" class="form-control">
                                    <option v-for="value in attr_value_list" :value="value">{value}</option>
                                </select>
                                <span class="help-block"></span>
                            </div>
                            <div class="col-sm-2">
                                <input type="text" class="form-control" :name="'sku1['+(index+1)+'][attr_price]'" placeholder="属性价格">
                            </div>
                            <div class="col-sm-1">
                                <a @click="del_upload(index)" class="btn btn-sm btn-danger"><i class="glyphicon glyphicon-minus"></i></a>
                            </div>
                        </div>
            </div><!-- panel-body -->
        <!--商品相册-->

        <div class="panel-footer">
                    <div class="row">
                        <div class="col-sm-6 col-sm-offset-3">
                            <button class="btn btn-primary btn-danger" id="btn-save">保存属性</button>&nbsp;
                        </div>
                    </div>
        </div><!-- panel-footer -->
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
            
            var goodsSku = new Vue({
                el: "#goods_sku",
                delimiters: ['{','}'],
                data: {
                    tab: 1,
                    gallery_data:[],
                    gallery_num:0,

                    attr_name_list: [],//sku数据的列表
                    attr_value_list:[],
                },
                created: function(){
                    this.getSkuAttr();
                    this.getAttrValue();
                },
                methods: {
                    //标签切换
                    switchTab: function(e){
                        console.log(e.target.dataset.tab);//获取当前对象属性
                        this.tab = e.target.dataset.tab;
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
                    },
                    //获取sku的属性列表
                    getSkuAttr: function(){

                        var goods_id = $("input[name=goods_id]").val();

                        var that = this;

                        $.ajax({
                        url: "/admin/goods/sku/attr/"+goods_id,
                        type: "post",
                        data: {_token: $("input[name=_token]").val()},
                        dataType:"json",
                        success: function(res){
                            console.log(res);
                            if(res.code == 2000){
                                that.attr_name_list = res.data;
                            }
                            
                        }
                    })
                    },
                    //获取属性的值
                    getAttrValue: function(e){
                        var goods_id = $("input[name=goods_id]").val();
                        var that = this;

                        $.ajax({
                        url: "/admin/goods/attr/value/"+goods_id,
                        type: "post",
                        data: {_token: $("input[name=_token]").val()},
                        dataType:"json",
                        success: function(res){
                            if(res.code == 2000){
                                that.attr_value_list = res.data;
                            }
                            
                        }
                    })
                    }
                }
            })

            $(".alert-danger").hide();
        </script>
@endsection