@extends('common.admin_base')

@section('title','管理后台-订单详情')

<!--页面顶部信息-->
@section('pageHeader')
    <div class="pageheader">
        <h2><i class="fa fa-home"></i> 订单详情 <span>Subtitle goes here...</span></h2>
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
        <button :class="tab == 1 ? 'btn btn-sm btn-success': 'btn btn-sm btn-danger' " data-tab="1" data-title="基本信息" @click="switchTab">基本信息</button>&nbsp;
        <button :class="tab == 2 ? 'btn btn-sm btn-success': 'btn btn-sm btn-danger'" data-tab="2" data-title="商品信息" @click="switchTab">商品信息</button>&nbsp;
        <button :class="tab == 3 ? 'btn btn-sm btn-success': 'btn btn-sm btn-danger'" data-tab="3" data-title="其他信息" @click="switchTab">其他信息</button>&nbsp;
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
                    <label class="col-sm-2 control-label">订单号</label>
                    <div class="col-sm-4">
                        <label class="control-label">{{$order->order_sn}}</label>
                    </div>
                    <label class="col-sm-2 control-label">订单状态</label>
                    <div class="col-sm-4">
                        <label class="control-label">
                         @if($order->order_status==1)
                                未确认
                            @elseif($order->order_status==2)
                                已确认
                            @elseif($order->order_status==3)
                                已取消
                            @else
                                退货
                            @endif

                            @if($order->pay_status==1)
                                未支付
                            @elseif($order->pay_status==2)
                                支付中
                            @elseif($order->order_status==3)
                                支付成功
                            @else
                                支付失败
                            @endif

                            @if($order->shipping_status==1)
                                待发货
                            @elseif($order->shipping_status==2)
                                已发货
                            @elseif($order->shipping_status==3)
                                确认收货
                            @else
                                退货
                            @endif
                    </label>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">购货人</label>
                    <div class="col-sm-4">
                        <label class="control-label">{{$member->username}}</label>
                    </div>
                    <label class="col-sm-2 control-label">下单时间</label>
                    <div class="col-sm-4">
                        <label class="control-label">{{$order->created_at}}</label>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2 control-label">配送方式</label>
                    <div class="col-sm-4">
                        <label class="control-label">{{$order->shipping_name}}</label>
                    </div>
                    <label class="col-sm-2 control-label">支付方式</label>
                    <div class="col-sm-4">
                        <label class="control-label">{{$order->pay_name}}</label>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2 control-label">确认时间</label>
                    <div class="col-sm-4">
                        <label class="control-label">{{$order->confirm_time}}</label>
                    </div>
                    <label class="col-sm-2 control-label">支付时间</label>
                    <div class="col-sm-4">
                        <label class="control-label">{{$order->pay_time}}</label>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2 control-label">收货人</label>
                    <div class="col-sm-4">
                        <label class="control-label">{{$order->consignee}}</label>
                    </div>
                    <label class="col-sm-2 control-label">收货人手机号</label>
                    <div class="col-sm-4">
                        <label class="control-label">{{$order->phone}}</label>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">收货人地址</label>
                    <div class="col-sm-4">
                        <label class="control-label">{{$country}}
                            {{$province}} {{$city}} {{$district}}  {{$order->address}}</label>
                    </div>
                    <label class="col-sm-2 control-label">收货人编码</label>
                    <div class="col-sm-4">
                        <label class="control-label">{{$order->zcode}}</label>
                    </div>
                </div>
        </div>
        <!--通用信息-->
        <!--商品详情-->
        <div class="panel-body panel-body-nopadding" v-show="tab==2">
                 <div class="col-md-12">
            <div class="table-responsive">
                <table class="table table-primary  mb30">
                    <thead>
                    <tr>
                        <th>商品名称</th>
                        <th>价格</th>
                        <th>数量</th>
                        <th>属性</th>
                        <th>小计</th>
                    </tr>
                    </thead>
                    <tbody>
                @if(!empty($order_goods))
                @foreach($order_goods as $goods)
                    <tr>
                        <td>{{$goods['goods_name']}}</td>
                        <td>{{$goods['market_price']}}</td>
                        <td>{{$goods['goods_num']}}</td>
                        <td>{{$goods['goods_attr']}}</td>
                        <td>{{$goods['market_price'] * $goods['goods_num']}}</td>
                    </tr>
                @endforeach
                @endif
                    </tbody>
                </table>
            </div><!-- table-responsive -->
        </div>
        </div>
        <!--商品详情-->
        <!--商品相册-->
        <div class="panel-body panel-body-nopadding" v-show="tab==3">
                    <div class="form-group">
                        <label class="col-sm-2 control-label">商品总金额</label>
                        <div class="col-sm-4">
                            <label class="control-label">{{$order->goods_price}}</label>
                        </div>
                        <label class="col-sm-2 control-label">配送费</label>
                        <div class="col-sm-4">
                            <label class="control-label">{{$order->shipping_fee}}</label>
                        </div>
                   </div>
                   <div class="form-group">
                        <label class="col-sm-2 control-label">支付总金额</label>
                        <div class="col-sm-4">
                            <label class="control-label">{{$order->pay_price}}</label>
                        </div>
                        <label class="col-sm-2 control-label">已支付金额</label>
                        <div class="col-sm-4">
                            <label class="control-label">{{$order->paid_price}}</label>
                        </div>
                   </div>
                   <div class="form-group">
                        <label class="col-sm-2 control-label">红包金额</label>
                        <div class="col-sm-4">
                            <label class="control-label">{{$order->bonus_price}}</label>
                        </div>
                        <label class="col-sm-2 control-label">备注</label>
                        <div class="col-sm-4">
                            <label class="control-label">{{$order->note}}</label>
                        </div>
                   </div>
            </div><!-- panel-body -->
        <!--商品相册-->
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
                    panel_title:"基本信息"
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

            $(".alert-danger").hide();

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