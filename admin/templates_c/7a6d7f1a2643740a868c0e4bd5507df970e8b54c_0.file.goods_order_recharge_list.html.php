<?php
/* Smarty version 3.1.30, created on 2018-04-28 10:25:27
  from "E:\phpStudy\WWW\openepay\fic.xs9999\admin\templates\goods_order_recharge_list.html" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_5ae3db977162d1_88373589',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '7a6d7f1a2643740a868c0e4bd5507df970e8b54c' => 
    array (
      0 => 'E:\\phpStudy\\WWW\\openepay\\fic.xs9999\\admin\\templates\\goods_order_recharge_list.html',
      1 => 1524880056,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:header.html' => 1,
  ),
),false)) {
function content_5ae3db977162d1_88373589 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_subTemplateRender("file:header.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

	<link rel="stylesheet" type="text/css" href="css/jquery.datetimepicker.css"/>
	<?php echo '<script'; ?>
 src="js/jquery.datetimepicker.js"><?php echo '</script'; ?>
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
	</style>
	<div class="main-content">
		<div class="breadcrumbs">
			订单兑换列表
		</div>
		<div class="page-content">
			<div class="retrieval">
				<div id="news_filter" class="dataTables_filter">
					<span class="spaninline">
						<span class="tit">订单金额：</span>
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
						<span class="tit">兑换平台：</span>	
						<span class="label">
							<select id="recharge_platform_id" class="select-long">
								<option value="-1" <?php if ($_smarty_tpl->tpl_vars['recharge_platform_id']->value == "-1") {?>selected<?php }?>>全部</option>
								<option value="1" <?php if ($_smarty_tpl->tpl_vars['recharge_platform_id']->value == "1") {?>selected<?php }?>>鑫圣金业</option>
								<option value="2" <?php if ($_smarty_tpl->tpl_vars['recharge_platform_id']->value == "2") {?>selected<?php }?>>鑫圣钜丰</option>
								<option value="3" <?php if ($_smarty_tpl->tpl_vars['recharge_platform_id']->value == "3") {?>selected<?php }?>>鑫圣投资</option>
							</select>
						</span>
					</span>
					<span class="spaninline">
						<span class="tit">关键字：</span>
						<span class="label">
							<input type="search" id="keys" placeholder="订单号/账号/真实姓名/交易账号" value="<?php echo $_smarty_tpl->tpl_vars['keys']->value;?>
" aria-controls="news"  style="width:87%;">								
						</span>
					</span>
					<span>
							<input type="button" id="search" class="search-btn" value="搜索" />
							<input type="button" id="reset" class="search-btn" value="重置" />
							<input type="button" id="output" class="search-btn" value="导出" />
					</span>
				</div>
				<!--div class="dataTables_filter" style="margin-top:20px;">
					<div class="spaninline bluediv">
						<div class="blue-msg">
							<div class="num"><?php echo $_smarty_tpl->tpl_vars['result']->value['order_yestoday_statistics'];?>
</div>
							<div class="txt">昨日兑换总数</div>
						</div>
					</div>
				</div>
				<div class="dataTables_filter" style="margin-top:20px;">
					<div class="spaninline bluediv">
						<div class="blue-msg">
							<div class="num"><?php echo $_smarty_tpl->tpl_vars['result']->value['price_yestoday_statistics'];?>
</div>
							<div class="txt">昨日兑换总充入值</div>
						</div>
					</div>
				</div>
				<div class="dataTables_filter" style="margin-top:20px;">
					<div class="spaninline bluediv">
						<div class="blue-msg">
							<div class="num"><?php echo $_smarty_tpl->tpl_vars['result']->value['total_yestoday_statistics'];?>
</div>
							<div class="txt">昨日兑换总金额</div>
						</div>
					</div>
				</div>
				<div class="dataTables_filter" style="margin-top:20px;">
					<div class="spaninline bluediv">
						<div class="blue-msg">
							<div class="num"><?php echo $_smarty_tpl->tpl_vars['result']->value['order_today_statistics'];?>
</div>
							<div class="txt">今日兑换总数</div>
						</div>
					</div>
				</div>
				<div class="dataTables_filter" style="margin-top:20px;">
					<div class="spaninline bluediv">
						<div class="blue-msg">
							<div class="num"><?php echo $_smarty_tpl->tpl_vars['result']->value['price_today_statistics'];?>
</div>
							<div class="txt">今日兑换总充入值</div>
						</div>
					</div>
				</div>
				<div class="dataTables_filter" style="margin-top:20px;">
					<div class="spaninline bluediv">
						<div class="blue-msg">
							<div class="num"><?php echo $_smarty_tpl->tpl_vars['result']->value['total_today_statistics'];?>
</div>
							<div class="txt">今日兑换总金额</div>
						</div>
					</div>
				</div>
				<div class="dataTables_filter" style="margin-top:20px;">
					<div class="spaninline bluediv">
						<div class="blue-msg">
							<div class="num"><?php echo $_smarty_tpl->tpl_vars['result']->value['order_statistics'];?>
</div>
							<div class="txt">兑换总数</div>
						</div>
					</div>
				</div>
				<div class="dataTables_filter" style="margin-top:20px;">
					<div class="spaninline bluediv">
						<div class="blue-msg">
							<div class="num"><?php echo $_smarty_tpl->tpl_vars['result']->value['price_statistics'];?>
</div>
							<div class="txt">兑换总充入值</div>
						</div>
					</div>
				</div>
				<div class="dataTables_filter" style="margin-top:20px;">
					<div class="spaninline bluediv">
						<div class="blue-msg">
							<div class="num"><?php echo $_smarty_tpl->tpl_vars['result']->value['total_statistics'];?>
</div>
							<div class="txt">兑换总金额</div>
						</div>
					</div>
				</div-->
				<div class="tablebox">
					<table class="display listTable" cellpadding="0" cellspacing="0" border="0">
						<thead>
							<tr>
								<th>订单编号</th>
								<th>付款账号</th>
								<th>订单金额</th>
								<th>订单总价</th>
								<th>手续费率</th>
								<th>手续费</th>
								<th>支付来源</th>
								<th>支付通道</th>
								<th>支付时间</th>
								<th>兑换平台</th>
								<th>交易账号</th>
								<th>兑换金额</th>
								<th>兑换时间</th>
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
								<td><?php echo $_smarty_tpl->tpl_vars['result']->value['result'][(isset($_smarty_tpl->tpl_vars['__smarty_section_show']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_show']->value['index'] : null)]['mobile'];?>
（<?php echo $_smarty_tpl->tpl_vars['result']->value['result'][(isset($_smarty_tpl->tpl_vars['__smarty_section_show']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_show']->value['index'] : null)]['realname'];?>
）</td>
								<td><?php echo $_smarty_tpl->tpl_vars['result']->value['result'][(isset($_smarty_tpl->tpl_vars['__smarty_section_show']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_show']->value['index'] : null)]['price_show'];?>
</td>
								<td><?php echo $_smarty_tpl->tpl_vars['result']->value['result'][(isset($_smarty_tpl->tpl_vars['__smarty_section_show']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_show']->value['index'] : null)]['total_show'];?>
</td>
								<td><?php echo $_smarty_tpl->tpl_vars['result']->value['result'][(isset($_smarty_tpl->tpl_vars['__smarty_section_show']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_show']->value['index'] : null)]['scharge'];?>
</td>
								<td><?php echo $_smarty_tpl->tpl_vars['result']->value['result'][(isset($_smarty_tpl->tpl_vars['__smarty_section_show']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_show']->value['index'] : null)]['service_charge'];?>
</td>
								<td><?php echo $_smarty_tpl->tpl_vars['result']->value['result'][(isset($_smarty_tpl->tpl_vars['__smarty_section_show']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_show']->value['index'] : null)]['source'];?>
</td>
								<td><?php echo $_smarty_tpl->tpl_vars['result']->value['result'][(isset($_smarty_tpl->tpl_vars['__smarty_section_show']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_show']->value['index'] : null)]['channel'];?>
</td>
								<td><?php echo $_smarty_tpl->tpl_vars['result']->value['result'][(isset($_smarty_tpl->tpl_vars['__smarty_section_show']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_show']->value['index'] : null)]['paytime_show'];?>
</td>
								<td><?php echo $_smarty_tpl->tpl_vars['result']->value['result'][(isset($_smarty_tpl->tpl_vars['__smarty_section_show']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_show']->value['index'] : null)]['recharge_platform'];?>
</td>
								<td><?php echo $_smarty_tpl->tpl_vars['result']->value['result'][(isset($_smarty_tpl->tpl_vars['__smarty_section_show']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_show']->value['index'] : null)]['recharge_account'];?>
</td>
								<td><?php echo $_smarty_tpl->tpl_vars['result']->value['result'][(isset($_smarty_tpl->tpl_vars['__smarty_section_show']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_show']->value['index'] : null)]['recharge_total_show'];?>
</td>
								<td><?php echo $_smarty_tpl->tpl_vars['result']->value['result'][(isset($_smarty_tpl->tpl_vars['__smarty_section_show']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_show']->value['index'] : null)]['usetime_show'];?>
</td>
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
				<div class="tablebox" style="margin-bottom: 50px;">
					<h2 style="padding:20px 0;">统计周期：<?php echo $_smarty_tpl->tpl_vars['total_paytime_start']->value;?>
至<?php echo $_smarty_tpl->tpl_vars['total_paytime_end']->value;?>
</h2>
					<table class="display listTable" cellpadding="0" cellspacing="0" border="0" >
						<thead>
							<tr>
								<th>支付来源-支付通道</th>
								<th>订单金额（$）</th>
								<th>折算金额（￥）</th>
								<th>实际金额（￥）</th>
								<th>手续费（￥）</th>
								<th>到账金额（￥）</th>
							</tr>
						</thead>
						<?php if ($_smarty_tpl->tpl_vars['result']->value['nums'] != 0) {?>
						<tbody>
							<?php
$__section_show_1_saved = isset($_smarty_tpl->tpl_vars['__smarty_section_show']) ? $_smarty_tpl->tpl_vars['__smarty_section_show'] : false;
$__section_show_1_loop = (is_array(@$_loop=$_smarty_tpl->tpl_vars['total']->value) ? count($_loop) : max(0, (int) $_loop));
$__section_show_1_total = $__section_show_1_loop;
$_smarty_tpl->tpl_vars['__smarty_section_show'] = new Smarty_Variable(array());
if ($__section_show_1_total != 0) {
for ($__section_show_1_iteration = 1, $_smarty_tpl->tpl_vars['__smarty_section_show']->value['index'] = 0; $__section_show_1_iteration <= $__section_show_1_total; $__section_show_1_iteration++, $_smarty_tpl->tpl_vars['__smarty_section_show']->value['index']++){
?>
							<tr>
								<td><?php echo $_smarty_tpl->tpl_vars['total']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_show']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_show']->value['index'] : null)]['channel'];?>
</td>
								<td><?php echo $_smarty_tpl->tpl_vars['total']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_show']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_show']->value['index'] : null)]['dollar'];?>
</td>
								<td><?php echo $_smarty_tpl->tpl_vars['total']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_show']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_show']->value['index'] : null)]['cha'];?>
</td>
								<td><?php echo $_smarty_tpl->tpl_vars['total']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_show']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_show']->value['index'] : null)]['cha'];?>
</td>
								<td><?php echo $_smarty_tpl->tpl_vars['total']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_show']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_show']->value['index'] : null)]['rate'];?>
</td>
								<td><?php echo $_smarty_tpl->tpl_vars['total']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_show']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_show']->value['index'] : null)]['actcha'];?>
</td>
							</tr>
							<?php
}
}
if ($__section_show_1_saved) {
$_smarty_tpl->tpl_vars['__smarty_section_show'] = $__section_show_1_saved;
}
?>
							<tr>
								<td>合计</td>
								<td><?php echo $_smarty_tpl->tpl_vars['sum']->value['dollar'];?>
</td>
								<td><?php echo $_smarty_tpl->tpl_vars['sum']->value['cha'];?>
</td>
								<td><?php echo $_smarty_tpl->tpl_vars['sum']->value['cha'];?>
</td>
								<td><?php echo $_smarty_tpl->tpl_vars['sum']->value['rate'];?>
</td>
								<td><?php echo $_smarty_tpl->tpl_vars['sum']->value['actcha'];?>
</td>
							</tr>
						</tbody>
						<?php } else { ?>
						<tbody>
							<tr>
								<td colspan="6">暂无订单</td>
							</tr>
						</tbody>
						<?php }?>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
</body>
</html>
<?php echo '<script'; ?>
>
	$(document).ready(function() 
	{
		//搜索
		$("#search").click(function() 
		{
			var price_start = $("#price_start").val() ? "&price_start=" + $("#price_start").val() : "";
			var price_end = $("#price_end").val() ? "&price_end=" + $("#price_end").val() : "";
			var paytime_start = $("#paytime_start").val() ? "&paytime_start=" + $("#paytime_start").val() : "";
			var paytime_end = $("#paytime_end").val() ? "&paytime_end=" + $("#paytime_end").val() : "";
			var usetime_start = $("#usetime_start").val() ? "&usetime_start=" + $("#usetime_start").val() : "";
			var usetime_end = $("#usetime_end").val() ? "&usetime_end=" + $("#usetime_end").val() : "";
			var recharge_platform_id = $("#recharge_platform_id").val() ? "&recharge_platform_id=" + $("#recharge_platform_id").val() : "";
			var keys = $("#keys").val() ? "&keys=" + $("#keys").val() : "";

			var url = "goods_order_recharge_list.php?page=1";
			var para = price_start + price_end + paytime_start + paytime_end + usetime_start + usetime_end + recharge_platform_id + keys;
			window.location.href = url + para;
		});

		$("#reset").click(function() 
		{
			var url = "goods_order_recharge_list.php?recharge_platform_id=-1&page=1";
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
			var recharge_platform_id = $("#recharge_platform_id").val() ? "&recharge_platform_id=" + $("#recharge_platform_id").val() : "";
			var keys = $("#keys").val() ? "&keys=" + $("#keys").val() : "";

			var url = "goods_order_recharge_list.php?op=output";
			var para = price_start + price_end + paytime_start + paytime_end + usetime_start + usetime_end + recharge_platform_id + keys;
			window.location.href = url + para;
		});
	});
<?php echo '</script'; ?>
><?php }
}
