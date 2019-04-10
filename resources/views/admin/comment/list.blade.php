@extends('common.admin_base')

@section('title','管理后台商品评论')


<!--页面顶部信息-->
@section('pageHeader')
    <div class="pageheader">
        <h2><i class="fa fa-home"></i> 商品评论 <span>Subtitle goes here...</span></h2>
        <div class="breadcrumb-wrapper">
            
        </div>
    </div>
@endsection

@section('content')

    <div class="row" id="goods_list">
        <div class="col-md-12">
            <div class="table-responsive">
                <table class="table table-primary  mb30">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>商品名称</th>
                        <th>评论者</th>
                        <th>评论头像</th>
                        <th>评论类型</th>
                        <th>评论内容</th>
                        <th>操作</th>
                    </tr>
                    </thead>
                    <tbody>
                @if(!empty($comment))
                    @foreach($comment as $val)
                    <tr>
                        <td>{{$val->id or null}}</td>
                        <td>{{$val->goods_name}}</td>
                        <td>{{$val->username or 'admin'}}</td>
                        <td><img  style="width:60px;" src="{{$val->image_url or '/images/photos/media2.png'}}"></td>
                        <td>商评论品</td>
                        <td>{{$val->content or null}}</td>
                        <td>
                            <a class="btn btn-sm btn-success" href="/admin/goods/comment/del/{{$val->id}}">删除
                            </a>
                        </td>
                    </tr>
                    @endforeach
                @endif
                    </tbody>
                </table>
                {{$comment->links()}}
            </div><!-- table-responsive -->
        </div>
    </div>
    <script src="/js/vue.js"></script>
    <script type="text/javascript">
        var goods_list = new Vue({
            el: "#goods_list",
            delimiters: ['{','}'],
            data: {
                goods_list: [],
            },
            //构造函数
            created:function(){

            },
            methods: {
                //商品列表
                getGoodsList: function(){
                    var that = this;

                    $.ajax({
                        url: "/goods/get/data",
                        type: "post",
                        data: {_token: $("input[name=_token"]).val()},
                        dataType:"json",
                        success: function(res){

                        }
                    })
                },
                //修改商品属性
                changeAttr: function(id,key,val){
                    var that = this;

                    $.ajax({
                        url: "/goods/change/attr",
                        type: "post",
                        data: {_token: $("input[name=_token"]).val()},
                        dataType:"json",
                        success: function(res){

                        }
                    })
                },
                //执行删除的操作
                goodsDel:function(id){
                    var that = this;

                    $.ajax({
                        url: "/goods/del/"+id,
                        type: "post",
                        data: {_token: $("input[name=_token"]).val()},
                        dataType:"json",
                        success: function(res){

                        }
                    })
                }
            }
        })
    </script>
@endsection