<?php
/* Smarty version 3.1.30, created on 2018-04-03 09:10:15
  from "/u01/nginx/html/fic.sxgcsy.top/admin/templates/goods_order_list.html" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_5ac2d4778a2c24_49646823',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '8f71541c6550d208f58c498925e679da258bf906' => 
    array (
      0 => '/u01/nginx/html/fic.sxgcsy.top/admin/templates/goods_order_list.html',
      1 => 1522717811,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:header.html' => 1,
  ),
),false)) {
function content_5ac2d4778a2c24_49646823 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_subTemplateRender("file:header.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

<link rel="stylesheet" href="/shopp/css/reset.css">
<link rel="stylesheet" href="/shopp/css/headFoot.css">
<link rel="stylesheet" href="/shopp/css/firmOrder.css">
	<link rel="stylesheet" type="text/css" href="css/jquery.datetimepicker.css"/>
	<?php echo '<script'; ?>
 src="js/jquery.datetimepicker.js"><?php echo '</script'; ?>
>
	<?php echo '<script'; ?>
 src="/shopp/js/public.js"><?php echo '</script'; ?>
>
	<?php echo '<script'; ?>
 src="js/datetimepicker.js"><?php echo '</script'; ?>
>
	<style>
		.tablebox{
			padding-top:46px;
		}

		.tablebox .listTable{
			border-bottom: 1px solid #dfdfdf;
		}

		.listTable tr th{
			padding: 10px 18px;
			border-bottom: 1px solid #dfdfdf;
			font-weight: bold;
		}

		table.listTable tbody tr {
			background-color: #ffffff;
		}

		table.listTable tbody tr.odd > .sorting_1, table.listTable tbody tr.odd > .sorting_1 {
			background-color: #f1f1f1;
		}

		table.listTable tbody tr.odd, table.listTable tbody tr.odd {
			background-color: #f9f9f9;
		}

		table.listTable tbody tr:hover > .sorting_1, table.listTable tbody tr:hover > .sorting_1 {
			background-color: #eaeaea;
		}

		table.listTable tbody tr:hover, table.listTable tbody tr:hover {
			background-color: #f6f6f6;
		}

		table.listTable tbody th, table.listTable tbody td {
			padding: 8px 10px;
		}
		table.listTable tbody tr:last-child a{
			padding:0 10px;
			margin:0 10px;
			border:1px solid #ccc;
			border-radius: 2px;
		}
		table.listTable tbody tr:last-child span a{
			padding:0 10px;
			margin:0 6px;
			background: #346fad;
			border: 2px solid #346fad;
			color:#fff;
		}
		.dataTables_filter{
			color: #333;
			text-align: right;
		}
		.dataTables_filter .spaninline{
			display: inline-block;
			float: left;
			width: 33.3%;
			margin-bottom: 10px;
		}
		.dataTables_filter .spaninline .tit{
			width: 26%;
			display: inline-block;
		}
		.dataTables_filter .spaninline .label{
			width:72%;
			display:inline-block;
			text-align: left;
		}
		.dataTables_filter .spaninline .label input{
			width:40%;
			margin-left:0;
		}
		.dataTables_filter .spaninline .label select{
			width:87%!important;
		}
		.dataTables_filter input{
			margin-left: 0.5em;
			line-height: 30px;
			height: 30px;
			border: 1px solid #d5d5d5;
			border-radius: 4px;
			padding: 0 0 0 4px;
		}

		.search-btn {
			color: #fff;
			font-size: 14px;
			border: none;
			cursor: pointer;
			background: #347ab8;
			z-index: 1;
			height: 30px;
			line-height: 30px;
			border-radius: 4px;
			width: 50px;
		}
		.bluediv{
			width:11.1%!important;
		}
		.blue-msg{
			background: #f1fbff;
			height: 60px;
			border-bottom: 10px solid #bdefff;
			margin: 0 10px;
			text-align: center;
		}
		.blue-msg .num{
			color: #30b8e3;
			font-size: 20px;
			padding-top: 6px;
		}
		.blue-msg .txt{
			font-size: 14px;
			color: #8b9ea5;
		}
		.hide{
			display: none;
		}
		.pop{
			position: fixed;
			top:0;
			left:0;
			width: 100%;
			height:100%;
			z-index: 999;
			background: #333;
			opacity: .7;
			filter: Alpha(opacity=70);
		}
		.popbox{
			position: fixed;
			top:50%;
			left:20%;
			width:60%;
			z-index: 1000;
			margin-top:-125px;
		}
		#div_edit{
			vertical-align:middle;
			background: #fff;
			border-radius: 5px;
			padding:5%;
			text-align: center;
		}
		#form_order input{
 			background: #fff;
			height: 30px;
			line-height: 30px;
			color: #000;
		}
		#form_order p{
			padding-bottom: 15px;
		}
		#form_order #order_submit{
			width:100px;
			height: 30px;
			line-height: 30px;
			background: #858585;
			border: none;
			border-radius: 5px;
			margin-top: 5px;
			cursor: pointer;
		}
		#form_order #order_remo{
			width:100px;
			height: 30px;
			line-height: 30px;
			background: deepskyblue;
			border: none;
			border-radius: 5px;
			margin-top: 5px;
			cursor: pointer;
		}
	</style>
	<div class="main-content">
		<div class="breadcrumbs">
			商品订单列表
		</div>
		<div class="page-content">
			<div class="retrieval">
				<div id="news_filter" class="dataTables_filter">
					<span class="spaninline">
						<span class="tit">充入值：</span>
						<span class="label">
							<input type="number" step="0.01" id="price_start" placeholder="输入最低金额" value="<?php echo $_smarty_tpl->tpl_vars['price_start']->value;?>
"/> - 
							<input type="number" step="0.01" id="price_end" placeholder="输入最高金额" value="<?php echo $_smarty_tpl->tpl_vars['price_end']->value;?>
" />
						</span>
					</span>
					<span class="spaninline">
						<span class="tit">订单成交日期：</span>
						<span class="label">
							<input type="text" id="paytime_start" readonly placeholder="选择日期" value="<?php echo $_smarty_tpl->tpl_vars['paytime_start']->value;?>
" /> - 
							<input type="text" id="paytime_end" readonly placeholder="选择日期" value="<?php echo $_smarty_tpl->tpl_vars['paytime_end']->value;?>
" />
						</span>
					</span>
					<span class="spaninline">
						<span class="tit">订单兑换日期：</span>
						<span class="label">
							<input type="text" id="usetime_start" readonly placeholder="选择日期" value="<?php echo $_smarty_tpl->tpl_vars['usetime_start']->value;?>
" /> - 
							<input type="text" id="usetime_end" readonly placeholder="选择日期" value="<?php echo $_smarty_tpl->tpl_vars['usetime_end']->value;?>
" />
						</span>
					</span>
					<span class="spaninline">
						<span class="tit">订单状态：</span>	
						<span class="label">
							<select id="order_status" class="select-long">
								<option value="-1" <?php if ($_smarty_tpl->tpl_vars['order_status']->value == "-1") {?>selected<?php }?>>全部</option>
								<option value="0" <?php if ($_smarty_tpl->tpl_vars['order_status']->value == "0") {?>selected<?php }?>>未支付</option>
								<option value="1" <?php if ($_smarty_tpl->tpl_vars['order_status']->value == "1") {?>selected<?php }?>>已支付</option>
								<option value="2" <?php if ($_smarty_tpl->tpl_vars['order_status']->value == "2") {?>selected<?php }?>>已关闭</option>
							</select>
						</span>
					</span>
					<span class="spaninline"  id="use_status_div">
						<span class="tit">兑换状态：</span>
						<span class="label">
							<select id="use_status" class="select-long">
								<option value="-1" <?php if ($_smarty_tpl->tpl_vars['use_status']->value == "-1") {?>selected<?php }?>>全部</option>
								<option value="0" <?php if ($_smarty_tpl->tpl_vars['use_status']->value == "0") {?>selected<?php }?>>未兑换</option>
								<option value="1" <?php if ($_smarty_tpl->tpl_vars['use_status']->value == "1") {?>selected<?php }?>>已兑换</option>
							</select>
						</span>
					</span>
					<span class="spaninline">
						<span class="tit">关键字：</span>
						<span class="label">
							<input type="search" id="keys" placeholder="订单号/账号/真实姓名" value="<?php echo $_smarty_tpl->tpl_vars['keys']->value;?>
" aria-controls="news"  style="width:87%;">								
						</span>
					</span>
					<span style="position:relative;bottom:0;right: 10px;">
							<input type="button" id="search" class="search-btn" value="搜索" />
							<input type="button" id="reset" class="search-btn" value="重置" />
							<input type="button" id="output" class="search-btn" value="导出" />
					</span>
				</div>
				<div class="dataTables_filter" style="margin-top:20px;">
					<div class="spaninline bluediv">
						<div class="blue-msg">
							<div class="num"><?php echo $_smarty_tpl->tpl_vars['result']->value['order_yestoday_statistics'];?>
</div>
							<div class="txt">昨日订单总数</div>
						</div>
					</div>
				</div>
				<div class="dataTables_filter" style="margin-top:20px;">
					<div class="spaninline bluediv">
						<div class="blue-msg">
							<div class="num"><?php echo $_smarty_tpl->tpl_vars['result']->value['price_yestoday_statistics'];?>
</div>
							<div class="txt">昨日订单总充入值</div>
						</div>
					</div>
				</div>
				<div class="dataTables_filter" style="margin-top:20px;">
					<div class="spaninline bluediv">
						<div class="blue-msg">
							<div class="num"><?php echo $_smarty_tpl->tpl_vars['result']->value['total_yestoday_statistics'];?>
</div>
							<div class="txt">昨日订单总金额</div>
						</div>
					</div>
				</div>
				<div class="dataTables_filter" style="margin-top:20px;">
					<div class="spaninline bluediv">
						<div class="blue-msg">
							<div class="num"><?php echo $_smarty_tpl->tpl_vars['result']->value['order_today_statistics'];?>
</div>
							<div class="txt">今日订单总数</div>
						</div>
					</div>
				</div>
				<div class="dataTables_filter" style="margin-top:20px;">
					<div class="spaninline bluediv">
						<div class="blue-msg">
							<div class="num"><?php echo $_smarty_tpl->tpl_vars['result']->value['price_today_statistics'];?>
</div>
							<div class="txt">今日订单总充入值</div>
						</div>
					</div>
				</div>
				<div class="dataTables_filter" style="margin-top:20px;">
					<div class="spaninline bluediv">
						<div class="blue-msg">
							<div class="num"><?php echo $_smarty_tpl->tpl_vars['result']->value['total_today_statistics'];?>
</div>
							<div class="txt">今日订单总金额</div>
						</div>
					</div>
				</div>
				<div class="dataTables_filter" style="margin-top:20px;">
					<div class="spaninline bluediv">
						<div class="blue-msg">
							<div class="num"><?php echo $_smarty_tpl->tpl_vars['result']->value['order_statistics'];?>
</div>
							<div class="txt">订单总数</div>
						</div>
					</div>
				</div>
				<div class="dataTables_filter" style="margin-top:20px;">
					<div class="spaninline bluediv">
						<div class="blue-msg">
							<div class="num"><?php echo $_smarty_tpl->tpl_vars['result']->value['price_statistics'];?>
</div>
							<div class="txt">订单总充入值</div>
						</div>
					</div>
				</div>
				<div class="dataTables_filter" style="margin-top:20px;">
					<div class="spaninline bluediv">
						<div class="blue-msg">
							<div class="num"><?php echo $_smarty_tpl->tpl_vars['result']->value['total_statistics'];?>
</div>
							<div class="txt">订单总金额</div>
						</div>
					</div>
				</div>
				<div class="tablebox">
					<table class="display listTable" cellpadding="0" cellspacing="0" border="0" >
						<thead>
							<tr>
								<th>订单编号</th>
								<th>订单金额</th>
								<th>实际金额</th>
								<th>汇率</th>
								<th>折算美元</th>
								<th>付款账号</th>
								<th>支付来源</th>
								<th>支付通道</th>
								<th>下单时间</th>
								<th>支付状态</th>
								<th>支付时间</th>
								<th>兑换状态</th>
								<th>兑换时间</th>
								<th>操作</th>
							</tr>
						</thead>
						<?php if ($_smarty_tpl->tpl_vars['result']->value['nums'] != 0) {?>
						<tbody>
							<?php
$__section_show_0_saved = isset($_smarty_tpl->tpl_vars['__smarty_section_show']) ? $_smarty_tpl->tpl_vars['__smarty_section_show'] : false;
$__section_show_0_loop = (is_array(@$_loop=$_smarty_tpl->tpl_vars['result']->value['result']) ? count($_loop) : max(0, (int) $_loop));
$__section_show_0_total = $__section_show_0_loop;
$_smarty_tpl->tpl_vars['__smarty_section_show'] = new Smarty_Variable(array());
if ($__section_show_0_total != 0) {
for ($__section_show_0_iteration = 1, $_smarty_tpl->tpl_vars['__smarty_section_show']->value['index'] = 0; $__section_show_0_iteration <= $__section_show_0_total; $__section_show_0_iteration++, $_smarty_tpl->tpl_vars['__smarty_section_show']->value['index']++){
?>
							<tr>
								<td><?php echo $_smarty_tpl->tpl_vars['result']->value['result'][(isset($_smarty_tpl->tpl_vars['__smarty_section_show']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_show']->value['index'] : null)]['order_id'];?>
</td>
								<td><?php echo $_smarty_tpl->tpl_vars['result']->value['result'][(isset($_smarty_tpl->tpl_vars['__smarty_section_show']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_show']->value['index'] : null)]['total']/100;?>
</td>
								<?php if ($_smarty_tpl->tpl_vars['result']->value['result'][(isset($_smarty_tpl->tpl_vars['__smarty_section_show']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_show']->value['index'] : null)]['channel'] == '转账/汇款' && $_smarty_tpl->tpl_vars['result']->value['result'][(isset($_smarty_tpl->tpl_vars['__smarty_section_show']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_show']->value['index'] : null)]['order_status'] == 1) {?>
									<td><?php echo $_smarty_tpl->tpl_vars['result']->value['result'][(isset($_smarty_tpl->tpl_vars['__smarty_section_show']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_show']->value['index'] : null)]['recharge_total']/100;?>
</td>
								<?php } else { ?>
									<td><?php echo $_smarty_tpl->tpl_vars['result']->value['result'][(isset($_smarty_tpl->tpl_vars['__smarty_section_show']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_show']->value['index'] : null)]['total']/100;?>
</td>
								<?php }?>
								<td><?php echo $_smarty_tpl->tpl_vars['result']->value['result'][(isset($_smarty_tpl->tpl_vars['__smarty_section_show']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_show']->value['index'] : null)]['use_rate'];?>
</td>
								<td><?php echo $_smarty_tpl->tpl_vars['result']->value['result'][(isset($_smarty_tpl->tpl_vars['__smarty_section_show']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_show']->value['index'] : null)]['price']/100;?>
</td>
								<td><?php echo $_smarty_tpl->tpl_vars['result']->value['result'][(isset($_smarty_tpl->tpl_vars['__smarty_section_show']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_show']->value['index'] : null)]['mobile'];?>
（<?php echo $_smarty_tpl->tpl_vars['result']->value['result'][(isset($_smarty_tpl->tpl_vars['__smarty_section_show']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_show']->value['index'] : null)]['realname'];?>
）</td>
								<td><?php echo $_smarty_tpl->tpl_vars['result']->value['result'][(isset($_smarty_tpl->tpl_vars['__smarty_section_show']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_show']->value['index'] : null)]['source'];?>
</td>
								<td><?php echo $_smarty_tpl->tpl_vars['result']->value['result'][(isset($_smarty_tpl->tpl_vars['__smarty_section_show']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_show']->value['index'] : null)]['channel'];?>
</td>
								<td><?php echo $_smarty_tpl->tpl_vars['result']->value['result'][(isset($_smarty_tpl->tpl_vars['__smarty_section_show']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_show']->value['index'] : null)]['addtime_show'];?>
</td>
								<td><?php echo $_smarty_tpl->tpl_vars['result']->value['result'][(isset($_smarty_tpl->tpl_vars['__smarty_section_show']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_show']->value['index'] : null)]['order_status_show'];?>
</td>
								<td><?php echo $_smarty_tpl->tpl_vars['result']->value['result'][(isset($_smarty_tpl->tpl_vars['__smarty_section_show']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_show']->value['index'] : null)]['paytime_show'];?>
</td>
								<td><?php echo $_smarty_tpl->tpl_vars['result']->value['result'][(isset($_smarty_tpl->tpl_vars['__smarty_section_show']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_show']->value['index'] : null)]['use_status_show'];?>
</td>
								<td><?php echo $_smarty_tpl->tpl_vars['result']->value['result'][(isset($_smarty_tpl->tpl_vars['__smarty_section_show']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_show']->value['index'] : null)]['usetime_show'];?>
</td>
								<?php if ($_smarty_tpl->tpl_vars['result']->value['result'][(isset($_smarty_tpl->tpl_vars['__smarty_section_show']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_show']->value['index'] : null)]['channel'] == '转账/汇款' && $_smarty_tpl->tpl_vars['result']->value['result'][(isset($_smarty_tpl->tpl_vars['__smarty_section_show']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_show']->value['index'] : null)]['paytime_show'] == '') {?>
								<td><span class="div_order" data-id="<?php echo $_smarty_tpl->tpl_vars['result']->value['result'][(isset($_smarty_tpl->tpl_vars['__smarty_section_show']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_show']->value['index'] : null)]['order_id'];?>
" data-val="<?php echo $_smarty_tpl->tpl_vars['result']->value['result'][(isset($_smarty_tpl->tpl_vars['__smarty_section_show']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_show']->value['index'] : null)]['total_show'];?>
" data-rate="<?php echo $_smarty_tpl->tpl_vars['result']->value['result'][(isset($_smarty_tpl->tpl_vars['__smarty_section_show']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_show']->value['index'] : null)]['use_rate'];?>
"  style='color:#0a568c; font-weight:bold;cursor:pointer;' >编辑</span></td>
								<?php } else { ?>
								<td>--</td>
								<?php }?>
							</tr>
							<?php
}
}
if ($__section_show_0_saved) {
$_smarty_tpl->tpl_vars['__smarty_section_show'] = $__section_show_0_saved;
}
?>
							<tr>
								<td colspan="13"><?php echo $_smarty_tpl->tpl_vars['result']->value['page_info'];?>
</td>
							</tr>
						</tbody>
						<?php } else { ?>
						<tbody>
							<tr>
								<td colspan="13">暂无订单</td>
							</tr>
						</tbody>
						<?php }?>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="pop hide"></div>
<div class="popbox hide">
	<div id="div_edit">
		<form id="form_order">
			<p>
				&nbsp;&nbsp;&nbsp;订单号： <input type="text" id="order_id" name="order_id" disabled value="" >
			</p>
			<p>
				&nbsp;&nbsp;实际金额： <input type="text" id="money" name="money" value="" >
			</p>
			<p>
				&nbsp;&nbsp;&nbsp;折算美元： <input type="text" id="m_money" name="m_money" readOnly value="" >
			</p>
			<span style="color: red;font-size: 16px;">确定把未付款订单修改成已付款未兑换吗？</span><br>
			<input type="button" id="order_submit" value="确认">
			<input type="button" id="order_remo" value="取消">
		</form>
	</div>
</div>

</body>
</html>
<?php echo '<script'; ?>
>

	// 除法
  function accDiv(arg1, arg2) {
	var t1 = 0,
	  t2 = 0,
	  r1, r2;
	try {
	  t1 = arg1.toString().split(".")[1].length;
	} catch (e) {

	}
	try {
	  t2 = arg2.toString().split(".")[1].length;
	} catch (e) {

	}
	with(Math) {
	  r1 = Number(arg1.toString().replace(".", ""));
	  r2 = Number(arg2.toString().replace(".", ""));
	  return (r1 / r2) * pow(10, t2 - t1);
	}
  }

	$('#money').on('input',function(){
		 var rate = $(this).data('rate');
		 $('#m_money').val(!rate?0:accDiv($(this).val(),rate).toFixed(2));
	});

	$(document).on('click','.div_order',function () {
      $('.pop,.popbox').removeClass('hide');
      var order_id = $(this).data('id');
      var total = $(this).data('val');
			$('#order_id').val(order_id);
			$('#money').val(total.replace('￥','')).data('rate', $(this).data('rate')).trigger('input');
  });


	$('#order_remo').on('click',function () {
        $('.pop,.popbox').addClass('hide');
    });

	$('#order_submit').on('click',function () {
        var v_url = '/shopp/admin/goods_order.php?op=order_id';
        var order_id = $('#order_id').val();
        var v_data = {
            "order_id":order_id,
            'rmbmoney':$('#money').val(),
            'money':$('#m_money').val()
				};
        $.ajax({
            type: 'post',
            url: v_url,
            dataType: 'json',
            data: v_data,
            success: function(_json) {
                $('.pop,.popbox').addClass('hide');
                if(_json.success){
                    alert('修改成功');
                    location.reload();
				}
            }
        });
    });
	
	$(document).ready(function() 
	{
		var order_status = $("#order_status").val();
		if (order_status == -1 || order_status == 1)
		{
			$("#use_status_div").css({ display: "inline" });
		}
		else
		{
			$("#use_status_div").css({ display: "none" });
			$("#use_status").val("-1");
		}

		$("#order_status").change(function() 
		{
			var order_status = $("#order_status").val();
			if (order_status == -1 || order_status == 1)
			{
				$("#use_status_div").css({ display: "inline" });
			}
			else
			{
				$("#use_status_div").css({ display: "none" });
				$("#use_status").val("-1");
			}
		});

		//搜索
		$("#search").click(function() 
		{
			var price_start = $("#price_start").val() ? "&price_start=" + $("#price_start").val() : "";
			var price_end = $("#price_end").val() ? "&price_end=" + $("#price_end").val() : "";
			var paytime_start = $("#paytime_start").val() ? "&paytime_start=" + $("#paytime_start").val() : "";
			var paytime_end = $("#paytime_end").val() ? "&paytime_end=" + $("#paytime_end").val() : "";
			var usetime_start = $("#usetime_start").val() ? "&usetime_start=" + $("#usetime_start").val() : "";
			var usetime_end = $("#usetime_end").val() ? "&usetime_end=" + $("#usetime_end").val() : "";
			var order_status = $("#order_status").val() ? "&order_status=" + $("#order_status").val() : "";
			var use_status = $("#use_status").val() ? "&use_status=" + $("#use_status").val() : "";
			var keys = $("#keys").val() ? "&keys=" + $("#keys").val() : "";

			var url = "goods_order.php?page=1";
			var para = price_start + price_end + paytime_start + paytime_end + usetime_start + usetime_end + order_status + use_status + keys;
			window.location.href = url + para;
		});

		$("#reset").click(function() 
		{
			var url = "goods_order.php?order_status=1&use_status=-1&page=1";
			window.location.href = url;
		});
		
		//导出
		$("#output").click(function() 
		{
			var price_start = $("#price_start").val() ? "&price_start=" + $("#price_start").val() : "";
			var price_end = $("#price_end").val() ? "&price_end=" + $("#price_end").val() : "";
			var paytime_start = $("#paytime_start").val() ? "&paytime_start=" + $("#paytime_start").val() : "";
			var paytime_end = $("#paytime_end").val() ? "&paytime_end=" + $("#paytime_end").val() : "";
			var usetime_start = $("#usetime_start").val() ? "&usetime_start=" + $("#usetime_start").val() : "";
			var usetime_end = $("#usetime_end").val() ? "&usetime_end=" + $("#usetime_end").val() : "";
			var order_status = $("#order_status").val() ? "&order_status=" + $("#order_status").val() : "";
			var use_status = $("#use_status").val() ? "&use_status=" + $("#use_status").val() : "";
			var keys = $("#keys").val() ? "&keys=" + $("#keys").val() : "";

			var url = "goods_order.php?op=output";
			var para = price_start + price_end + paytime_start + paytime_end + usetime_start + usetime_end + order_status + use_status + keys;
			window.location.href = url + para;
		});
	});
<?php echo '</script'; ?>
><?php }
}
