<?php
/* Smarty version 3.1.30, created on 2018-03-26 12:24:55
  from "/u01/nginx/html/fic.sxgcsy.top/admin/templates/index.html" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_5ab876178e0342_38191227',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '993b8051db89b0b78f4bf40966f9728a8e00535c' => 
    array (
      0 => '/u01/nginx/html/fic.sxgcsy.top/admin/templates/index.html',
      1 => 1521027338,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5ab876178e0342_38191227 (Smarty_Internal_Template $_smarty_tpl) {
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>后台管理系统</title>
	<link href="css/global.css" rel="stylesheet">
	<?php echo '<script'; ?>
 src="js/jquery.min.js"><?php echo '</script'; ?>
>
</head>
<body class="login_box">
	<div class="login">
		<div>
			<form id="login_form" action="index.php?op=login" method="post">
			<div class="input_msg">
				<input type="text" name="username" placeholder="用户名">
				<input type="password" name="password" placeholder="密码">
				<button type="submit" class="btn" id="submit">登录</button>
			</div>
			</form>
		</div>
	</div>
</body>
</html><?php }
}
