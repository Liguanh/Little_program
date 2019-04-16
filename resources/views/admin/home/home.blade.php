@extends('common.admin_base')

@section('title','管理后台首页')

@section('pageHeader')
<div class="pageheader">
      <h2><i class="fa fa-home"></i> 后台首页 <span>Subtitle goes here...</span></h2>
      <div class="breadcrumb-wrapper">
        <span class="label">You are here:</span>
        <ol class="breadcrumb">
          <li><a href="index.html">Bracket</a></li>
          <li class="active">Dashboard</li>
        </ol>
      </div>
    </div>
@endsection

@section('content')
 
 <div class="row">
        <div class="col-sm-6 col-md-3">
          <div class="panel panel-success panel-stat">
            <div class="panel-heading">

              <div class="stat">
                <div class="row">
                  <div class="col-xs-4">
                    <img src="images/is-user.png" alt="" />
                  </div>
                  <div class="col-xs-8">
                    <small class="stat-label">会员总数</small>
                    <h1>{{$member_nums}}</h1>
                  </div>
                </div><!-- row -->

                <div class="mb15"></div>

                <div class="row">
                  <div class="col-xs-6">
                    <small class="stat-label">今日注册</small>
                    <h4>{{$today_register_nums}}</h4>
                  </div>

                  <div class="col-xs-6">
                    <small class="stat-label">近一周注册</small>
                    <h4>{{$last_week_register}}</h4>
                  </div>
                </div><!-- row -->
              </div><!-- stat -->

            </div><!-- panel-heading -->
          </div><!-- panel -->
        </div><!-- col-sm-6 -->

        <div class="col-sm-6 col-md-3">
          <div class="panel panel-danger panel-stat">
            <div class="panel-heading">

              <div class="stat">
                <div class="row">
                  <div class="col-xs-4">
                    <img src="images/is-user.png" alt="" />
                  </div>
                  <div class="col-xs-8">
                    <small class="stat-label">订单总数</small>
                    <h1>{{$order_nums}}</h1>
                  </div>
                </div><!-- row -->

                <div class="mb15"></div>

                <div class="row">
                  <div class="col-xs-6">
                    <small class="stat-label">今日订单总数</small>
                    <h4>{{$today_order_nums}}</h4>
                  </div>

                  <div class="col-xs-6">
                    <small class="stat-label">近一周订单总数</small>
                    <h4>{{$last_week_order}}</h4>
                  </div>
                </div><!-- row -->
              </div><!-- stat -->

            </div><!-- panel-heading -->
          </div><!-- panel -->
        </div><!-- col-sm-6 -->

        <div class="col-sm-6 col-md-3">
          <div class="panel panel-primary panel-stat">
            <div class="panel-heading">

              <div class="stat">
                <div class="row">
                  <div class="col-xs-4">
                    <img src="images/is-user.png" alt="" />
                  </div>
                  <div class="col-xs-8">
                    <small class="stat-label">商品总数</small>
                    <h1>{{$goods_nums}}</h1>
                  </div>
                </div><!-- row -->

                <div class="mb15"></div>

                <div class="row">
                  <div class="col-xs-6">
                    <small class="stat-label">今日商品</small>
                    <h4>{{$today_goods_nums}}</h4>
                  </div>

                  <div class="col-xs-6">
                    <small class="stat-label">近一周商品</small>
                    <h4>{{$last_week_goods}}</h4>
                  </div>
                </div><!-- row -->
              </div><!-- stat -->

            </div><!-- panel-heading -->
          </div><!-- panel -->
        </div><!-- col-sm-6 -->

      </div><!-- row -->
      <!--订单概况-->
      <div class="row">
        <div class="col-sm-8 col-md-12">
          <div class="panel panel-default">
            <div class="panel-body" id="order_data" style="height: 300px;">
            </div><!-- panel-body -->
          </div><!-- panel -->
        </div><!-- col-sm-9 -->
 </div><!-- row -->
        
      <!--用户注册量-->
       <div class="row">
        <div class="col-sm-8 col-md-12">
          <div class="panel panel-default">
            <div class="panel-body" id="member_data" style="height: 300px;">
            </div><!-- panel-body -->
          </div><!-- panel -->
        </div><!-- col-sm-9 --> 
      </div><!-- row -->
     

      </div>

      <!-- ECharts单文件引入 -->
    <script src="http://echarts.baidu.com/build/dist/echarts.js"></script>
    <script type="text/javascript">
        // 路径配置
        require.config({
            paths: {
                echarts: 'http://echarts.baidu.com/build/dist'
            }
        });
        
        // 使用生成饼状图
        require(
            [
                'echarts',
                'echarts/chart/pie', // 使用饼状图
                'echarts/chart/bar',//折线图
                'echarts/chart/line',//折线图funnel
                'echarts/chart/funnel',//漏斗图
            ],
            function (ec) {
                // 基于准备好的dom，初始化echarts图表//这是订单概况信息
                var myChart = ec.init(document.getElementById('order_data')); 
                
                option = {
                      title:{
                        text: '订单概况',
                        x: 'center'
                      },
                      tooltip : {
                          
                          trigger: 'item',
                          formatter: "{a} <br/>{b} : {c} ({d}%)"
                      },
                      legend: {
                          orient : 'vertical',
                          x : 'left',
                          data:['已确认','待支付','已支付','支付失败','退货']
                      },
                      toolbox: {
                          show : true,
                          feature : {
                              mark : {show: false},
                              dataView : {show: true, readOnly: false},
                              magicType : {
                                  show: true, 
                                  type: ['pie', 'funnel'],
                                  option: {
                                      funnel: {
                                          x: '25%',
                                          width: '50%',
                                          funnelAlign: 'center',
                                          max: 1548
                                      }
                                  }
                              },
                              restore : {show: true},
                              saveAsImage : {show: true}
                          }
                      },
                      calculable : true,
                      series : [
                          {
                              name:'订单概况',
                              type:'pie',
                              radius : ['50%', '70%'],
                              itemStyle : {
                                  normal : {
                                      label : {
                                          show : true
                                      },
                                      labelLine : {
                                          show : true
                                      }
                                  },
                                  emphasis : {
                                      label : {
                                          show : true,
                                          position : 'center',
                                          textStyle : {
                                              fontSize : '30',
                                              fontWeight : 'bold'
                                          }
                                      }
                                  }
                              },
                              data:[
                                  {value:335, name:'已确认'},
                                  {value:310, name:'待支付'},
                                  {value:234, name:'已支付'},
                                  {value:135, name:'支付失败'},
                                  {value:1548, name:'退货'}
                              ]
                          }
                      ]
                  };
        
                // 为echarts对象加载数据 
                myChart.setOption(option); 

                //会员近一周注册走势图
                var memChart = ec.init(document.getElementById('member_data')); 

                option1 = {
                        title : {
                            text: '近一周用户注册走势',
                        },
                        tooltip : {
                            trigger: 'axis'
                        },
                        legend: {
                            data:['用户注册量']
                        },
                        toolbox: {
                            show : true,
                            feature : {
                                mark : {show: false},
                                dataView : {show: true, readOnly: false},
                                magicType : {show: true, type: ['line', 'bar']},
                                restore : {show: true},
                                saveAsImage : {show: true}
                            }
                        },
                        calculable : true,
                        xAxis : [
                            {
                                type : 'category',
                                // data : ['2019-04-08','2019-04-09','2019-04-10','2019-04-11','2019-04-12','2019-04-13','2019-04-14']
                                data : [<?php echo $register_date;?>]
                            }
                        ],
                        yAxis : [
                            {
                                type : 'value'
                            }
                        ],
                        series : [
                            {
                                name:'用户注册量',
                                type:'bar',
                                data:[<?php echo $register_nums; ?>],
                                markPoint : {
                                    data : [
                                        {type : 'max', name: '最大值'},
                                        {type : 'min', name: '最小值'}
                                    ]
                                },
                                markLine : {
                                    data : [
                                        {type : 'average', name: '平均值'}
                                    ]
                                }
                            },
                        ]
                    };

                    // 为echarts对象加载数据 
                memChart.setOption(option1); 
                    
            }
        );
    </script>

@endsection