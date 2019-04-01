@extends('common.admin_base')

@section('title','管理后台商品分类')


<!--页面顶部信息-->
@section('pageHeader')
    <div class="pageheader">
        <h2><i class="fa fa-home"></i> 商品分类 <span>Subtitle goes here...</span></h2>
        <div class="breadcrumb-wrapper">
            <a class="btn btn-sm btn-danger" href="/admin/category/add">+ 商品分类</a>
        </div>
    </div>
@endsection

@section('content')
    {{csrf_field()}}
    <div class="row" id="cate_list">
        
        <div class="col-md-12">
            <div class="table-responsive">
                <p><button v-if="fid > 0" class="btn btn-sm btn-success" @click="getCategoryList(0)">返回上级</button></p>
                <table class="table table-primary  mb30">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>分类名称</th>
                        <th>是否可用</th>
                        <th>操作</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="cate in cate_list">
                        <td>{cate.id}</td>
                        <td>{cate.cate_name}</td>
                        <td>
                            <button v-if="cate.status==1" class="btn btn-sm btn-success">可用</button>
                            <button v-else class="btn btn-sm btn-black" >禁用</button>
                        </td>
                        <td>
                            <button class="btn btn-sm btn-success" @click="getCategoryList(cate.id)">查看子级</button>&nbsp;
                            <a class="btn btn-sm btn-warning" v-bind:href="'/admin/category/edit/'+cate.id">编辑</a>&nbsp;
                            <button class="btn btn-sm btn-danger" @click="delCategory(cate.id)">删除</button>&nbsp;
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div><!-- table-responsive -->
        </div>
    </div>
    <script src="/js/vue.js"></script>
    <script type="text/javascript">
        
        var category = new Vue({
            el: "#cate_list",
            delimiters: ['{','}'],
            data: {
                cate_list: [],
                fid: 0,
            },

            created: function(){
                this.getCategoryList();
            },

            methods:{
                //获取分类列表
                getCategoryList: function(fid=0){

                    var that = this;
                    this.fid = fid;
                    $.ajax({
                        url:"/admin/category/get/data/"+fid,
                        type: "get",
                        data:{},
                        dataType:"json",
                        success: function(res) {
                            if(res.code == 2000){
                                that.cate_list = res.data;
                            }
                        }
                    })
                },
                //删除操作
                delCategory:function(id){
                    var that = this;
                    $.ajax({
                        url:"/admin/category/del/"+id,
                        type: "get",
                        data:{},
                        dataType:"json",
                        success: function(res) {
                            if(res.code == 2000){
                                that.getCategoryList(that.fid)
                            }
                        }
                    })
                }
            }
        })
    </script>

@endsection