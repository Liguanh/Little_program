@extends('common.admin_base')

@section('title','管理后台商品品牌')


<!--页面顶部信息-->
@section('pageHeader')
    <div class="pageheader">
        <h2><i class="fa fa-home"></i> 商品品牌 <span>Subtitle goes here...</span></h2>
        <div class="breadcrumb-wrapper">
            <a class="btn btn-sm btn-danger" href="/admin/brand/add">+ 商品品牌</a>
        </div>
    </div>
@endsection

@section('content')
    {{csrf_field()}}
    <div class="row" id="brand_list">
        <div class="col-md-12">
            <div class="table-responsive">
                <table class="table table-primary  mb30">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>品牌名称</th>
                        <th>是否可用</th>
                        <th>操作</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="brand in brand_list">
                        <td>{brand.id}</td>
                        <td>{brand.brand_name}</td>
                        <td>
                            <button @click="changeAttr(brand.id,'status',2)" v-if="brand.status==1" class="btn btn-sm btn-success">可用</button>
                            <button v-else class="btn btn-sm btn-black" @click="changeAttr(brand.id,'status',1)">禁用</button>
                        </td>
                        <td>
                            <a v-bind:href="'/admin/brand/edit/'+brand.id" class='btn btn-sm btn-danger'>修改</a>&nbsp;&nbsp;
                            <button class="btn btn-sm btn-primary" @click="delBrand(brand.id)">删除</button>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div><!-- table-responsive -->
        </div>
    </div>
    <script src="/js/vue.js"></script>
    <script type="text/javascript">
        var brand = new Vue({
            el: "#brand_list",
            delimiters: ['{','}'],//自定义标签
            data: {
                brand_list:[]
            },
            created: function() {
                this.getList();
            },

            methods:{
                //获取列表
                getList: function(){
                    var that = this;

                    $.ajax({
                        url:"/admin/brand/data/list",
                        type: "post",
                        data:{_token: $("input[name=_token]").val()},
                        dataType:"json",

                        success: function(res) {
                            that.brand_list = res.data;
                        }
                    })
                },
                //删除操作
                delBrand: function(id) {
                    var that = this;
                    $.ajax({
                        url:"/admin/brand/del/"+id,
                        type: "get",
                        data:{},
                        dataType:"json",
                        success: function(res) {
                            if(res.code == 2000){
                                that.getList();
                            }
                        }
                    })
                },
                //修改商品属性
                changeAttr: function(id,key,value){
                    var that = this;
                    $.ajax({
                        url:"/admin/brand/change/attr",
                        type: "post",
                        data:{_token: $("input[name=_token]").val(),id:id,key:key,value:value},
                        dataType:"json",
                        success: function(res) {
                            if(res.code == 2000){
                                that.getList();
                            }
                        }
                    })
                }
            }

        })
    </script>
@endsection