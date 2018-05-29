<?php
/* Smarty version 3.1.30, created on 2018-04-05 10:40:48
  from "/u01/nginx/html/fic.sxgcsy.top/templates/ucenter_goods_order_list.html" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_5ac58cb084b5e7_81416509',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '8e73ee924726e981ccf26683517bf27e4aeb3590' => 
    array (
      0 => '/u01/nginx/html/fic.sxgcsy.top/templates/ucenter_goods_order_list.html',
      1 => 1522896024,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:header.html' => 1,
    'file:footer.html' => 1,
  ),
),false)) {
function content_5ac58cb084b5e7_81416509 (Smarty_Internal_Template $_smarty_tpl) {
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0;">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title><?php echo $_smarty_tpl->tpl_vars['server_name']->value['name'];?>
</title>
	<link rel="stylesheet" href="css/reset.css">
	<link rel="stylesheet" href="css/headFoot.css">
	<link rel="stylesheet" href="css/orderList.css">
</head>
<body>
<?php $_smarty_tpl->_subTemplateRender("file:header.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

	<div class="mobile-header">
		<span class="goback"></span>
		订单管理
		<span class="gohome"></span>
	</div>
	<div class="orderList">
		<div class="wrap">
			<div class="titTab">
				<span class="tab active">所有订单</span>
			</div>
			<?php if ($_smarty_tpl->tpl_vars['result']->value['nums'] != 0) {?>
			<ul class="lists">
				<li class="listDetail head">
					<span class="orderImg"></span>
					<span class="orderName">商品</span>
					<span class="orderUnitPrice">单价</span> 
					<span class="orderGoodsNum">数量</span> 
					<span class="orderPrice">合计金额（人民币）</span>
					<span class="orderStatus">交易状态</span>
					<span class="orderOperate">操作</span>
				</li>
				<?php
$__section_show_0_saved = isset($_smarty_tpl->tpl_vars['__smarty_section_show']) ? $_smarty_tpl->tpl_vars['__smarty_section_show'] : false;
$__section_show_0_loop = (is_array(@$_loop=$_smarty_tpl->tpl_vars['result']->value['result']) ? count($_loop) : max(0, (int) $_loop));
$__section_show_0_total = $__section_show_0_loop;
$_smarty_tpl->tpl_vars['__smarty_section_show'] = new Smarty_Variable(array());
if ($__section_show_0_total != 0) {
for ($__section_show_0_iteration = 1, $_smarty_tpl->tpl_vars['__smarty_section_show']->value['index'] = 0; $__section_show_0_iteration <= $__section_show_0_total; $__section_show_0_iteration++, $_smarty_tpl->tpl_vars['__smarty_section_show']->value['index']++){
?>
				<li class="listDetail body cl">
					<span class="orderId">
						<span class="orderTime"><?php echo $_smarty_tpl->tpl_vars['result']->value['result'][(isset($_smarty_tpl->tpl_vars['__smarty_section_show']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_show']->value['index'] : null)]['addtime_show'];?>
</span>
						订单号：<span class="orderNum"><?php echo $_smarty_tpl->tpl_vars['result']->value['result'][(isset($_smarty_tpl->tpl_vars['__smarty_section_show']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_show']->value['index'] : null)]['order_id'];?>
</span>
					</span>
					<span class="orderId">
						<lable style='color:red'>兑换码</lable>：<span class="orderNum codepwd" style="color: red;"><?php echo $_smarty_tpl->tpl_vars['result']->value['result'][(isset($_smarty_tpl->tpl_vars['__smarty_section_show']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_show']->value['index'] : null)]['order_code'];?>
</span>&nbsp;&nbsp;&nbsp;&nbsp;
						<label class="seecode" val='<?php echo $_smarty_tpl->tpl_vars['result']->value['result'][(isset($_smarty_tpl->tpl_vars['__smarty_section_show']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_show']->value['index'] : null)]['order_id'];?>
'><img style="cursor: pointer;" src="../shopp/img/eyeclose.png" /></label>
					</span>
					<span class="orderImg eyeimg">
						<img src="<?php echo $_smarty_tpl->tpl_vars['result']->value['result'][(isset($_smarty_tpl->tpl_vars['__smarty_section_show']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_show']->value['index'] : null)]['images_show'];?>
" alt="<?php echo $_smarty_tpl->tpl_vars['result']->value['result'][(isset($_smarty_tpl->tpl_vars['__smarty_section_show']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_show']->value['index'] : null)]['goods'];?>
" title="<?php echo $_smarty_tpl->tpl_vars['result']->value['result'][(isset($_smarty_tpl->tpl_vars['__smarty_section_show']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_show']->value['index'] : null)]['goods'];?>
">
					</span>
					<span class="orderName"><?php echo $_smarty_tpl->tpl_vars['result']->value['result'][(isset($_smarty_tpl->tpl_vars['__smarty_section_show']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_show']->value['index'] : null)]['goods'];?>
</span>
					<span class="orderUnitPrice">¥1.00</span>
					<span class="orderGoodsNum"><?php echo $_smarty_tpl->tpl_vars['result']->value['result'][(isset($_smarty_tpl->tpl_vars['__smarty_section_show']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_show']->value['index'] : null)]['count'];?>
 个</span>
					<span class="orderPrice"><?php echo $_smarty_tpl->tpl_vars['result']->value['result'][(isset($_smarty_tpl->tpl_vars['__smarty_section_show']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_show']->value['index'] : null)]['total_show'];?>
（约<?php echo $_smarty_tpl->tpl_vars['result']->value['result'][(isset($_smarty_tpl->tpl_vars['__smarty_section_show']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_show']->value['index'] : null)]['price_show'];?>
）</span>
					<span class="orderCode"><?php echo $_smarty_tpl->tpl_vars['result']->value['result'][(isset($_smarty_tpl->tpl_vars['__smarty_section_show']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_show']->value['index'] : null)]['order_status_show'];?>
</span>
					<span class="orderOperate">
						<?php echo $_smarty_tpl->tpl_vars['result']->value['result'][(isset($_smarty_tpl->tpl_vars['__smarty_section_show']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_show']->value['index'] : null)]['button'];?>

					</span>
				</li>
				<?php
}
}
if ($__section_show_0_saved) {
$_smarty_tpl->tpl_vars['__smarty_section_show'] = $__section_show_0_saved;
}
?>
			</ul>
			<div class="pager">
				<?php echo $_smarty_tpl->tpl_vars['result']->value['page_info'];?>

			</div>
			<?php } else { ?>
			<div style="line-height:50px;text-align:center;font-size:16px;">
				暂无订单
			</div>
			<?php }?>
		</div>
	</div>
 <?php $_smarty_tpl->_subTemplateRender("file:footer.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

</body>
<?php echo '<script'; ?>
 src="js/jquery.min.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="js/public.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
>
	function send_sms_code(order_id)
	{
		$.ajax({
			type: "post",
			url: "ucenter.php",
			data: { "op": "send_sms_code", "order_id": order_id },
			dataType: "json",
			success: function (data) {
				alert(data.Message);
			}
		});
	}
	(function($){
		$('.seecode').on('click',function(){
			orderid = $(this).attr('val');
			$this = $(this);
			$.ajax({
				type: "post",
				url: "ucenter.php",
				data: { "op": "see_code", "order_id": orderid },
				dataType: "json",
				success: function (data) {
					if(data.IsSuccess){
						$this.parent().find('span.codepwd').html(data.Message);
					}else{
						alert(data.Message);
					}
					
				}
			});
		});
	})(jQuery);
	<?php echo '</script'; ?>
>
</html><?php }
}
