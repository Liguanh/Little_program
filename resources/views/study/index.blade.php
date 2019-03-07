@extends('common.base')

@section('title','抢红包页面')


@section('content')

<div class="panel-body panel-body-nopadding" id="bonus">
	<form  class="form-horizontal form-bordered" onsubmit="return false;">

			{{csrf_field()}}

			<div class="form-group">
              <label class="col-sm-3 control-label">红包金额</label>
              <div class="col-sm-6">
                <input type="text" placeholder="红包金额" class="form-control" name="total_amount"/>
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-3 control-label">红包个数</label>
              <div class="col-sm-6">
                <input type="text" placeholder="红包个数" class="form-control" name="total_nums"/>
              </div>
           </div>

		  <div class="row">
				<div class="col-sm-6 col-sm-offset-3">
				  <button class="btn btn-primary btn-danger" v-on:click="addBonus">添加红包</button>&nbsp;
				</div>
		 </div>
		
	</form>

	 <div class="row">

        <div class="col-md-12">
          <div class="table-responsive">
          <table class="table mb30">
            <thead>
              <tr>
                <th>ID</th>
                <th>总金额</th>
                 <th>剩余金额</th>
                <th>总个数</th>
                <th>剩余个数</th>
                <th>操作</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="bonus in bonus_list">
                <td>{bonus.id}</td>
                <td>{bonus.total_amount}</td>
                <td>{bonus.left_amount}</td>
                <td>{bonus.total_nums}</td>
                <td>{bonus.left_nums}</td>
                <td >
                  <button class="btn btn-warning" v-if="bonus.left_nums <=0">红包已经抢完了</button>
                   <button class="btn btn-danger" v-on:click="getBonus(bonus.id)" v-else>抢红包</button>

                   <button class="btn btn-primary" v-if="bonus.left_nums <=0" v-on:click="getBonusRecord(bonus.id)">查看红包记录</button>
                </td>
              </tr>
            </tbody>
          </table>
          </div><!-- table-responsive -->
        </div><!-- col-md-6 -->

      </div>

       <div class="row" v-if="show">

        <div class="col-md-12">
          <div class="table-responsive">
          <table class="table mb30">
            <thead>
              <tr>
                <th>用户id</th>
                <th>金额</th>
                 <th>是否最佳手气</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="bonus in bonus_record">
                <td>{bonus.user_id}</td>
                <td>{bonus.money}</td>
                <td >
                  <button class="btn btn-warning" v-if="bonus.flag ==2">最佳手气</button>
                </td>
              </tr>
            </tbody>
          </table>
          </div><!-- table-responsive -->
        </div><!-- col-md-6 -->

      </div>

</div>
<script type="text/javascript" src="/js/vue.js"></script>

<script type="text/javascript">
	var bonus = new Vue({
		el: "#bonus",
		delimiters: ['{','}'],
		data:{
			bonus_list: [],
			show:false,
			bonus_record: [],
		},
		created: function(){
			this.getList();
		},

		methods:{

			addBonus:function(){
				var that =this;
				var token = $("input[name=_token]").val();
				var total_amount = $("input[name=total_amount]").val();
				var total_nums = $("input[name=total_nums]").val();

				if(total_amount=='' || total_nums==''){
					alert("参数不能为空");
					return false;
				}

				$.ajax({
					url: '/study/bonus/add',
					type: "post",
					data: {_token:token, total_amount:total_amount,total_nums:total_nums},
					dataType: "json",
					success: function(res){
						if(res.code==2000){
							that.getList();
						}
					}
				})
			},
			//获取列表
			getList: function(){
				var that = this;
				$.ajax({
					url: '/study/bonus/list',
					type: "get",
					data: {},
					dataType: "json",
					success: function(res){
						if(res.code == 2000){
							that.bonus_list = res.data;
						}
					}
				})
			},
			//获取列表
			getBonusRecord: function(bonus_id){
				var that = this;
				$.ajax({
					url: '/study/bonus/record/list',
					type: "get",
					data: {bonus_id:bonus_id},
					dataType: "json",
					success: function(res){
						if(res.code == 2000){
							that.show = true;
							that.bonus_record = res.data;
						}
					}
				})
			},

			//获取红包
			getBonus: function(bonus_id){
				var that = this;
				//alert(bonus_id);
				//return false;
				$.ajax({
					url: '/study/get/bonus',
					type: "get",
					data: {bonus_id: bonus_id, user_id:2},
					dataType: "json",
					success: function(res){
						if(res.code == 2000){
							//alert(res.msg);
							that.getList();
						}else{
							alert(res.msg);
							return false;
						}
					}
				})
			}

		}
	});
</script>
@endsection