<?php
/* Smarty version 3.1.30, created on 2018-03-15 15:13:20
  from "/u01/nginx/html/fic.cuilvshop.com/admin/templates/header.html" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_5aaa1d1096d310_29560610',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'f644b3a60e66737ad20296cf20447db13c11b09f' => 
    array (
      0 => '/u01/nginx/html/fic.cuilvshop.com/admin/templates/header.html',
      1 => 1521027338,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5aaa1d1096d310_29560610 (Smarty_Internal_Template $_smarty_tpl) {
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>后台管理系统</title>
	<link rel="stylesheet" href="css/global.css">
	<?php echo '<script'; ?>
 src="js/jquery.min.js"><?php echo '</script'; ?>
>
	<?php echo '<script'; ?>
 src="js/index.js"><?php echo '</script'; ?>
>
	<?php echo '<script'; ?>
 charset="utf-8" src="../kindeditor/kindeditor-min.js"><?php echo '</script'; ?>
>
	<?php echo '<script'; ?>
 charset="utf-8" src="../kindeditor/lang/zh_CN.js"><?php echo '</script'; ?>
>
</head>
<body>
<div class="navbar fix">
	<div class="logo fl">
		<a href="javascript:void(0);">
			<img src="img/logo.png" alt="">
		</a>
	</div>
	<div class="right-btn fr">
		<button class="green" onclick="window.location.href='admin_password.php'">修改密码</button>
		<button class="red" onclick="window.location.href='index.php?op=logout'">退出登录</button>
	</div>
</div>
<div class="main-container fix">
	<div class="sidebar-box fl">
		<div class="sidebar">
			<div class="account-msg fix">
				<div class="msg">
					<p style="margin-bottom: 20px"><?php echo $_SESSION['admin']['info']['username'];?>
</p>
					<p><span>身份：</span><?php echo $_SESSION['admin']['info']['group'];?>
</p>
				</div>
				<p class="times" id="time"></p>
			</div>
			<ul class="nav-list">
				<?php
$__section_show_0_saved = isset($_smarty_tpl->tpl_vars['__smarty_section_show']) ? $_smarty_tpl->tpl_vars['__smarty_section_show'] : false;
$__section_show_0_loop = (is_array(@$_loop=$_SESSION['admin']['action']) ? count($_loop) : max(0, (int) $_loop));
$__section_show_0_total = $__section_show_0_loop;
$_smarty_tpl->tpl_vars['__smarty_section_show'] = new Smarty_Variable(array());
if ($__section_show_0_total != 0) {
for ($__section_show_0_iteration = 1, $_smarty_tpl->tpl_vars['__smarty_section_show']->value['index'] = 0; $__section_show_0_iteration <= $__section_show_0_total; $__section_show_0_iteration++, $_smarty_tpl->tpl_vars['__smarty_section_show']->value['index']++){
?>
				<li>
					<a href="javascript:void(0);" class="dropdown-toggle">
						<span class="menu-text"><?php echo $_SESSION['admin']['action'][(isset($_smarty_tpl->tpl_vars['__smarty_section_show']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_show']->value['index'] : null)]['title'];?>
</span>
						<b class="arrow"></b>
					</a>
					<ul class="submenu">
						<?php
$__section_show_son_1_saved = isset($_smarty_tpl->tpl_vars['__smarty_section_show_son']) ? $_smarty_tpl->tpl_vars['__smarty_section_show_son'] : false;
$__section_show_son_1_loop = (is_array(@$_loop=$_SESSION['admin']['action'][(isset($_smarty_tpl->tpl_vars['__smarty_section_show']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_show']->value['index'] : null)]['son']) ? count($_loop) : max(0, (int) $_loop));
$__section_show_son_1_total = $__section_show_son_1_loop;
$_smarty_tpl->tpl_vars['__smarty_section_show_son'] = new Smarty_Variable(array());
if ($__section_show_son_1_total != 0) {
for ($__section_show_son_1_iteration = 1, $_smarty_tpl->tpl_vars['__smarty_section_show_son']->value['index'] = 0; $__section_show_son_1_iteration <= $__section_show_son_1_total; $__section_show_son_1_iteration++, $_smarty_tpl->tpl_vars['__smarty_section_show_son']->value['index']++){
?>
						<?php if ($_SESSION['admin']['action'][(isset($_smarty_tpl->tpl_vars['__smarty_section_show']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_show']->value['index'] : null)]['son'][(isset($_smarty_tpl->tpl_vars['__smarty_section_show_son']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_show_son']->value['index'] : null)]['checked'] == "checked") {?>
						<li>
							<a href="<?php echo $_SESSION['admin']['action'][(isset($_smarty_tpl->tpl_vars['__smarty_section_show']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_show']->value['index'] : null)]['son'][(isset($_smarty_tpl->tpl_vars['__smarty_section_show_son']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_show_son']->value['index'] : null)]['url'];?>
" <?php if ($_SESSION['admin']['action'][(isset($_smarty_tpl->tpl_vars['__smarty_section_show']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_show']->value['index'] : null)]['son'][(isset($_smarty_tpl->tpl_vars['__smarty_section_show_son']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_show_son']->value['index'] : null)]['url'] == $_SESSION['admin']['now_page']) {?>class="active"<?php }?>>
								<?php echo $_SESSION['admin']['action'][(isset($_smarty_tpl->tpl_vars['__smarty_section_show']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_show']->value['index'] : null)]['son'][(isset($_smarty_tpl->tpl_vars['__smarty_section_show_son']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_show_son']->value['index'] : null)]['title'];?>

							</a>
						</li>
						<?php }?>
						<?php
}
}
if ($__section_show_son_1_saved) {
$_smarty_tpl->tpl_vars['__smarty_section_show_son'] = $__section_show_son_1_saved;
}
?>
					</ul>
				</li>
				<?php
}
}
if ($__section_show_0_saved) {
$_smarty_tpl->tpl_vars['__smarty_section_show'] = $__section_show_0_saved;
}
?>
			</ul>
		</div>
	</div>
	<?php echo '<script'; ?>
>
		var left=$(".submenu");
		for(var i=0;i<left.length;i++){
			for(var j=0;j<left.eq(i).find("li").length;j++){
				if(left.eq(i).find("li").eq(j).find("a").hasClass("active")){
					left.eq(i).css("display","block");
				}
			}
		}
		$(".nav-list .dropdown-toggle").click(function(){
			if($(this).next().css("display")=="block"){			
				$(this).next().slideUp();
			}else{
				$(this).next().slideDown();
			}
		});
	<?php echo '</script'; ?>
><?php }
}
