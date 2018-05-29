<?php
/* Smarty version 3.1.30, created on 2018-03-29 09:32:49
  from "/u01/nginx/html/fic.sxgcsy.top/templates/goods_quick.html" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_5abc42413ca924_17087583',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '1d603ae93b096f0ba6f22ced0b12412293f7b589' => 
    array (
      0 => '/u01/nginx/html/fic.sxgcsy.top/templates/goods_quick.html',
      1 => 1521713113,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:header.html' => 1,
    'file:footer.html' => 1,
  ),
),false)) {
function content_5abc42413ca924_17087583 (Smarty_Internal_Template $_smarty_tpl) {
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>国灿实业</title>
	<link rel="stylesheet" href="css/reset.css">
	<link rel="stylesheet" href="css/headFoot.css">
	<link rel="stylesheet" href="css/firmOrder.css">
	<link rel="stylesheet" href="css/goods_quick.css">
</head>
<body class="quick">
<?php $_smarty_tpl->_subTemplateRender("file:header.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

	<div class="mobile-header">
		<span class="goback"></span>
		在线支付
		<span class="gohome"></span>
	</div>
	<div class="firmOrder">
		<div class="tips">* 请使用您本人的借记卡，手机号码为银行预留手机。</div>
		<form id="form-quick">
			<div class="form-table">
				<label class="form-label">
					真实姓名：
				</label>
				<div class="form-cell">
					<input type="text" name="name" value="<?php echo $_smarty_tpl->tpl_vars['name']->value;?>
" class="form-input" placeholder="请输入您的姓名"/>
				</div>
			</div>
			<div class="form-table">
				<label class="form-label">
					身份证号：
				</label>
				<div class="form-cell">
					<input type="text" name="idcard" value="<?php echo $_smarty_tpl->tpl_vars['idcard']->value;?>
"class="form-input" placeholder="请输入您的身份证号"/>
				</div>
			</div>
			<div class="form-table">
				<label class="form-label">
					银行卡号：
				</label>
				<div class="form-cell">
					<input type="number" name="bank" class="form-input" placeholder="请输入您的银行卡号"/>
				</div>
			</div>
			<div class="form-table">
				<label class="form-label">
					银行名称：
				</label>
				<div class="form-cell">
					<div class="form-text" id="bankname_text">所属银行名称</div>
					<input type="hidden" name="bankname" class="form-input"/>
				</div>
			</div>
			<div class="form-table">
				<label class="form-label">
					手机号码：
				</label>
				<div class="form-cell">
					<input type="text" name="mobile" maxlength="11" value="<?php echo $_smarty_tpl->tpl_vars['mobile']->value;?>
" class="form-input" placeholder="请输入您的银行预留手机号"/>
				</div>
			</div>			
		</form>
		<div class="submitOrder">
			<div class="submitBtn">支付</div>
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
 src="js/goods_quick.js"><?php echo '</script'; ?>
>
</html><?php }
}
