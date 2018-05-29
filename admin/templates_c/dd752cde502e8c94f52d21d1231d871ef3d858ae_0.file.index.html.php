<?php
/* Smarty version 3.1.30, created on 2018-04-09 16:00:05
  from "E:\phpStudy\WWW\openepay\fic.xs9999\admin\templates\index.html" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_5acb1d858f4152_99518991',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'dd752cde502e8c94f52d21d1231d871ef3d858ae' => 
    array (
      0 => 'E:\\phpStudy\\WWW\\openepay\\fic.xs9999\\admin\\templates\\index.html',
      1 => 1521027338,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5acb1d858f4152_99518991 (Smarty_Internal_Template $_smarty_tpl) {
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
