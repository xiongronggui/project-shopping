//支付通道订单笔数统计
function channelCountPie()
{
	var myChart = echarts.init(document.getElementById('channel_count_pie'), 'macarons');
	var channel = new Array();
	var arr = new Array();
	var time_start = $("#time_start").val();
	var time_end = $("#time_end").val();
	$.ajax({
        type: "post",
        url: "charts.php",
        data: {"op": "goodsOrderChannel", "time_start": time_start, "time_end": time_end},
        dataType: "json",
        success: function (data) {
			for (var i=0; i<data.length; i++)
			{
				channel.push(data[i].channel);
				arr.push({value:data[i].count, name:data[i].channel});
			}
	     
			option = {
				title : {
					text: '支付通道订单数分布图',
					subtext: '',
					x:'center'
				},
				tooltip : {
					trigger: 'item',
					formatter: "{a} <br/>{b} : {c} ({d}%)"
				},
				legend: {
					orient: 'vertical',
					left: 'left',
					data: channel
				},
				series : [
					{
						name: '交易量',
						type: 'pie',
						radius : '75%',
						center: ['50%', '50%'],
						data:arr,
						itemStyle: {
							emphasis: {
								shadowBlur: 10,
								shadowOffsetX: 0,
								shadowColor: 'rgba(0, 0, 0, 0.5)'
							}
						}
					}
				]
			};
			myChart.setOption(option);
        }
    });
}

//支付通道收入统计
function channelTotalPie()
{
	var myChart = echarts.init(document.getElementById('channel_total_pie'), 'macarons');
	var channel = new Array();
	var arr = new Array();
	var time_start = $("#time_start").val();
	var time_end = $("#time_end").val();
	$.ajax({
        type: "post",
        url: "charts.php",
        data: {"op": "goodsOrderChannel", "time_start": time_start, "time_end": time_end},
        dataType: "json",
        success: function (data) {
			for (var i=0; i<data.length; i++)
			{
				channel.push(data[i].channel);
				arr.push({value:data[i].total_show, name:data[i].channel});
			}
	     
			option = {
				title : {
					text: '支付通道总金额分布图',
					subtext: '',
					x:'center'
				},
				tooltip : {
					trigger: 'item',
					formatter: "{a} <br/>{b} : {c} ({d}%)"
				},
				legend: {
					orient: 'vertical',
					left: 'left',
					data: channel
				},
				series : [
					{
						name: '人民币总额',
						type: 'pie',
						radius : '75%',
						center: ['50%', '50%'],
						data:arr,
						itemStyle: {
							emphasis: {
								shadowBlur: 10,
								shadowOffsetX: 0,
								shadowColor: 'rgba(0, 0, 0, 0.5)'
							}
						}
					}
				]
			};
			myChart.setOption(option);
        }
    });
}

//来源统计
function sourcePie()
{
	var myChart = echarts.init(document.getElementById('source_pie'), 'macarons');
	var source = new Array();
	var arr = new Array();
	var time_start = $("#time_start").val();
	var time_end = $("#time_end").val();
	$.ajax({
        type: "post",
        url: "charts.php",
        data: {"op": "goodsOrderSource", "time_start": time_start, "time_end": time_end},
        dataType: "json",
        success: function (data) {
			for (var i=0; i<data.length; i++)
			{
				source.push(data[i].source);
				arr.push({value:data[i].count, name:data[i].source});
			}
	     
			option = {
				title : {
					text: '订单来源商城分布图',
					subtext: '',
					x:'center'
				},
				tooltip : {
					trigger: 'item',
					formatter: "{a} <br/>{b} : {c} ({d}%)"
				},
				legend: {
					orient: 'vertical',
					left: 'left',
					data: source
				},
				series : [
					{
						name: '订单数',
						type: 'pie',
						radius : '75%',
						center: ['50%', '50%'],
						data:arr,
						itemStyle: {
							emphasis: {
								shadowBlur: 10,
								shadowOffsetX: 0,
								shadowColor: 'rgba(0, 0, 0, 0.5)'
							}
						}
					}
				]
			};
			myChart.setOption(option);
        }
    });
}

//入金平台数据统计
function rechargePlatformPie()
{
	var myChart = echarts.init(document.getElementById('recharge_platform_pie'), 'macarons');
	var recharge_platform = new Array();
	var arr = new Array();
	var time_start = $("#time_start").val();
	var time_end = $("#time_end").val();
	$.ajax({
        type: "post",
        url: "charts.php",
        data: {"op": "goodsOrderRechargePlatform", "time_start": time_start, "time_end": time_end},
        dataType: "json",
        success: function (data) {
			for (var i=0; i<data.length; i++)
			{
				recharge_platform.push(data[i].recharge_platform);
				arr.push({value:data[i].count, name:data[i].recharge_platform});
			}
	     
			option = {
				title : {
					text: '入金平台分布图',
					subtext: '',
					x:'center'
				},
				tooltip : {
					trigger: 'item',
					formatter: "{a} <br/>{b} : {c} ({d}%)"
				},
				legend: {
					orient: 'vertical',
					left: 'left',
					data: recharge_platform
				},
				series : [
					{
						name: '订单数',
						type: 'pie',
						radius : '75%',
						center: ['50%', '50%'],
						data:arr,
						itemStyle: {
							emphasis: {
								shadowBlur: 10,
								shadowOffsetX: 0,
								shadowColor: 'rgba(0, 0, 0, 0.5)'
							}
						}
					}
				]
			};
			myChart.setOption(option);
        }
    });
}

//过去七天各支付通道完成交易笔数
function channelLastWeekCountArea()
{
	var myChart = echarts.init(document.getElementById('channel_last_week_count_area'), 'macarons');
	var date = new Array();
	var channel = new Array();
	var arr = new Array();
	var time_start = $("#time_start").val();
	var time_end = $("#time_end").val();
	$.ajax({
        type: "post",
        url: "charts.php",
        data: {"op": "goodsOrderChannelChannelLastWeek", "time_start": time_start, "time_end": time_end},
        dataType: "json",
		async:false,
        success: function (data) {
			//统计类型
			for (var i=0; i<data.length; i++)
			{
				var val = new Array();
				channel.push(data[i].channel);
				
				for (var j=0; j<data[i].val.length; j++)
				{
					val.push(data[i].val[j].count);
				}
				arr.push({name:data[i].channel, type:'line', stack: '总额', areaStyle: {normal: {}}, data:val});
			}

			for (var k=0; k<data[0].val.length; k++)
			{
				date.push(data[0].val[k].date);
			}
	     
			option = {
				title: {
					text: '七日内各支付通道订单笔数分布图（笔）'
				},
				tooltip : {
					trigger: 'axis',
					axisPointer: {
						type: 'cross',
						label: {
							backgroundColor: '#6a7985'
						}
					}
				},
				legend: {
					data: channel
				},
				toolbox: {
					feature: {
						saveAsImage: {}
					}
				},
				grid: {
					left: '3%',
					right: '4%',
					bottom: '3%',
					containLabel: true
				},
				xAxis : [
					{
						type : 'category',
						boundaryGap : false,
						data : date
					}
				],
				yAxis : [
					{
						type : 'value'
					}
				],
				series : arr
			};
			myChart.setOption(option);
        }
    });
}

//过去七天各支付通道完成交易金额
function channelLastWeekTotalArea()
{
	var myChart = echarts.init(document.getElementById('channel_last_week_total_area'), 'macarons');
	var date = new Array();
	var channel = new Array();
	var arr = new Array();
	var time_start = $("#time_start").val();
	var time_end = $("#time_end").val();
	$.ajax({
        type: "post",
        url: "charts.php",
        data: {"op": "goodsOrderChannelChannelLastWeek", "time_start": time_start, "time_end": time_end},
        dataType: "json",
		async:false,
        success: function (data) {
			//统计类型
			for (var i=0; i<data.length; i++)
			{
				var val = new Array();
				channel.push(data[i].channel);
				
				for (var j=0; j<data[i].val.length; j++)
				{
					val.push(data[i].val[j].total_show);
				}
				arr.push({name:data[i].channel, type:'line', stack: '总额', areaStyle: {normal: {}}, data:val});
			}

			for (var k=0; k<data[0].val.length; k++)
			{
				date.push(data[0].val[k].date);
			}
	     
			option = {
				title: {
					text: '七日内各支付通道订单金额分布图（人民币）'
				},
				tooltip : {
					trigger: 'axis',
					axisPointer: {
						type: 'cross',
						label: {
							backgroundColor: '#6a7985'
						}
					}
				},
				legend: {
					data: channel
				},
				toolbox: {
					feature: {
						saveAsImage: {}
					}
				},
				grid: {
					left: '3%',
					right: '4%',
					bottom: '3%',
					containLabel: true
				},
				xAxis : [
					{
						type : 'category',
						boundaryGap : false,
						data : date
					}
				],
				yAxis : [
					{
						type : 'value'
					}
				],
				series : arr
			};
			myChart.setOption(option);
        }
    });
}

//过去七天各商城来源订单笔数
function sourceLastWeekArea()
{
	var myChart = echarts.init(document.getElementById('source_last_week_area'), 'macarons');
	var date = new Array();
	var source = new Array();
	var arr = new Array();
	var time_start = $("#time_start").val();
	var time_end = $("#time_end").val();
	$.ajax({
        type: "post",
        url: "charts.php",
        data: {"op": "sourceLastWeekArea", "time_start": time_start, "time_end": time_end},
        dataType: "json",
		async:false,
        success: function (data) {
			//统计类型
			for (var i=0; i<data.length; i++)
			{
				var val = new Array();
				source.push(data[i].source);
				
				for (var j=0; j<data[i].val.length; j++)
				{
					val.push(data[i].val[j].count);
				}
				arr.push({name:data[i].source, type:'line', stack: '总额', areaStyle: {normal: {}}, data:val});
			}

			for (var k=0; k<data[0].val.length; k++)
			{
				date.push(data[0].val[k].date);
			}
	     
			option = {
				title: {
					text: '七日内各商城来源订单笔数分布图（笔）'
				},
				tooltip : {
					trigger: 'axis',
					axisPointer: {
						type: 'cross',
						label: {
							backgroundColor: '#6a7985'
						}
					}
				},
				legend: {
					data: source
				},
				toolbox: {
					feature: {
						saveAsImage: {}
					}
				},
				grid: {
					left: '3%',
					right: '4%',
					bottom: '3%',
					containLabel: true
				},
				xAxis : [
					{
						type : 'category',
						boundaryGap : false,
						data : date
					}
				],
				yAxis : [
					{
						type : 'value'
					}
				],
				series : arr
			};
			myChart.setOption(option);
        }
    });
}

//过去七天各平台入金数据统计
function rechargePlatformLastWeekArea()
{
	var myChart = echarts.init(document.getElementById('recharge_platform_last_week_area'), 'macarons');
	var date = new Array();
	var recharge_platform = new Array();
	var arr = new Array();
	var time_start = $("#time_start").val();
	var time_end = $("#time_end").val();
	$.ajax({
        type: "post",
        url: "charts.php",
        data: {"op": "rechargePlatformLastWeekArea", "time_start": time_start, "time_end": time_end},
        dataType: "json",
		async:false,
        success: function (data) {
			//统计类型
			for (var i=0; i<data.length; i++)
			{
				var val = new Array();
				recharge_platform.push(data[i].recharge_platform);
				
				for (var j=0; j<data[i].val.length; j++)
				{
					val.push(data[i].val[j].price_show);
				}
				arr.push({name:data[i].recharge_platform, type:'line', stack: '总额', areaStyle: {normal: {}}, data:val});
			}

			for (var k=0; k<data[0].val.length; k++)
			{
				date.push(data[0].val[k].date);
			}
	     
			option = {
				title: {
					text: '七日内各平台入金分布图（美元）'
				},
				tooltip : {
					trigger: 'axis',
					axisPointer: {
						type: 'cross',
						label: {
							backgroundColor: '#6a7985'
						}
					}
				},
				legend: {
					data: recharge_platform
				},
				toolbox: {
					feature: {
						saveAsImage: {}
					}
				},
				grid: {
					left: '3%',
					right: '4%',
					bottom: '3%',
					containLabel: true
				},
				xAxis : [
					{
						type : 'category',
						boundaryGap : false,
						data : date
					}
				],
				yAxis : [
					{
						type : 'value'
					}
				],
				series : arr
			};
			myChart.setOption(option);
        }
    });
}
/*
//柱状图
function DrawBar()
{
	var myChart = echarts.init(document.getElementById('bar'), 'macarons');
	var year = new Array();
	var arr = new Array();
	$.ajax({
        type: "post",
        url: "main.php",
        data: {"op": "newsMonthAddCount"},
        dataType: "json",
		async:false,
        success: function (data) {
			//划分年份
			for (var i=0; i<data.length; i++)
			{
				var year_check = $.inArray(data[i].year, year);
				if (year_check == "-1")
				{
					year.push(data[i].year);
				}
			}

			//倒序排列
			year.sort(function(a, b){
				return b - a;
			});
			
			//按年统计每月发帖数
			for (var j=0; j<year.length; j++)
			{
				var month = new Array();
				var all_month = new Array();
				var val = new Array();
				//统计发帖月份的发帖数
				for (var k=0; k<data.length; k++)
				{
					if (year[j] == data[k]['year'])
					{
						month.push({month:data[k]['month'], count:data[k]['count']});
					}
				}
				
				//补全十二个月
				for (var r=1; r<=12; r++)
				{
					all_month.push({month:r, count:0});
				}
				
				//用真实发帖数替换默认数据
				for (var s=0; s<month.length; s++)
				{
					all_month.splice(month[s]['month']-1, 1, month[s])
				}
				
				//生成正确格式数组
				for (var t=0; t<all_month.length; t++)
				{
					val.push(all_month[t]['count']);
				}

				arr.push({name:year[j], type:'bar', data:val});
			}
			
			option = {
				title : {
					text: '每月新闻发布数分布图',
					subtext: ''
				},
				tooltip : {
					trigger: 'axis',
					axisPointer : {
						type : 'shadow'
					}
				},
				legend: {
					data:year
				},
				toolbox: {
					show : true,
					feature : {
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
						data : ['1月','2月','3月','4月','5月','6月','7月','8月','9月','10月','11月','12月']
					}
				],
				yAxis : [
					{
						type : 'value'
					}
				],
				series :arr
			};
        }
    });
	myChart.setOption(option);
}

//区域图
function DrawArea()
{
	var myChart = echarts.init(document.getElementById('area'), 'macarons');
	var date = new Array();
	var group = new Array();
	var arr = new Array();
	$.ajax({
        type: "post",
        url: "main.php",
        data: {"op": "newsLastWeekAddCount"},
        dataType: "json",
		async:false,
        success: function (data) {
			//统计类型
			for (var i=0; i<data.length; i++)
			{
				var val = new Array();
				group.push(data[i].group);
				
				for (var j=0; j<data[i].val.length; j++)
				{
					val.push(data[i].val[j].count);
				}
				arr.push({name:data[i].group, type:'line', stack: '总量', areaStyle: {normal: {}}, data:val});
			}

			for (var k=0; k<data[0].val.length; k++)
			{
				date.push(data[0].val[k].date);
			}
	     
			option = {
				title: {
					text: '七日内新闻类型发布分布图'
				},
				tooltip : {
					trigger: 'axis',
					axisPointer: {
						type: 'cross',
						label: {
							backgroundColor: '#6a7985'
						}
					}
				},
				legend: {
					data: group
				},
				toolbox: {
					feature: {
						saveAsImage: {}
					}
				},
				grid: {
					left: '3%',
					right: '4%',
					bottom: '3%',
					containLabel: true
				},
				xAxis : [
					{
						type : 'category',
						boundaryGap : false,
						data : date
					}
				],
				yAxis : [
					{
						type : 'value'
					}
				],
				series : arr
			};
        }
    });
	myChart.setOption(option);
}

*/