@extends('common.admin_base')

@section('title','小说评论列表')


<!--页面顶部信息-->
@section('pageHeader')
<div class="pageheader">
      <h2><i class="fa fa-home"></i> 小说评论列表 <span>Subtitle goes here...</span></h2>
      <div class="breadcrumb-wrapper">
      </div>
    </div>
@endsection

@section('content')
  {{csrf_field()}}
  <div class="row" id="comment">
        <div class="col-md-12">
            <div class="table-responsive">
                <table class="table table-primary  mb30">
                    <thead>
                      <tr>
                        <th>ID</th>
                        <th>评论小说</th>
                        <th>评论者</th>
                        <th>评论内容</th>
                        <th>状态</th>
                        <th>操作</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr v-for="comment in comment_list">
                        <td>{comment.id}</td>
                        <td>{comment.name}</td>
                        <td>{comment.username}</td>
                        <td>{comment.content}</td>
                        <td>{comment.status ==1 ? '未审核': '审核'}</td>
                        <td>
                        	<button class="btn btn-sm btn-danger" v-on:click="checkComment(comment.id)">审核</button>&nbsp;&nbsp;
                        	

                        	<button class="btn btn-primary btn-sm" v-on:click="delRecord(comment.id)">删除</button>

                        </td>
                      </tr>
                    </tbody>
                </table>

                <ul class="pagination">
                    <!--上一页-->
                    <li v-if="page==1" class="disabled"><span>«</span></li>
                    <li v-else v-on:click="prevPage"><span>«</span></li>


                    <li v-for="num in total_page" v-on:click="currentPage(num)">
                        <span v-if="page == num" style="color:#ff0000;">{num}</span>
                        <span v-else >{num}</span>
                    </li>
                
                   <!--  <li v-for v-if="page==num" ><a href="" class="active">{num}</a></li> 
                    <li  v-for="num in total_page" v-if="page!=num"><a href="">{num}</a></li>  -->
                    
                           
                     <!--下一页-->
                    <li v-if="page==total_page" class="disabled"><span>»</span></li>
                    <li v-else v-on:click="nextPage"><span>»</span></li>                         
                    
            </ul>
            </div><!-- table-responsive -->
        </div>
    </div>

        <script type="text/javascript" src="/js/vue.js"></script>
        <script type="text/javascript">
        	
        	var comment = new Vue({
        		el: "#comment",
        		delimiters: ['{','}'],
        		data:{
                    comment_list:[],//评论列表数据
                    page: 1,//当前页
                    total_page:'',//总页码数
                },
        		created: function(){
        			this.getComment();
        		},

        		methods:{
        			//获取评论列表
        			getComment:function(){
        				var that = this;
        				$.ajax({
        					url: '/admin/novel/comment/data',
        					type:'get',
        					data:{page:that.page},
        					dataType: "json",
        					success: function(res){
        						if(res.code == 2000){
        							that.comment_list = res.data.comment;
                                    that.page = res.data.page;
                                    that.total_page = res.data.total_page;
        						}
        					},

        					error: function(res){

        					}
        				})
        			},
                    //上一页
                    prevPage:function(){
                        if(this.page == 1){
                            alert('已经是第一页了');
                            return false;
                        }

                        this.page = this.page-1;

                        this.getComment();
                    },

                    //下一页
                    nextPage:function(){
                        if(this.page == this.total_page){
                            alert('已经是最后一页');
                            return false;
                        }

                        this.page = this.page+1;
                        this.getComment();
                    },
                    //当前页面
                    currentPage:function(page){
                        this.page = page;
                        this.getComment();

                    },

                    //执行审核评论
                    checkComment: function(id)
                    {
                        var that = this;

                        $.ajax({
                            url: '/admin/novel/comment/check/'+id,
                            type:'get',
                            data:{},
                            dataType: "json",
                            success: function(res){

                                if(res.code == 2000){
                                    that.getComment();
                                }
                            },

                            error: function(res){

                            }
                        })
                    },
        		    //执行删除
        			delRecord:function(id){
        				var that = this;

        				$.ajax({
        					url: '/admin/novel/comment/del/'+id,
        					type:'get',
        					data:{},
        					dataType: "json",
        					success: function(res){

        						if(res.code == 2000){
        							that.getComment();
        						}
        					},

        					error: function(res){

        					}
        				})
        			}

        		}
        	})
        </script>
@endsection