<?php
/* Smarty version 3.1.30, created on 2018-03-01 17:49:43
  from "/u01/nginx/html/cuilvshop/shop/admin/templates/admin_password.html" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_5a97ccb7e84dc4_45516501',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'f6fb125713f3d40d88582a21596b541a296f9a06' => 
    array (
      0 => '/u01/nginx/html/cuilvshop/shop/admin/templates/admin_password.html',
      1 => 1518591981,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:header.html' => 1,
  ),
),false)) {
function content_5a97ccb7e84dc4_45516501 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_subTemplateRender("file:header.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

	<div class="main-content">
		<div class="breadcrumbs">
			管理员修改密码
		</div>
		<div class="page-content">
			<div class="linkmodify">
				<form action="admin_password.php?op=save" method="post">
				<div class="linkbox">
					<input type="hidden" name="id" value="<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
" />
					<div>
						<span class="tit">原始密码：</span>
						<input type="password" name="oldPassword" placeholder="输入内容" required="required" />
					</div>
					<div>
						<span class="tit">新密码：</span>
						<input type="password" name="newPassword" placeholder="输入内容" required="required" />
					</div>
					<div>
						<span class="tit">新密码确认：</span>
						<input type="password" name="verifyPassword" placeholder="输入内容" required="required" />
					</div>
					<div>
						<button type="submit" class="btn" id="submit" style="margin-left: 30%">提交</button>
					</div>
				</div>
				</form>
			</div>
		</div>
	</div>
</div>
</body>
</html><?php }
}
