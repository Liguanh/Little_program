@extends('common.admin_base')

@section('title','管理后台-商品编辑')

<!--页面顶部信息-->
@section('pageHeader')
    <div class="pageheader">
        <h2><i class="fa fa-home"></i> 商品编辑 <span>Subtitle goes here...</span></h2>
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
    <div id="goods_add">
    <p>
        <button :class="tab == 1 ? 'btn btn-sm btn-success': 'btn btn-sm btn-danger' " data-tab="1" @click="switchTab">通用信息</button>&nbsp;
        <button :class="tab == 2 ? 'btn btn-sm btn-success': 'btn btn-sm btn-danger'" data-tab="2" @click="switchTab">商品描述</button>&nbsp;
        <button :class="tab == 3 ? 'btn btn-sm btn-success': 'btn btn-sm btn-danger'" data-tab="3" @click="switchTab">商品相册</button>&nbsp;
    </p>
    <!--标签切换-->
    <div class="panel panel-default">
        
        <div class="panel-heading">
            <div class="panel-btns">
                <a href="" class="panel-close">&times;</a>
                <a href="" class="minimize">&minus;</a>
            </div>
            <h4 class="panel-title">商品编辑表单</h4>
        </div>
        <form class="form-horizontal form-bordered" action="/admin/goods/save" method="post" enctype="multipart/form-data">
            {{csrf_field()}}
            <input type="hidden" name="id" value="{{$info->id}}" id="goods_id">
        <!--通用信息-->
        <div class="panel-body panel-body-nopadding" v-show="tab==1">
                <div class="form-group">
                    <label class="col-sm-2 control-label">商品分类</label>
                    <div class="col-sm-4">
                        <select class="form-control" name="cate_id">
                            @if(!empty($cate_list))
                                @foreach($cate_list as $cate)
                                    <option value="{{$cate['id']}}" {{$info->cate_id == $cate['id'] ? "selected" : ""}}>{{str_repeat('--',$cate['level'])}}{{$cate['cate_name']}}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                     <label class="col-sm-2 control-label">商品品牌</label>
                    <div class="col-sm-4">
                        <select class="form-control" name="brand_id">
                             @if(!empty($brand_list))
                                @foreach($brand_list as $brand)
                                    <option value="{{$brand['id']}}"  {{$info->brand_id == $brand['id'] ? "selected" : ""}}>{{$brand['brand_name']}}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">商品类型</label>
                    <div class="col-sm-4">
                        <select class="form-control" name="type_id">
                            @if(!empty($type_list))
                                @foreach($type_list as $type)
                                    <option value="{{$type['id']}}" {{$info->type_id == $type['id'] ? "selected" : ""}}>{{$type['type_name']}}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                    <label class="col-sm-2 control-label">商品名称</label>
                    <div class="col-sm-4">
                        <input type="text" placeholder="商品名称" class="form-control" name="goods_name" value="{{$info->goods_name}}" />
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">商品货号</label>
                    <div class="col-sm-4">
                        <input type="text" placeholder="商品货号" class="form-control" name="goods_sn" value="{{$info->goods_sn}}" />
                    </div>
                    <label class="col-sm-2 control-label">关键字</label>
                    <div class="col-sm-4">
                        <input type="text" placeholder="关键字" class="form-control" name="keywords" value="{{$info->keywords}}" />
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">市场售价</label>
                    <div class="col-sm-4">
                        <input type="text" placeholder="市场售价" class="form-control" name="shop_price" value="{{$info->shop_price}}" />
                    </div>
                    <label class="col-sm-2 control-label">本店售价</label>
                    <div class="col-sm-4">
                        <input type="text" placeholder="本店售价" class="form-control" name="market_price" value="{{$info->market_price}}" />
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">商品库存</label>
                    <div class="col-sm-4">
                        <input type="text" placeholder="商品库存" class="form-control" name="goods_num" value="{{$info->goods_num}}" />
                    </div>
                    <label class="col-sm-2 control-label">库存报警</label>
                    <div class="col-sm-4">
                        <input type="text" placeholder="库存报警" class="form-control" name="warn_num" value="{{$info->warn_num}}" />
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2 control-label">是否上架</label>
                    <div class="col-sm-4">
                         <div class="radio"><label><input type="radio" name="is_shop" value="1" {{$info->is_shop == 1 ? "checked" : ""}}> 是</label></div>
                        <div class="radio"><label><input type="radio" name="is_shop" value="2" {{$info->is_shop == 2 ? "checked" : ""}}>否</label></div> 
                    </div>
                    <label class="col-sm-2 control-label">上架时间</label>
                    <div class="col-sm-4">
                        <input type="text" placeholder="上架时间" class="form-control" name="shop_time" value="{{$info->shop_time}}" id="shop_time"/>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">是否推荐</label>
                    <div class="col-sm-4">
                         <div class="radio"><label><input type="radio" name="is_recommand" value="1" {{$info->is_recommand == 1 ? "checked" : ""}}> 是</label></div>
                        <div class="radio"><label><input  type="radio" name="is_recommand" value="2" {{$info->is_recommand == 2 ? "checked" : ""}}>否</label></div> 
                    </div>
                    <label class="col-sm-2 control-label">是否最新</label>
                    <div class="col-sm-4">
                         <div class="radio"><label><input type="radio" name="is_new" value="1" {{$info->is_new == 1 ? "checked" : ""}}> 是</label></div>
                        <div class="radio"><label><input  type="radio" name="is_new" value="2" {{$info->is_new == 2 ? "checked" : ""}}>否</label></div> 
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">是否热销</label>
                    <div class="col-sm-4">
                         <div class="radio"><label><input type="radio" name="is_hot" value="1" {{$info->is_hot == 1 ? "checked" : ""}}> 是</label></div>
                        <div class="radio"><label><input  type="radio" name="is_hot" value="2" {{$info->is_hot == 2 ? "checked" : ""}}>否</label></div> 
                    </div>
                    <label class="col-sm-2 control-label">状态</label>
                    <div class="col-sm-4">
                         <div class="radio"><label><input type="radio" name="status" value="1" {{$info->status == 1 ? "checked" : ""}}> 待审核</label></div>
                        <div class="radio"><label><input  type="radio" name="status" value="2" {{$info->status == 2? "checked" : ""}}>已审核</label></div> 
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">商品排序</label>
                    <div class="col-sm-4">
                        <input type="text" placeholder="发布时间" class="form-control"  name="sort" value="{{$info->sort}}" />
                    </div>
                    <label class="col-sm-2 control-label">赠送积分</label>
                    <div class="col-sm-4">
                        <input type="text" placeholder="赠送积分" class="form-control"  name="give_score" value="{{$info->give_score}}" />
                    </div>
                </div>
        </div>
        <!--通用信息-->
        <!--商品详情-->
        <div class="panel-body panel-body-nopadding" v-show="tab==2">
                <div class="form-group">
                    <div class="col-sm-12">
                        <textarea id="content" name="goods_desc">{{$info->goods_desc}}</textarea>
                    </div>
                </div>
        </div>
        <!--商品详情-->
        <!--商品相册-->
        <div class="panel-body panel-body-nopadding" v-show="tab==3">

                <div class="form-group" style="margin-top: 10px;">
                    <div class="col-sm-2" v-for="gall in gallery_list">
                        <p><a href="" target="_blank"><img :src="gall.image_url" style="width: 100%; height: 120px;"></a></p>
                        <p><input class="form-control" :value="gall.image_name"></p>
                        <p style="text-align: center"><a class="btn btn-xs btn-danger" @click="delGoodsGaller(gall.id)"><i class="glyphicon glyphicon-minus"></i></a> </p>
                    </div>
                </div>
                     <!-- 相册添加表单-->
                        <!-- 相册添加表单-->
                        <div class="form-group">
                            <label class="col-sm-2 control-label">图片描述</label>
                            <div class="col-sm-4">
                                <input type="text"  value="" class="form-control" name="gallery[][image_name]">
                                <span class="help-block"></span>
                            </div>
                            <label class="col-sm-2 control-label">商品图片</label>
                            <div class="col-sm-3">
                                <input type="file" placeholder="输入用户名" value="" class="form-control" name="gallery[][image_url]">
                                <span class="help-block"></span>
                            </div>
                            <div class="col-sm-1">
                                <a class="btn btn-sm btn-primary" @click="add_upload"><i class="glyphicon glyphicon-plus"></i> </a>
                            </div>
                        </div>
                        <div class="form-group" v-for="(value,index) in gallery_data" :id="'data_'+index">
                            <label class="col-sm-2 control-label">图片描述</label>
                            <input type="hidden" value="">
                            <div class="col-sm-4">
                                <input type="text"  value="" class="form-control" name="gallery[][image_name]">
                                <span class="help-block"></span>
                            </div>
                            <label class="col-sm-2 control-label">商品图片</label>
                            <div class="col-sm-3">
                                <input type="file" placeholder="输入用户名" value="" class="form-control" name="gallery[][image_url]">
                                <span class="help-block"></span>
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
                            <button class="btn btn-primary btn-danger" id="btn-save">保存商品</button>&nbsp;
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
            //ueditor
            var ue = UE.getEditor('content');
            ue.ready(function(){
                ue.setHeight(280);
            })
            //vue的代码
            var goodsAdd = new Vue({
                el: "#goods_add",
                delmiters: ['{','}'],
                data: {
                    tab: 1,
                    gallery_data:[],//循环添加的数据信息
                    gallery_num:0,//数字
                    gallery_list: [],//相册列表数据
                },
                created: function(){
                    this.getGoodsGallery();
                },
                methods: {
                    //获取商品相册列表
                    getGoodsGallery: function(){
                        var that = this;

                        $.ajax({
                            url: "/admin/goods/gallery/list/"+$("#goods_id").val(),
                            type: "post",
                            data: {_token: $("input[name=_token]").val()},
                            dataType: "json",
                            success: function(res){
                                if(res.code == 2000){
                                    that.gallery_list = res.data;
                                }
                            }
                        })
                    },
                    //删除相册
                    delGoodsGaller: function(id){
                        var that = this;

                        $.ajax({
                            url: "/admin/goods/gallery/del/"+id,
                            type: "get",
                            data: {},
                            dataType: "json",
                            success: function(res){
                                if(res.code == 2000){
                                    that.getGoodsGallery();
                                }
                            }
                        })
                    },
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
                    }
                }
            })

            $(".alert-danger").hide();

            $("#btn-save").click(function(){
                var goods_num = $("input[name=goods_name]").val();
                var goods_sn = $("input[name=goods_sn]").val();
                var shop_price = $("input[name=shop_price]").val();
                var market_price = $("input[name=market_price]").val();
                var goods_num = $("input[name=goods_num]").val();
                var warn_num = $("input[name=warn_num]").val();

                if(goods_num == ''){
                    $("#error_msg").text('商品名称不能为空');
                    $(".alert-danger").show();
                    return false;
                }

                if(goods_sn == ''){
                    $("#error_msg").text('商品货号不能为空');
                    $(".alert-danger").show();
                    return false;
                }

                if(market_price == '' || market_price == ''){
                     $("#error_msg").text('价格不能为空');
                     $(".alert-danger").show();
                     return false;
                }

                if(goods_num == '' || warn_num == ''){
                     $("#error_msg").text('库存不能为空');
                     $(".alert-danger").show();
                     return false;
                }

            });



            //开始日期
            $("#shop_time").datetimepicker({
                format: 'yyyy-mm-dd hh:ii:ss',
                autoclose: true,
                minView: 0,
                language:  'zh-CN',
                minuteStep:1
            });
        </script>
@endsection